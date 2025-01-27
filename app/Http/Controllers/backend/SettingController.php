<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use carbon\carbon;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->view = 'backend.Setting.';
        $this->title = 'Settings';
    }
    public function show()
    {
        $id = '1';
        $return_data['setting'] = Setting::find($id);
        $return_data['site_title'] =  $this->title;
        return view($this->view . 'edit', array_merge($return_data));
    }
    public function index()
    {
        $id = '1';
        $return_data['site_title'] =  $this->title;
        $return_data['setting'] = Setting::find($id);
        return view($this->view . 'edit', array_merge($return_data));
    }




    public function edit($id)
    {
        $id = '1';
        $return_data['setting'] = Setting::find($id);
        return view($this->view . 'edit', array_merge($return_data));
    }



    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'site_name' => 'required',
            'adminemail' => 'required',
            'contact_email' => 'required',
            'address' => 'required',
            'aboutus' => 'required',
            'canonical' => 'required',
            'phone' => 'required|regex:/^[0-9]{10,15}$/',
            // 'fb' => 'required|url',
            // 'insta' => 'required|url',
            // 'twitter' =>  'required|url' ,
            'googletagmanager' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dateTime = Carbon::now();
        $setting =  Setting::find($id);

        // prx($setting->logo );
        $data =  [
            'site_name' => request()->site_name,
            'phone' => request()->phone,
            'address' => request()->address,
            'aboutus' => request()->aboutus,
            'contact_email' => request()->contact_email,
            'youtube' => request()->youtube,
            'fb' => request()->fb,
            'insta' => request()->insta,
            'copyright_year' => request()->copyright_year,
            'adminemail' => request()->adminemail,
            // 'fevicon' => request()->fevicon,
            'seo_title' => request()->seo_title,
            'meta_keyword' => request()->meta_keyword,
            'meta_description' => request()->meta_description,
            'canonical' => request()->canonical,
            'googletagmanager' => request()->googletagmanager,
            // 'password' => request()->password,
            'twitter' => request()->twitter,


        ];
        // prx($data);
        // prx(public_path('test'));
        
        if ($request->hasFile('logo')) {
            // Delete the old profile video if it exists
            $oldFilename = $setting->logo;
            if ($request->has('logo') && Storage::disk('public')->exists('logo/' . $oldFilename)) {
                Storage::disk('public')->delete('logo/' . $setting->logo);
            }

            $filename = ImageUploadTrait::updateImage($oldFilename, $request->file('logo'), 'logo');
            $data['logo'] = $filename;
        } else {
            unset($data['logo']);
        }

        if ($request->hasFile('fevicon')) {
            $oldFilename = $setting->fevicon;
            $filename = ImageUploadTrait::updateImage($oldFilename, $request->file('fevicon'), 'fevicon');
            $data['fevicon'] = $filename;
        } else {
            unset($data['fevicon']);
        }

        // Update the existing record
        $setting = Setting::findOrFail($id);
        $setting->update($data);
        // prx($setting);
        session()->flash('success', 'setting updated successfully');
        return redirect()->back();
    }
}
