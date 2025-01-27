<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use carbon\carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfilePageController extends Controller
{
    public $modual_name = '';
    public $title = '';
    public $view = '';

    public function __construct()
    {
        $this->view = 'backend.ProfilePage.';
        $this->title = 'Profile Page';
    }

    public function show($id)
    {
        $return_data['profilepage'] = User::find($id);
        return view($this->view . 'edit', $return_data);
    }
    public function index()
    {
        $id = '1';
        $return_data['site_title'] = $this->title;
        $return_data['profilepage'] = User::find($id);
        return view($this->view . 'edit', array_merge($return_data));
    }

    public function edit($id)
    {
        $return_data['profilepage'] = User::find($id);
        return view($this->view . 'edit', $return_data);
    }
    public function update(Request $request, $id)
    {
        // prx($id);
        $rules = [
            'email' => 'required|email|unique:users,email,' . $id,
        ];
        if (!empty($request->password)) {
            $rules['password'] = 'required|min:1|confirmed';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dateTime = Carbon::now();
        $user = User::find($id);
        $data = $request->only('email');

        if ($request->has('password')) {
            $password = Hash::make($request->password);
            $data['password'] = $password;
        }

        $dateTime = Carbon::now();
        $data['updated_at'] = $dateTime;

        $user = $user->update($data);
        session()->flash('success', 'profile updated successfully');
        return redirect()->back();
    }
}
