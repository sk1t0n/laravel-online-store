<?php

namespace App\Orchid\Resources;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class CartItemResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\CartItem::class;

    /**
     * Get the fields displayed by the resource.
     */
    public function fields(): array
    {
        return [
            Relation::make('cart_id')
                ->fromModel(Cart::class, 'id')
                ->title('Cart'),
            Relation::make('product_id')
                ->fromModel(Product::class, 'name')
                ->title('Product'),
            Input::make('price')->title('Price'),
            Input::make('quantity')->title('Quantity'),
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
                    $url = "/admin/crud/view/cart-item-resources/{$c->id}";

                    return "<a href='{$url}'>{$c->id}</a>";
                }),
            TD::make('cart_id', __('Cart'))
                ->render(function ($c) {
                    $url = "/admin/crud/view/cart-resources/{$c->cart->id}";

                    return "<a href='{$url}'>{$c->cart->id}</a>";
                }),
            TD::make('product_id', __('Product'))
                ->render(function ($c) {
                    $url = "/admin/crud/view/product-resources/{$c->product->id}";

                    return "<a href='{$url}'>{$c->product->name}</a>";
                }),
            TD::make('price', __('Price')),
            TD::make('quantity', __('Quantity')),
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
            Sight::make('cart_id', __('Cart'))
                ->render(function ($c) {
                    $url = "/admin/crud/view/cart-resources/{$c->cart->id}";

                    return "<a href='{$url}'>{$c->cart->id}</a>";
                }),
            Sight::make('product_id', __('Product'))
                ->render(function ($c) {
                    $url = "/admin/crud/view/product-resources/{$c->product->id}";

                    return "<a href='{$url}'>{$c->product->name}</a>";
                }),
            Sight::make('price'),
            Sight::make('quantity'),
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
            'cart_id' => 'required',
            'product_id' => 'required',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:1',
        ];
    }

    public function with(): array
    {
        return [
            'cart',
            'product',
        ];
    }

    public static function perPage(): int
    {
        return 10;
    }

    public static function createToastMessage(): string
    {
        return 'Cart Item '.__('was successfully created');
    }

    public static function updateToastMessage(): string
    {
        return 'Cart Item '.__('was successfully updated');
    }

    public static function deleteToastMessage(): string
    {
        return 'Cart Item '.__('was successfully deleted');
    }

    public static function listBreadcrumbsMessage(): string
    {
        return __('Cart Items');
    }

    public static function createBreadcrumbsMessage(): string
    {
        return __('Create').' Cart Item';
    }

    public static function editBreadcrumbsMessage(): string
    {
        return __('Edit').' Cart Item';
    }
}
