<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreContactRequest;
class ContactController extends Controller
{
    public function index() {
        return view("frontend.contact");
    }
   
    public function store(StoreContactRequest $request)
    {
        $contact = new Contact();
        $user = Auth::user();
        $contact->user_id = $user ? $user->id : 0;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->title = $request->title;
        $contact->content = $request->content;
        $contact->created_at = date('Y-m-d H:i:s');
        // $contact->created_by = Auth::id() ?? 1;
        if ($contact->save()) {
            toastr()->success('Added successfully!');
        }
        return redirect()->route('site.contact');
    }
}
