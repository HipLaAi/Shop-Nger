<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $cartDetail = null;
        $loveDetail = null;
        if(auth()->check()){
            $cart = \App\Models\Cart::where('userid', auth()->id())->first();
            $cartDetail = \App\Models\CartDetail::where('cartid', $cart->id)->get();
            $love = \App\Models\LoveList::where('userid', auth()->id())->first();
            $loveDetail = \App\Models\LoveListDetail::where('loveid', $love->id)->get();
        }
        return view('user.contact.index',compact('cartDetail','loveDetail'));
    }
}
