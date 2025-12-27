<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
   public function getAllPaginated(int $perPage = 10, ?string $search = null): LengthAwarePaginator
{
    return Product::query()
        ->when($search, function ($query, $search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");

                if (is_numeric($search)) {
                    $q->orWhere('price', '=', $search);
                }
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate($perPage);
}

    public function createProduct(array $data): Product
    {
        return Product::create($data);
    }

    public function updateProduct(Product $product, array $data): bool
    {
        return $product->update($data);
    }

    public function deleteProduct(Product $product): bool
    {
        return $product->delete();
    }
}
