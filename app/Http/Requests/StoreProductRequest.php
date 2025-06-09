<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\DTO\CreateProductDTO;

class StoreProductRequest extends FormRequest
{
    /**
     * Определяет, разрешено ли пользователю выполнять этот запрос.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Определяет правила валидации для запроса.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0.01'],
        ];
    }

    /**
     * Создает и возвращает CreateProductDTO из валидированных данных запроса.
     * Это наш "фасад" для запроса.
     */
    public function toDTO(): CreateProductDTO
    {
        $validated = $this->validated();

        return new CreateProductDTO(
            name: $validated['name'],
            category_id: (int) $validated['category_id'],
            description: $validated['description'] ?? null,
            price: (float) $validated['price'],
        );
    }
}
