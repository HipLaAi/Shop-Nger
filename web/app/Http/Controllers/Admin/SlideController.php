<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slide;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide = Slide::latest()->get();
        return view('admin.slide.index',compact('slide'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slide.add');
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
    
        $slide = Slide::create([
            'title' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        return redirect('admin/slide');
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
        $slide = Slide::find($id);
        return view('admin.slide.edit',compact('slide'));
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
        $slide = Slide::find($id);

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $name = time().rand(1,100) . '.' . $image->extension();
            $image->move(public_path('images'), $name); 
        }

        else
        {
            $name = $slide->image;
        }
    
        $slide->update([
            'title' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $name,
            'updated_at' => now(),
        ]);
    
        return redirect('admin/slide');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slide::find($id)->delete();
        return redirect('admin/slide');
    }
}
