<?php

namespace App\Orchid\Resources;

use Illuminate\Database\Eloquent\Model;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class CustomerResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Customer::class;

    /**
     * Get the fields displayed by the resource.
     */
    public function fields(): array
    {
        return [
            Input::make('email')->title('Email'),
            Input::make('phone')->title('Phone'),
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
                    $url = "/admin/crud/view/customer-resources/{$c->id}";

                    return "<a href='{$url}'>{$c->id}</a>";
                }),
            TD::make('email', __('Email')),
            TD::make('phone', __('Phone')),
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
            Sight::make('email', __('Email')),
            Sight::make('phone', __('Phone')),
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
            'email' => 'required|email',
        ];
    }

    public static function perPage(): int
    {
        return 10;
    }

    public static function createToastMessage(): string
    {
        return 'Customer '.__('was successfully created');
    }

    public static function updateToastMessage(): string
    {
        return 'Customer '.__('was successfully updated');
    }

    public static function deleteToastMessage(): string
    {
        return 'Customer '.__('was successfully deleted');
    }

    public static function listBreadcrumbsMessage(): string
    {
        return __('Customers');
    }

    public static function createBreadcrumbsMessage(): string
    {
        return __('Create').' Customer';
    }

    public static function editBreadcrumbsMessage(): string
    {
        return __('Edit').' Customer';
    }
}
