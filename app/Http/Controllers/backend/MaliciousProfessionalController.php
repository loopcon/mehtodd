<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use carbon\carbon;
use Illuminate\Http\Request;
use App\Models\Video;
use App\DataTables\MaliciousVideoDatatable;
use App\DataTables\MaliciousProfessionalDatatable;
use App\Models\Category;
use App\Models\MaliciousVideo;
use App\Models\MaliciousProfile;
use App\Models\User;
use App\Models\VideoCategory;
use App\Models\VideoView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class MaliciousProfessionalController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->view = 'backend.MaliciousProfile.';
        $this->title = 'Malicious Professional';
    }

    public function updateStatusProfessional(Request $request)
    {
        $data = $request->all();
        // prx($data);
        $professionalId = $data['user_id'];
        $status = $data['status'];
        $note = $data['note'];
        // dd($status);
        $Query = User::find($professionalId);
        // dd($Query);
        if ($Query) {
            $Query->status = $status;
            $Query->note = $note;
            $Query->save();
            $status = 200;
            $message = 'Profile Blocked Successfully';
        } else {
            $status = 404;
            $message = 'Profile not found';
        }
        return response()->json(['status' => $status, 'message' => $message], $status);
    }

    public function index(MaliciousProfessionalDatatable $datatable)
    {
        $return_data = [];
        $return_data['site_title'] = trans($this->title);


        $getData = MaliciousProfile::all();
        // dd($getData);

        return $datatable->render($this->view . 'index', $return_data);
    }

    public function GetDescriptions(Request $request)
    {
        $dataId = $request->input('id');
        $dataIds = MaliciousProfile::where('id',$dataId)->first();
        $message =$dataIds->descriptions;
        // prx($message);
        return response()->json(['data'=> $message ],200);
    }

    public function GetNotes(Request $request)
    {
        $dataId = $request->input('id');
        $getUser = MaliciousProfile::where('id',$dataId)->first();
        $getUserId = $getUser->user_id;
        $dataIds = User::where('id',$getUserId)->first();
        $message =$dataIds->note;
        // prx($dataIds);
        return response()->json(['data'=> $message ],200);
    }

}
