<?php

namespace App\Repositories;

use App\Contracts\RepositoryContracts\CategoryRepositoryContract;
use App\Models\Category;

use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryContract
{
    public function getAll(): Collection
    {
        return Category::all();
    }

    public function find(int $id): ?Category
    {
        return Category::findOrFail($id);
    }
}
