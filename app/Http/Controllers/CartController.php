<?php

namespace IVSales\Http\Controllers;

use IVSales\Components\Cart\Cart;
use IVSales\Exceptions\QuantityOverstated;
use IVSales\Product;
use Illuminate\Http\Request;
use Lang;

class CartController extends Controller
{
    /**
     * @var Cart
     */
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        return view('cart');
    }

    public function incrementOrDecrementItem(Request $request)
    {
        $product = Product::find($request->product);
        try {
            $this->cart->add($product, $request->quantity);
        } catch (QuantityOverstated $e) {
            return response()->json(['message' => Lang::get('cart.quantity_overstated')], 422);
        }
        $productInCart = $this->cart->get($product);
        return response()->json([
            'totalQuantity' => $this->cart->totalQuantity(),
            'totalPrice' => $this->cart->totalPrice()->format(),
            'item' => $productInCart,
            'amount' => $productInCart ? $productInCart->getAmount()->format() : 0
        ]);
    }

    public function remove(Request $request)
    {
        $this->cart->remove(Product::find($request->product));
        return response()->json([
            'totalQuantity' => $this->cart->totalQuantity(),
            'totalPrice' => $this->cart->totalPrice()->format()
        ]);
    }
}
