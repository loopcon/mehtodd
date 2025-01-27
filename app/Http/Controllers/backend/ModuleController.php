<?php

namespace App\Http\Controllers\backend;

use App\DataTables\ModuleDataTable;
use App\Models\Module;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Models\Subscription;
use App\Models\SubscriptionAccess;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public $modual_name = '';
    public $title = '';
    public $view = '';

    public function __construct()
    {
        $this->title = 'Module';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ModuleDataTable $datatable)
    {
        $return_data['site_title'] = trans($this->title);
        return $datatable->render('backend.module.index', array_merge($return_data));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        $subscriptions = Subscription::get()->pluck('title', 'id')->toArray();
        $subscriptionAccess = SubscriptionAccess::where('module_id', $module->id)
            ->get()
            ->pluck('subscription_id')
            ->toArray();
        return view('backend.module.edit', compact('module', 'subscriptions', 'subscriptionAccess'));
    }

    public function Update(Module $module, Request $request)
    {
        $subscriptionsIds = $request->subscriptions;
        $module->label = $request->label;
        $module->save();

        SubscriptionAccess::where('module_id', $module->id)->delete();

        $subscriptionAccess = [];

        if (isset($subscriptionsIds) && count($subscriptionsIds) > 0) {
            foreach ($subscriptionsIds as $key => $value) {
                $subscriptionAccess[] = [
                    'subscription_id' => $value,
                    'module_id' => $module->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        if (!is_null($subscriptionAccess)) {
            SubscriptionAccess::insert($subscriptionAccess);
        }
        return redirect()->route('module.index');
    }
}
