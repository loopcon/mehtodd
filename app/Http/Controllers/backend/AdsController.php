<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Ads;

class AdsController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->view = 'backend.Ads.';
        $this->title = 'Ads';
    }

    public function index()
    {
        $ads = Ads::first();
        if (!$ads) {
            abort(404);
        }
        $return_data['ads'] = $ads;
        $return_data['site_title'] = $this->title;
        return view($this->view . 'edit', $return_data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'profile_adds' => 'required|integer',
            'video_adds' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $ads = Ads::find($id);
        $data = $request->all();
        $ads->update($data);

        session()->flash('success', 'ads updated successfully');
        return redirect()->route('ads.index');
    }
}
