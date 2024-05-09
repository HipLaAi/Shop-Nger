<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index($id){
        $cartDetail = null;
        $loveDetail = null;
        if(auth()->check()){
            $cart = \App\Models\Cart::where('userid', auth()->id())->first();
            $cartDetail = \App\Models\CartDetail::where('cartid', $cart->id)->get();
            $love = \App\Models\LoveList::where('userid', auth()->id())->first();
            $loveDetail = \App\Models\LoveListDetail::where('loveid', $love->id)->get();
        }
        $product = \App\Models\Product::find($id);
        $relatedProduct = \App\Models\Product::where('catid','=',$product->catid)->get();
        $review = \App\Models\Review::where('proid','=',$id)->get();
        $checkReview = \App\Models\Review::where('userid',auth()->id())->where('proid','=',$id)->first();
        return view('user.detail.index', compact('checkReview','review','relatedProduct','product','cartDetail','loveDetail'));
    }

    public function getSize(Request $request){
        if ($request->ajax()) {
            $sizes = \App\Models\ProductDetail::where('proid', $request->proid)
                                    ->where('color', $request->color)
                                    ->pluck('size')
                                    ->unique()
                                    ->toArray();

            return response()->json(['sizes' => $sizes]);
        }
    }

    // public function review(Request $request, $id){
    //     $review = \App\Models\Review::create([
    //         'proid' => $id,
    //         'userid' => auth()->id(),
    //         'review' => $request->input('rating'),
    //         'comment' => $request->input('comment'),
    //         'status' => 1,
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);
    //     return redirect('product/' . $id);
    // }

    
    public function review(Request $request){
        if ($request->ajax()) {
            $review = \App\Models\Review::create([
                'proid' => $request->proid,
                'userid' => auth()->id(),
                'review' => $request->review,
                'comment' => $request->comment,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $response['name'] = $review->users->name;
            $response['avatar'] = $review->users->avatar;
            $response['reviews'] = $review;

            $review = \App\Models\Review::where('proid','=',$request->proid)->get();
            $response['avg'] = number_format($review->avg('review'),1);
            $response['count'] = $review->count('review');
            $response['5start'] = $review->where('review', 5)->count();
            $response['4start'] = $review->where('review', 4)->count();
            $response['3start'] = $review->where('review', 3)->count();
            $response['2start'] = $review->where('review', 2)->count();
            $response['1start'] = $review->where('review', 1)->count();

            return $response;
        }
    }
}
