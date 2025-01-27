<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
   public function add_inventory($id){
    $colors = Color::all();
    $product = Product::find($id);
    $inventories = Inventory::where('product_id',$id)->get();
    return view('admin.product.inventory',compact('colors','product','inventories'));
   }

   public function inventory_store(Request $request,$id){
    $request->validate([
        'color_id'=>'required',
        'size_id'=>'required',
        'quantity'=>'required'
    ]);

    if(Inventory::where('product_id',$id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->exists()){
        Inventory::where('product_id',$id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->increment('quantity',$request->quantity);

        return back();
    }

    Inventory::create([
        'product_id'=>$id,
        'color_id'=>$request->color_id,
        'size_id'=>$request->size_id,
        'quantity'=>$request->quantity
    ]);
    return back();
   }

   public function inventory_delete($id){
    Inventory::find($id)->delete();
    return back();
   }
}
