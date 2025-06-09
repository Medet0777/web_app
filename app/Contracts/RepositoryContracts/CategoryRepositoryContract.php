<?php

namespace App\Contracts\RepositoryContracts;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryContract
{
    /**
     * Получить все категории.
     * @return Collection<Category>
     */
    public function getAll(): Collection;

    /**
     * Найти категорию по ID.
     * @param int $id
     * @return Category|null
     */
    public function find(int $id): ?Category;
}
