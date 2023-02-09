<?php

namespace App\Traits;

use App\Models\Category;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

trait CategoryServices
{
    public function getTreeCategories(): object
    {
        return Category::where('parent_id', '=', null)->get();
    }

    public function getFilter($request): mixed
    {
        return $request->query('filter');
    }
    public function getAndSetSelectedOrder($request): int
    {
        return $request->order != null ? $request->order : 0;
    }

    public function getFilterByOrder($selectedOrder): array
    {
        return match ($selectedOrder) {
            0 => ["categories.id", "asc"],
            1 => ["categories_translations.name", "asc"],
            2 => ["categories_translations.name", "desc"],
        };
    }

    public function getCategories(string $orderBy, string $orderByDirection): object
    {
        $categories = QueryBuilder::for(Category::class)
            ->join('categories_translations', function ($join) {
                $join->on('categories.id', '=', 'categories_translations.category_id')
                    ->where('categories_translations.locale', '=', app()->getLocale());
            })
            ->allowedFilters([allowedFilter::scope('namelike')])
            ->allowedAppends(request()->query())
            ->orderBy($orderBy, $orderByDirection)
            ->where('parent_id', '=', null)
            ->get();

        foreach ($categories as $category) {
            $category->id = $category->category_id;
        }

        return $categories;
    }

    private function calculateTotalShownInnercategories(object $category): int
    {
        $totalInnerShownCategories = 0;

        foreach ($category->innerCategories as $innerCategory) {
            $totalInnerShownCategories += 1;

            if (count($innerCategory->innerCategories)) {
                $totalInnerShownCategories += $this->calculateTotalShownInnercategories($innerCategory);
            }
        }

        return $totalInnerShownCategories;
    }

    public function calculateTotalShownCategories(object $categories): int
    {
        $totalShownCategories = 0;

        foreach ($categories as $category) {
            $totalShownCategories += 1;

            if (count($category->innerCategories)) {
                $totalShownCategories += $this->calculateTotalShownInnercategories($category);
            }
        }

        return $totalShownCategories;
    }
}
