<?php

namespace App\Nova;

use App\Models\Categorie;
use App\Models\Replies;
use App\Nova\Filters\CategoriesName;
use App\Nova\Filters\UserName;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsToMany;

class Topic extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Topic::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title'
    ];

    public static $searchRelations = [
        'categorie' => ['name'],
        'user' => ['name']
    ];

    //public static $with = ['user'];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [

            ID::make(__('ID'), 'id')->sortable(),

            Text::make('标题', 'title')->rules('required'),

            // BelongsTo::make('user'),
            // BelongsTo::make('replie'),
            // BelongsTo::make('categorie'),

            Text::make('作者', function ($model) {
                    $userInfo = \App\Models\User::query()->where('id', $model->user_id)->first();
                    return $userInfo->name;
            }),
            Text::make('分类', function ($model) {
                $categoryName = Categorie::query()->where('id', $model->category_id)->first();
                return $categoryName->name;
            }),

            DateTime::make('发布时间', 'created_at')->hideWhenCreating()->hideWhenUpdating()->sortable(),

            Text::make('评论数', function ($model) {
                 return Replies::query()->where('topic_id', $model->id)->count();
            }),

            Text::make('', function ($model) {
                return '<a href="http://larabbs.org/topics/'.$model->id.'/'.$model->slug.'"><button>论坛详情</button></a>';
            })->asHtml(),

            Trix::make('内容', 'body')->hideFromIndex()->rules('required')->withFiles(''),

            HasMany::make('Replie'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {

    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new CategoriesName(),
            new UserName()
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
