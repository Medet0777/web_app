<?php

namespace App\Repositories;

use App\Contracts\RepositoryContracts\ProductRepositoryContract;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryContract
{
    public function getAll(): Collection
    {
        return Product::with('category')->get();
    }

    public function find(int $id): Product
    {
        /** @var Product $product */
        $product = Product::with('category')->findOrFail($id);
        return $product;
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }
}
