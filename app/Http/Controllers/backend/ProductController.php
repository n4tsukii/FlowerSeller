<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
class ProductController extends Controller
{
    
    public function index()
    {
        $list = Product::where('product.status','!=',0)
        ->join('category','category.id','=','product.category_id')
        ->join('brand','brand.id','=','product.brand_id')
        ->select('product.id','product.name','product.price','product.pricesale','product.image','category.id as categoryid','category.name as categoryname','brand.name as brandname','product.status as status')
        ->orderBy('product.created_at','desc')
        ->get();
        return view("backend.product.product",compact("list"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Product::where('product.status','!=',0)
        ->join('category','category.id','=','product.category_id')
        ->join('brand','brand.id','=','product.brand_id')
        ->select('product.id','product.name','product.image','brand.id as brandid','brand.name as brandname','category.id as categoryid','category.name as categoryname','brand.name as brandname')
        ->orderBy('product.created_at','desc')
        ->get();
        $htmlcategoryid="";
        $htmlbrandid="";
        foreach($list as $item)
        {
            $htmlcategoryid .= "<option value='" . $item->categoryid . "'>" . $item->categoryname . "</option>";
            $htmlbrandid .= "<option value='" . $item->brandid . "'>" . $item->brandname . "</option>";
        }
        return view("backend.product.create",compact("list","htmlcategoryid","htmlbrandid"));
    }
     
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::of($request->name)->slug('-');
        $product->category_id =$request->category_id;
        $product->brand_id =$request->brand_id;
        $product->detail =$request->detail;
        $product->price =$request->price;
        $product->pricesale =$request->pricesale;
        $product->qty =$request->qty;
        $product->description =$request->description;
        $product->created_at =date('Y-m-d H:i:s');
        $product->created_by =Auth::id()??1;
        $product->status = $request->status;
        if ($request->hasFile('image')) {
            if (in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])) {
                $filename = $product->slug . '.' . $request->image->extension();
                $request->image->move(public_path("images/products"), $filename);
                $product->image = $filename;
            }
        }
        if ($product->save()) {
            toastr()->success('Added successfully!');
        }
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     */
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.product.index');
        }
        $list = Product::where('product.status','!=',0)
        ->join('category','category.id','=','product.category_id')
        ->join('brand','brand.id','=','product.brand_id')
        ->select('product.id','product.name','product.image','brand.id as brandid','brand.name as brandname','category.id as categoryid','category.name as categoryname','brand.name as brandname')
        ->orderBy('product.created_at','desc')
        ->get();
        $htmlcategoryid="";
        $htmlbrandid="";
        foreach ($list as $item){
            if($product->category_id==$item->categoryid)
            {
                $htmlcategoryid .= "<option selected value='" . $item->categoryid . "'>" . $item->categoryname . "</option>";            }
            else {
                $htmlcategoryid .= "<option value='" . $item->categoryid . "'>" . $item->categoryname . "</option>";            }
            if($product->brand_id==$item->brandid)
            {
                $htmlbrandid .= "<option selected value='" . $item->brandid . "'>" . $item->brandname . "</option>";

            }
            else{
                $htmlbrandid .= "<option value='" . $item->brandid . "'>" . $item->brandname . "</option>";
            }
        }
        return view("backend.product.edit",compact("product","htmlcategoryid","htmlbrandid"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.product.index');
        }
        $product->name = $request->name;
        $product->slug = Str::of($request->name)->slug('-');
        $product->category_id =$request->category_id;
        $product->brand_id =$request->brand_id;
        $product->detail =$request->detail;
        $product->price =$request->price;
        $product->pricesale =$request->pricesale;
        $product->qty =$request->qty;
        $product->description =$request->description;
        $product->updated_at =date('Y-m-d H:i:s');
        $product->created_by =Auth::id()??1;
        $product->status = $request->status;
        if ($request->hasFile('image')) {
            if (in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])) {
                $filename = $product->slug . '.' . $request->image->extension();
                $request->image->move(public_path("images/products"), $filename);
                $product->image = $filename;
            }
        }
        if ($product->save()) {
            toastr()->success('Updated successfully!');
        }
        return redirect()->route('admin.product.index') ;
    }
    public function trash()
    {
        $list= Product::where('status','=',0)->orderBy('updated_at','desc')->get();
        return view("backend.product.trash",compact("list"));
    }
    public function show(string $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.product.index');
        }
        return view("backend.product.show", compact("product"));
    }
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return redirect()->route('admin.product.index');
        }
        $product->delete();
        return redirect()->route('admin.product.trash');
    }

    public function delete(string $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return redirect()->route('admin.product.index');
        }
        $product->status = 0;
        $product->updated_at = date('Y-m-d H:i:s');
        $product->updated_by = Auth::id() ?? 1; //id cua quan tri
        $product->save();
        return redirect()->route('admin.product.index');
    }
    public function status(string $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.product.index');
        }
        $product->status = ($product->status == 2) ? 1:2;
        $product->updated_at = date('Y-m-d H:i:s');
        $product->updated_by = Auth::id() ?? 1; //id cua quan tri
        $product->save();
        return redirect()->route('admin.product.index');
    }

    public function restore(string $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return redirect()->route('admin.product.index');
        }
        $product->status = 2;
        $product->updated_at = date('Y-m-d H:i:s');
        $product->updated_by = Auth::id() ?? 1; //id cua quan tri
        $product->save();
        return redirect()->route('admin.product.trash');
    }
}
