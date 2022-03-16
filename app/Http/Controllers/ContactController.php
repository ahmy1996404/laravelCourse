<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function AdminContact()
    {
        $contacts = Contact::all();
       return view('admin.contact.index',compact('contacts'));
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
        return redirect()->route('contact')->with('success', 'Contact inserted successfully');
    }
    public function index()
    {
        # code...
    }
}
