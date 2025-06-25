<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
class ProductController extends Controller
{
    //product all
    public function index(Request $request)
    {
        $query = Product::query()->where('status', '=', 1);
        $sort = $request->input('sort', 'default');
        if ($sort == 'nameasc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'namedesc') {
            $query->orderBy('name', 'desc');
        } elseif ($sort == 'priceasc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort == 'pricedesc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }
        $product_list = $query->paginate(6)->appends($request->query());
        $sortOptions = [
            'default' => 'Mặc định',
            'nameasc' => 'Tên A-Z',
            'namedesc' => 'Tên Z-A',
            'priceasc' => 'Giá từ thấp đến cao',
            'pricedesc' => 'Giá từ cao đến thấp',
        ];
        $htmlSortOptions = "";
        foreach ($sortOptions as $value => $label) {
            $selected = $sort == $value ? 'selected' : '';
            $htmlSortOptions .= "<option value='$value' $selected>$label</option>";
        }
        return view('frontend.product', compact('product_list', 'htmlSortOptions'));
    }
    
    public function getlistcategoryid($rowid)
    {
        $listcatid = [];
        array_push($listcatid, $rowid);
        $list1 = Category::where([['parent_id', '=', $rowid], ['status', '=', 1]])->select('id')->get();
        if (count($list1) > 0) {
            foreach ($list1 as $row1) {
                array_push($listcatid, $row1->id);
                $list2 = Category::where([['parent_id', '=', $row1->id], ['status', '=', 1]])->select('id')->get();
                if (count($list2) > 0) {
                    foreach ($list2 as $row2) {
                        array_push($listcatid, $row2->id);
                    }
                }
            }
        }       
        return $listcatid;
    }
    //product category
    public function category($slug, Request $request)    {
        $row = Category::where([['slug', $slug], ['status', '=', 1]])
        ->select('id', 'name', 'slug')
        ->first();
        $listcatid = [];
        if ($row != null) {
            $listcatid = $this->getlistcategoryid($row->id);
        }

        $query = Product::where('product.status', '!=', 0)
            ->whereIn('category_id', $listcatid);

        // Apply sorting
        $sort = $request->input('sort', 'default');
        if ($sort == 'nameasc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'namedesc') {
            $query->orderBy('name', 'desc');
        } elseif ($sort == 'priceasc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort == 'pricedesc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $product_list = $query->paginate(6);

        // Generate sort options HTML
        $sortOptions = [
            'default' => 'Mặc định',
            'nameasc' => 'Tên A-Z',
            'namedesc' => 'Tên Z-A',
            'priceasc' => 'Giá từ thấp đến cao',
            'pricedesc' => 'Giá từ cao đến thấp',
        ];
        $htmlSortOptions = "";
        foreach ($sortOptions as $value => $label) {
            $selected = $sort == $value ? 'selected' : '';
            $htmlSortOptions .= "<option value='$value' $selected>$label</option>";
        }
        return view("frontend.product-category", compact("product_list", "row", "htmlSortOptions"));
    }
    
    public function product_detail($slug)
    {
        $product = Product::where([['status', '=', 1], ['slug', '=', $slug]])->first();
        $listcatid = [];
        $listcatid = $this -> getlistcategoryid($product->category_id);
        $product_list = Product::where([['product.status','=',1],['id','!=',$product->id]])
        ->whereIn('category_id',$listcatid)
        ->orderBy('product.created_at','desc')
        ->limit(8)
        ->get();
        return view('frontend.product-detail', compact('product','product_list'));
    }

    public function brand($slug, Request $request)
    {
        $args_row = [
            ['slug', '=', $slug],
            ['status', '=', 1]
        ];
        $brand = Brand::where($args_row)->select("id", "name", "slug")->first();
        $brandid = $brand->id;
        $query = Product::where([['status', '=', 1], ["brand_id", "=", $brandid]]);
        $sort = $request->input('sort', 'default');
        if ($sort == 'nameasc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'namedesc') {
            $query->orderBy('name', 'desc');
        } elseif ($sort == 'priceasc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort == 'pricedesc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }
        $product_list = $query->paginate(6);
        // Generate sort options HTML
        $sortOptions = [
            'default' => 'Mặc định',
            'nameasc' => 'Tên A-Z',
            'namedesc' => 'Tên Z-A',
            'priceasc' => 'Giá từ thấp đến cao',
            'pricedesc' => 'Giá từ cao đến thấp',
        ];
        $htmlSortOptions = "";
        foreach ($sortOptions as $value => $label) {
            $selected = $sort == $value ? 'selected' : '';
            $htmlSortOptions .= "<option value='$value' $selected>$label</option>";
        }

        return view('frontend.product-brand', compact('product_list', 'brand', 'htmlSortOptions'));
        }

        public function search_product(Request $request)
        {
            $query = htmlspecialchars($request->input('search_query')); // Sử dụng 
            $product_list = Product::where('name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->paginate(9);
        
            return view('frontend.search-product', compact('query', 'product_list'));
        }
}
