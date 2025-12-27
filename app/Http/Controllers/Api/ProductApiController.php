<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\JsonResponse;

class ProductApiController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Product::all(),
            'message' => 'Produtos listados com sucesso'
        ]);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = $this->productService->createProduct($request->validated());
        return response()->json([
            'data' => $product,
            'message' => 'Produto criado com sucesso'
        ], 201);
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json([
            'data' => $product,
            'message' => 'Produto encontrado'
        ]);
    }

    public function update(StoreProductRequest $request, Product $product): JsonResponse
    {
        $this->productService->updateProduct($product, $request->validated());
        return response()->json([
            'data' => $product->fresh(),
            'message' => 'Produto atualizado com sucesso'
        ]);
    }

    public function destroy(Product $product): JsonResponse
    {
        $this->productService->deleteProduct($product);
        return response()->json([
            'data' => null,
            'message' => 'Produto removido com sucesso'
        ], 200);
    }
}
