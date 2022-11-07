<?php

namespace App\Traits;

use App\Models\CartItem;

trait CartItems
{
    public function getCartItems(object $cart): object
    {
        $cartItems = CartItem::query()
            ->with('product')
            ->where(['cart_id' => $cart->id])
            ->get();

        if (empty($cartItems))
            session()->flash('error', 'Failed to get cart items');

        return $cartItems;
    }

    public function setAndGetCartItemCount(object $cartItems): int
    {
        $count = 0;

        foreach ($cartItems as $cartItem) {
            $count += $cartItem->count;
        }

        if (empty($count))
            session()->flash('error', 'Failed to get cart item count');

        return $count;
    }
}
