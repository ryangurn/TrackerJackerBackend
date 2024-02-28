<?php

namespace App\Nova;

use Illuminate\Support\Str;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Competition extends Resource
{
    /**
     * The grouping that is used to oranized resources
     */
    public static $group = 'Engine';

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Competition>
     */
    public static $model = \App\Models\Competition::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'uuid', 'name', 'description'
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

            Text::make('Name')
                ->rules('required', 'min:3', 'max:255'),

            Textarea::make('Description')
                ->rules('nullable', 'min:10', 'max:65000'),

            Boolean::make('Allow Teams')
                ->rules('nullable', 'boolean'),

            Number::make('# of Rounds', function ($model) {
                return $model->rounds()->count();
            })
                ->hide()
                ->showOnIndex(),

            HasMany::make('Rounds')
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
