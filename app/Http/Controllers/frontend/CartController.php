<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    public function index()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            toastr()->warning('Vui lòng đăng nhập để xem giỏ hàng của bạn.');
            return redirect()->route('website.getlogin');
        }
        
        // Get cart items for authenticated user
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'asc')
            ->get();
            
        // Convert to format expected by the view
        $list_cart = [];
        foreach ($cartItems as $item) {
            $list_cart[] = [
                'id' => $item->id, // Cart item ID, not product ID
                'product_id' => $item->product_id, // Keep product ID for updates/deletes
                'name' => $item->product->name,
                'image' => $item->product->image,
                'qty' => $item->quantity,
                'price' => $item->price,
            ];
        }
        
        return view("frontend.cart", compact('list_cart'));
    }


    public function addcart()
    {
        try {
            \Log::info('AddCart called with data:', $_GET);
            
            // Check if user is authenticated
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.',
                    'toastr_type' => 'warning',
                    'redirect' => route('website.getlogin')
                ]);
            }
            
            $productid = $_GET['productid'] ?? null;
            $qty = (int)($_GET['qty'] ?? 1);
            
            if (!$productid) {
                return response()->json([
                    'success' => false,
                    'message' => 'Thiếu mã sản phẩm!',
                    'toastr_type' => 'error'
                ]);
            }
            
            $product = Product::find($productid);
            
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm!',
                    'toastr_type' => 'error'
                ]);
            }
            
            $price = ($product->pricesale > 0) ? $product->pricesale : $product->price;
            $userId = Auth::id();
            
            // Check if item already exists in cart
            $existingCartItem = Cart::where('user_id', $userId)
                ->where('product_id', $productid)
                ->first();
                
            if ($existingCartItem) {
                // Update quantity
                $existingCartItem->quantity += $qty;
                $existingCartItem->save();
                $message = "🔄 Đã cập nhật số lượng '{$product->name}' trong giỏ hàng!";
            } else {
                // Create new cart item
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $productid,
                    'quantity' => $qty,
                    'price' => $price
                ]);
                $message = "✅ Đã thêm '{$product->name}' vào giỏ hàng!";
            }
            
            // Get total cart count
            $cartCount = Cart::where('user_id', $userId)->sum('quantity');
            
            \Log::info('Cart updated successfully', ['cart_count' => $cartCount]);
            
            return response()->json([
                'success' => true,
                'message' => $message,
                'cart_count' => $cartCount,
                'toastr_type' => 'success'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('AddCart error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage(),
                'toastr_type' => 'error'
            ], 500);
        }
    }
   

    public function update(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            toastr()->warning('Vui lòng đăng nhập để cập nhật giỏ hàng.');
            return redirect()->route('website.getlogin');
        }
        
        $list_qty = $request->qty;
        $userId = Auth::id();
        
        try {
            foreach($list_qty as $cartItemId => $qtyvalue) {
                if ($qtyvalue > 0) {
                    Cart::where('user_id', $userId)
                        ->where('id', $cartItemId)
                        ->update(['quantity' => $qtyvalue]);
                } else {
                    // Remove item if quantity is 0 or negative
                    Cart::where('user_id', $userId)
                        ->where('id', $cartItemId)
                        ->delete();
                }
            }
            
            toastr()->success('🔄 Giỏ hàng đã được cập nhật thành công!');
        } catch (\Exception $e) {
            \Log::error('Cart update error: ' . $e->getMessage());
            toastr()->error('Cập nhật giỏ hàng thất bại. Vui lòng thử lại.');
        }
        
        return redirect()->route('site.cart.index');
    }

    public function delete($id)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            toastr()->warning('Vui lòng đăng nhập để quản lý giỏ hàng của bạn.');
            return redirect()->route('website.getlogin');
        }
        
        $userId = Auth::id();
        
        try {
            // Find the cart item with product details using cart item ID
            $cartItem = Cart::with('product')
                ->where('user_id', $userId)
                ->where('id', $id)
                ->first();
            
            if ($cartItem) {
                $productName = $cartItem->product->name;
                $cartItem->delete();
                toastr()->warning("🗑️ Đã xóa '{$productName}' khỏi giỏ hàng!");
            } else {
                toastr()->error('Không tìm thấy sản phẩm trong giỏ hàng!');
            }
        } catch (\Exception $e) {
            \Log::error('Cart delete error: ' . $e->getMessage());
            toastr()->error('Xóa sản phẩm khỏi giỏ hàng thất bại. Vui lòng thử lại.');
        }
        
        return redirect()->route('site.cart.index');
    }
    public function checkout(){
        // Check if user is authenticated
        if (!Auth::check()) {
            toastr()->warning('Vui lòng đăng nhập để thanh toán.');
            return redirect()->route('website.getlogin');
        }
        
        // Get cart items from database
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'asc')
            ->get();
            
        // Convert to format expected by the view
        $cart_list = [];
        foreach ($cartItems as $item) {
            $cart_list[] = [
                'id' => $item->id, // Cart item ID
                'product_id' => $item->product_id, // Keep product ID for reference
                'name' => $item->product->name,
                'image' => $item->product->image,
                'qty' => $item->quantity,
                'price' => $item->price,
            ];
        }
        
        if (empty($cart_list)) {
            toastr()->warning('🛒 Giỏ hàng của bạn đang trống!');
            return redirect()->route('site.cart.index');
        }
        
        return view('frontend.checkout', compact('cart_list'));
    }
    public function docheckout(Request $request) {
        // Check if user is authenticated
        if (!Auth::check()) {
            toastr()->warning('Vui lòng đăng nhập để đặt hàng.');
            return redirect()->route('website.getlogin');
        }
        
        $user = Auth::user();
        $userId = Auth::id();
        
        // Get cart items from database
        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->orderBy('id', 'asc')
            ->get();
        
        if($cartItems->count() == 0){
            toastr()->warning('🛒 Giỏ hàng của bạn đang trống!');
            return redirect()->route('site.cart.index');
        }
        
        try {
            $order = new Order();
            $order->user_id = $user->id;
            $order->note = $request->note;
            $order->status = 1;
            
            if ($order->save()) {
                foreach ($cartItems as $cartItem) {
                    $orderdetail = new Orderdetail();
                    $orderdetail->order_id = $order->id;
                    $orderdetail->product_id = $cartItem->product_id;
                    $orderdetail->price = $cartItem->price;
                    $orderdetail->qty = $cartItem->quantity;
                    $orderdetail->discount = 0;
                    $orderdetail->amount = $cartItem->price * $cartItem->quantity;
                    $orderdetail->save();
                }
                
                // Clear cart after successful order by deleting all cart items for this user
                Cart::where('user_id', $userId)->delete();
                
                toastr()->success('🎉 Đặt hàng thành công! Cảm ơn bạn đã mua sắm.');
            } else {
                toastr()->error('❌ Đặt hàng thất bại. Vui lòng thử lại.');
                return redirect()->route('site.cart.checkout');
            }
        } catch (\Exception $e) {
            \Log::error('Checkout error: ' . $e->getMessage());
            toastr()->error('❌ Có lỗi xảy ra trong quá trình đặt hàng. Vui lòng thử lại.');
            return redirect()->route('site.cart.checkout');
        }
        
        return view('frontend.checkout-message');
    }

}
