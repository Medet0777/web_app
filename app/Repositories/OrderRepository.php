<?php

namespace App\Repositories;

use App\Contracts\RepositoryContracts\OrderRepositoryContract;
use App\Models\Order;

use Illuminate\Database\Eloquent\Collection;

class OrderRepository implements OrderRepositoryContract
{
    public function getAll(): Collection
    {
        return Order::with('product')->get();
    }

    public function find(int $id): ?Order
    {
        /** @var Order|null $order */
        $order = Order::with('product')->where('id', $id)->first();
        return $order;
    }

    public function create(array $data): Order
    {
        return Order::create($data);
    }

    public function update(Order $order, array $data): Order
    {
        $order->update($data);
        return $order;
    }

    public function delete(Order $order): void
    {
        $order->delete();
    }
}
