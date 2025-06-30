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
    
    public function index(Request $request)
    {
        // Debug: Add some logging
        \Log::info('ProductController@index called', [
            'search' => $request->get('search'),
            'category' => $request->get('category'), 
            'status' => $request->get('status'),
            'all_params' => $request->all()
        ]);
        
        // Build base query
        $query = Product::where('product.status','!=',0)
            ->join('category','category.id','=','product.category_id')
            ->join('brand','brand.id','=','product.brand_id')
            ->select('product.id','product.name','product.price','product.pricesale','product.image','product.qty','category.id as categoryid','category.name as categoryname','brand.name as brandname','product.status as status');
        
        // Apply search filter
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            \Log::info('Applying search filter', ['term' => $searchTerm]);
            $query->where(function($q) use ($searchTerm) {
                $q->where('product.name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('category.name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('brand.name', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // Apply category filter
        if ($request->has('category') && !empty($request->category)) {
            \Log::info('Applying category filter', ['category' => $request->category]);
            $query->where('category.id', $request->category);
        }
        
        // Apply status filter
        if ($request->has('status') && $request->status !== '' && $request->status !== null) {
            \Log::info('Applying status filter', ['status' => $request->status]);
            $query->where('product.status', $request->status);
        }
        
        // Log the final query
        \Log::info('Final query SQL', ['sql' => $query->toSql()]);
        
        // Get all products for statistics (without filters)
        $all_products = Product::where('product.status','!=',0)
            ->join('category','category.id','=','product.category_id')
            ->join('brand','brand.id','=','product.brand_id')
            ->select('product.id','product.name','product.price','product.pricesale','product.image','product.qty','category.id as categoryid','category.name as categoryname','brand.name as brandname','product.status as status')
            ->orderBy('product.created_at','desc')
            ->get();
        
        // Get filtered and paginated products for display
        $list_product = $query->orderBy('product.created_at','desc')->paginate(10);
        
        // Preserve query parameters in pagination
        $list_product->appends($request->query());
        
        // Get all categories for filter dropdown (exclude "Hoa tươi" and "Dụng cụ chăm sóc hoa")
        $categories = \App\Models\Category::where('status', '!=', 0)
            ->whereNotIn('id', [1, 2]) // Exclude "Hoa tươi" (ID=1) and "Dụng cụ chăm sóc hoa" (ID=2)
            ->get();
        
        // For backward compatibility, also pass as $list
        $list = $list_product;
        
        return view("backend.product.product",compact("list_product", "list", "all_products", "categories"));
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
        
        // Get categories directly from category table (exclude "Hoa tươi" and "Dụng cụ chăm sóc hoa")
        $categories = \App\Models\Category::where('status', '!=', 0)
            ->whereNotIn('id', [1, 2]) // Exclude "Hoa tươi" (ID=1) and "Dụng cụ chăm sóc hoa" (ID=2)
            ->get();
        
        // Get brands from products
        $brands = \App\Models\Brand::where('status', '!=', 0)->get();
        
        $htmlcategoryid="";
        $htmlbrandid="";
        
        // Build category options (excluding the two hidden categories)
        foreach($categories as $category)
        {
            $htmlcategoryid .= "<option value='" . $category->id . "'>" . $category->name . "</option>";
        }
        
        // Build brand options
        foreach($brands as $brand)
        {
            $htmlbrandid .= "<option value='" . $brand->id . "'>" . $brand->name . "</option>";
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
        
        // Get categories directly from category table (exclude "Hoa tươi" and "Dụng cụ chăm sóc hoa")
        $categories = \App\Models\Category::where('status', '!=', 0)
            ->whereNotIn('id', [1, 2]) // Exclude "Hoa tươi" (ID=1) and "Dụng cụ chăm sóc hoa" (ID=2)
            ->get();
        
        // Get brands from brand table
        $brands = \App\Models\Brand::where('status', '!=', 0)->get();
        
        $htmlcategoryid="";
        $htmlbrandid="";
        
        // Build category options (excluding the two hidden categories)
        foreach ($categories as $category){
            if($product->category_id == $category->id)
            {
                $htmlcategoryid .= "<option selected value='" . $category->id . "'>" . $category->name . "</option>";
            }
            else {
                $htmlcategoryid .= "<option value='" . $category->id . "'>" . $category->name . "</option>";
            }
        }
        
        // Build brand options
        foreach ($brands as $brand){
            if($product->brand_id == $brand->id)
            {
                $htmlbrandid .= "<option selected value='" . $brand->id . "'>" . $brand->name . "</option>";
            }
            else{
                $htmlbrandid .= "<option value='" . $brand->id . "'>" . $brand->name . "</option>";
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
