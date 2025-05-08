<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'payment_amount', 'sub_total', 'tax', 'discount', 'service_charge', 'total',
        'payment_method', 'total_item', 'transaction_time', 'order_type', 'id_reserved',
        'id_customer', 'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'id_order');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'id_reserved');
    }
}