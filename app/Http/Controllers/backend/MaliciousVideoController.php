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

    public function GetVideoDescriptions(Request $request)
    {
        $dataId = $request->input('id');
        $dataIds = MaliciousVideo::where('id',$dataId)->first();
        // dd($dataIds);
        $message =$dataIds->description;
        // prx($message);
        return response()->json(['data'=> $message ],200);
    }

    public function GetVideoNotes(Request $request)
    {
        $dataId = $request->input('id');
        $getVideo = MaliciousVideo::where('id',$dataId)->first();
        $getVideoId = $getVideo->video_id;
        $dataIds = Video::where('id',$getVideoId)->first();
        $message =$dataIds->note;
        // prx($dataIds);
        return response()->json(['data'=> $message ],200);
    }

    public function updateStatus(Request $request)
    {
        $data = $request->all();
        $videoId = $data['id'];
        $status = $data['status'];
        $note = $data['note'];

        $videoQuery = Video::find($videoId);

        if ($videoQuery) {
            $videoQuery->status = $status;
            $videoQuery->note = $note;
            $videoQuery->save();

            $status = 200;
            $message = 'Video Blocked Successfully';
        } else {
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

}
