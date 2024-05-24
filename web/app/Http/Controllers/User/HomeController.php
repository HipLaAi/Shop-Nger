<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
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
        $productSale = \App\Models\Product::where('status',0)->take(9)->get();
        $productDiscount = \App\Models\Product::whereColumn('price', '>', 'discount')->latest()->take(6)->get();
        $latestProduct = \App\Models\Product::latest()->take(8)->get();
        $slide = \App\Models\Slide::limit(5)->get();
        $category = \App\Models\Category::limit(8)->get();
        $brand = \App\Models\Brand::limit(6)->get();
        $mostLovedProducts = \App\Models\Product::select('p.id','p.name','p.price','p.discount', \DB::raw('count(l.proid) as love_count'))
                                                ->from('products as p')
                                                ->join('love_list_details as l', 'l.proid', '=', 'p.id')
                                                ->groupBy('p.name','p.id','p.price','p.discount')
                                                ->orderBy('love_count','desc')
                                                ->take(8)
                                                ->get();
    
        $bestSellingProducts = \App\Models\Product::select('p.id','p.name','p.price','p.discount', \DB::raw('count(sbd.quantity) as product_count'))
                                                    ->from('products as p')
                                                    ->join('sale_bill_details as sbd', 'sbd.name_product', '=', 'p.name')
                                                    ->groupBy('p.name','p.id','p.price','p.discount')
                                                    ->orderBy('product_count','desc')
                                                    ->take(8)
                                                    ->get();

        return view ('user.home.index', compact('loveDetail','cartDetail','bestSellingProducts','mostLovedProducts','latestProduct','productSale', 'slide', 'category', 'brand','productDiscount'));
    }    
}
