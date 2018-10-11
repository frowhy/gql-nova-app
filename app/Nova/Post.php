<?php

namespace App\Nova;

use CustomConfiguration\ResourceLabel;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Frowhy\NovaFieldQuill\NovaFieldQuill;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use Spatie\TagsField\Tags;

class Post extends Resource
{
    use ResourceLabel;

    public static $label = '帖子';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Post';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'seo_title', 'seo_description',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('标题', 'title'),

            Images::make('图片', 'post')->multiple(),

            Select::make('是否启用外部链接', 'is_external_link')
                ->hideFromIndex()
                ->options([
                              0 => '不启用',
                              1 => '启用',
                          ])
                ->displayUsingLabels(),

            NovaDependencyContainer::make([
                                              NovaFieldQuill::make('内容', 'content')->hideFromIndex(),
                                          ])->dependsOn('is_external_link', 0),

            NovaDependencyContainer::make([
                                              Text::make('外部链接', 'external_link')->hideFromIndex(),
                                          ])->dependsOn('is_external_link', 1),

            new Panel('SEO 字段', $this->seoFields()),

            BelongsTo::make('用户', 'user', User::class)->searchable(),

            DateTime::make('创建时间', 'created_at')->sortable()->onlyOnDetail(),

            DateTime::make('更新时间', 'updated_at')->sortable()->exceptOnForms(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }

    protected function seoFields()
    {
        return [
            Text::make('SEO 标题', 'seo_title')->hideFromIndex(),

            Tags::make('SEO 关键词')->type('seo_keywords')->hideFromIndex(),

            Textarea::make('SEO 描述', 'seo_description')->hideFromIndex(),
        ];
    }
}
