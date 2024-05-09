<?php

namespace App\Http\Controllers\Sign;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{
    public function signIn(){
        return view ('sign.in.index');
    }

    public function signUp(){
        return view ('sign.up.index');
    }

    public function signOut(){
        Auth::logout();
        return redirect('/');
    }

    public function checkSignIn(Request $request)
    {
        $request->validate([
            'password' => 'string|max:100',
            'email' => 'email',
        ]);  
    
        $data = $request->only('email', 'password');
        if (auth()->attempt($data)) {

            $user = auth()->user();

            if ($user->roleid == 1) {
                return redirect()->route('overview.index');          
            } elseif ($user->roleid == 2) {
                return redirect()->route('home.index');          
            }
        }

        return redirect()->back()->with('error', 'Email or password is wrong');
    }    
    
    
    public function checkSignUp(){
        request()->validate([
            'name' => 'string|max:50',
            'email' => 'email|unique:users,email',
            'password' => 'string|max:100',
            'confirmpassword' => 'string|max:100|same:password',
        ]);

        $data = request()->only('email','name');
        $data['roleid'] = 2;
        $data['password'] = bcrypt(request('password'));

        $user = User::create($data);

        if($user){
            \App\Models\Cart::create([
                'userid' => $user->id,
            ]);
    
            \App\Models\LoveList::create([
                'userid' => $user->id,
            ]);
        }

        return redirect()->route('login')->with('success', 'Account successfully created');
    }
}
