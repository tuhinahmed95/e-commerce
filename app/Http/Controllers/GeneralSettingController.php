<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\GeneralSetting;
use App\Models\Socialmedia;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    public function general_setting(){
        $generals = GeneralSetting::all();
        return view('admin.sidesetting.general_setting',compact('generals'));
    }
    public function general_store(Request $request){
        $request->validate([
            'header_logo'=>'required',
            'footer_logo'=>'required',
        ]);

        $uploadPath = public_path('uploads/sidesetting/');

        if($request->hasFile('header_logo')){
            $header_image = $request->file('header_logo');
            $header_image_name = time().'.'.$header_image->getClientOriginalExtension();
            $header_image->move($uploadPath,$header_image_name);
        }
        if($request->hasFile('footer_logo')){
            $footer_image = $request->file('footer_logo');
            $footer_image_name = time().'.'.$footer_image->getClientOriginalExtension();
            $footer_image->move($uploadPath,$footer_image_name);
        }
        GeneralSetting::create([
            'header_logo'=>$header_image_name,
            'footer_logo'=>$footer_image_name,
            'created_at'=> Carbon::now(),
        ]);
        return back()->with('success', 'Header & Footer Logo Created Successfully');
    }
    public function general_edit($id){
        $general = GeneralSetting::find($id);
        return view('admin.sidesetting.general_setting_edit',compact('general'));
    }
    public function general_update(Request $request,$id){
        $request->validate([
            'header_logo'=>'nullable',
            'footer_logo'=>'nullable',
        ]);

       $settings = GeneralSetting::findOrFail($id);
       $uploadPath = public_path('uploads/sidesetting/');

       if($request->file('header_logo')){
            if($settings->header_logo && file_exists(public_path($settings->header_logo))){
                unlink(public_path($settings->header_logo));
            }

            $header_image = $request->file('header_logo');
            $header_image_name = time().'.'.$header_image->getClientOriginalExtension();
            $header_image->move($uploadPath,$header_image_name);
            $settings->header_logo = ('uploads/sidesetting/'.$header_image_name);
       }
       if($request->file('footer_logo')){
            if($settings->footer_logo && file_exists(public_path($settings->footer_logo))){
                unlink(public_path($settings->footer_logo));
            }

            $footer_image = $request->file('footer_logo');
            $footer_image_name = time().'.'.$footer_image->getClientOriginalExtension();
            $footer_image->move($uploadPath,$footer_image_name);
            $settings->footer_logo = ('uploads/sidesetting/'.$footer_image_name);
       }
       $settings->save();
       return redirect()->route('general.logo');
    }
    public function general_delete($id){
        $settings = GeneralSetting::find($id);

        if($settings->header_logo && file_exists(public_path($settings->header_logo))){
            unlink(public_path($settings->header_logo));
        }
        if($settings->footer_logo && file_exists(public_path($settings->footer_logo))){
            unlink(public_path($settings->footer_logo));
        }
        $settings->delete();
        return back();
    }
    public function general_contact(){
        $contacts = Contact::all();
        return view('admin.sidesetting.contact_list',compact('contacts'));
    }
    public function general_contact_store(Request $request){
        $request->validate([
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);
        Contact::create([
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success', 'Contact Created Successfully');
    }
    public function general_contact_edit($id){
        $contact = Contact::find($id);
        return view('admin.sidesetting.contact_edit',compact('contact'));
    }
    public function general_contact_update(Request $request, $id){
        $request->validate([
            'email'=>'nullable',
            'phone'=>'nullable',
            'address'=>'nullable',
        ]);
        $contact = Contact::find($id);
        $contact->update([
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
        ]);
        return redirect()->route('general.contact.list');
    }
    public function general_contact_delete($id){
        $contact = Contact::find($id);
        $contact->delete();
        return back()->with('contact_delete', 'Contact Delete Successfully');
    }
    public function socialmedia_list(){
        $socialmedias = Socialmedia::all();
        return view('admin.sidesetting.socilmeia_list',compact('socialmedias'));
    }
    public function socialmedia_create(){
        return view('admin.sidesetting.socialmedia_create');
    }
    public function socialmedia_store(Request $request){
        $request->validate([
            'icon_name'=>'nullable',
            'social_icon'=>'required',
            'link'=>'nullable',
            'color'=>'nullable',

        ]);
        Socialmedia::create([
            'icon_name' => $request->icon_name,
            'social_icon' => $request->social_icon,
            'link' => $request->link,
            'color' =>$request->color,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('general.socialmedia.list');
    }
    public function socialmedia_edit($id){
        $social = Socialmedia::find($id);
        return view('admin.sidesetting.social_update',compact('social'));
    }
    public function socialmedia_update(Request $request, $id){
        $social = Socialmedia::find($id);
        $request->validate([
            'icon_name'=>'nullable',
            'social_icon'=>'nullable',
            'link'=>'nullable',
            'color'=>'nullable',
        ]);
        $social->update([
            'icon_name' => $request->icon_name,
            'social_icon' => $request->social_icon,
            'link' => $request->icon,
            'color' =>$request->color,
        ]);
        return redirect()->route('general.socialmedia.list');
    }
    public function socialmedia_delete($id){
        $social = Socialmedia::find($id);
        $social->delete();
        return back();
    }
}
