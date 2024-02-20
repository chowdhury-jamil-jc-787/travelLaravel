<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coursel;

class CourselController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coursels = Coursel::latest()->paginate(5);
    
        return view('coursels.index',compact('coursels'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coursels.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
    
        Coursel::create($input);
     
        return redirect()->route('admin.coursels.index')
                        ->with('success','Coursel created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\coursel  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Coursel $coursel)
    {
        return view('coursels.show',compact('coursel'));
    }
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Coursel $coursel)
    {
        return view('coursels.edit',compact('coursel'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coursel $coursel)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required'
        ]);
    
        $input = $request->all();
    
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }
    
        try {
            $coursel->update($input);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Coursel');
        }
    
        return redirect()->route('admin.coursels.index')->with('success', 'Coursel updated successfully');
    }
    
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coursel $coursel)
    {
        $coursel->delete();
     
        return redirect()->route('admin.coursels.index')
                        ->with('success','Coursel deleted successfully');
    }
}
