<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Post;

class AdminHomeController extends Controller
{
    public function index()
    {
        // Lấy số liệu thống kê thực từ database
        $totalProducts = Product::where('status', '!=', 0)->count();
        $totalOrders = Order::count();
        $totalUsers = User::where('roles', '!=', 'admin')->count(); // Chỉ đếm customer, không đếm admin
        $totalPosts = Post::where('status', '!=', 0)->count();
        
        // Thống kê chi tiết
        $activeProducts = Product::where('status', 1)->count();
        $pendingOrders = Order::where('status', 1)->count(); // Đơn hàng chờ xử lý
        $recentOrders = Order::orderBy('created_at', 'desc')->limit(5)->get();
        
        return view("backend.home.home", compact(
            'totalProducts', 
            'totalOrders', 
            'totalUsers', 
            'totalPosts',
            'activeProducts',
            'pendingOrders',
            'recentOrders'
        ));       
    }
}
