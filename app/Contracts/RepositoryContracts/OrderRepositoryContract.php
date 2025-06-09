<?php

namespace App\Contracts\RepositoryContracts;

use App\Models\Order; // Импортируем модель Order
use Illuminate\Database\Eloquent\Collection;

interface OrderRepositoryContract
{
    /**
     * Получить все заказы с их товарами.
     * @return Collection<Order>
     */
    public function getAll(): Collection;

    /**
     * Найти заказ по ID с его товаром.
     * @param int $id
     * @return Order|null
     */
    public function find(int $id): ?Order;

    /**
     * Создать новый заказ.
     * @param array $data Данные для создания заказа.
     * @return Order
     */
    public function create(array $data): Order;

    /**
     * Обновить существующий заказ.
     * @param Order $order Объект заказа.
     * @param array $data Данные для обновления.
     * @return Order
     */
    public function update(Order $order, array $data): Order;

    /**
     * Удалить заказ.
     * @param Order $order Объект заказа.
     * @return void
     */
    public function delete(Order $order): void;
}
