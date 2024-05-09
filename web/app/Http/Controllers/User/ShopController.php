<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function perPage(Request $request){
        $number = 9;
        if (session()->has('    perPage')) {
            $number = session('perPage');
        }
        $perPage = $request->input('perPage', $number);
        session(['perPage' => $perPage]);
        return $perPage;
    }

    public function filter(Request $request, $product){
        $brand = $request->input('brand',[]);
        $brands = array_keys($brand);
        $product = $brands != null ? $product->whereIn('brandid', $brands) : $product;
        
        $min = ($request->min)*1000000;
        $max = ($request->max)*1000000;

        $product = ($min != null && $max != null) ? $product->whereBetween('price',[$min,$max]) : $product;

        return $product;
    }
    
    public function index(Request $request){   
        $cartDetail = null;
        $loveDetail = null;
        if(auth()->check()){
            $cart = \App\Models\Cart::where('userid', auth()->id())->first();
            $cartDetail = \App\Models\CartDetail::where('cartid', $cart->id)->get();
            $love = \App\Models\LoveList::where('userid', auth()->id())->first();
            $loveDetail = \App\Models\LoveListDetail::where('loveid', $love->id)->get();
        }
        $search = $request->input('search', '');
        $product = \App\Models\Product::where('name','like','%'.$search.'%');
        $product = $this->filter($request,$product)->paginate($this->perPage($request));
        $category = \App\Models\Category::limit(8)->get();
        $brand = \App\Models\Brand::limit(6)->get();
        return view('user.shop.index', compact('loveDetail','cartDetail','brand','category','product'));
    }

    public function category(Request $request, $catid){   
        $cartDetail = null;
        $loveDetail = null;
        if(auth()->check()){
            $cart = \App\Models\Cart::where('userid', auth()->id())->first();
            $cartDetail = \App\Models\CartDetail::where('cartid', $cart->id)->get();
            $love = \App\Models\LoveList::where('userid', auth()->id())->first();
            $loveDetail = \App\Models\LoveListDetail::where('loveid', $love->id)->get();
        }
        $product = \App\Models\Product::where('catid','=',$catid);
        $product = $this->filter($request,$product)->paginate($this->perPage($request));
        $category = \App\Models\Category::limit(8)->get();
        $brand = \App\Models\Brand::limit(6)->get();
        return view('user.shop.index', compact('loveDetail','cartDetail','brand','category','product'));
    }
}
