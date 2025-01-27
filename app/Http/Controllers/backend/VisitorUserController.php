<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use carbon\carbon;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
// use App\Models\VisitorUser;
use App\Models\User;
use App\DataTables\VistiorUserDatatable;
use App\Models\Service;
use App\Models\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VisitorUserController extends Controller
{
    public $modual_name = '';
    public $title = '';
    public $view = '';

    public function __construct()
    {
        $this->view = 'backend.VistiorUser.';
        $this->title = 'Vistior User';
    }

    public function index(VistiorUserDatatable $datatable)
    {
        $return_data = [];
        $return_data['site_title'] = trans($this->title);
        return $datatable->render($this->view . 'index', array_merge($return_data));
    }


    public function create()
    {
        $return_data = [];
        $site_title = trans($this->title);
        $service = Service::get()->pluck('name', 'id');
        return view($this->view . 'create', compact('site_title', 'service'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'fullname' => 'required',
            'displayname' => 'required',
            'mobile_number' => 'required|regex:/^[0-9]{10,15}$/',
            'instaname' => 'nullable', // Assuming instaname is part of your request data
            'instalink' => $request->instaname ? 'required' : '', // Conditional validation
            'twittername' => 'nullable', // Assuming instaname is part of your request data
            'twitterlink' => $request->twittername ? 'required' : '', // Conditional validation
        ]);
        $data = ['fullname' => $request->fullname];
        $fullSlug = GetSlug($data);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $randomPassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+[]{}|;:,.<>?'), 0, 12);
        $password = Hash::make($randomPassword);

        $data = ['fullname' => request()->fullname,
         'displayname' => request()->displayname,
          'email' => request()->email, 
          'mobile_number' => request()->mobile_number, 
          'role_id' => 3,  
          'password' => $password, 
          'slug' => $fullSlug, 
          'instaname' => request()->instaname,
          'instalink' => request()->instalink,
          'twittername' => request()->twittername,
          'twitterlink' => request()->twitterlink,
        ];
    //   prx($data);
        $dateTime = Carbon::now();
        $data['created_at'] = $dateTime;
        $data['updated_at'] = $dateTime;

        if ($request->hasFile('profile_photo')) {
            $filename = ImageUploadTrait::uploadImage($request->file('profile_photo'), 'profilephoto');
            $data['profile_photo'] = $filename;
        }
        $user = User::create($data);
        // prx($user);
        if (request()->has('services')) {
            $services = [];

            foreach (request()->services as $key => $value) {
                $services[] = ['user_id' => $user->id, 'service_id' => $value];
            }
            UserService::insert($services);
        }
        session()->flash('success', 'Vistior User created successfully');
        return redirect()->route('user.visitor.index');
    }

    public function edit(User $user)
    {
        $return_data = [];
        $site_title = trans($this->title);
        $service_list = Service::get()->pluck('name', 'id');
        $service = UserService::where('user_id', $user->id)
            ->join('services', 'user_services.service_id', '=', 'services.id')
            ->select('services.id', 'services.name as name')
            ->get();
        return view($this->view . 'edit', compact('site_title', 'service', 'user', 'service_list'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . $id,
            'fullname' => 'required',
            'displayname' => 'required',
            'mobile_number' => 'required|regex:/^[0-9]{10,15}$/',
            'instaname' => 'nullable', // Assuming instaname is part of your request data
            'instalink' => $request->instaname ? 'required' : '', // Conditional validation
            'twittername' => 'nullable', // Assuming instaname is part of your request data
            'twitterlink' => $request->twittername ? 'required' : '', // Conditional validation
        ]);
        $data = ['fullname' => $request->fullname];
        $fullSlug = GetSlug($data);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::find($id);
        $data = [
            'email' => request()->email,
            'mobile_number' => request()->mobile_number,
            'role_id' => 3,
            'fullname' => request()->fullname,
            'displayname' => request()->displayname,
            'instalink' => request()->instalink,
            'twitterlink' => request()->twitterlink,
            'slug' => $fullSlug,
            'instaname' => request()->instaname,
            'instalink' => request()->instalink,
            'twittername' => request()->twittername,
            'twitterlink' => request()->twitterlink,
        ];

// prx($data);
        if ($request->hasFile('profile_photo')) {
            $filename = ImageUploadTrait::updateImage($user->profile_photo, $request->file('profile_photo'), 'profilephoto');
            $data['profile_photo'] = $filename;
        }

        $user->update($data);
        // prx($data);

        $existing_services = UserService::where('user_id', $user->id)->get();

        if (request()->has('services')) {
            foreach ($existing_services as $key => $value) {
                $serviceId = $value->id;
                if (!in_array($serviceId, request()->services)) {
                    UserService::where('id', $value->id)->delete();
                }
            }
            foreach (request()->services as $key => $value) {
                $query = UserService::where('service_id', $value)
                    ->where('user_id', $value)
                    ->first();
                if (!$query) {
                    $data = [
                        'service_id' => $value,
                        'user_id' => $id,
                    ];
                    UserService::insert($data);
                }
            }
        }

        session()->flash('success', 'Vistior User Updated successfully');
        return redirect()->route('user.visitor.index');
    }



    public function ChangeStatusVisitorUser(Request $request)
    {
        $user = User::where('id', $request->row_id)->update(['status' => $request->value]);
        if ($user) {
            session()->flash('success', 'Status updated successfully');
        } else {
            session()->flash('error', 'There is some thing went, Please try after some time.');
        }
        return redirect()->route('user.visitor.index');
    }
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Visitor User Deleted Successfully',
        ]);
    }
}
