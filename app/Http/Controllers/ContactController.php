<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{


    public function Contact(){
        $contact = DB::table('contacts')->first();
        return view('pages.contact', compact('contact'));
    }

    public function ContactForm( Request $request){
        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' =>Carbon::now(),
        ]);
        return Redirect()->route('contact')->with('success', 'Contact Message Successfully');
    }

    public function ContactMessage(){
        $contacts_message = ContactForm::all();
        return view('admin.contact.message', compact('contacts_message'));
    }


    //Admin Contact function
    public function AdminContact(){
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function AdminAddContact(){
        return view('admin.contact.create');
    }

    public function AdminStoreContact(Request $request){
        Contact::insert([
            'address'=>$request->address,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'created_at'=>Carbon::now(),
        ]);
        return Redirect()->route('admin.contact')->with('success', 'Contact Inserted Successfully');
    }
    public function AdminEditContact($id){
        $contact = Contact::find($id);
        return view('admin.contact.edit', compact('contact'));
    }

    public function AdminUpdateContact(Request $request,$id){
        Contact::find($id)->update([
            'address'=>$request->address,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'created_at'=>Carbon::now(),
        ]);
        return Redirect()->route('admin.contact')->with('success', 'Contact Updated Successfully');
    }
    public function AdminDeleteContact($id){
        Contact::find($id)->delete();
        return Redirect()->back()->with('success','Contact deleted Successfully');
    }
}
