<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * returns register view 
     */
    public function register_view()
    {
        return view('auth.register');
    }
    /**
     * creates a new user
     */
    public function register(Request $request)
    {
           // validate user input
        
        $this->validate($request,[
            'name'      => 'required|min:3|max:191',
            'email'     => 'email|unique:users|required',
            'password'  => 'required|min:3|max:12'
          ]);
          
         
           $user = new User;
           $user->name = $request->input('name');
           $user->email = $request->input('email');
           $user->password = bcrypt($request->input('password'));
           $user->save();
           return redirect('/login_view')->with('success_message','Thank you for joining us');
    }
    /**
     * returns login view 
     */
    public function login_view()
    {
        return view('auth.login');
    }
    /**
     * user logs in with valid credentials and gets redirected to booking page 
     * or redirected to the same page if credentials are invalid
     */
    public function login(Request $request)
    {
          $credentials = [
             'email'     => $request->input('email'),
             'password'  => $request->input('password')
          ];

          if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/booking/create');
          }else{
            return redirect('/login_view')->with('error_messge','Invalid credentials');
          }
         
    }
    /**
     * logs the user out and invalidates the session
     */
    public function logout(Request $request)
    {
         Auth::logout();
         $request->session()->invalidate();
         $request->session()->regenerateToken();
         return redirect('/login_view')->with('success_message','you have logged out successfully'); 
    }
}
