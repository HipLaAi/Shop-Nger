<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::latest()->get();
        return view('admin.blog.index',compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.add');
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
    
        $blog = Blog::create([
            'title' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        return redirect('admin/blog');
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
        $blog = Blog::find($id);
        return view('admin.blog.edit',compact('blog'));
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
        $blog = Blog::find($id);

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $name = time().rand(1,100) . '.' . $image->extension();
            $image->move(public_path('images'), $name); 
        }

        else
        {
            $name = $blog->image;
        }
    
        $blog->update([
            'title' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $name,
            'updated_at' => now(),
        ]);
    
        return redirect('admin/blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id)->delete();
        return redirect('admin/blog');
    }
}
