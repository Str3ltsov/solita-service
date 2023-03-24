<?php

namespace App\Traits;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

trait ProductServices {
    use ProductRatings;

    public function getCategories($categoryRepository): Collection|array
    {
        return $categoryRepository->allQuery()->get();
    }

    public function getFilter($request): mixed
    {
        return $request->query('filter');
    }

    public function getFilterByCategories($filter): mixed
    {
        return $filter && array_key_exists('categories.id', $filter)
            ? $filter['categories.id']
            : array();
    }

    public function getAndSetSelectedOrder($request): int
    {
        return $request->order != null ? $request->order : 0;
    }

    public function getFilterByOrder($selectedOrder): array
    {
        return match ($selectedOrder) {
            0 => ["products.id", "asc"],
            1 => ["products_translations.name", "asc"],
            2 => ["products_translations.name", "desc"],
            3 => ["products.price", "asc"],
            4 => ["products.price", "desc"]
        };
    }

    public function getAndSetSelectedProductsPerPage($request): int
    {
        return $request->productsPerPage != null ? $request->productsPerPage : 0;
    }

    public function getFilterByProductsPerPage($selectedProductsPerPage): int
    {
        return match ($selectedProductsPerPage) {
            0 => 12,
            1 => 24,
            2 => 36
        };
    }

    public function getProducts($orderBy, $orderByDirection): object
    {
        return QueryBuilder::for(Product::class)
            ->join('products_translations', function ($join) {
                $join->on('products.id', '=', 'products_translations.product_id')
                    ->where('products_translations.locale', '=', app()->getLocale());
            })
            ->allowedFilters([
                AllowedFilter::scope('namelike'),
                'categories.id',
                AllowedFilter::scope('pricefrom'),
                AllowedFilter::scope('priceto'),
            ])
            ->allowedIncludes('categories')
            ->where('visible', true)
            ->orderBy($orderBy, $orderByDirection);
    }

    public function addRatingAttributesToProducts($products, $paginateNumber): object
    {
        $products = $products->paginate($paginateNumber)->appends(request()->query());

        foreach ($products as $product) {
            $product->id = $product->product_id;

            $sumAndCount = $this->calculateRatingSumAndCount($this->getProductRatings($product->id));
            $product->sum = $sumAndCount['sum'];
            $product->count = $sumAndCount['count'];
            $product->average = $this->calculateAverageRating($product->sum, $product->count);
        }

        return $products;
    }
}
