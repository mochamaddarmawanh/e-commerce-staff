<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticationController extends Controller
{
    public function index()
    {
        $datas = array(
            "title" => "Login"
        );

        return view("authentication/login", $datas);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            return redirect()->intended('dashboards');

            // /** @var User $user */
            // $user = Auth::user();

            // if ($user->hasVerifiedEmail()) {
            //     $request->session()->regenerate();
            //     return redirect()->intended('dashboards');
            // }

            // Auth::logout();
            // return back()->with([
            //     'login_error' => 'hasNoVerified',
            // ]);
        }

        return back()->with([
            'login_error' => 'Email or password is incorrect, please try again.',
        ]);
    }

    public function not_verified()
    {
        $datas = array(
            "title" => "Verify Email"
        );

        return view("authentication/verify", $datas);
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('resent', 'true');
    }

    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if ($user->hasVerifiedEmail()) {
            return redirect('verify-success')->with('verified', 'Your email is already verified.');
        }

        if (!$user->markEmailAsVerified()) {
            return redirect()->route('verification.notice')->with('verification_error', 'Email verification failed.');
        }

        return redirect('verify-success')->with('verified', 'Congratulations! Your email has been successfully verified. You&#39;re all set to proceed.');
    }

    public function verify_success()
    {
        $datas = array(
            "title" => "Verify Success"
        );

        return view("authentication/verify_success", $datas);
    }
}
