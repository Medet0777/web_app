
@extends('layouts.app')

@section('content')
    <h1>Редактировать заказ #{{ $order->id }}</h1>

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="customer_name" class="form-label">Имя покупателя</label>
            <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ old('customer_name', $order->customer_name) }}" required>
            @error('customer_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="product_id" class="form-label">Товар</label>
            <select class="form-select @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                <option value="">Выберите товар</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id', $order->product_id) == $product->id ? 'selected' : '' }}>
                        {{ $product->name }} ({{ number_format($product->price, 2) }} KZT)
                    </option>
                @endforeach
            </select>
            @error('product_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Количество</label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $order->quantity) }}" min="1" required>
            @error('quantity')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Комментарий</label>
            <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="3">{{ old('comment', $order->comment) }}</textarea>
            @error('comment')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Статус</label>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                <option value="{{ \App\Models\Order::STATUS_NEW }}" {{ old('status', $order->status) == \App\Models\Order::STATUS_NEW ? 'selected' : '' }}>Новый</option>
                <option value="{{ \App\Models\Order::STATUS_COMPLETED }}" {{ old('status', $order->status) == \App\Models\Order::STATUS_COMPLETED ? 'selected' : '' }}>Выполнен</option>
            </select>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Обновить заказ</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
@endsection
