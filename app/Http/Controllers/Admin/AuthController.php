<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
	use AuthenticatesUsers;
	
	protected $redirectTo = '/';
	
	
	/**
	 * @return mixed
	 */
	protected function guard()
	{
		$this->redirectTo = route('admin.dashboard');
		
		return Auth::guard('admin');
	}
	
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getLogin()
	{
		return view('admin.login');
	}
	
	
	/**
	 * @param Request $request
	 * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|void
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function login(Request $request)
	{
		$this->validateLogin($request);

		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		if ($this->hasTooManyLoginAttempts($request)) {
			$this->fireLockoutEvent($request);
			
			return $this->sendLockoutResponse($request);
		}
		
		if ($this->attemptLogin($request)) {
			return $this->sendLoginResponse($request);
		}
		
		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		$this->incrementLoginAttempts($request);
		
		return $this->sendFailedLoginResponse($request);
	}
	
	
	/**
	 * Log the user out of the application.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function logout(Request $request)
	{
		$this->guard()->logout();
		$request->session()->invalidate();
		
		return redirect(route('admin.login'));
	}
}
