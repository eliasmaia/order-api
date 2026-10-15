<?php

namespace App\Core\Domain\Entities;

use InvalidArgumentException;

class Order {
    private String $id;
    private string $customerEmail;
    private float $totalAmount;
    private string $status;
    private \DateTimeImmutable $createdAt;

    public function __construct(
        string $customerEmail,
        float $totalAmount, 
        ?string $id = null, 
        string $status = 'pending', 
        ?\DateTimeImmutable $createdAt = null
    ) {
        if (!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)){
            throw new InvalidArgumentException("E-mail do cliente inválido");
        }

        if ($totalAmount <= 0){
            throw new InvalidArgumentException("O valor do pedido deve ser maior que zero.");
        }

        $this->id = $id ?? uniqid('ord_');
        $this->customerEmail = $customerEmail;
        $this->totalAmount = $totalAmount;
        $this->status = $status;
        $this->createdAt = $createdAt ?? new \DateTimeImmutable();
    }

    public function markAsPaid(): void
    {
        $this->status = 'paid';
    }

    public function getId(): string { return $this->id; }
    public function getCustomerEmail(): string { return $this->customerEmail; }
    public function getTotalAmount(): string { return $this->totalAmount; }
    public function getStatus(): string { return $this->status; }
    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
}