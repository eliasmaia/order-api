<?php

namespace App\Core\Infrastructure\Persistence\Eloquent;

class OrderModel extends Model {
    protector $table = 'order_models';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'customer_email',
        'total_amount',
        'status'
    ]
}