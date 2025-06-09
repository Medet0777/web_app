<?php

namespace App\Services;

use App\Contracts\ServiceContracts\ProductServiceContract;
use App\Models\Product;
use App\Contracts\RepositoryContracts\ProductRepositoryContract;
use App\Contracts\RepositoryContracts\CategoryRepositoryContract;
use App\DTO\CreateProductDTO;
use Illuminate\Database\Eloquent\Collection;

class ProductService implements ProductServiceContract
{
    protected ProductRepositoryContract $productRepository;
    protected CategoryRepositoryContract $categoryRepository;


    public function __construct(
        ProductRepositoryContract $productRepository,
        CategoryRepositoryContract $categoryRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllProducts(): Collection
    {
        return $this->productRepository->getAll();
    }

    public function getProductById(int $id): ?Product
    {
        return $this->productRepository->find($id);
    }

    public function createProduct(CreateProductDTO $dto): Product
    {

        $this->categoryRepository->find($dto->category_id);


        return $this->productRepository->create((array) $dto);
    }

    public function updateProduct(Product $product, CreateProductDTO $dto): Product
    {

        $data = array_filter((array) $dto, fn($value) => !is_null($value));


        if (isset($data['category_id'])) {
            $this->categoryRepository->find($data['category_id']);
        }
        return $this->productRepository->update($product, $data);
    }

    public function deleteProduct(Product $product): void
    {
        $this->productRepository->delete($product);
    }
}
