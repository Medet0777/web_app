<?php

namespace App\Http\Controllers;

use App\Contracts\ServiceContracts\OrderServiceContract;
use App\Contracts\ServiceContracts\ProductServiceContract;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;


class OrderController extends Controller
{
    protected OrderServiceContract $orderService;
    protected ProductServiceContract $productService;


    public function __construct(
        OrderServiceContract $orderService,
        ProductServiceContract $productService
    )
    {
        $this->orderService = $orderService;
        $this->productService = $productService;
    }

    /**
     * Отображает список всех заказов.
     */
    public function index()
    {
        $orders = $this->orderService->getAllOrders();
        return view('orders.index', compact('orders'));
    }

    /**
     * Показывает форму для создания нового заказа.
     */
    public function create()
    {
        $products = $this->productService->getAllProducts();
        return view('orders.create', compact('products'));
    }

    /**
     * Сохраняет новый заказ в базе данных.
     */
    public function store(StoreOrderRequest $request)
    {
        $this->orderService->createOrder($request->toDTO());
        return redirect()->route('orders.index')->with('success', 'Заказ успешно добавлен!');
    }

    /**
     * Отображает полную информацию о конкретном заказе.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Показывает форму для редактирования существующего заказа. (Опционально)
     */
    public function edit(Order $order)
    {
        $products = $this->productService->getAllProducts();
        return view('orders.edit', compact('order', 'products'));
    }

    /**
     * Обновляет информацию о заказе в базе данных. (Опционально)
     */
    public function update(StoreOrderRequest $request, Order $order)
    {
        $this->orderService->updateOrder($order, $request->toDTO()); // Передаем DTO
        return redirect()->route('orders.index')->with('success', 'Заказ успешно обновлен!');
    }

    /**
     * Удаляет заказ из базы данных.
     */
    public function destroy(Order $order)
    {
        $this->orderService->deleteOrder($order);
        return redirect()->route('orders.index')->with('success', 'Заказ успешно удален!');
    }

    /**
     * Изменяет статус заказа на "выполнен".
     */
    public function complete(Order $order)
    {
        $this->orderService->completeOrder($order);
        return redirect()->back()->with('success', 'Статус заказа успешно изменен на "выполнен"!');
    }
}
