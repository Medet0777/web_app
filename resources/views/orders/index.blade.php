@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Список заказов</h1>
        <a href="{{ route('orders.create') }}" class="btn btn-primary">Создать новый заказ</a>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Покупатель</th>
            <th>Товар</th>
            <th>Кол-во</th>
            <th>Общая цена</th>
            <th>Статус</th>
            <th>Дата создания</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->product->name ?? 'Товар удален' }}</td> {{-- Отображаем название товара --}}
                <td>{{ $order->quantity }}</td>
                <td>{{ number_format($order->total_price, 2) }} KZT</td> {{-- Используем аксессор --}}
                <td>
                        <span class="badge {{ $order->status === 'новый' ? 'bg-info' : 'bg-success' }}">
                            {{ $order->status }}
                        </span>
                </td>
                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                <td>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Просмотр</a>
                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Редактировать</a>

                    @if ($order->status === \App\Models\Order::STATUS_NEW)
                        <form action="{{ route('orders.complete', $order->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Вы уверены, что хотите отметить этот заказ как выполненный?')">Выполнить</button>
                        </form>
                    @endif

                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот заказ?')">Удалить</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Нет заказов.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
