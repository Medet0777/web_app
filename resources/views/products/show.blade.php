@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Просмотр товара: {{ $product->name }}</h1>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">К списку товаров</a>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Категория: {{ $product->category->name ?? 'Без категории' }}</h6>
            <p class="card-text"><strong>Описание:</strong> {{ $product->description ?? 'Нет описания.' }}</p>
            <p class="card-text"><strong>Цена:</strong> {{ number_format($product->price, 2) }} KZT</p>
            <p class="card-text"><small class="text-muted">Создан: {{ $product->created_at->format('d.m.Y H:i') }}</small></p>
            <p class="card-text"><small class="text-muted">Последнее обновление: {{ $product->updated_at->format('d.m.Y H:i') }}</small></p>

            <div class="mt-4">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Редактировать</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этот товар?')">Удалить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
