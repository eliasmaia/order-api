<?php

namespace App\Core\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model {
    protected $table = 'order_models';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'customer_email',
        'total_amount',
        'status'
    ];
}