<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Contact;

class AdminController extends Controller
{
    public function login() {
        return view('admin.login');
    }

    public function login_process(Request $request) {
        $data = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'type' => 'admin',
            'active' => true
        ];

        if(Auth::attempt($data)) {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/admin/login')->with('errMsg', 'Invalid Credentials');
        }        
    }

    public function dashboard() {        
        $users_count = User::where('type', 'user')->count();
        $contacts_count = Contact::count();
        return view(
            'admin.dashboard', 
            compact('users_count', 'contacts_count' )
        );
    }

    public function logout() {
        Auth::logout();
        return redirect('/admin/login');
    }

    public function users() {
        $users = User::where('type', 'user')->get();
        return view('admin.users', compact('users'));
    }

    public function activate($user_id) {
        $user = User::find($user_id);
        $user->active = true;
        $user->save();
        return redirect('/admin/users')->with('successMsg', 'User Activated!');
    }

    public function deactivate($user_id) {
        $user = User::find($user_id);
        $user->active = false;
        $user->save();
        return redirect('/admin/users')->with('successMsg', 'User Deactivated!');
    }
}