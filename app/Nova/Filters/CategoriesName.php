<?php

namespace App\Nova\Filters;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class CategoriesName extends Filter
{
    public $name = '分类';

    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->where('category_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function options(Request $request)
    {
        $categorieList = Categorie::query()->get();

        $options = [];
        foreach ($categorieList as $categories) {
            $options[$categories->name] = $categories->id;
        }

        return $options;
    }
}
