<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
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
        $blogs = \App\Models\Blog::all();
        $blog = \App\Models\Blog::take(3)->get();
        return view('user.blog.index',compact('blogs','blog','cartDetail','loveDetail'));
    }
}
