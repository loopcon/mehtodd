<?php


namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use carbon\carbon;
use Illuminate\Http\Request;
use App\Models\Video;
use App\DataTables\MaliciousVideoDatatable;
use App\Models\Category;
use App\Models\MaliciousVideo;
use App\Models\User;
use App\Models\VideoCategory;
use App\Models\VideoView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class MaliciousVideoController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->view = 'backend.MaliciousVideo.';
        $this->title = 'Malicious Videos';
    }

    // public function updateStatus(Request $request)
    // {
    //     $data = $request->all();
    //     prx($data);

    //     $videoQuery = Video::find($row->video_id);
    //     $videoQuery->update('status',0);
    //     if($videoQuery){
    //         $status = 200;
    //         $message = 'Video Blocked Sucessfully';

    //     }else {
    //         $status = 404;
    //         $message = 'Something Went Wrong';
    //     }
    //     return response()->json(['status' => $status, 'message' => $message], $status);
    // }

    public function updateStatus(Request $request)
    {
        // Get all the request data
        $data = $request->all();
        // prx($data);
        $videoId = $data['id'];
        $status = $data['status'];

        // Find the video by ID
        $videoQuery = Video::find($videoId);
        // prx([$videoQuery, $videoId]);

        // Check if the video exists
        if ($videoQuery) {
            // Update the status
            $videoQuery->status = $status;
            $videoQuery->save();

            // Set success status and message
            $status = 200;
            $message = 'Video Blocked Successfully';
        } else {
            // Set error status and message
            $status = 404;
            $message = 'Video not found';
        }

        // Return the response as JSON
        return response()->json(['status' => $status, 'message' => $message], $status);
    }



    public function index(MaliciousVideoDatatable $datatable)
    {
        $return_data = [];
        $return_data['site_title'] = trans($this->title);

        $datatableInstance = $datatable;

        $additionalData = request()->all();
        $datatableInstance->setAdditionalData($additionalData);

        $return_data['category_list'] = Category::all();
        $return_data['category_id'] = request()->category_id;

        $sub_category_3_list = [];
        $sub_category_4_list = [];
        $return_data['sub_category_1'] = request()->sub_category_1;
        $return_data['sub_category_1_list'] = Category::where('category_id', request()->category_id)->whereNotNull('category_id')->get();
        $return_data['sub_category_2'] = request()->sub_category_2;
        $return_data['sub_category_2_list'] = VideoCategory::where('sub_category_1', request()->sub_category_1)->whereNull('sub_category_2')->get();

        $return_data['sub_category_3'] = request()->sub_category_3;
        if (request()->sub_category_2 != null) {
            $sub_category_3_list = VideoCategory::where('sub_category_2', request()->sub_category_2)->whereNull('sub_category_3')->whereNull('sub_category_4')->get();
        }
        $return_data['sub_category_3_list'] = $sub_category_3_list;

        $return_data['sub_category_4'] = request()->sub_category_4;
        if (request()->sub_category_3 != null) {
            $sub_category_4_list = VideoCategory::where('sub_category_3', request()->sub_category_3)->whereNull('sub_category_4')->get();
        }
        $return_data['sub_category_4_list'] = $sub_category_4_list;

        return $datatable->render($this->view . 'index', $return_data);
    }


    // public function index(MaliciousVideoDatatable $datatable)
    // {
    //     $return_data = [];
    //     $return_data['site_title'] = trans($this->title);
    //     $datatableInstance = $datatable;
    //     $additionalData = [request()->all()];
    //     $datatableInstance->setAdditionalData($additionalData);
    //     $return_data['category_list'] = Category::get();
    //     $return_data['category_id'] = request()->category_id;
    //     $sub_category_3_list = [];
    //     $sub_category_4_list = [];
    //     $return_data['sub_category_1'] = request()->sub_category_1;
    //     $return_data['sub_category_1_list'] = Category::where('category_id', request()->category_id)->whereNotNull('category_id')->get();
    //     $return_data['sub_category_2'] = request()->sub_category_2;
    //     $return_data['sub_category_2_list'] = VideoCategory::where('sub_category_1', request()->sub_category_1)->whereNull('sub_category_2')->get();

    //     $return_data['sub_category_3'] = request()->sub_category_3;
    //     if (request()->sub_category_2 != null) {
    //         $sub_category_3_list = VideoCategory::where('sub_category_2', request()->sub_category_2)->whereNull('sub_category_3')->whereNull('sub_category_4')->get();
    //         // prx($sub_category_3_list);
    //     }
    //     $return_data['sub_category_3_list'] = $sub_category_3_list;

    //     $return_data['sub_category_4'] = request()->sub_category_4;
    //     if (request()->sub_category_3 != null) {
    //         $sub_category_4_list = VideoCategory::where('sub_category_3', request()->sub_category_3)->whereNull('sub_category_4')->get();
    //     }
    //     $return_data['sub_category_4_list'] = $sub_category_4_list;

    //     // prx(  $return_data['sub_category_4_list']);

    //     return $datatable->render($this->view . 'index', array_merge($return_data));
    // }

    // public function create()
    // {
    //     $return_data['users'] =  User::get()->pluck('username', 'id');
    //     return view($this->view . 'create', array_merge($return_data));
    // }


    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'title' => 'required|unique:videos',
    //         'user_id' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()
    //             ->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     $data = $request->all();

    //     $dateTime = Carbon::now();

    //     $data = [
    //         'title' => request()->title,
    //         'user_id' => request()->user_id,
    //         'created_at' => $dateTime,
    //         'updated_at' => $dateTime
    //     ];

    //     Video::create($data);

    //     session()->flash('success', 'User created successfully');
    //     return redirect()->route('videos.index');
    // }

    // public function edit($id)
    // {
    //     $return_data['users'] = User::get()->pluck('username', 'id');
    //     $return_data['video'] = Video::find($id);
    //     return view($this->view . 'edit', array_merge($return_data));
    // }


    // public function Update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'title' => 'required|unique:videos,title,' . $id,
    //         'user_id' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()
    //             ->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     $dateTime = Carbon::now();
    //     $video =  Video::find($id);

    //     $data =  [
    //         'title' => request()->title,
    //         'user_id' => request()->user_id,
    //         'updated_at' => $dateTime,
    //     ];

    //     $video->update($data);

    //     session()->flash('success', 'User updated successfully');
    //     return redirect()->route('videos.index');
    // }

    // public function destroy($id)
    // {
    //     $video = Video::find($id);
    //     $video->delete();
    //     return response()->json([
    //         'status' => 200,
    //         'message' => 'User deleted successfully',
    //     ]);
    // }


    // public function ChangeStatusVideo(Request $request)
    // {
    //     Video::find($request->row_id)->update(['status' => $request->value]);
    //     return response()->json(['status' => 200, 'message' => 'Video status change successfully.'], 200);
    // }

    // public function GetCategoryList(Request $request)
    // {
    //     // prx($request->all());
    //     $container_id = $request->data_level;
    //     $container_net_level = $request->data_level + 1;
    //     $categories = VideoCategory::all();

    //     if ($request->data_level == 0) {
    //         $categories = [];
    //         if ($request->category_id != '') {
    //             $categories = Category::where('category_id', $request->category_id)->pluck('name', 'id')->all();
    //         }
    //     } else {
    //         $categories = $categories->where('sub_category_' . $request->data_level, $request->category_id);
    //         if ($request->data_level == 1) {
    //             $categories = $categories->whereNull('sub_category_2')->whereNull('sub_category_3')->whereNull('sub_category_4');
    //         } elseif ($request->data_level == 2) {
    //             // prx(2);
    //             $categories = $categories->whereNull('sub_category_3')->whereNull('sub_category_4');
    //         } elseif ($request->data_level == 3) {
    //             // prx(3);
    //             $categories = $categories->whereNull('sub_category_4');
    //         }
    //         // prx($request->data_level);
    //         $categories = $categories->pluck('category_name', 'id')->all();
    //     }
    //     // if ($request->data_level == 1) {
    //     //     prx([$categories]);
    //     // }
    //     $name = 'sub_category_' . $container_net_level;
    //     $label = 'Sub Category ' . $container_net_level;

    //     $html_data = View::make('backend.GetCategoryDropDown.CategoryData', compact('name', 'categories', 'label'))->render();

    //     return response()->json([
    //         'html_data' => $html_data,
    //     ], 200);
    // }
    // public function addVideoWatchCount(Request $request)
    // {
    //     $user_id = Auth::id();

    //     $video_id = $request->video_id;

    //     $data = [
    //         'user_id' => $user_id,
    //         'video_id' => $video_id,
    //     ];
    //     $videoView = VideoView::create($data);

    //     return response()->json(['status' => 1, 'msg' => 'View added successfully', 'data' => $videoView]);
    // }
    // public function ChangeHomeShareStatus(Request $request)
    // {
    //     $id = $request->id;
    //     $video = Video::find($id);

    //     $share_home_page = '1';
    //     if ($video->share_home_page == '1') {
    //         $share_home_page = '0';
    //     }

    //     $video->update(['share_home_page' => $share_home_page]);

    //     return response()->json(['status' => 200, 'msg' => 'Video share status updated.'], 200);
    // }
}
