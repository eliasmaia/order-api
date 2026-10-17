<?php

namespace App\Core\Domain\Repositories;

use App\Core\Domain\Entities\Order;

interface OrderRepositoryInterface
{
    public function save(Order $order): void;
    public function findById(string $id): ?Order;
}