<?php



namespace App\Http\Controllers\Auth;

use App\DataTables\ProjectDatatable;
use App\DataTables\UserDatatable;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\WorkStatus;
use App\Models\UserStatusTag;
use App\Models\TagMaster;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller

{
    public function index(UserDatatable $datatable)
    {
        return $datatable->render('admin.registration.index', ['title' => 'User']);
    }

    public function Register(Request $request)
    {
        // $project_id = base64_decode($request->project_id);
        return view('admin.registration.register', ['title' => 'User']);
    }

    public function Store(Request $request)
    {
        //$project_id = base64_decode($request->project_id);
        try {
            $validator = Validator::make($request->all(), [
                'username' =>  [
                    'required',
                    Rule::unique('users', 'username')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ],
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'mobile_number' => 'required|digits:10',
                'preferred_contact_method' => [
                    'required',
                    'array',
                ],
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            $preferredContactMethods = $request->preferred_contact_method;
            $preferredContactMethodsString = implode(', ', $preferredContactMethods);
            // $password = bcrypt($request->password);
            $password = hash('sha256', $request->password);

            $data = [
                'role_id' => 2,
                'username' => $request->username,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'password' => $password,
                'preferred_contact_method' => $preferredContactMethodsString,

            ];
            $UserData = AddDateTimeInArray($data);
            // $id = User::insert($UserData)->id;
            $id = DB::table('users')->insertGetId($UserData);

            if ($id) {
                session()->flash('success', 'Registration successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('registration');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('user.index');
        }
        // $data = $request->all();
        // $data['password'] = bcrypt($validated['password']);


        // return redirect()->route('dashboard')->with('success', 'Registration successful');
    }

    public function edit($id)
    {
        $Data = User::find($id);
        $contactMethod = explode(', ', $Data['preferred_contact_method']);
        $team = Team::get()->pluck('team_name', 'id')->toArray();
        $workStatus = WorkStatus::where('user_id', $id)->get()->pluck('status_name', 'id')->toArray();
        $tagName = TagMaster::get();
        $workStatus = implode(', ', $workStatus);
        $assignTeam = TeamMember::with('teamName')->where('user_id', $id)->get()->pluck('teamName.team_name', 'id')->toArray();
        $selectedTag = UserStatusTag::where('user_id', $id)->get()->pluck('tag_id')->toArray();
        return view('admin.registration.edit', [
            'title' => 'User - ' . $Data->username,
            //'user' => $Data->username,
            'user_id' => $id,
            'data' => $Data,
            'team' => $team,
            'workStatus' => $workStatus,
            'tagName' => $tagName,
            'assignTeam' => $assignTeam,
            'contactMethod' => $contactMethod,
            'selectedTag' => $selectedTag,
        ]);
    }
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                // 'username' =>  [
                //     'required',
                //     Rule::unique('users', 'username')->where(function ($query) {
                //         $query->whereNull('deleted_at');
                //     }),
                // ], 
                'username' =>  [
                    'required',
                    // 'unique:teams,team_name,' . $id,
                    Rule::unique('users', 'username')
                        ->ignore($id)
                        ->whereNull('deleted_at'),
                ],
                'first_name' => 'required',
                'last_name' => 'required',
                'email' =>  [
                    'required',
                    Rule::unique('users', 'email')
                        ->ignore($id)
                        ->whereNull('deleted_at'),
                ],
                'mobile_number' => 'required|digits:10',
                'preferred_contact_method' => [
                    'required',
                    'array',
                ],
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            // $password = bcrypt($request->password);
            $password = hash('sha256', $request->password);
            if ($password == '') {
                unset($password);
            }
            $data['password'] = $password;
            if ($request->team_id != '') {
                $assigne_user_data = [
                    'user_id' => $id,
                    'team_id' => $request->team_id
                ];
                
                $count = TeamMember::where('team_id', $request->team_id)->where('user_id', $id)->count();
                $assigne_user_input = AddDateTimeInArray($assigne_user_data);
                
                if ($count <= 0) {
                    $assignUser = TeamMember::create($assigne_user_input);
                    // prx($assignUser);
                }
            }
            if ($request->user_status_tag != '') {
                $tag = $request->user_status_tag;
                $tag_data = [];
                foreach ($tag as $data) {
                    $tag_data = [
                        'user_id' => $id,
                        'tag_id' => $data
                    ];
                    $tag_data_input[] = AddDateTimeInArray($tag_data);
                }
                $statusTag = UserStatusTag::insert($tag_data_input);
            }

            $preferredContactMethods = $request->preferred_contact_method;
            $preferredContactMethodsString = implode(', ', $preferredContactMethods);

            $data = [
                'username' => $request->username,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'password' => $password,
                'preferred_contact_method' => $preferredContactMethodsString,
                'recruiting_platform' => $request->recruiting_platform,
                'handle_on_upwork' => $request->handle_on_upwork,
                'negotiated_compensation' => $request->negotiated_compensation,
                'applying_for' => $request->applying_for,
                'rating' => $request->rating,
                'review'=> $request->review
            ];
            $data_input = AddDateTimeInArray($data);
            $User = User::findOrFail($id);
            $User->update($data_input);

            session()->flash('success', 'User updated successfully');
            return redirect()->route('user.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back();
    }

    public function ChangeStatus(Request $request)
    {
        $bookingData = User::where('id', $request->row_id)->update(['status' => $request->value]);
        if ($bookingData) {
            session()->flash('success', 'Status updated successfully');
        } else {
            session()->flash('error', "There is some thing went, Please try after some time.");
        }
        return redirect()->route('user.index');
    }

    public function UserWorkStatus(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status_name' =>  [
                    'required',
                ],
            ]);
            if ($validator->fails()) {
                // return back()->withInput()->withErrors($validator->errors());
                return response()->json([
                    'status' => 400,
                    'message' =>  '',
                    'data' =>  $validator->errors(),
                    'alertType' => "error",
                ]);
            }
            $input = AddDateTime($request);
            $id = WorkStatus::create($input)->id;
            if ($id) {
                return response()->json([
                    'status' => 200,
                    'message' =>  'Work status added successfully',
                    'alertType' => "success",
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' =>  "There is some thing went, Please try after some time.",
                    'alertType' => "error",
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' =>  "There is some thing went, Please try after some time.",
                'alertType' => "error",
            ]);
        }
    }

    public function UserStatusTag(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tag_name' =>  [
                    'required',
                ],
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' =>  $validator->errors(),
                    'data' =>  $validator->errors(),
                    'alertType' => "error",
                ]);
            }

            $input = AddDateTime($request);
            $id = TagMaster::create($input)->id;
            if ($id) {
                return response()->json([
                    'status' => 200,
                    'message' =>  'Status tag added successfully',
                    'alertType' => "success",
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' =>  "There is some thing went, Please try after some time.",
                    'alertType' => "error",
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' =>  "There is some thing went, Please try after some time.",
                'alertType' => "error",
            ]);
        }
    }

    public function RemoveTeam(Request $request)
    {
        try {
            $query = TeamMember::where('id', $request->id)->first();
            $teamData = TeamMember::where('id', $request->id)->delete();
            $teamCount = TeamMember::where('user_id', $query->user_id)->count();

            // prx($teamCount);
            if ($teamData) {
                return response()->json([
                    'status' => 200,
                    'message' =>  'User removed from team successfully',
                    'alertType' => "success",
                    'teamCount' => $teamCount,

                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' =>  "There is some thing went, Please try after some time.",
                    'alertType' => "error",
                    'teamCount' => $teamCount,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' =>  "There is some thing went, Please try after some time.",
                'alertType' => "error",
            ]);
        }
    }

    public function RemoveAllTeam(Request $request)
    {
        try {
            $allTeamData = TeamMember::where('user_id', $request->user_id)->delete();
            if ($allTeamData) {
                return response()->json([
                    'status' => 200,
                    'message' =>  'All team remove successfully',
                    'alertType' => "success",
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' =>  "There is some thing went, Please try after some time.",
                    'alertType' => "error",
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' =>  "There is some thing went, Please try after some time.",
                'alertType' => "error",
            ]);
        }
    }

    public function UndoUser($id)
    {
        $undoUser = User::where('id', $id)->onlyTrashed()->whereNotNull('users.deleted_at')->update(['deleted_at' => null]);
        if ($undoUser) {
            session()->flash('success', 'Undo user successfully');
        } else {
            session()->flash('error', "There is some thing went, Please try after some time.");
        }
        return redirect()->route('teams.index');
    }

    // public function blockUser(Request $request)
    // {
    //     try {
    //         $userId = $request->row_id;
    //         $blockStatus = $request->value;

    //         $user = User::findOrFail($userId);

    //         $user->status = $blockStatus;
    //         $user->save();

    //         if ($blockStatus == 'blocked') {
    //             session()->flash('success', 'User blocked successfully');
    //         } elseif ($blockStatus == 'unblocked') {
    //             session()->flash('success', 'User unblocked successfully');
    //         }
    //     } catch (\Exception $e) {
    //         session()->flash('error', "There is some thing went wrong. Please try after some time.");
    //     }

    //     return redirect()->route('user.index');
    // }
}
