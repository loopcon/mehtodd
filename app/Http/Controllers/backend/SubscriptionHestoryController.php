<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\VideoAds;
use App\Models\Video;
use App\Models\User;
use App\Models\SubscriptionHestory;
use App\DataTables\SubscriptionHestoryDatatable;
use App\Exports\SubscriptionHistoryExport;
use Maatwebsite\Excel\Facades\Excel;


class SubscriptionHestoryController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->view = 'backend.SubscriptionsHistory.';
        $this->title = 'Subscriptions';
    }
    
    public function index(SubscriptionHestoryDatatable $datatable)
    {
        $return_data = [];
        $return_data['site_title'] = trans($this->title);
        return $datatable->render($this->view . 'index', array_merge($return_data));
    }

    public function exportSubscriptionHistory()
    {
        return Excel::download(new SubscriptionHistoryExport, 'subscription_history.xlsx');
    }
}
