<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use carbon\carbon;
use App\Models\Category;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use App\Models\User;
use App\DataTables\UserDatatable;
use App\Models\Service;
use App\Models\UserProfessionalDetail;
use App\Models\UserEducationDetail;
use App\Models\UserService;
use App\Models\UserSlider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public $modual_name = '';
    public $title = '';
    public $view = '';

    public function __construct()
    {
        $this->view = 'backend.User.';
        $this->title = 'Users';
    }
    public function index(UserDatatable $datatable)
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
        $category = Category::whereNull('category_id')->get();
        return view($this->view . 'create', compact('site_title', 'service', 'category'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'fullname' => 'required',
            'displayname' => 'required',
            'user_category_id' => 'required',
            'year_of_experience' => 'required',
            'mobile_number' => 'required|regex:/^[0-9]{10,15}$/',
            'instaname' => 'nullable', // Assuming instaname is part of your request data
            'instalink' => $request->instaname ? 'required' : '', // Conditional validation
            'twittername' => 'nullable', // Assuming instaname is part of your request data
            'twitterlink' => $request->twittername ? 'required' : '', // Conditional validation
            'about_long' => 'required|min:10|max:200',
            'about_sort' => 'required|min:5|max:50',
        ]);


        $slug_data = ['fullname' => $request->fullname];
        $fullSlug = GetSlug($slug_data);

        $year_Of_experience = ['year_of_experience' => $request->year_of_experience];
        $yearOfExperience = Getyearofexperience($year_Of_experience);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $randomPassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+[]{}|;:,.<>?'), 0, 12);
        $password = Hash::make($randomPassword);
        $data = [
            'fullname' => request()->fullname,
            'displayname' => request()->displayname,
            'email' => request()->email,
            'mobile_number' => request()->mobile_number,
            'role_id' => 2,  'password' => $password,
            'slug' => $fullSlug,
            'instaname' => request()->instaname,
            'instalink' => request()->instalink,
            'twittername' => request()->twittername,
            'twitterlink' => request()->twitterlink,
            'user_category_id' => request()->user_category_id,
            'year_of_experience' => request()->year_of_experience,
            'about_long' => request()->about_long,
            'about_sort' => request()->about_sort,

        ];
        // prx($data);
        if (request()->is_top != null) {
            $data['is_top'] = request()->is_top;
        }
        if ($request->hasFile('profile_video')) {
            $filename = ImageUploadTrait::uploadImage($request->file('profile_video'), 'videos');
            $data['profile_video'] = $filename;
        }
        if ($request->hasFile('profile_photo')) {
            $filename = ImageUploadTrait::uploadImage($request->file('profile_photo'), 'profilephoto');
            $data['profile_photo'] = $filename;
        }
        $user = User::create($data);
        if (request()->has('services')) {
            $services = [];
            foreach (request()->services as $key => $value) {
                $services[] = ['user_id' => $user->id, 'service_id' => $value];
            }
            UserService::insert($services);
        }
        if (request()->has('professionaldetalis')) {
            $data = [];
            foreach (request()->professionaldetalis as $key => $value) {
                if ($value != null) {
                    $data[] = ['user_id' => $user->id, 'details' => $value];
                }
            }
            UserProfessionalDetail::insert($data);
        }
        if (request()->has('education_detalis')) {
            $data = [];
            foreach (request()->education_detalis as $key => $value) {
                if ($value != null) {
                    $data[] = ['user_id' => $user->id, 'details' => $value];
                }
            }
            UserEducationDetail::insert($data);
        }
        session()->flash('success', 'user created successfully');
        return redirect()->route('user.index');
    }
    public function edit(User $user)
    {
        // prx($user);
        $return_data = [];
        $site_title = trans($this->title);
        $category = Category::whereNull('category_id')->get();
        $service_list = Service::get()->pluck('name', 'id');
        $service = UserService::where('user_id', $user->id)
            ->join('services', 'user_services.service_id', '=', 'services.id')
            ->select('services.id', 'services.name as name')
            ->get();

        $user_professional_service = UserProfessionalDetail::where('user_id', $user->id)->get();
        $user_education_service = UserEducationDetail::where('user_id', $user->id)->get();

        return view($this->view . 'edit', compact('site_title', 'service', 'user', 'service_list', 'user_education_service', 'user_professional_service', 'category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'displayname' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'required|regex:/^[0-9]{10,15}$/',
            'year_of_experience' => 'required',
            'instaname' => 'nullable', // Assuming instaname is part of your request data
            'instalink' => $request->instaname ? 'required' : '', // Conditional validation
            'twittername' => 'nullable', // Assuming instaname is part of your request data
            'twitterlink' => $request->twittername ? 'required' : '', // Conditional validation
            'about_long' => 'required|min:10|max:200',
            'about_sort' => 'required|min:5|max:50',
        ]);

        $user = User::find($id);

        $slug_data = ['fullname' => $request->fullname];
        // $fullSlug = GetSlug($slug_data);

        $year_Of_experience = ['year_of_experience' => $request->year_of_experience];
        $yearOfExperience = Getyearofexperience($year_Of_experience);

        $data = [
            'fullname' => request()->fullname,
            'displayname' => request()->displayname,
            'email' => request()->email,
            'mobile_number' => request()->mobile_number,
            'role_id' => 2,
            // 'instalink' => request()->instalink,
            // 'twitterlink' => request()->twitterlink,
            'user_category_id' => request()->user_category_id,
            'year_of_experience' => request()->year_of_experience,
            'instaname' => request()->instaname,
            'instalink' => request()->instalink,
            'twittername' => request()->twittername,
            'twitterlink' => request()->twitterlink,
            'about_long' => request()->about_long,
            'about_sort' => request()->about_sort,
        ];
        // prx($data);
        if ($request->fullname != $user->fullname) {
            $data['slug']   = GetSlug($slug_data);
        }

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (request()->has('is_top')) {
            $data['is_top'] = request()->is_top;
        } else {
            $data['is_top'] = 0;
        }
        if ($request->hasFile('profile_video')) {
            $filename = ImageUploadTrait::updateImage($user->profile_video, $request->file('profile_video'), 'videos');
            $data['profile_video'] = $filename;
        }

        if ($request->hasFile('profile_photo')) {
            $filename = ImageUploadTrait::updateImage($user->profile_photo, $request->file('profile_photo'), 'profilephoto');
            $data['profile_photo'] = $filename;
        }

        $user->update($data);

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

        UserProfessionalDetail::where('user_id', $user->id)->delete();
        UserEducationDetail::where('user_id', $user->id)->delete();

        if (request()->has('professionaldetalis')) {
            $data = [];
            foreach (request()->professionaldetalis as $key => $value) {
                if ($value != null) {
                    $data[] = ['user_id' => $user->id, 'details' => $value];
                }
            }
            UserProfessionalDetail::insert($data);
        }

        if (request()->has('education_detalis')) {
            $data = [];
            foreach (request()->education_detalis as $key => $value) {
                if ($value != null) {
                    $data[] = ['user_id' => $user->id, 'details' => $value];
                }
            }
            UserEducationDetail::insert($data);
        }

        session()->flash('success', 'User Updated successfully');
        return redirect()->route('user.index');
    }

    public function ChangeStatusUser(Request $request)
    {
        $user = User::where('id', $request->row_id)->update(['status' => $request->value]);
        if ($user) {
            session()->flash('success', 'Status updated successfully');
        } else {
            session()->flash('error', 'There is some thing went, Please try after some time.');
        }
        return redirect()->route('user.index');
    }

    public function GetProfileVideo(Request $request)
    {
        $dataId = $request->input('id');
        // prx($dataId);
        $dataId = User::where('id', $dataId)->first();
        // prx($dataId);
        $video = $dataId->profile_video;
        // prx($video);
        return response()->json(['data' => $video], 200);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'status' => 200,
            'message' => 'user deleted Successfully',
        ]);
    }

    public function Slider(Request $request)
    {
        $sliders = UserSlider::where('user_id', $request->input('user_id'))->get();
    // prx($sliders);
        $html = view('backend.User.user-profile-slider', ['sliders' => $sliders])->render();
    
        return response()->json(['status' => 200, 'msg' => 'Data load successfully.', 'data' => $html]);
    }
    
    }

