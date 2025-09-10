<?php

namespace App\Services;

use App\Models\HandSet;
use Illuminate\Pagination\LengthAwarePaginator;

class HandSetService
{
    public function getFilterHandsets(array $filters, $perPage=10): LengthAwarePaginator
    {
        $query = HandSet::query();

        if (isset($filters['brand'])) {
            $query->where('brand', $filters['brand']);
        }

        if (isset($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (isset($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        if (isset($filters['features']) && is_array($filters['features'])) {
            foreach ($filters['features'] as $feature) {
                $query->whereJsonContains('features', $feature);
            }
        }

        if (isset($filters['search_item']) && !empty($filters['search_item'])) {
            $searchTerm = $filters['search_item'];
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('brand', 'like', "%{$searchTerm}%");
            });
        }

        $page = $filters['page'] ?? 1;

        return $query->orderBy('id', 'asc')
                     ->paginate(
                        $perPage,
                        [
                            'id', 'name', 'brand', 'price', 'release_date', 'features'
                        ],
                        'page',
                        $page
                    )
                    ->withQueryString();
    }
}
