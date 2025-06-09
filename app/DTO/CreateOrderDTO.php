<?php

namespace App\DTO;

use App\Models\Order;

class CreateOrderDTO
{
    public function __construct(
        public string $customer_name,
        public int $product_id,
        public int $quantity,
        public ?string $comment,
        public string $status = Order::STATUS_NEW,
    ) {}
}
