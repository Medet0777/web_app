<?php

namespace App\Contracts\RepositoryContracts;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryContract
{
    /**
     * Получить все товары с их категориями.
     * @return Collection<Product>
     */
    public function getAll(): Collection;

    /**
     * Найти товар по ID с его категорией.
     * @param int $id
     * @return Product|null
     */
    public function find(int $id): ?Product;

    /**
     * Создать новый товар.
     * @param array $data Данные для создания товара.
     * @return Product
     */
    public function create(array $data): Product;

    /**
     * Обновить существующий товар.
     * @param Product $product Объект товара.
     * @param array $data Данные для обновления.
     * @return Product
     */
    public function update(Product $product, array $data): Product;

    /**
     * Удалить товар.
     * @param Product $product Объект товара.
     * @return void
     */
    public function delete(Product $product): void;
}
