<?php

namespace App\Controllers;

use App\Models\User;
use App\Controllers\Controller;
use App\Helpers\MailTool;
use Leaf\Helpers\Password;

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        return $this->renderPage('Login', 'auth.login');
    }

    public function register()
    {
        return $this->renderPage('Register', 'auth.register');
    }

    public function logout(){
        auth()->logout();
        response()->redirect(route('login'));
    }

    public function forgot()
    {
        return $this->renderPage('Reset Password', 'auth.forgot');
    }

    public function signin()
    {
        $data = auth()->login([
            'email' => request()->get('email'),
            'password' => request()->get('password')
        ]);

        return $this->jsonResponse($data, "Welcome, Login successful", "Invalid login details", route('app.home'));
    }

    public function signup()
    {
        $request = request()->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required|min:6'
        ]);

        if (!$request) {
            return $this->jsonError("Invalid registration details");
        }

        if (User::where('email', request()->get('email'))->first()) {
            return $this->jsonError("User already exists");
        }

        $data = User::create([
            'email' => $request['email'],
            'fullname' => $request['name'],
            'password' => Password::hash($request['password'])
        ]);

        return $this->jsonResponse($data, "Registration successful", "Registration failed", route('login'));
    }


    public function reset()
    {
        try {
            $request = request()->validate(['email' => 'required|email']);

            if (!$request) {
                return $this->jsonError("Invalid email address");
            }

            $userData = User::where('email', request()->get('email'))->first();
            if (!$userData) {
                return $this->jsonError("User with such email does not exist");
            }

            if ($userData->remember_token && (time() - strtotime($userData->updated_at)) < 60) {
                return $this->jsonError("Password reset link already sent, check spam folder");
            }

            $resetToken = Password::hash($userData->id . time());
            User::where('email', request()->get('email'))->update(['remember_token' => $resetToken]);

            (new MailTool())->sendHtml('Password Reset', view('mails.reset', [
                'name' => $userData->fullname,
                'token' => base64_encode($resetToken)
            ]), request()->get('email'), $userData->fullname);

            return $this->jsonSuccess('Password reset link sent to your email');
        } catch (\Exception $e) {
            return $this->jsonException($e);
        }
    }


    public function password($token)
    {
        $token = base64_decode($token);
        $user = User::where('remember_token', $token)->first();

        if (!$user || $this->isTokenExpired($user)) {
            return response()->markup(view('errors.400'), 400);
        }

        return $this->renderPage('Change Password', 'auth.reset', ['token' => base64_encode($token)]);
    }

    public function updatePassword()
    {
        $request = $this->validateRequest(['password' => 'required|min:6', 'token' => 'required']);
        if (!$request) return $this->jsonError('Invalid password details');

        $user = User::where('remember_token', base64_decode($request['token']))->first();
        if (!$user || $this->isTokenExpired($user)) {
            return $this->jsonError('Invalid password reset token');
        }

        $user->password = Password::hash($request['password']);
        $user->remember_token = null;
        $user->save();

        return $this->jsonSuccess('Password updated successfully');
    }

    private function validateRequest($rules)
    {
        return request()->validate($rules);
    }

    private function isTokenExpired($user)
    {
        return (time() - strtotime($user->updated_at)) > 7200;
    }

    public static function routes()
    {
        app()->get('login', ['name' => 'login', 'AuthController@login']);
        app()->get('reset', ['name' => 'reset', 'AuthController@forgot']);
        app()->get('logout', ['name' => 'logout', 'AuthController@logout']);
        app()->get('register', ['name' => 'register', 'AuthController@register']);
        app()->get('password/{token}', ['name' => 'password', 'AuthController@password']);

        app()->post('login', ['name' => 'signin', 'AuthController@signin']);
        app()->post('register', ['name' => 'signup', 'AuthController@signup']);
        app()->post('reset', ['name' => 'reset', 'AuthController@reset']);
        app()->post('password', ['name' => 'update.password', 'AuthController@updatePassword']);
    }
}