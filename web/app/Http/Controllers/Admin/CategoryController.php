<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::latest()->get();
        return view('admin.category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.category.add',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
        ]);
  
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $name = time().rand(1,100) . '.' . $image->extension();
            $image->move(public_path('images'), $name); 
        }
        else
        {
            $name = null;
        }
    
        $category = Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        return redirect('admin/category');
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
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
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
        $category = Category::find($id);

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $name = time().rand(1,100) . '.' . $image->extension();
            $image->move(public_path('images'), $name); 
        }

        else
        {
            $name = $category->image;
        }
    
        $category->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $name,
            'updated_at' => now(),
        ]);
    
        return redirect('admin/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id)->delete();
        return redirect('admin/category');
    }
}
