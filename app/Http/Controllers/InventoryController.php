<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function inventory_list($id){
        $product = Product::find($id);
        return view('admin.inventory.inventory_list',compact('product'));
    }

    public function inventory_create($id){
        $colors = Color::all();
        $product = Product::find($id);

        return view('admin.inventory.inventory_create',compact('colors','product'));
    }

    public function inventory_store(Request $request,$id){
        $request->validate([
            'product_id'=>'required',
            'color_id'=>'required',
            'size_id'=>'required',
            'quantity'=>'required',
        ]);
        Inventory::create([
            'product_id'=>$id,
            'color_id'=>$request->color_id,
            'size_id'=>$request->size_id,
            'quantity'=>$request->quantity,
        ]);
    }
}
