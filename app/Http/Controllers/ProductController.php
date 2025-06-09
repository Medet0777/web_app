<?php

namespace App\Http\Controllers;


use App\Contracts\RepositoryContracts\CategoryRepositoryContract;
use App\Contracts\ServiceContracts\ProductServiceContract;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    protected ProductServiceContract $productService;
    protected CategoryRepositoryContract $categoryRepository;


    public function __construct(
        ProductServiceContract $productService,
        CategoryRepositoryContract $categoryRepository
    )
    {
        $this->productService = $productService;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Отображает список всех товаров.
     */
    public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('products.index', compact('products'));
    }

    /**
     * Показывает форму для создания нового товара.
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAll();
        return view('products.create', compact('categories'));
    }

    /**
     * Сохраняет новый товар в базе данных.
     * StoreProductRequest автоматически валидирует запрос и инжектируется сюда.
     */
    public function store(StoreProductRequest $request)
    {

        $this->productService->createProduct($request->toDTO());
        return redirect()->route('products.index')->with('success', 'Товар успешно добавлен!');
    }

    /**
     * Отображает полную информацию о конкретном товаре.
     * Laravel's Route Model Binding автоматически найдет товар по ID из URL.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Показывает форму для редактирования существующего товара.
     */
    public function edit(Product $product)
    {
        $categories = $this->categoryRepository->getAll();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Обновляет информацию о товаре в базе данных.
     */
    public function update(StoreProductRequest $request, Product $product)
    {

        $this->productService->updateProduct($product, $request->toDTO());
        return redirect()->route('products.index')->with('success', 'Товар успешно обновлен!');
    }

    /**
     * Удаляет товар из базы данных.
     */
    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);
        return redirect()->route('products.index')->with('success', 'Товар успешно удален!');
    }
}
