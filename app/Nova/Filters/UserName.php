<?php

namespace App\Nova\Filters;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class UserName extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     * @param Request $request
     * @param $query
     * @param $value
     * @return Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->where('user_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param Request $request
     * @return array
     */
    public function options(Request $request): array
    {
        $userList = User::query()->get();

        $options = [];
        foreach ($userList as $user) {
            $options[$user->name] = $user->id;
        }

        return $options;
    }
}
