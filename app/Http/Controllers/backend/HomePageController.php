<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\HomePageSetting;
use carbon\carbon;
use Illuminate\Validation\Rule;

class HomePageController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->view = 'backend.HomePage.';
        $this->title = 'Home Page';
    }
    public function index()
    {
        $id = '1';
        $return_data['homepage'] =  $this->title;
        $return_data['setting'] = HomePageSetting::find($id);
        // prx($return_data);
        return view($this->view . 'edit', array_merge($return_data));
    }

    public function show()
    {
        $id = '1';
        $return_data['homepagesetting'] = HomePageSetting::find($id);
        $return_data['site_title'] =  $this->title;
        return view($this->view . 'edit', array_merge($return_data));
    }
    public function edit($id)
    {
        $id = '1';
        $return_data['homepage'] = HomePageSetting::find($id);


        return view($this->view . 'edit', array_merge($return_data));
    }




    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'link' => 'required|url',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dateTime = Carbon::now();
        $homepagesetting =  HomePageSetting::find($id);

        // prx($setting->logo );
        $data =  [
            'title' => request()->title,
            'description' => request()->description,
            'link' => request()->link,
        ];


        // Update the existing record
        $homepagesetting->update($data);
        // prx($homepagesetting);
        session()->flash('success', 'HomePage updated successfully');
        return redirect()->back();
    }
}
