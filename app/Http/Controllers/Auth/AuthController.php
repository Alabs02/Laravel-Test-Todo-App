<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLoginPage()
    {
        if (Auth::check()) {
            return redirect()
                ->route('user.dashboard')
                ->with('message', 'You are logged in already!');
        } else {
            return view('auth.login', [
                'title' => 'Login Page',
            ]);
        }
    }

    public function showRegisterPage()
    {
        return view('auth.register', [
            'title' => 'Register Page'
        ]);
    }

    public function register(Request $request)
    {
        try {
            $request['name'] = $request->input('user-name');
            $request['username'] = $request->input('user-username');
            $request['email'] = $request->input('user-email');
            $request['password'] = $request->input('user-password');


            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'username' => 'required|unique:users|max:100',
                'email' => 'required|email',
                'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->letters()],
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all());
            }

            $check = $this->create($request->toArray());

            if ($check) {
                $request->session()->regenerateToken();
                return redirect()
                    ->intended(route('user.dashboard'))
                    ->with('message', 'Registration successfull, cheers!');
            }
        } catch (\Exception $e) {
            return back()
                ->withErrors('An error occured, '. $e->getMessage());
        }
    }

    public function login(Request $request)
    {
        
        $request['email'] = $request->input('user-email');
        $request['password'] = $request->input('user-password');

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator->errors());
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
           return back()
                ->withErrors('Invalid login credentials');
        }

         $request->session()->regenerateToken();
            return redirect()
                ->intended(route('user.dashboard'))
                ->with('message', 'Logged in successfully!');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        Session::flush();
        Session::invalidate();
        Session::regenerateToken();

        return redirect()
            ->intended(route('user.login'))
            ->with('message', 'Logged out successfully!');
    }

    private static function create(array $data)
    {
        return User::create($data);
    }
}
