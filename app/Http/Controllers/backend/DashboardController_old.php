<?php



namespace App\Http\Controllers\backend;



use App\Http\Controllers\Controller;

use App\Models\Project;

use Request as Input;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Video;

use App\Models\Team;

use Illuminate\Support\Facades\DB;

use Validator;

use URL;
use carbon\carbon;

use Illuminate\Support\Facades\Hash;

use App\Models\VideoCategory;


class DashboardController extends Controller

{



    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    # Display dashboard

    public function index()

    {

        // $user = Auth::user();



        // $user_count = 0;

        // $user_active_count =  0;

        // $user_inactive_count =  0;

        // $user_blocked_count =  0;



        // if ($user->role_id == '1') {



        //     $counts = User::selectRaw('

        //     SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as user_active_count,

        //     SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as user_inactive_count,

        //     SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as user_blocked_count,

        //     COUNT(*) as total_user_count

        // ')

        //         ->where('role_id', '!=', 1)

        //         ->first();



        //     $user_count = $counts->total_user_count ?? 0;

        //     $user_active_count = $counts->user_active_count ?? 0;

        //     $user_inactive_count = $counts->user_inactive_count ?? 0;

        //     $user_blocked_count = $counts->user_blocked_count ?? 0;

        // }



        // $team = new Team();

        // $project = new Project();



        // if ($user->role_id == '2') {



        //     $team = $team->whereIn('id', function ($query) use ($user) {

        //         $query->select('team_id')

        //             ->from('team_members')

        //             ->where('user_id', $user->id);

        //     });



        //     $project = $project->whereIn('id', function ($query) use ($user) {

        //         $query->select('project_id')

        //             ->from('assign_users')

        //             ->where('user_id', $user->id);

        //     });

        // }

        $return_data = [];
        // $team_total = $team->count();
        $today = Carbon::today();
        $return_data['totalCount'] = User::count();
        $return_data['totalthismonthCount'] = User::whereDate('created_at', $today)->count();

        $return_data['totalprofessionuserCount'] = User::where('role_id', 2)->count();
        $return_data['totalvistioruserCount'] = User::where('role_id', 3)->count();

        $return_data['currentMonthName'] = Carbon::now()->format('F');
        $currentMonth = Carbon::now()->month;
        // Count users with role_id = 3 for today's date
        $return_data['thismonthprofessionuserCount'] = User::where('role_id', 2)
            ->whereDate('created_at', $today)
            ->count();
        // Count users with role_id = 3 for today's date
        $return_data['totalthismonthvistioruserCount'] = User::where('role_id', 3)
            ->whereDate('created_at', $today)
            ->count();

            $return_data['videocount'] = Video::count();
            $return_data['thismonthvideoCount'] = Video::whereDate('created_at', $today)->count();

            $return_data['videocategoriescount'] = VideoCategory::count();
            $return_data['thismonthvideocategoryCount'] = VideoCategory::whereDate('created_at', $today)->count();

            // prx( $return_data['thismonthvideocategoryCount']);
        return view('admin.dashboard', $return_data);
    }



    public function showMyProfilePage()

    {

        $data = User::find(Auth::user()->id);

        return view('admin.dashboard.my-profile', ['data' => $data]);
    }



    public function showUpdatePassword()

    {

        return view('admin.dashboard.change-password');
    }



    public function updateMyProfile(Request $request)

    {

        try {

            $validator = Validator::make($request->all(), [

                //  'name' => 'required',

            ]);

            if ($validator->fails()) {

                return back()->withInput()->withErrors($validator->errors());
            }

            $userInfo = User::where(['id' => Auth::user()->id])->update(['name' => $request->name]);

            if ($userInfo) {

                session()->flash('success', 'Your profile has been updated successfully.');
            } else {

                session()->flash('error', 'Oops, There is some thing went wrong, Please try again.');
            }

            return redirect()->route('my-profile');
        } catch (\Exception $e) {

            session()->flash('error', $e->getMessage());

            return back()->withInput();
        }
    }



    public function udpatePassword(Request $request)

    {

        try {

            $validator = Validator::make($request->all(), [

                'cuurent_password' => 'required',

                'password' => ['required'],

                'confirm_password' => ['same:password'],

            ]);



            if ($validator->fails()) {

                return back()->withInput()->withErrors($validator->errors());
            }



            if (!Hash::check($request->cuurent_password, auth()->user()->password)) {

                session()->flash('error', 'Your current password does not matches with password you provided. Please try agian.');

                return redirect()->route('change-password');
            }



            $data = User::find(Auth::user()->id);

            $data->password = bcrypt($request->password);

            $data->save();



            session()->flash('success', 'Password changed successfully');

            return redirect()->route('change-password');
        } catch (\Exception $e) {

            session()->flash('error', $e->getMessage());

            return redirect()->route('change-password')->withInput();
        }
    }
}
