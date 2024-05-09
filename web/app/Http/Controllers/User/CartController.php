<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(){
        $cart = \App\Models\Cart::where('userid', auth()->id())->first();
        $cartDetail = \App\Models\CartDetail::where('cartid', $cart->id)->get();
        $love = \App\Models\LoveList::where('userid', auth()->id())->first();
        $loveDetail = \App\Models\LoveListDetail::where('loveid', $love->id)->get();
        $productDetail = \App\Models\ProductDetail::all();
        $cartDetails = \App\Models\CartDetail::where('cartid', $cart->id)->where('status',1)->get();
        return view('user.cart.index',compact('cartDetails','cartDetail','productDetail','loveDetail'));
    }

    public function add(Request $request){
        if($request->ajax()){
            $product = \App\Models\Product::find($request->proid);

            if($request->color != null && $request->size != null){
                $productDetail = \App\Models\ProductDetail::where('proid', $request->proid)
                                                           ->where('color', $request->color)
                                                           ->where('size', $request->size)
                                                           ->first();
            }
            else{
                $productDetail = \App\Models\ProductDetail::where('proid', $request->proid)->first();
            }

            //Kiểm tra xem thông tin sản phẩm đã có trong giỏ hàng chưa
            $cart = \App\Models\Cart::where('userid', auth()->id())->first();
            $check = \App\Models\CartDetail::where('cartid', $cart->id)
                                            ->where('prodid', $productDetail->id)
                                            ->first();
    
            if(!$check){
                $cartDetail = \App\Models\CartDetail::create([
                    'cartid' => $cart->id,
                    'prodid' => $productDetail->id,
                    'price' => $product->discount,
                    'total' => $product->discount,
                    'quantity' => $request->quantity,
                    'status' => 1,
                ]);
            }
    
            // Đếm lại số lượng sản phẩm trong giỏ hàng
            $response['count'] = \App\Models\CartDetail::where('cartid', $cart->id)->count();
    
            return $response;
        }
    
        return back();
    }    

    public function delete(Request $request){
        if($request->ajax()){

            $response['cart'] = $cartDetail = \App\Models\CartDetail::find($request->id)->delete();

            $cart = \App\Models\Cart::where('userid', auth()->id())->first();
            $cartDetails = \App\Models\CartDetail::where('cartid', $cart->id)->where('status',1)->get();
            
            $response['count'] = $cartDetails->count();
            $response['total'] = number_format($cartDetails->sum('total'));

            return $response;
        }

        return back();
    }

    public function edit(Request $request){
        if($request->ajax()){

            $cartDetail = \App\Models\CartDetail::find($request->id);

            if($cartDetail){
                $cartDetail->update([
                    'quantity' => $request->quantity,
                    'total' => $request->quantity * $cartDetail->price
                ]);

                $response['total'] = number_format($cartDetail->total);

                $cart = \App\Models\Cart::where('userid', auth()->id())->first();
                $cartDetails = \App\Models\CartDetail::where('cartid', $cart->id)->where('status',1)->get();

                $response['totals'] = number_format($cartDetails->sum('total'));

                return $response;
            }
        }
    }

    public function update(Request $request){
        if($request->ajax()){

            $cartDetail = \App\Models\CartDetail::find($request->id);
            $productDetail = \App\Models\ProductDetail::where('size', $request->size)->where('color', $request->color)->first();

            if($cartDetail && $productDetail){
                $cartDetail->update([
                    'prodid' => $productDetail->id,
                ]);

                $response = [
                    'cart' => $productDetail,
                ];

                return $response;
            }
        }
    }

    public function check(Request $request){
        if($request->ajax()){

            $cartDetail = \App\Models\CartDetail::find($request->id);

            if($cartDetail){
                if($cartDetail->status == 1){
                    $cartDetail->update([
                        'status' => 0,
                    ]);
                }
                else{
                    $cartDetail->update([
                        'status' => 1,
                    ]);
                }
         
                $cart = \App\Models\Cart::where('userid', auth()->id())->first();
                $cartDetails = \App\Models\CartDetail::where('cartid', $cart->id)->where('status',1)->get();

                $response['totals'] = number_format($cartDetails->sum('total'));

                return $response;
            }
        }
    }
}
