<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateOrderRequest;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Order::where('order.status','!=',0)
            ->orderBy('order.created_at','desc')
            ->join('user','user.id','=','order.user_id')
            ->leftJoin('orderdetail', 'order.id', '=', 'orderdetail.order_id')
            ->select(
                "order.id as orderid",
                "order.*",
                "user.name as customer_name",
                "user.email as customer_email", 
                "user.phone as customer_phone",
                "user.address as customer_address",
                \DB::raw('COUNT(ntdd_orderdetail.order_id) as total_products'),
                \DB::raw('SUM(ntdd_orderdetail.amount) as total_amount')
            )
            ->groupBy('order.id', 'order.user_id', 'order.status', 'order.created_at', 
                     'order.updated_at', 'order.updated_by', 'user.name', 'user.email', 'user.phone', 'user.address')
            ->get();
        return view("backend.order.order",compact('list'));
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $order = Order::find($id);
        if ($order == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.order.index');
        }
        return view("backend.order.edit",compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, string $id)
    {
        $order = Order::find($id);
        if ($order == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.order.index');
        }
        // Chỉ cập nhật các field có trong bảng order
        $order->status = $request->status ?? $order->status;
        $order->updated_at = date('Y-m-d H:i:s');
        $order->updated_by = Auth::id() ?? 1;
        
        if ($order->save()) {
            toastr()->success('Updated successfully!');
        }
        return redirect()->route('admin.order.index');
    }
    public function trash()
    {
        $list= Order::where('status','=',0)->orderBy('updated_at','desc')->get();
        return view("backend.order.trash",compact("list"));
    }
    public function show(string $id)
    {
        // Sử dụng Eloquent relationships để lấy thông tin từ user
        $order = Order::with('user')->find($id);
        
        if (!$order) {
            toastr()->error('The order does not exist.');
            return redirect()->route('admin.order.index');
        }
        
        return view("backend.order.show", compact("order"));
    }
    
    public function destroy(string $id)
    {
        $order = Order::find($id);
        if ($order == null) {
            return redirect()->route('admin.order.index');
        }
        $order->delete();
        return redirect()->route('admin.order.trash');
    }

    public function delete(string $id)
    {
        $order = Order::find($id);
        if ($order == null) {
            return redirect()->route('admin.order.index');
        }
        $order->status = 0;
        $order->updated_at = date('Y-m-d H:i:s');
        $order->updated_by = Auth::id() ?? 1; //id cua quan tri
        $order->save();
        return redirect()->route('admin.order.index');
    }
    public function status(string $id)
    {
        $order = Order::find($id);
        if ($order == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.order.index');
        }
        $order->status = ($order->status == 2) ? 1:2;
        $order->updated_at = date('Y-m-d H:i:s');
        $order->updated_by = Auth::id() ?? 1; //id cua quan tri
        $order->save();
        return redirect()->route('admin.order.index');
    }

    public function restore(string $id)
    {
        $order = Order::find($id);
        if ($order == null) {
            return redirect()->route('admin.order.index');
        }
        $order->status = 2;
        $order->updated_at = date('Y-m-d H:i:s');
        $order->updated_by = Auth::id() ?? 1; //id cua quan tri
        $order->save();
        return redirect()->route('admin.order.trash');
    }
     
}
