<?php

namespace App\Contracts\ServiceContracts;

use App\Models\Order;
use App\DTO\CreateOrderDTO;
use Illuminate\Database\Eloquent\Collection;

interface OrderServiceContract
{
    /**
     * Получить список всех заказов.
     * @return Collection<Order>
     */
    public function getAllOrders(): Collection;

    /**
     * Получить заказ по ID.
     * @param int $id
     * @return Order|null
     */
    public function getOrderById(int $id): ?Order;

    /**
     * Создать новый заказ.
     * @param CreateOrderDTO $dto DTO с данными для создания.
     * @return Order
     */
    public function createOrder(CreateOrderDTO $dto): Order;

    /**
     * Обновить существующий заказ.
     * @param Order $order
     * @param CreateOrderDTO $dto DTO с данными для обновления.
     * @return Order
     */
    public function updateOrder(Order $order, CreateOrderDTO $dto): Order;

    /**
     * Изменить статус заказа на "выполнен".
     * @param Order $order
     * @return Order
     */
    public function completeOrder(Order $order): Order;

    /**
     * Удалить заказ.
     * @param Order $order
     * @return void
     */
    public function deleteOrder(Order $order): void;
}
