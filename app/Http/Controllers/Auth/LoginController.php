<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the Github authentication page.
     *
     * @param $provider
     * @return \Symphony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Github.
     *
     * @param $provider
     * @return void
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        // dd($user);

        $existinguser = User::whereEmail($user->getEmail())->first();

        if($existinguser) {
            auth()->login($existinguser);
            return redirect($this->redirectPath())->with('success', 'Login Successful');
        }

        
        $newUser = User::create([
           'username' => $user->getName(),
           'email' => $user->getEmail(),
           'password' => bcrypt('password'),
           'firstname' => '',
           'lastname' => '',
           'role' => 'employee',
           'last_login_at' => null,
           'last_login_ip' => ''
        ]);

        auth()->login($newUser);

        return redirect($this->redirectPath())->with('success', 'Login Successful');
    }

    function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
    }
}
