<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Http\Request;

class loginRegistrationController extends Controller
{
    public static function login(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            if (password_verify($request->input('password'), $user->password)) {
                $request->session()->put('user', $user);
                return redirect('/');
            } else {
                return redirect('/login')->with('error', 'Password is incorrect');
            }
        } else {
            return redirect('/login')->with('error', 'Email is not registered');
        }
    }

    public static function register(Request $request)
    {
        $user_data = User::where('email', $request->input('user_email'))->first();

        $name = $request->input('user_name');
        $email = $request->input('user_email');

        $password = $request->input('password');
        $password_confirmation = $request->input('re_password');

        if ($password != $password_confirmation){
            return back()->with('error', 'Password and re-password are not same');
        }

        if ($user_data){
            return back()->with('error', 'Email is already registered');
        }

        $role = null;

        if ($request->input('is_admin')){
            $role = 'payroll';
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'role' => 'payroll',
            'password' => Hash::make($password),
        ]);

        return redirect('/login')->with('success', 'You have been registered successfully');
    }

}
