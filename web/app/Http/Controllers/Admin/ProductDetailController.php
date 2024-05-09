<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductDetail;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($proid)
    {
        $product = \App\Models\Product::find($proid);
        return view('admin.product_detail.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($proid)
    {
        $product = \App\Models\Product::find($proid);
        return view('admin.product_detail.add',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $proid)
    {
        $this->validate($request, [
            'color.*' => 'required',
        ]);

        if ($request->has('color')) {
            foreach ($request->color as $key => $color) {
                $productDetail = ProductDetail::create([
                    'proid' => $proid,
                    'size' => $request->size[$key],
                    'color' => $color,
                    'quantity' => $request->quantity[$key],
                ]);
            }
        }
        
        return redirect('admin/product/' . $proid . '/detail');
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
    public function edit($proid,$id)
    {
        $product = \App\Models\Product::find($proid);
        $productDetail = ProductDetail::find($id);
        return view('admin.product_detail.edit',compact('productDetail','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $proid, $id)
    {
        $productDetail = $request->all();
        ProductDetail::find($id)->update($productDetail);
        return redirect('admin/product/' . $proid . '/detail');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($proid,$id)
    {
        ProductDetail::find($id)->delete();
        return redirect('admin/product/' . $proid . '/detail');
    }
}
