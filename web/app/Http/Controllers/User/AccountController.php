<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(){
        $cart = \App\Models\Cart::where('userid', auth()->id())->first();
        $cartDetail = \App\Models\CartDetail::where('cartid', $cart->id)->get();
        $love = \App\Models\LoveList::where('userid', auth()->id())->first();
        $loveDetail = \App\Models\LoveListDetail::where('loveid', $love->id)->get();
        $account = \App\Models\User::find(auth()->id());
        return view('user.account.index',compact('account','cartDetail','loveDetail'));
    }

    public function update(Request $request){
        $account = \App\Models\User::find(auth()->id());

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $name = time().rand(1,100) . '.' . $image->extension();
            $image->move(public_path('images'), $name); 
        }

        else
        {
            $name = $account->avatar;
        }
    
        $account->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'avatar' => $name,
            'updated_at' => now(),
        ]);
    
        return redirect('account');
    }
}
