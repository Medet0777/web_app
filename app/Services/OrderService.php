<?php

namespace App\Services;

use App\Models\Order;
use App\Contracts\ServiceContracts\OrderServiceContract;
use App\Contracts\RepositoryContracts\OrderRepositoryContract;
use App\Contracts\RepositoryContracts\ProductRepositoryContract;
use App\DTO\CreateOrderDTO;
use Illuminate\Database\Eloquent\Collection;

class OrderService implements OrderServiceContract
{
    protected OrderRepositoryContract $orderRepository;
    protected ProductRepositoryContract $productRepository;

    public function __construct(
        OrderRepositoryContract $orderRepository,
        ProductRepositoryContract $productRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    public function getAllOrders(): Collection
    {
        return $this->orderRepository->getAll();
    }

    public function getOrderById(int $id): ?Order
    {
        return $this->orderRepository->find($id);
    }

    public function createOrder(CreateOrderDTO $dto): Order
    {

        $this->productRepository->find($dto->product_id);
        return $this->orderRepository->create((array) $dto);
    }

    public function updateOrder(Order $order, CreateOrderDTO $dto): Order
    {
        $data = array_filter((array) $dto, fn($value) => !is_null($value));


        if (isset($data['product_id'])) {
            $this->productRepository->find($data['product_id']);
        }
        return $this->orderRepository->update($order, $data);
    }

    public function completeOrder(Order $order): Order
    {

        if ($order->status === Order::STATUS_NEW) {
            $order->update(['status' => Order::STATUS_COMPLETED]);
        }
        return $order;
    }

    public function deleteOrder(Order $order): void
    {
        $this->orderRepository->delete($order);
    }
}
