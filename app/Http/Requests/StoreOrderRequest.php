<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\DTO\CreateOrderDTO;
use App\Models\Order;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:255'],
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'comment' => ['nullable', 'string'],
            'status' => ['nullable', 'in:' . Order::STATUS_NEW . ',' . Order::STATUS_COMPLETED],
        ];
    }

    /**
     * Создает и возвращает CreateOrderDTO из валидированных данных запроса.
     */
    public function toDTO(): CreateOrderDTO
    {
        $validated = $this->validated();

        return new CreateOrderDTO(
            customer_name: $validated['customer_name'],
            product_id: (int) $validated['product_id'],
            quantity: (int) $validated['quantity'],
            comment: $validated['comment'] ?? null,
            status: $validated['status'] ?? Order::STATUS_NEW,
        );
    }
}
