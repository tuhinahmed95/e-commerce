<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class BrandController extends Controller
{
    public function brand_list(){
        $brands = Brand::all();
        return view('admin.brand.brand_list',compact('brands'));
    }

    public function brand_create(){
        return view('admin.brand.brand_create');
    }

    public function brand_store(Request $request){
        $request->validate([
            'brand_name'=>'required',
            'brand_logo'=>'required'
        ]);

        if ($request->hasFile('brand_logo')) {
            $image = $request->file('brand_logo');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_path = 'uploads/brand/' . $image_name;
            $image->move(public_path('uploads/brand'), $image_name);
        }


        Brand::create([
            'brand_name' => $request->brand_name,
            'brand_logo' => $image_path,
        ]);
        return redirect()->route('brand.list');
    }

    public function brand_edit($id){
        $brands = Brand::find($id);
        return view('admin.brand.brand_edit',compact('brands'));
    }

    public function brand_update(Request $request,$id){
        $request->validate([
            'brand_name'=>'required',
            'brand_logo'=>'nullable'
        ]);

        $brands = Brand::find($id);
     if($request->hasFile('brand_logo')) {
        $oldImagePath = str_replace('uploads/category', '', $brands->brand_logo);

        if (file_exists(public_path($oldImagePath)) && $brands->brand_logo) {
            unlink(public_path($oldImagePath));
        }

        $image = $request->file('brand_logo');
        $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/brand'), $imageName);

        $brands->brand_logo = 'uploads/brand/' . $imageName;
    }

    $brands->update([
        'brand_name' => $request->brand_name,
        'brand_logo' => $brands->brand_logo,
     ]);

     return redirect()->route('brand.list');
    }

    public function brand_delete($id){
        $brands = Brand::find($id);

        if ($brands && $brands->brand_logo) {
            $oldImagePath = str_replace('uploads/category', '', $brands->brand_logo);

            if (file_exists(public_path('uploads/category/' . $oldImagePath))) {
                unlink(public_path('uploads/category/' . $oldImagePath));
            }
        }

        $brands->delete();

        return redirect()->route('brand.list');
    }

}
