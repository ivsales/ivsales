<?php

namespace IVSales\Observers;

use IVSales\Components\Cart\Cart;
use IVSales\Http\Requests\OrderRequest;
use IVSales\Order;

class OrderObserver
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var Cart
     */
    private $cart;

    public function __construct(OrderRequest $request, Cart $cart)
    {
        $this->data = $request->all();
        $this->cart = $cart;
    }

    public function creating(Order $order)
    {
        $order->cart = serialize($this->cart->all());
        $order->is_self_delivery = $this->data['delivery'] === 'on' ? false : true;
        $order->shipping_price = $this->data['delivery'] === 'on' ? $this->cart->getShippingInUSD()->getAmount() : 0;
        $order->warehouse = $this->data['warehouse_id'] ?? null;
    }
}