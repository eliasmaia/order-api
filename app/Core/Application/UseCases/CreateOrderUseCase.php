<?php

class CreateOrderUseCase
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository){
        $this->orderRepository = $orderRepository;
    }

    public function execute(String $customerEmail, float $totalAmount): Order
    {
        $order = new Order($customerEmail, $totalAmount);

        $this->orderRepository->save(order);

        return $order;
    }
}