<?php

namespace App\Orchid\Resources;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class OrderResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Order::class;

    /**
     * Get the fields displayed by the resource.
     */
    public function fields(): array
    {
        return [
            Relation::make('customer_id')
                ->fromModel(Customer::class, 'email')
                ->title('Customer'),
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
                ->render(function ($o) {
                    $url = "/admin/crud/view/order-resources/{$o->id}";

                    return "<a href='{$url}'>{$o->id}</a>";
                }),
            TD::make('customer_id', __('Customer'))
                ->render(function ($o) {
                    $url = "/admin/crud/view/customer-resources/{$o->customer->id}";

                    return "<a href='{$url}'>{$o->customer->email}</a>";
                }),
            TD::make('total', __('Total')),
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
            Sight::make('customer_id', __('Customer'))
                ->render(function ($o) {
                    $url = "/admin/crud/view/customer-resources/{$o->customer->id}";

                    return "<a href='{$url}'>{$o->customer->email}</a>";
                }),
            Sight::make('total', __('Total')),
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
            'customer_id' => 'required',
        ];
    }

    public function with(): array
    {
        return [
            'customer',
        ];
    }

    public static function perPage(): int
    {
        return 10;
    }

    public static function createToastMessage(): string
    {
        return 'Order '.__('was successfully created');
    }

    public static function updateToastMessage(): string
    {
        return 'Order '.__('was successfully updated');
    }

    public static function deleteToastMessage(): string
    {
        return 'Order '.__('was successfully deleted');
    }

    public static function listBreadcrumbsMessage(): string
    {
        return __('Orders');
    }

    public static function createBreadcrumbsMessage(): string
    {
        return __('Create').' Order';
    }

    public static function editBreadcrumbsMessage(): string
    {
        return __('Edit').' Order';
    }
}
