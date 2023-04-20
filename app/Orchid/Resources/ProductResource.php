<?php

namespace App\Orchid\Resources;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class ProductResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product::class;

    /**
     * Get the fields displayed by the resource.
     */
    public function fields(): array
    {
        return [
            Input::make('name')->title('Title'),
            Relation::make('category_id')
                ->fromModel(Category::class, 'name')
                ->title('Category'),
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
                ->render(function ($p) {
                    $url = "/admin/crud/view/product-resources/{$p->id}";

                    return "<a href='{$url}'>{$p->id}</a>";
                }),
            TD::make('name', __('Title')),
            TD::make('category_id', __('Category'))
                ->render(function ($p) {
                    $url = "/admin/crud/view/category-resources/{$p->category->id}";

                    return "<a href='{$url}'>{$p->category->name}</a>";
                }),
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
            Sight::make('category_id', __('Category'))
                ->render(function ($p) {
                    $url = "/admin/crud/view/category-resources/{$p->category->id}";

                    return "<a href='{$url}'>{$p->category->name}</a>";
                }),
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
            'name' => 'required|max:20',
            'category_id' => 'required',
        ];
    }

    public function with(): array
    {
        return [
            'category',
        ];
    }

    public static function perPage(): int
    {
        return 10;
    }

    public static function createToastMessage(): string
    {
        return 'Product '.__('was successfully created');
    }

    public static function updateToastMessage(): string
    {
        return 'Product '.__('was successfully updated');
    }

    public static function deleteToastMessage(): string
    {
        return 'Product '.__('was successfully deleted');
    }

    public static function listBreadcrumbsMessage(): string
    {
        return __('Products');
    }

    public static function createBreadcrumbsMessage(): string
    {
        return __('Create').' Product';
    }

    public static function editBreadcrumbsMessage(): string
    {
        return __('Edit').' Product';
    }
}
