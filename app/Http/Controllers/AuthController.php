<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPasswordLink;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_decode;


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
            return redirect('/login_view')->with('error_message','Invalid credentials,please check your email and password');
          }
         
    }
    /**
     * return the forgoten password view
     */
    public function edit_user()
    {
        return view('auth.forget-password');
    }
    /**
     * send the edit password link to user email
     */
    public function send_link_to_user(Request $request)
    {
           $this->validate($request,[
               'email' => 'required|email'
           ]);

         $email = $request->input('email');
         //check that if  the user exist in the database by searching
         $user = DB::table('users')
                    ->where('email','=',$email)
                    ->get();
         // if count is 1 means user exist
         if(count($user) == 1){
            
             $user_array = json_decode($user,true);
             $data = array(
                 'id'       => $user_array[0]['id'],
                 'name'     => $user_array[0]['name'],
                 'password' => $user_array[0]['password'],
             );
             Mail::to($email)->send(new SendPasswordLink($data));
             return redirect('/login_view')->with('success_message','please check your email inbox an email has been sent');
          }else{
            return redirect('/user/edit')->with('error_message','The user you are looking does not exists');
          }
    }
    /**
     * update user password
     */
    public function update_user_password(Request $request,$id)
    {
        $this->validate($request,[
            'name'      => 'required|min:3|max:191',
            'email'     => 'email|unique:users|required',
            'password'  => 'required|min:3|max:12'
          ]);
          
         
           $user = User::find($id);
           $user->name = $request->input('name');
           $user->email = $request->input('email');
           $user->password = bcrypt($request->input('password'));
           $user->save();
           return redirect()->with('success_mssage','your password has been updated successfully');
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
