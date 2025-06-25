<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list= Category::where('status','!=',0)->orderBy('created_at','desc')->get();
        $htmlparentid="";
        $htmlsortorder="";
        foreach($list as $item)
        {
            $htmlparentid .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            $htmlsortorder .="<option value='" . $item->sort_order . "'>" . $item->name . "</option>";
        }
        return view("backend.category.category",compact("list","htmlparentid","htmlsortorder"));
    }

    /**
     * Show the form for creating a new resource.
     */
 

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    { 
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::of($request->name)->slug('-');
        $category->parent_id =$request->parent_id;
        $category->sort_order =$request->sort_order;
        $category->description =$request->description;
        $category->created_at =date('Y-m-d H:i:s');
        $category->created_by =Auth::id()??1;
        $category->status = $request->status;
        $filename=$category->slug;
        if ($request->hasFile('image')) {
            if (in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])) {
                $filename = $category->slug . '.' . $request->image->extension();
                $request->image->move(public_path("images/categorys"), $filename);
                $category->image = $filename;
            }
        }
        if ($category->save()) {
            toastr()->success('Added successfully!');
        }
     
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     */
  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.category.index');
        }
        $list = Category::where('status','!=',0)->orderBy('created_at','desc')->get();
        $htmlparentid="";
        $htmlsortorder="";
        foreach ($list as $item){
            if($category->parent_id==$item->id)
            {
                $htmlparentid .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";    
            }
            else {
                $htmlparentid .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            }
            if($category->sort_order-1==$item->sort_order)
            {
                $htmlsortorder .="<option selected value='" . $item->sort_order . "'>" . $item->name . "</option>"; 
            }
            else{
                $htmlsortorder .="<option value='" . $item->sort_order . "'>" . $item->name . "</option>";
            }
        }
        return view("backend.category.edit",compact("category","htmlparentid","htmlsortorder"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.category.index');
        }
        $category->name = $request->name;
        $category->slug = Str::of($request->name)->slug('-');
        $category->parent_id =$request->parent_id;
        $category->sort_order =$request->sort_order;
        $category->description =$request->description;
        // $category->created_at =date('Y-m-d H:i:s');
        $category->updated_at =date('Y-m-d H:i:s');

        $category->created_by =Auth::id()??1;
        $category->status = $request->status;
        $filename=$category->slug;
        if ($request->hasFile('image')) {
            if (in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])) {
                $filename = $category->slug . '.' . $request->image->extension();
                $request->image->move(public_path("images/categorys"), $filename);
                $category->image = $filename;
            }
        }
    
        if ($category->save()) {
            toastr()->success('Updated successfully!');
        }
 
        return redirect()->route('admin.category.index');
    }

    public function trash()
    {
        $list= Category::where('status','=',0)->orderBy('updated_at','desc')->get();
        return view("backend.category.trash",compact("list"));
    }
    public function show(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.category.index');
        }
        return view("backend.category.show", compact("category"));
    }

    public function destroy(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return redirect()->route('admin.category.index');
        }
        $category->delete();
        return redirect()->route('admin.category.trash');
    }

    public function delete(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return redirect()->route('admin.category.index');
        }
        $category->status = 0;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->updated_by = Auth::id() ?? 1; //id cua quan tri
        $category->save();
        return redirect()->route('admin.category.index');
    }
    public function status(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.category.index');
        }
        $category->status = ($category->status == 2) ? 1:2;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->updated_by = Auth::id() ?? 1; //id cua quan tri
        $category->save();
        return redirect()->route('admin.category.index');
    }

    public function restore(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return redirect()->route('admin.category.index');
        }
        $category->status = 2;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->updated_by = Auth::id() ?? 1; //id cua quan tri
        $category->save();
        return redirect()->route('admin.category.trash');
    }
}
