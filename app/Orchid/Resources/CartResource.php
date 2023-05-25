<?php

namespace App\Orchid\Resources;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class CartResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Cart::class;

    /**
     * Get the fields displayed by the resource.
     */
    public function fields(): array
    {
        return [
            Relation::make('order_id')
                ->fromModel(Order::class, 'id')
                ->title('Order'),
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
                    $url = "/admin/crud/view/cart-resources/{$c->id}";

                    return "<a href='{$url}'>{$c->id}</a>";
                }),
            TD::make('session_id', __('Session ID')),
            TD::make('order_id', __('Order'))
                ->render(function ($c) {
                    $orderId = $c->order ? $c->order->id : null;
                    $url = "/admin/crud/view/order-resources/{$orderId}";

                    return "<a href='{$url}'>{$orderId}</a>";
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
            Sight::make('session_id', __('Session ID')),
            Sight::make('order_id', __('Order'))
                ->render(function ($c) {
                    $orderId = $c->order ? $c->order->id : null;
                    $url = "/admin/crud/view/order-resources/{$orderId}";

                    return "<a href='{$url}'>{$orderId}</a>";
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
            'order_id' => 'required',
        ];
    }

    public function with(): array
    {
        return [
            'order',
        ];
    }

    public static function perPage(): int
    {
        return 10;
    }

    public static function createToastMessage(): string
    {
        return 'Cart '.__('was successfully created');
    }

    public static function updateToastMessage(): string
    {
        return 'Cart '.__('was successfully updated');
    }

    public static function deleteToastMessage(): string
    {
        return 'Cart '.__('was successfully deleted');
    }

    public static function listBreadcrumbsMessage(): string
    {
        return __('Carts');
    }

    public static function createBreadcrumbsMessage(): string
    {
        return __('Create').' Cart';
    }

    public static function editBreadcrumbsMessage(): string
    {
        return __('Edit').' Cart';
    }
}
