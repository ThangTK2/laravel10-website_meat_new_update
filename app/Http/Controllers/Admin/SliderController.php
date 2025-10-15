<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Banner::orderBy('id', 'desc')->paginate(10);
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sliders = Banner::all();
        return view('admin.slider.create', compact('sliders'));

    }

    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required',
            'status' => 'required|in:0,1',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
        ]);

        $slider = new Banner();
        $slider->name = $data['name'];
        $slider->position = $data['position'];
        $slider->status = $data['status'];
        $slider->description = $data['description'];

        $get_image = $request->image;
        $path = 'uploads/gallery/' ;
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_name_image;
        $get_image->move($path, $new_image);
        $slider->image = $new_image;

        $slider->save();

        return redirect()->route('sliders.index')->with('success', 'Tạo slider mới thành công.');
    }


    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slider = Banner::find($id);

        if (!$slider) {
            return redirect()->back()->with('error', 'Không tìm thấy slider.');
        }
        $path_unlink = 'uploads/gallery/'.$slider->image;

        if(file_exists($path_unlink)){
            unlink($path_unlink);
        }
        $slider->delete();
        return redirect()->back()->with('success', 'Xóa slider thành công.');
    }
}
