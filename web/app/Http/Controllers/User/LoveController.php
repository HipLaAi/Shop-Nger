<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoveController extends Controller
{
    public function index(){
        $cart = \App\Models\Cart::where('userid', auth()->id())->first();
        $cartDetail = \App\Models\CartDetail::where('cartid', $cart->id)->get();
        $love = \App\Models\LoveList::where('userid', auth()->id())->first();
        $loveDetail = \App\Models\LoveListDetail::where('loveid', $love->id)->get();
        $product = \App\Models\Product::all();
        return view('user.love.index',compact('loveDetail','product','cartDetail'));
    }

    public function add(Request $request){
        if($request->ajax()){
            $product = \App\Models\Product::find($request->proid);
            $love = \App\Models\LoveList::where('userid', auth()->id())->first();
    
            $check = \App\Models\LoveListDetail::where('loveid', $love->id)
                                                ->where('proid', $product->id)
                                                ->first();
    
            if(!$check){
                $loveDetail = \App\Models\LoveListDetail::create([
                    'loveid' => $love->id,
                    'proid' => $product->id,
                    'price' => $product->price,
                    'discount' => $product->discount,
                    'status' => 1,
                ]);
            }
    
            $response['count'] = \App\Models\LoveListDetail::where('loveid', $love->id)->count();
    
            return $response;
        }
    
        return back();
    }    

    public function delete(Request $request){
        if($request->ajax()){

            $loveDetail = \App\Models\LoveListDetail::find($request->id)->delete();

            $love = \App\Models\LoveList::where('userid', auth()->id())->first();
            $loveDetail = \App\Models\LoveListDetail::where('loveid', $love->id)->get();
            
            $response['count'] = $loveDetail->count();

            return $response;
        }

        return back();
    }
}
