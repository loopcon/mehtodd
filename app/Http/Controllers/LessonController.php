<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\PrivateLessonUser;
use App\Models\User;
use App\Models\Video;
use App\Models\VideoLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    public $perPage = 5,
        $pageNo = 0;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function addVideoToLesson(Request $request)
    {
        $videoId = $request->input('video_id');
        $lessonIds = $request->input('lesson_id');

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'video_id' => 'required',
            'lesson_id' => 'required|array',
            'lesson_id.*' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Get the existing lesson IDs associated with the video
        $existingLessonIds = VideoLesson::where('video_id', $videoId)->pluck('lesson_id')->toArray();

        // Determine which lessons to add and which to remove
        $lessonsToAdd = array_diff($lessonIds, $existingLessonIds);
        $lessonsToRemove = array_diff($existingLessonIds, $lessonIds);

        // Add new associations
        foreach ($lessonsToAdd as $lessonId) {
            VideoLesson::create([
                'video_id' => $videoId,
                'lesson_id' => $lessonId,
            ]);
        }

        // Remove deselected associations
        if (!empty($lessonsToRemove)) {
            VideoLesson::where('video_id', $videoId)->whereIn('lesson_id', $lessonsToRemove)->delete();
        }

        return response()->json(['message' => 'Video associations updated successfully'], 200);
    }

    public function GetLessonDrpHtml(Request $request)
    {
        // prx($request->all());
        $video_id = $request->video_id;
        $lessons = Lesson::where('user_id', Auth::id())->pluck('name', 'id');
        $selected_lessons = videoLesson::where('video_id', $video_id)->pluck('lesson_id');
        $selected_lesson_names = $lessons->only($selected_lessons)->values();
        // prx([$selected_lesson_names]);

        $htmlContent = view('frontend.profile.lesson.get-lesson-drp', compact('selected_lesson_names', 'video_id', 'lessons', 'selected_lessons'))->render();
        // prx([ $htmlContent]);
        return response()->json(['html' => $htmlContent]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'create';

        $user_id = Auth::id();

        $users = User::where('id', '!=', $user_id)->latest()->get()->pluck('displayname', 'id')->toArray();

        ['videos' => $videos, 'count' => $count] = $this->getVideos($user_id);

        $data = view('frontend.profile.get-lesson-data', compact('videos', 'action', 'users'))->render();
        return response()->json(['status' => 200, 'msg' => 'Data load successfully.', 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'users' => 'required_if:is_private,on', // Validate user_id only if is_private is 'on'
        ]);

        $lesson = Lesson::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'is_private' => $request->is_private ? '1' : '0',
        ]);
        if (request()->has('video_id')) {
            $lessonVideos = [];
            $videoIds = request()->get('video_id');

            if (count($videoIds) > 0) {
                foreach ($videoIds as $key => $value) {
                    $lessonVideos[] = [
                        'video_id' => $value,
                        'lesson_id' => $lesson->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                VideoLesson::insert($lessonVideos);
            }
        }
        if (request()->has('is_private')) {
            $privateLessonsUsers = [];
            $users = request()->get('users');
            if (is_array($users) && count($users) > 0) {
                foreach ($users as $key => $value) {
                    $privateLessonsUsers[] = [
                        'user_id' => $value,
                        'lesson_id' => $lesson->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                PrivateLessonUser::insert($privateLessonsUsers);
            }
        }

        return response()->json(['status' => 200, 'msg' => 'Video added successfully.'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        $action = 'edit';

        $user_id = Auth::id();

        $users = User::where('id', '!=', $user_id)->latest()->get()->pluck('displayname', 'id')->toArray();

        $selectedUsers = $lesson->privateUsers()->pluck('user_id')->toArray();

        ['videos' => $videos, 'videoIds' => $videoIds, 'count' => $count] = $this->getVideos($user_id, $lesson->id, true);

        $data = view('frontend.profile.get-lesson-data', compact('videos', 'action', 'videoIds', 'lesson', 'users', 'selectedUsers'))->render();

        return response()->json(['status' => 200, 'msg' => 'Data load successfully.', 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'users' => 'required_if:is_private,on', // Validate user_id only if is_private is 'on'
        ]);
        $isPrivate = $request->is_private ? '1' : '0';

        $lesson->name = $request->name;
        $lesson->is_private = $isPrivate;
        $lesson->save();

        $existingVideoIds = VideoLesson::where('lesson_id', $lesson->id)
            ->pluck('video_id')
            ->toArray();
        $videoIds = request()->has('video_id') ? request()->get('video_id') : [];
        $videosToDelete = array_diff($existingVideoIds, $videoIds);
        if (!empty($videosToDelete)) {
            VideoLesson::where('lesson_id', $lesson->id)
                ->whereIn('video_id', $videosToDelete)
                ->delete();
        }
        // Prepare the new VideoLesson records
        $lessonVideos = [];
        foreach ($videoIds as $value) {
            $lessonVideos[] = [
                'video_id' => $value,
                'lesson_id' => $lesson->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        VideoLesson::insert($lessonVideos);
        if ($isPrivate == 0) {
            PrivateLessonUser::where('lesson_id', $lesson->id)->delete();
        } else {
            $existingUserIds = PrivateLessonUser::where('lesson_id', $lesson->id)
                ->pluck('user_id')
                ->toArray();
            $userIds = $request->has('users') ? $request->users : [];
            $usersToDelete = array_diff($existingUserIds, $userIds);
            if (!empty($usersToDelete)) {
                PrivateLessonUser::where('lesson_id', $lesson->id)
                    ->whereIn('user_id', $usersToDelete)
                    ->delete();
            }

            $privateLessonUsers = [];
            foreach ($userIds as $value) {
                $privateLessonUsers[] = [
                    'user_id' => $value,
                    'lesson_id' => $lesson->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            PrivateLessonUser::insert($privateLessonUsers);
        }

        return response()->json(['status' => 200, 'msg' => 'Lesson updated successfully.']);
    }

    public function getMoreLessonVideos($pageNo, $lesson_id = null)
    {
        $this->pageNo = $pageNo;

        $user_id = Auth::id();
        $data = $this->getVideos($user_id, $lesson_id ?? null);
        $action = !$lesson_id ? 'create' : '';

        $videos = $data['videos'];
        $videoIds = $data['videoIds'] ?? null;
        $count = $data['count'];

        $data = view('frontend.profile.lesson.load-more', compact('videos'))->render();

        return response()->json(['status' => 200, 'msg' => 'Data load successfully.', 'data' => $data]);
    }

    public function getVideos(int $user_id, $lesson_id = null, $is_selected = false)
    {
        $videosSql = Video::where('user_id', $user_id);
        $countSql = clone $videosSql;
        $count = $countSql->count();

        if (!$lesson_id) {
            $videos = $videosSql
                ->skip($this->pageNo * $this->perPage)
                ->take($this->perPage)
                ->get();

            return ['videos' => $videos, 'count' => $count];
        } else {
            $videoIds = VideoLesson::where('lesson_id', $lesson_id)->get()->pluck('video_id')->toArray();

            $unSelectedVideosSql = clone $videosSql;
            $unSelectedVideos = $unSelectedVideosSql
                ->whereNotIn('id', $videoIds)
                ->skip($this->pageNo * $this->perPage)
                ->take($this->perPage)
                ->get();

            if ($is_selected) {
                $selectedVideoSql = clone $videosSql;
                $selectedVideo = $selectedVideoSql->whereIn('id', $videoIds)->get();
                $videos = $selectedVideo->concat($unSelectedVideos);
            } else {
                $videos = $unSelectedVideos;
            }
            return ['videos' => $videos, 'videoIds' => $videoIds, 'count' => $count];
        }
    }
}
