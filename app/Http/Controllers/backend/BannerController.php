<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use App\Models\Banner;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use Flasher\Toastr\Prime\ToastrInterface;
 
 
 
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list= Banner::where('status','!=',0)->orderBy('created_at','desc')->get();
        return view("backend.banner.banner",compact("list"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerRequest $request)
    {
        $banner = new Banner();
        $banner->name = $request->name;
        $banner->link =$request->link;
        $banner->position =$request->position;
        $banner->image =$request->image;
        $banner->description =$request->description;
        $banner->created_at =date('Y-m-d H:i:s');
        $banner->created_by =Auth::id()??1;
        $banner->status = $request->status;
        if ($request->hasFile('image')) {
            if (in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])) {
                $filename = $banner->name . '.' . $request->image->extension();
                $request->image->move(public_path("images/banners"), $filename);
                $banner->image = $filename;
            }
        }
        if ($banner->save()) {
            toastr()->success('Added successfully!');
        }
        return redirect()->route('admin.banner.index');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.banner.index');
        }
        return view("backend.banner.edit", compact("banner"));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, string $id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.banner.index');
        }
        $banner->name = $request->name;
        $banner->link =$request->link;
        $banner->position =$request->position;
        $banner->image =$request->image;
        $banner->description =$request->description;
        $banner->updated_at =date('Y-m-d H:i:s');
        $banner->created_by =Auth::id()??1;
        $banner->status = $request->status;
        if ($request->hasFile('image')) {
            if (in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])) {
                $filename = $banner->name . '.' . $request->image->extension();
                $request->image->move(public_path("images/banners"), $filename);
                $banner->image = $filename;
            }
        }
        if ($banner->save()) {
            toastr()->success('Updated successfully!');
        }
        return redirect()->route('admin.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     */


    public function trash()
    {
        $list= Banner::where('status','=',0)->orderBy('updated_at','desc')->get();
        return view("backend.banner.trash",compact("list"));
    }
    public function show(string $id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.banner.index');
        }
        return view("backend.banner.show", compact("banner"));
    }

    public function destroy(string $id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            return redirect()->route('admin.banner.index');
        }
        $banner->delete();
        return redirect()->route('admin.banner.trash');
    }

    public function delete(string $id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            return redirect()->route('admin.banner.index');
        }
        $banner->status = 0;
        $banner->updated_at = date('Y-m-d H:i:s');
        $banner->updated_by = Auth::id() ?? 1; //id cua quan tri
        $banner->save();
        return redirect()->route('admin.banner.index');
    }
    public function status(string $id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.banner.index');
        }
        $banner->status = ($banner->status == 2) ? 1:2;
        $banner->updated_at = date('Y-m-d H:i:s');
        $banner->updated_by = Auth::id() ?? 1; //id cua quan tri
        $banner->save();
        return redirect()->route('admin.banner.index');
    }

    public function restore(string $id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            return redirect()->route('admin.banner.index');
        }
        $banner->status = 2;
        $banner->updated_at = date('Y-m-d H:i:s');
        $banner->updated_by = Auth::id() ?? 1; //id cua quan tri
        $banner->save();
        return redirect()->route('admin.banner.trash');
    }
}
?>