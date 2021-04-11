<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;


class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }
    // Connection
    public function connextion(Request $request){
      // validation of data
        $validated = $request->validate([
            "username" => "required",
            "password" => "required",
          ]);
          //  if user and password is match => connected and redirect to home page
          if (Auth::attempt($validated)) {
            return redirect()->intended('/');
          }
          // if not , show error
          return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
          ]);
    }

    public function signup()
    {
        return view('signup');
    }

    //  création d'un nouvel utilisateur 
    public function newUsers(Request $request){
      // validation of data
        $validated = $request->validate([
            "username" => "required",
            "password" => "required",
            "password_confirmation" => "required|same:password"
          ]);
        // modèle: add the value from the form into the table "user" 
          $user = new User();
          $user->username = $validated["username"];
          $user->password = Hash::make($validated["password"]);
          $user->save();
          Auth::login($user);
          return redirect('/');
        }

    // Signt out
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}