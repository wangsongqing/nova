<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Replie extends Resource
{
    // public static $displayInNavigation = false;

    // public static $group = '内容管理';

//    public static $subGroup = '回复';

    public static $group = '内容管理';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Replies::class;

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
        'content',
        'user_id'
    ];

    public  static  $searchRelations = [
        'user' => [ 'name'],
        // 'topic'=> ['topic_id']
    ];

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

            Text::make('评论内容', 'content')->hideWhenUpdating()->hideWhenCreating()->asHtml(),
            Trix::make('评论内容', 'content')->hideFromIndex()->rules('required')->withFiles(''),
            Text::make('作者', function($model) {
                $userInfo = \App\Models\User::query()->where('id', $model->user_id)->first();
                return $userInfo->name;
            }),

            Text::make('话题', function($model) {
                $topics = \App\Models\Topic::query()->where('id', $model->topic_id)->first();
                return $topics->title;
            }),

             // \Laravel\Nova\Fields\HasMany::make('Topic')
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
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
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
