<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;



use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;



class LoginController extends Controller

{

    /*

      |--------------------------------------------------------------------------

      | Login Controller

      |--------------------------------------------------------------------------

      |

      | This controller handles authenticating users for the application and

      | redirecting them to your home screen. The controller uses a trait

      | to conveniently provide its functionality to your applications.

      |

     */



    use AuthenticatesUsers;



    /**

     * Where to redirect users after login.

     *

     * @var string

     */

    //protected $redirectTo = RouteServiceProvider::HOME;

    protected $redirectTo = '/admin/dashboard';



    public function index()
    {
        $return_data = [];
        $return_data['settting'] = Setting::first();

        return view('auth.login', array_merge($return_data));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            if ($remember) {
                // Set cookies for email and password
                Cookie::queue('email', $request->email, 60 * 24 * 30); // 30 days expiration
                Cookie::queue('password', $request->password, 60 * 24 * 30); // 30 days expiration
            } else {
                // Clear cookies if remember me is not checked
                Cookie::queue(Cookie::forget('email'));
                Cookie::queue(Cookie::forget('password'));
            }
            if ($request->ajax()) {
                return response()->json(['message' => 'Login successfully', 'redirect_url' => route('front.physio.bio', ['slug' => Auth::user()->slug])], 200);
            } else {
                return redirect()->route('dashboard');
            }
        }

        // Handle invalid login attempt...
        if ($request->ajax()) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        } else {
            return redirect()->back()->withErrors(['password' => 'Invalid credentials']);
        }
    }



    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        // $group = Group::all();

        // view()->share('group', $group);

        // $this->middleware('guest')->except('logout');

    }



    public function logout()
    {

        if (isset(Auth::user()->id)) {
            $role_id = Auth::user()->role_id;
            Auth::logout();
            if ($role_id == '1') {
                return redirect()->route('login');
            } else {
                return redirect()->route('front.home');
            }
            $role_id = Auth::user()->role_id;
            Auth::logout();
            if ($role_id == '1') {
                return redirect()->route('login');
            } else {
                return redirect()->route('front.home');
            }
        } else {
            return redirect()->route('front.home');
        }
    }
}
