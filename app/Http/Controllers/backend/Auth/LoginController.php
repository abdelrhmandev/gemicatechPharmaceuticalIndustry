<?php
namespace App\Http\Controllers\backend\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\backend\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;





class LoginController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('backend.auth.login');
    }
    public function login(LoginRequest $request)
    {


            $request->authenticate();

            $request->session()->regenerate();


            return redirect()->intended(route('admin.dashboard')); // get redirect to backend dashboard


    }


    protected function guard()
    {
        return Auth::guard('admin');
    }
    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();

            $request->session()->flush();
            $request->session()->regenerate();

            return redirect()->route('admin.login.form')->with('logout', trans('login.logout')); // redirect to backend login page
        }
    }
    public function sendFailedLoginResponse(Request $request)
    {
        $this->incrementLoginAttempts($request);
        return redirect()
            ->route('admin.login.form')
            ->withInput()
            ->with(['error' => trans('auth.failed')]); // redirect to backend login page
    }

    protected function isUsingThrottlesLoginsTrait()
    {
        return in_array(ThrottlesLogins::class, class_uses_recursive(get_class($this)));
    }
    public function getThrottleKey()
    {
        return \Str::lower(request('email')) . '|' . request()->ip();
    }


}
