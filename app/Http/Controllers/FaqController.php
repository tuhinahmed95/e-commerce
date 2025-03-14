<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::all();
        return view('admin.faq.faq_list',compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faq.faq_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question'=>'required',
            'answer'=>'required'
        ]);
        Faq::create([
            'question'=>$request->question,
            'answer'=>$request->answer,
            'created_at'=> Carbon::now(),
        ]);
        return redirect()->route('faq.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $faq = Faq::find($id);
        return view('admin.faq.faq_show',compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faq = Faq::find($id);
        return view('admin.faq.faq_edit',compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'question'=>'nullable',
            'ansswer'=>'nullable',
        ]);
        Faq::find($id)->update([
            'question'=>$request->question,
            'answer'=>$request->answer,
        ]);
        return redirect()->route('faq.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = Faq::find($id);
        $faq->delete();
        return redirect()->route('faq.index');
    }
}
