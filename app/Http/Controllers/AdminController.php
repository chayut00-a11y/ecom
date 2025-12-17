<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;

class AdminController extends Controller
{
    //
    public function adminlogin(Request $request)
    {
        $user = Admin::where(['username' => $request->username])->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return view('adminlogin')->with('error', 'Invalid username or password');

        } else {
            $request->session()->put('user', $user);

            return redirect('/alluser');
        }
    }

    public function allUser()
    {
        $users = User::paginate(5);

        return view('alluser', ['users' => $users]);
    }

    public function allAdmin()
    {
        $admins = Admin::paginate(5);

        return view('alladmin', ['admins' => $admins]);
    }

    public function allProduct()
    {
        $category = Category::get();
        $products = Product::paginate(5);
        return view('allproduct', ['products' => $products, 'category' => $category]);
    }

    public function addUser(Request $request)
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

        return redirect('/alluser')->with('success', 'Data Saved');

    }

    public function addAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|max:50',
            'password' => 'required|min:6',
        ]);

        $admin = new Admin;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect('/alladmin')->with('success', 'Data Saved');

    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('success', 'User has been deleted successfully!');
    }

    public function deleteAdmin($id)
    {
        $admin = Admin::find($id);
        $admin->delete();

        return redirect()->back()->with('success', 'Admin has been deleted successfully!');
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "images/$profileImage";
        }

        Product::create($input);

        return redirect('/allproduct')->with('success', 'Data Saved');

    }

    public function editUser($id)
    {
        $user = User::find($id);

        return response()->json([
            'status' => 200,
            'user' => $user,
        ]);
    }

    public function editAdmin($id)
    {
        $admin = Admin::find($id);

        return response()->json([
            'status' => 200,
            'admin' => $admin,
        ]);
    }

    public function updateAdmin(Request $request)
    {
        $admin_id = $request->admin_id;
        $admin = Admin::find($admin_id);
        $admin->username = $request->username;
        // $admin->password = $request->password;
        $admin->update();

        return redirect('/alladmin')->with('success', 'Data Saved');
    }

    public function updateUser(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::find($user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->update();

        return redirect('/alluser')->with('success', 'Data Saved');
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->back()->with('success', 'Product has been deleted successfully!');
    }

}
