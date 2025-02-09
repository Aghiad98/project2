<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showloginform(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors(['email'=>'invalid credentials']);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request){

        $this->validate($request,[
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $image=$request['image'];
            $imageName=time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images'),$imageName);// حفظ الصورة في storage
        } else {
            $imageName = null;  // إذا لم تكن الصورة موجودة، نترك القيمة null
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imageName,
        ]);
        $user->assignRole('user');
        Auth::login($user);
        return redirect()->route('posts.index')->with("success","you have been successfuly registered");
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
