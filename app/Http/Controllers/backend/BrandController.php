<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list =Brand::where('status','!=',0)->orderBy('created_at','desc')->get();
        $htmlsortorder="";
        foreach($list as $item)
        {
             $htmlsortorder .="<option value='" . $item->sort_order . "'>" . $item->sort_order . "</option>";
        }
        return view("backend.brand.brand",compact("list","htmlsortorder"));
    }

    /**
     * Show the form for creating a new resource.
     */
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::of($request->name)->slug('-');
        $brand->sort_order =$request->sort_order;
        $brand->description =$request->description;
        $brand->created_at =date('Y-m-d H:i:s');
        $brand->created_by =Auth::id()??1;
        $brand->status = $request->status;
        if ($request->hasFile('image')) {
            if (in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])) {
                $filename = $brand->slug . '.' . $request->image->extension();
                $request->image->move(public_path("images/brands"), $filename);
                $brand->image = $filename;
            }
        }
        if ($brand->save()) {
            toastr()->success('Added successfully!');
        }
        return redirect()->route('admin.brand.index');
    }

    /**
     * Display the specified resource.
     */
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.brand.index');
        }
        $list =Brand::where('status','!=',0)->orderBy('created_at','desc')->get();
        $htmlsortorder="";
        foreach($list as $item)
        {
            if($brand->sort_order-1==$item->sort_order)
            {
                $htmlsortorder .="<option selected value='" . $item->sort_order . "'>" . $item->name . "</option>"; 
            }
            else{
                $htmlsortorder .="<option value='" . $item->sort_order . "'>" . $item->name . "</option>";
            }
        }
        return view("backend.brand.edit",compact("brand","htmlsortorder"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, string $id)
    {
        $brand =Brand::find($id);
        if ($brand == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.brand.index');
        }
        $brand->name = $request->name;
        $brand->slug = Str::of($request->name)->slug('-');
        $brand->sort_order =$request->sort_order;
        $brand->description =$request->description;
        $brand->updated_at =date('Y-m-d H:i:s');
        $brand->created_by =Auth::id()??1;
        $brand->status = $request->status;
        if ($request->hasFile('image')) {
            if (in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])) {
                $filename = $brand->slug . '.' . $request->image->extension();
                $request->image->move(public_path("images/brands"), $filename);
                $brand->image = $filename;
            }
        }
        if ($brand->save()) {
            toastr()->success('Updated successfully!');
        }
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
 
    public function trash()
    {
        $list= Brand::where('status','=',0)->orderBy('updated_at','desc')->get();
        return view("backend.brand.trash",compact("list"));
    }
    public function show(string $id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.brand.index');
        }
        return view("backend.brand.show", compact("brand"));
    }

    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            return redirect()->route('admin.brand.index');
        }
        $brand->delete();
        return redirect()->route('admin.brand.trash');
    }

    public function delete(string $id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            return redirect()->route('admin.brand.index');
        }
        $brand->status = 0;
        $brand->updated_at = date('Y-m-d H:i:s');
        $brand->updated_by = Auth::id() ?? 1; //id cua quan tri
        $brand->save();
        return redirect()->route('admin.brand.index');
    }
    public function status(string $id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.brand.index');
        }
        $brand->status = ($brand->status == 2) ? 1:2;
        $brand->updated_at = date('Y-m-d H:i:s');
        $brand->updated_by = Auth::id() ?? 1; //id cua quan tri
        $brand->save();
        return redirect()->route('admin.brand.index');
    }

    public function restore(string $id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            return redirect()->route('admin.brand.index');
        }
        $brand->status = 2;
        $brand->updated_at = date('Y-m-d H:i:s');
        $brand->updated_by = Auth::id() ?? 1; //id cua quan tri
        $brand->save();
        return redirect()->route('admin.brand.trash');
    }
}
