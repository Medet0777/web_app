<?php

namespace App\Contracts\ServiceContracts;

use App\Models\Product;
use App\DTO\CreateProductDTO;
use Illuminate\Database\Eloquent\Collection;

interface ProductServiceContract
{
    /**
     * Получить список всех товаров.
     * @return Collection<Product>
     */
    public function getAllProducts(): Collection;

    /**
     * Получить товар по ID.
     * @param int $id
     * @return Product|null
     */
    public function getProductById(int $id): ?Product;

    /**
     * Создать новый товар.
     * @param CreateProductDTO $dto DTO с данными для создания.
     * @return Product
     */
    public function createProduct(CreateProductDTO $dto): Product;

    /**
     * Обновить существующий товар.
     * @param Product $product
     * @param CreateProductDTO $dto DTO с данными для обновления.
     * @return Product
     */
    public function updateProduct(Product $product, CreateProductDTO $dto): Product;

    /**
     * Удалить товар.
     * @param Product $product
     * @return void
     */
    public function deleteProduct(Product $product): void;
}
