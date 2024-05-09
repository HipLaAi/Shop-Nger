<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function index(){
        $cart = \App\Models\Cart::where('userid', auth()->id())->first();
        $cartDetail = \App\Models\CartDetail::where('cartid', $cart->id)->get();
        $love = \App\Models\LoveList::where('userid', auth()->id())->first();
        $loveDetail = \App\Models\LoveListDetail::where('loveid', $love->id)->get();
        $cartDetails = \App\Models\CartDetail::where('cartid', $cart->id)->where('status',1)->get();
        return view('user.checkout.index',compact('cartDetails','cartDetail','loveDetail'));
    }

    public function add(Request $request){
        
        $saleBill = \App\Models\SaleBill::create([
            'userid' => auth()->id(),
            'fullname' => $request->input('name'),
            'address' => $request->input('message'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'province' => $request->input('province'),
            'district' => $request->input('district'),
            'ward' => $request->input('ward'),
            'street' => $request->input('street'),
            'zip' => $request->input('zip'),
            'moneytotal' => $request->input('totals'),
            'pay' => $request->input('pay'),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($saleBill && $request->has('name_product')) {
            foreach ($request->name_product as $key => $name_product) {
                \App\Models\SaleBillDetail::create([
                    'saleid' => $saleBill->id,
                    'name_product'=> $name_product,
                    'size' => $request->size[$key],
                    'color' => $request->color[$key],
                    'quantity' => $request->quantity[$key],
                    'price' => $request->price[$key],
                    'discount' => $request->discount[$key],
                    'total' => $request->total[$key],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $product_detail = \App\Models\ProductDetail::find($request->prodid[$key]);
                $product_detail->update([
                    'quantity' => $product_detail->quantity - $request->quantity[$key],
                    'updated_at' => now(),
                ]);

                \App\Models\CartDetail::find($request->id[$key])->delete();
            }
        }

        $saleBillDetail = \App\Models\SaleBillDetail::where('saleid',$saleBill->id)->get();
        
        $cart = \App\Models\Cart::where('userid', auth()->id())->first();
        $cartDetail = \App\Models\CartDetail::where('cartid', $cart->id)->get();
        $love = \App\Models\LoveList::where('userid', auth()->id())->first();
        $loveDetail = \App\Models\LoveListDetail::where('loveid', $love->id)->get();
        
        return view('user.checkout.result',compact('cartDetail','loveDetail','saleBill','saleBillDetail'));
    }   
}
