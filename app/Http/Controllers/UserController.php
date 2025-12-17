<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function login(Request $request)
    {
        $user = User::where(['email' => $request->email])->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return view('login')->with('error', 'Invalid username or password');
        } else {
            $request->session()->put('user', $user);

            return redirect('/');
        }
    }

    public function register(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|min:6',
            'email' => 'required|email',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('login');
    }

    public function profile()
    {

        $user = Session('user');
        $orders = $user->orders()->with('user', 'address_list')->get();

        return view('profile', ['user' => $user, 'orders' => $orders]);
    }


    public function updateUser(Request $request)
    {
        $user_id = $request->input('user_id');
    
        $user = User::find($user_id);
    
        if ($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();
    
            return redirect()->back()->with('success', 'User updated successfully.');
        }
    
        return redirect()->back()->with('error', 'User not found.');
    }
     

}
