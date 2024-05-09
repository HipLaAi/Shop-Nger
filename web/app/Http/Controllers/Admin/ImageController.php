<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Image;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($proid)
    {
        $product = \App\Models\Product::find($proid);
        return view('admin.image.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $proid)
    {
        if($request->hasfile('images'))
		{
            foreach ($request->images as $key => $item) {
                $name = time().rand(1,100).'.'. $item->getClientOriginalName();
			    $item->move(public_path('images'), $name); 
                $image = Image::create([
                    'proid' => $proid,
                    'image' => $name,
                ]);
            }
		}
        
        return redirect('admin/product/' . $proid . '/image');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($proid,$id)
    {
        $image = Image::find($id)->image;
        if($image != ''){
            unlink('images/'.$image);
        }
        Image::find($id)->delete();
        return redirect('admin/product/' . $proid . '/image');
    }
}
