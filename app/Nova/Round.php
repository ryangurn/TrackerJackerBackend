<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Text;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class Round extends Resource
{
    /**
     * The grouping that is used to oranized resources
     */
    public static $group = 'Engine';
    
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Round>
     */
    public static $model = \App\Models\Round::class;

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
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Uuid')
                ->default(function ($request) {
                    return Str::uuid();
                })
                ->readonly(function ($request) {
                    return $request->isUpdateOrUpdateAttachedRequest();
                })
                ->hideFromIndex(),

            BelongsTo::make('Competition'),

            Number::make('Number')
                ->rules('required', 'numeric'),

            Date::make('Start', 'start_date')
                ->rules('required', 'date'),

            Date::make('End', 'end_date')
                ->rules('required', 'date'),

            Boolean::make('Active Override')
                ->rules('nullable', 'boolean'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
