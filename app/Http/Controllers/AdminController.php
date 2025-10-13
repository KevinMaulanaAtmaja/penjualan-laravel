<?php

namespace App\Http\Controllers;

use App\Mail\Websitemail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required|min:5',
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
        ];

        if (Auth::guard('admin')->attempt($data)) {
            return redirect()->route('admin.dashboard')->with('success', 'Login successfully');
        } else {
            return redirect()->route('admin.showLogin')->with('error', 'Invalid email or password');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.showLogin')->with('success', 'Logout successfully');
    }

    public function forget_password()
    {
        return view('admin.forget_password');
    }

    public function password_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $admin_data = Admin::where('email', $request->email)->first();

        if (!$admin_data) {
            return redirect()->back()->with('error', 'Email not found');
        }
        $token = hash('sha256', time());
        $admin_data->token = $token;
        $admin_data->update();

        $reset_link = url('/admin/reset_password/' . $token . '/' . $request->email);

        $subject = 'Reset Password';
        $message = 'Click the link below to reset your password<br>';
        $message .= '<a href="' . $reset_link . '">' . $reset_link . '</a>';

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->back()->with('success', 'Email sent successfully');
    }

    public function reset_password($token, $email)
    {
        $admin_data = Admin::where('token', $token)->where('email', $email)->first();

        if (!$admin_data) {
            return redirect()->route('admin.showLogin')->with('error', 'Invalid token or email');
        }
        return view('admin.reset_password', compact(['token', 'email']));
    }
    public function reset_password_submit(Request $request){
        $request->validate([
            'password' => 'required|min:5',
            'password_confirmation' => 'required|min:5|same:password',
        ]);

        $admin_data = Admin::where('email', $request->email)->where('token', $request->token)->first();

        if (!$admin_data) {
            return redirect()->back()->with('error', 'Invalid token or email');
        }
        // dd($admin_data);

        $admin_data->password = Hash::make($request->password);
        $admin_data->token = null;
        $admin_data->update();

        return redirect()->route('admin.showLogin')->with('success', 'Password reset successfully');
    }
}
