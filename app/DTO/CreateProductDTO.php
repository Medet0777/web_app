<?php

namespace App\DTO;


class CreateProductDTO
{
    public function __construct(
        public string $name,
        public int $category_id,
        public ?string $description,
        public float $price,
    ) {}
}
