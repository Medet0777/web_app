<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController; // Импортируем контроллер товаров
use App\Http\Controllers\OrderController;   // Импортируем контроллер заказов

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

// Ресурсные маршруты для управления товарами (CRUD)
// Это создает 7 маршрутов: index, create, store, show, edit, update, destroy
Route::resource('products', ProductController::class);

// Ресурсные маршруты для управления заказами (CRUD)
Route::resource('orders', OrderController::class);

// Дополнительный маршрут для изменения статуса заказа на "выполнен"
// Используем PUT-запрос, так как это обновление ресурса.
Route::put('orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');
