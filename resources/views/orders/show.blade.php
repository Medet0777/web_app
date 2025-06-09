@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Просмотр заказа #{{ $order->id }}</h1>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">К списку заказов</a>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Покупатель: {{ $order->customer_name }}</h5>
            <p class="card-text"><strong>Товар:</strong> {{ $order->product->name ?? 'Товар удален' }}</p>
            <p class="card-text"><strong>Количество:</strong> {{ $order->quantity }}</p>
            <p class="card-text"><strong>Общая цена:</strong> {{ number_format($order->total_price, 2) }} KZT</p>
            <p class="card-text">
                <strong>Статус:</strong>
                <span class="badge {{ $order->status === 'новый' ? 'bg-info' : 'bg-success' }}">
                    {{ $order->status }}
                </span>
            </p>
            <p class="card-text"><strong>Комментарий:</strong> {{ $order->comment ?? 'Нет комментария.' }}</p>
            <p class="card-text"><small class="text-muted">Создан: {{ $order->created_at->format('d.m.Y H:i') }}</small></p>
            <p class="card-text"><small class="text-muted">Последнее обновление: {{ $order->updated_at->format('d.m.Y H:i') }}</small></p>

            <div class="mt-4">
                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Редактировать</a>
                @if ($order->status === \App\Models\Order::STATUS_NEW)
                    <form action="{{ route('orders.complete', $order->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success" onclick="return confirm('Вы уверены, что хотите отметить этот заказ как выполненный?')">Выполнить</button>
                    </form>
                @endif
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этот заказ?')">Удалить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
