<?php

namespace IVSales\Components\Stripe;

use IVSales\Components\Cart\Cart;
use IVSales\Components\Money\Currency;
use IVSales\Order;
use Lang;
use Stripe\ApiResource;

class Charge
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @var ChargeRequest
     */
    private $charge;

    /**
     * Charge constructor.
     * @param Cart $cart
     * @param Currency $currency
     * @param ChargeRequest $chargeRequest
     */
    public function __construct(Cart $cart, Currency $currency, ChargeRequest $chargeRequest)
    {
        $this->cart = $cart;
        $this->currency = $currency;
        $this->charge = $chargeRequest;
    }

    /**
     * @param Order $order
     * @param string $stripeToken
     * @return ApiResource
     * @throws \IVSales\Exceptions\DifferentCurrencies
     */
    public function charge(Order $order, string $stripeToken): ApiResource
    {
        return $this->charge
            ->addMetaData('order_id', $order->id)
            ->addMetaData('customer_name', $order->customer_name)
            ->addMetaData('weight', $this->cart->totalWeight())
            ->addMetaData('dimensions', $this->cart->totalDimensions())
            ->setAmount($this->cart->totalPriceWithShipping())
            ->setCurrency($this->currency)
            ->setDescription(Lang::get('payment.description') . $order->customer_name)
            ->setToken($stripeToken)
            ->create();
    }
}