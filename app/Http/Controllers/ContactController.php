<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function AdminContact()
    {
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function AdminAddContact()
    {
        return view('admin.contact.create');
    }

    public function AdminStoreContact(Request $request)
    {
        Contact::insert([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('admin.contact')->with('success', 'Contact Inserted Successfully');
    }

    public function AllContact()
    {
        $contact = DB::table('contacts')->first();
        return view('pages.contact', compact('contact'));
    }

    public function ContactForm(Request $request)
    {
        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('contact')->with('success', 'Your Message Send Successfully');
    }

    public function AdminMessage()
    {
        $messages = ContactForm::all();
        return view('admin.contact.message', compact('messages'));
    }

    public function DeleteMessage($id)
    {
        $delete = ContactForm::find($id)->delete();
        return redirect()->route('admin.message')->with('success', 'Deleted Message Successfully');
    }
}
