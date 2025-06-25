<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
 
    public function index()
    {
        $list = User::where('status','!=',0)->orderBy('created_at','desc')->get();
        return view("backend.user.user",compact("list"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->email =$request->email;
        $user->roles =$request->roles;
        $user->address =$request->address;
        $user->created_at =date('Y-m-d H:i:s');
        $user->created_by =Auth::id()??1;
        $user->status = $request->status;
        if ($request->hasFile('image')) {
            if (in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])) {
                $filename = $user->username . '.' . $request->image->extension();
                $request->image->move(public_path("images/users"), $filename);
                $user->image = $filename;
            }
        }
        if ($user->save()) {
            toastr()->success('Added successfully!');
        }
        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     */
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.user.index');
        }
        return view('backend.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.user.index');
        }
        $user->name = $request->name;
        $user->username = $request->username;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->email =$request->email;
        $user->roles =$request->roles;
        $user->address =$request->address;
        $user->updated_at =date('Y-m-d H:i:s');
        $user->created_by =Auth::id()??1;
        $user->status = $request->status;
        if ($request->hasFile('image')) {
            if (in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])) {
                $filename = $user->username . '.' . $request->image->extension();
                $request->image->move(public_path("images/users"), $filename);
                $user->image = $filename;
            }
        }
        if ($user->save()) {
            toastr()->success('Updated successfully!');
        }        return redirect()->route('admin.user.index');
    }

    public function trash()
    {
        $list= User::where('status','=',0)->orderBy('updated_at','desc')->get();
        return view("backend.user.trash",compact("list"));
    }
    public function show(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.user.index');
        }
        return view("backend.user.show", compact("user"));
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->route('admin.user.index');
        }
        $user->delete();
        return redirect()->route('admin.user.trash');
    }

    public function delete(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->route('admin.user.index');
        }
        $user->status = 0;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->updated_by = Auth::id() ?? 1; //id cua quan tri
        $user->save();
        return redirect()->route('admin.user.index');
    }
    public function status(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.user.index');
        }
        $user->status = ($user->status == 2) ? 1:2;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->updated_by = Auth::id() ?? 1; //id cua quan tri
        $user->save();
        return redirect()->route('admin.user.index');
    }

    public function restore(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->route('admin.user.index');
        }
        $user->status = 2;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->updated_by = Auth::id() ?? 1; //id cua quan tri
        $user->save();
        return redirect()->route('admin.user.trash');
    }
}
