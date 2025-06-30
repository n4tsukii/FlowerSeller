<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $table = 'order';
    
    protected $fillable = [
        'user_id', 'name', 'phone', 'email', 'address', 'note', 'status', 'updated_by'
    ];
    
    public function orderDetails()
    {
        return $this->hasMany(Orderdetail::class, 'order_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    // Lấy thông tin liên hệ từ user
    public function getUserContactInfo()
    {
        return $this->user ? [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'phone' => $this->user->phone,
        ] : null;
    }
    
    // Lấy địa chỉ giao hàng từ user
    public function getUserAddress()
    {
        return $this->user ? $this->user->address : null;
    }
    
    // Lấy tên khách hàng từ user
    public function getCustomerName()
    {
        return $this->user ? $this->user->name : null;
    }
    
    // Lấy email khách hàng từ user
    public function getCustomerEmail()
    {
        return $this->user ? $this->user->email : null;
    }
    
    // Lấy số điện thoại khách hàng từ user
    public function getCustomerPhone()
    {
        return $this->user ? $this->user->phone : null;
    }
}
