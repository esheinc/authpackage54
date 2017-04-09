<?php

namespace Esheinc\AuthPackage\Controllers;

use Validator;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Esheinc\AuthPackage\Models\Admin;
use Esheinc\AuthPackage\Models\Admins_login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'dashboard';
    protected $username = 'username';
    protected $loginView = 'AuthView::pages.login';
    protected $redirectAfterLogout = 'login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'parent_id' => 'required',
            'level' => 'required',
            'status' => 'required',
            'username' => 'required|min:4',
            'password' => 'required|min:6|confirmed',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'last_login_at' => 'required',
            'last_login_ip' => 'required',
            'last_login_geo' => 'required',
        ]);
    }

    protected function create(array $data)
    {
        $ip = geoip()->getClientIP();
        $location = geoip()->getLocation($ip);
        
        return Admin::create([
            'parent_id' => $data['parent_id'],
            'level' => $data['level'],
            'status' => $data['status'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'last_login_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'last_login_ip' => $ip,
            'last_login_geo' => $location->iso_code,
        ]);
    }

    protected function getFailedLoginMessage()
    {
        return "Invalid credentials, please try again.";
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return [$this->username() => $request['username'], 'password' => $request['password'], 'status' => 1];
    }

    protected function sendLoginResponse(Request $request)
    {

        // added process
        $this->updateLoginAttempt(1);
        $this->updateLastLogin();
        // end added process

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        // added process
        $this->updateLoginAttempt(0);
        // end added process
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => $this->getFailedLoginMessage(),
            ]);
    }

    protected function updateLastLogin() {
        $ip = geoip()->getClientIP();
        $location = geoip()->getLocation($ip);

        $user = Auth::user();

        $user->last_login_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->last_login_ip = $ip;
        $user->last_login_geo = $location->iso_code;

        $user->save();
    }

    protected function updateLoginAttempt($status) {
        $ip = geoip()->getClientIP();
        $location = geoip()->getLocation($ip);

        $agent = new Agent();
        $language = implode(',', $agent->languages());
        $device = $agent->device();
        $os = $agent->platform();
        $browser = $agent->browser();
        $browser_version = $agent->version($browser);
        
        Admins_login::create([
            'status' => $status,
            'ip' => $ip,
            'geo' => $location->iso_code,
            'language' => $language,
            'device' => $device,
            'os' => $os,
            'browser' => $browser,
            'browser_version' => $browser_version,
        ]);

    }

    public function showLoginForm()
    {
        return view('AuthView::pages.login');
    }

    public function username()
    {
        return 'username';
    }

   

    

    
}
