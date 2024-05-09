<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return view('admin.product.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::all();
        $category = \App\Models\Category::all();
        $brand = \App\Models\Brand::all();
        return view('admin.product.add',compact('product','category','brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'images' => 'required',
        //     'images.*' => 'required'
        // ]);

        $brand = null;
        $category = null;

        if($request->input('brandid') != '0'){
            $brand = $request->input('brandid');
        }

        if($request->input('catid') != '0'){
            $category = $request->input('catid');
        }

        $product = Product::create([
            'catid' => $category,
            'brandid' => $brand,
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'description' => $request->input('description'),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($product && $request->has('color')) {
            foreach ($request->color as $key => $color) {
                $productDetail = \App\Models\ProductDetail::create([
                    'proid' => $product->id,
                    'size' => $request->size[$key],
                    'color' => $color,
                    'quantity' => $request->quantity[$key],
                ]);
            }
        }

        if($product && $request->hasfile('images'))
		{
            foreach ($request->images as $key => $item) {
                $name = time().rand(1,100).'.'. $item->getClientOriginalName();
			    $item->move(public_path('images'), $name); 
                $image = \App\Models\Image::create([
                    'proid' => $product->id,
                    'image' => $name,
                ]);
            }
		}
        
        return redirect('admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = \App\Models\Category::all();
        $brand = \App\Models\Brand::all();
        $product = Product::find($id);
        return view('admin.product.edit',compact('product','category','brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $brand = null;
        $category = null;

        if($request->input('brandid') != '0'){
            $brand = $request->input('brandid');
        }

        if($request->input('catid') != '0'){
            $category = $request->input('catid');
        }

        $product=Product::find($id)->update([
            'catid' => $category,
            'brandid' => $brand,
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'description' => $request->input('description'),
            'status'=>(bool)$request->input('status'),
            'updated_at' => now(),
        ]);
        return redirect('admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id)->delete();
        return redirect('admin/product');
    }
}
