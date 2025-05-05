<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Các thuộc tính có thể gán giá trị hàng loạt.
     *
     * @var array
     */
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'address',
        'total_amount',
        'status',
        'payment_method',
        'payment_status',
        'order_date',
        'delivery_date',
        'user_id',
    ];

    /**
     * Các thuộc tính ẩn khi chuyển đổi sang mảng hoặc JSON.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Các thuộc tính cần đổi kiểu dữ liệu.
     *
     * @var array
     */
    protected $casts = [
        'order_date' => 'datetime',
        'delivery_date' => 'datetime',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Lấy người dùng đã đặt đơn hàng này.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Lấy các item trong đơn hàng.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Phạm vi đơn hàng đã thanh toán.
     */
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    /**
     * Phạm vi đơn hàng đang xử lý.
     */
    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }

    /**
     * Phạm vi đơn hàng đã hoàn thành.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Phạm vi đơn hàng đã hủy.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }
} 