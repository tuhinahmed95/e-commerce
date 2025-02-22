<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function tag(){
        $tags = Tag::all();
        return view('admin.tag.tag',compact('tags'));
    }

    public function tag_store(Request $request){
       $request->validate([
        'tag_name'=>'required'
       ]);
        Tag::create([
            'tag_name'=>$request->tag_name,
        ]);
        return back();
    }

    public function tag_delete($id){
        $tag = Tag::find($id);
        $tag->delete();
        return back();
    }
}
