<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\VideoAds;
use App\Models\Video;
use App\Models\User;
use App\DataTables\VideoAdsDatatable;
use App\Exports\VideoAdsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class VideoAdsController  extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->view = 'backend.VideoAds.';
        $this->title = 'Video Ads';
    }

    public function generateInvoicePdf($id)
    {
        $subInvoice = VideoAds::where('video_id', $id)->first();
        $videoDetails = Video::where('id', $subInvoice->video_id)->first();
        // dd($videoDetails);
        // $subTransaction = User::where('user_id', $subInvoice->user_id)
        //     ->where('subscription_id', $subInvoice->subscription_id)
        //     ->first();
        $data = [
            "title" => "PDF Generate",
            "subInvoice" => $subInvoice,
            "videoDetails" => $videoDetails,
            // "subTransaction" => $subTransaction,
        ];
        $pdf = Pdf::loadView('backend.Invoice.subscription_inv_pdf', $data);
        return $pdf->download('invoice_' . $id . '.pdf');
    }

    public function PurchaseDetails($id)
    {
        $return_data = [];

        $site_title = trans($this->title);
        $getData = VideoAds::find($id);

        $videoData = Video::find($getData->video_id);
        // dd($data);

        $userData = User::find($videoData->user_id);
        // dd($userData); 

        // dd($getData);
        // $service = Service::get()->pluck('name', 'id');
        return view($this->view . 'view', compact('site_title', 'getData', 'videoData', 'userData'));
    }

    public function index(VideoAdsDatatable $datatable)
    {
        $return_data = [];
        $return_data['site_title'] = trans($this->title);
        return $datatable->render($this->view . 'index', array_merge($return_data));
    }

    public function exportVideoAds()
    {
        return Excel::download(new VideoAdsExport, 'Video_Ads.xlsx');
    }
}
