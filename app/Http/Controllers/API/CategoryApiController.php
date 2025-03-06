<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CategoryApiController extends Controller
{
    public function get_category()
    {
        $categories = Category::all();
        return ($categories);
    }

    public function category_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'icon' => 'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors()->all();
        }
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $file_name = Str::slug($request->category_name) . '-' . time() . '.webp';
            $upload_path = public_path('uploads/category/');
            $icon->move($upload_path, $file_name);
        } else {
            $file_name = 'default.webp';
        }

        $category = Category::create([
            'category_name'=>$request->category_name,
            'icon'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);
        $respones = [
            'category'=>$category,
            'message'=>' Category Added Success',
        ];
        return response()->json($respones);
    }

    public function category_show($id){

        $category = Category::find($id);
        if(!$category){
            $response = [
                'message'=>'Category Does not Esixt',
            ];
            return response()->json($response);
        }
        $response = [
            'category'=>$category,
        ];
        return response()->json($response);
    }


    public function category_update(Request $request, $id)
{

    $validator = Validator::make($request->all(), [
        'category_name' => 'required',
        'icon' => $request->hasFile('icon') ? 'required|image|mimes:jpeg,png,webp|max:2048' : '',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors(),
        ], 422);
    }


    $category = Category::find($id);
    if (!$category) {
        return response()->json([
            'message' => 'Category Does Not Exists!',
        ], 404);
    }


    $category->category_name = $request->category_name;


    if ($request->hasFile('icon')) {

        $old_image = public_path('uploads/category/' . $category->icon);
        if (file_exists($old_image) && is_file($old_image)) {
            unlink($old_image);
        }


        $icon = $request->file('icon');
        $file_name = Str::slug($request->category_name) . '-' . time() . '.webp';
        $upload_path = public_path('uploads/category/');
        $icon->move($upload_path, $file_name);


        $category->icon = $file_name;
    }

    $category->save();

    return response()->json([
        'category' => $category,
        'message' => 'Category Updated Successfully',
    ], 200);
 }

 public function category_delete($id){
    $category = Category::find($id);
    $category->delete();
    $response = [
        'message' => 'Category Delete Successfully',
    ];
    return response()->json($response);
 }
}
