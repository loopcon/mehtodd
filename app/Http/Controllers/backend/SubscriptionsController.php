<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use carbon\carbon;
use App\DataTables\SubscriptionDatatable;
use App\Models\{Module, Subscription, SubscriptionAccess, SubscriptionDescription};
use Illuminate\Support\Facades\Validator;

class SubscriptionsController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->view = 'backend.subscription.';
        $this->title = 'Subscriptions';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubscriptionDatatable $datatable)
    {
        $return_data = [];
        $return_data['site_title'] = trans($this->title);
        return $datatable->render($this->view . 'index', array_merge($return_data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $return_data = [];
        $site_title = trans($this->title);
        $modules = Module::get()->pluck('name', 'id')->toArray();
        return view($this->view . 'create', compact('site_title', 'modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'model_type' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $dateTime = GetDateTime();
        $data = [];
        $data = [
            'model_type' => $request->model_type,
            'title' => $request->title,
            'price' => $request->price,
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
        ];
        $subscription = Subscription::create($data);

        $subscriptionDescription = [];
        foreach ($request->description as $description) {
            $subscriptionDescription[] = [
                'subscription_id' => $subscription->id,
                'description' => $description,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ];
        }
        $subscription = SubscriptionDescription::insert($subscriptionDescription);

        $moduleIds = $request->module;

        $subscriptionAccess = [];

        foreach ($moduleIds as $key => $value) {

            $subscriptionAccess[] = [
                'subscription_id' => $subscription->id,
                'module_id' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!is_null($subscriptionAccess)) {
            SubscriptionAccess::insert($subscriptionAccess);
        }

        session()->flash('success', 'Subscription created successfully');
        return redirect()->route('subscriptions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        prx(12);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $return_data = [];
        $return_data['site_title'] = trans($this->title);
        $return_data['subscriptionData'] = Subscription::find($id);
        $return_data['descriptionData'] = SubscriptionDescription::where('subscription_id', $id)->get();

        $moduleIds = $return_data['subscriptionData']->subscriptionAccesses()->pluck('module_id')->toArray();

        if (!$return_data['subscriptionData']) {
            session()->flash('error', 'Subscriptions not found.');
            return redirect()->route('subscriptions.index');
        }
        $modules = Module::get()->pluck('name', 'id')->toArray();
        return view($this->view . 'edit', array_merge($return_data), compact('modules', 'moduleIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'model_type' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dateTime = GetDateTime();

        $descriptionList = SubscriptionDescription::where('subscription_id', $request->id)->delete();

        $subscription = Subscription::find($request->id)->update([
            'title' => $request->title,
            'model_type' => $request->model_type,
            'price' => $request->price,
            'updated_at' => $dateTime,
        ]);

        $subscriptionDescription = [];

        foreach ($request->description as $description) {
            $subscriptionDescription[] = [
                'subscription_id' => $request->id,
                'description' => $description,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ];
        }
        $subscription = SubscriptionDescription::insert($subscriptionDescription);

        $moduleIds = $request->module;

        $subscriptionAccess = [];

        SubscriptionAccess::where('subscription_id', $request->id)->delete();

        if (!is_null($request->module)) {
            foreach ($request->module as $key => $value) {
                $subscriptionAccess[] = [
                    'subscription_id' => $request->id,
                    'module_id' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        if (!is_null($subscriptionAccess)) {
            SubscriptionAccess::insert($subscriptionAccess);
        }


        session()->flash('success', 'Subscriptions updated successfully');
        return redirect()->route('subscriptions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscription = Subscription::find($id);
        $subscription->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Subscription deleted Successfully',
        ]);
    }

    public function ChangeStatusSubscription(Request $request)
    {
        $subscriptionData = Subscription::where('id', $request->row_id)->update(['status' => $request->value]);
        if ($subscriptionData) {
            session()->flash('success', 'Status updated successfully');
        } else {
            session()->flash('error', "There is some thing went, Please try after some time.");
        }
        return redirect()->route('subscriptions.index');
    }
}
