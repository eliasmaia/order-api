<?php

namespace App\Core\Infrastructure\Repositories;

use App\Core\Domain\Entities\Order;
use App\Core\Domain\Repositories\OrderRepositoryInterface;
use App\Core\Infrastructure\Persistence\Eloquent\OrderModel;

class OrderEloquentRepository implements OrderRepositoryInterface
{
    public function save(Order $order): void
    {
        OrderModel::updateOrCreate(
            ['id' => $order->getId()],
            [
                'customer_email'    =>  $order->getCustomerEmail(),
                'total_amount'      =>  $order->getTotalAmount(),
                'status'            =>  $order->getStatus(),
            ]
        );
    }


    public function findById(string $id): ?Order
    {
        $model = OrderModel::find($id);

        if (!$model){
            return null;
        }

        return new Order(
            $model->customer_email,
            (float) $model->total_amount,
            $model->id,
            $model->status,
            new \DateTimeImmutable($model->created_at)
        );
    }

}