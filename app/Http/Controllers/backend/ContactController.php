<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list= Contact::where('status','!=',0)->orderBy('created_at','desc')->get();
        return view("backend.contact.contact",compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.contact.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        $contact = new Contact();
        $contact->user_id = $request->user_id ?? 0; // Prevent null property access
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->title = $request->title;
        $contact->content = $request->content;
        $contact->replay_id = $request->replay_id ?? 0; // Prevent null property access
        $contact->created_at = date('Y-m-d H:i:s');
        // $contact->created_by = Auth::id() ?? 1;
        $contact->status = $request->status ?? 1;
        if ($contact->save()) {
            toastr()->success('Added successfully!');
        }
        return redirect()->route('admin.contact.index');
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list= Contact::where('status','!=',0)->orderBy('created_at','desc')->get();
        $contact = Contact::find($id);
        if ($contact == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.contact.index');
        }
        return view("backend.contact.edit",compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, string $id)
    {
        $contact = Contact::find($id);
        if ($contact == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.contact.index');
        }
        $contact->user_id = $request->user_id;
        $contact->name = $request->name;
        $contact->email =$request->email;
        $contact->phone =$request->phone;
        $contact->title =$request->title;
        $contact->content =$request->content;
        $contact->replay_id =$request->replay_id;
        $contact->updated_at =date('Y-m-d H:i:s');
        // $contact->created_by =Auth::id()??1;
        $contact->status = $request->status;
        if ($contact->save()) {
            toastr()->success('Updated successfully!');
        }
        return redirect()->route('admin.contact.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trash()
    {
        $list= Contact::where('status','=',0)->orderBy('updated_at','desc')->get();
        return view("backend.contact.trash",compact("list"));
    }
    public function show(string $id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            // Logging for debugging purposes
            Log::error("Contact with ID {$id} not found.");
            
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.contact.index');
        }
        return view("backend.contact.show", compact("contact"));
    }
    
    

    public function destroy(string $id)
    {
        $contact = Contact::find($id);
        if ($contact == null) {
            return redirect()->route('admin.contact.index');
        }
        $contact->delete();
        return redirect()->route('admin.contact.trash');
    }

    public function delete(string $id)
    {
        $contact = Contact::find($id);
        if ($contact == null) {
            return redirect()->route('admin.contact.index');
        }
        $contact->status = 0;
        $contact->updated_at = date('Y-m-d H:i:s');
        $contact->updated_by = Auth::id() ?? 1; //id cua quan tri
        $contact->save();
        return redirect()->route('admin.contact.index');
    }
    public function status(string $id)
    {
        $contact = Contact::find($id);
        if ($contact == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.contact.index');
        }
        $contact->status = ($contact->status == 2) ? 1:2;
        $contact->updated_at = date('Y-m-d H:i:s');
        $contact->updated_by = Auth::id() ?? 1; //id cua quan tri
        $contact->save();
        return redirect()->route('admin.contact.index');
    }

    public function restore(string $id)
    {
        $contact = Contact::find($id);
        if ($contact == null) {
            return redirect()->route('admin.contact.index');
        }
        $contact->status = 2;
        $contact->updated_at = date('Y-m-d H:i:s');
        $contact->updated_by = Auth::id() ?? 1; //id cua quan tri
        $contact->save();
        return redirect()->route('admin.contact.trash');
    }
}
