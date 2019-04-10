<?php

namespace IVSales\Components\Cart;

use IVSales\Product;

class CartItemCreator
{
    public function factory(Product $product, int $quantity)
    {
        return new CartItem($product, $quantity);
    }
}