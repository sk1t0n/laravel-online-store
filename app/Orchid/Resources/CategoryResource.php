<?php

namespace App\Orchid\Resources;

use Illuminate\Database\Eloquent\Model;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class CategoryResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Category::class;

    /**
     * Get the fields displayed by the resource.
     */
    public function fields(): array
    {
        return [
            Input::make('name')->title('Name'),
        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', 'ID')->sort()->filter(Input::make())
                ->render(function ($c) {
                    $url = "/admin/crud/view/category-resources/{$c->id}";

                    return "<a href='{$url}'>{$c->id}</a>";
                }),
            TD::make('name', __('Title')),
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make('id', 'ID'),
            Sight::make('name', __('Title')),
        ];
    }

    /**
     * Get the filters available for the resource.
     */
    public function filters(): array
    {
        return [];
    }

    public function rules(Model $model): array
    {
        return [
            'name' => 'required|max:15',
        ];
    }

    public static function perPage(): int
    {
        return 10;
    }

    public static function createToastMessage(): string
    {
        return 'Category '.__('was successfully created');
    }

    public static function updateToastMessage(): string
    {
        return 'Category '.__('was successfully updated');
    }

    public static function deleteToastMessage(): string
    {
        return 'Category '.__('was successfully deleted');
    }

    public static function listBreadcrumbsMessage(): string
    {
        return __('Categories');
    }

    public static function createBreadcrumbsMessage(): string
    {
        return __('Create').' Category';
    }

    public static function editBreadcrumbsMessage(): string
    {
        return __('Edit').' Category';
    }
}
