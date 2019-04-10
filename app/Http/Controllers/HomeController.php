<?php

namespace IVSales\Http\Controllers;

use IVSales\Events\UserEditInfo;
use IVSales\Http\Requests\UserRequest;
use IVSales\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var Order
     */
    protected $order;

    /**
     * Create a new controller instance.
     *
     * @param Order $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->middleware('auth');
        $this->order = $order;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('partials.home.main');
    }

    public function orders()
    {
        return view('partials.home.orders')
            ->with('orders', $this->order->getForUser());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function order(Request $request)
    {
        return response()->json([
            'content' => view('partials.ajax.order')
                ->with('order', Order::findOrFail($request->order))
                ->render()
        ]);
    }

    public function update(UserRequest $request)
    {
        $request->user()->update($request->all());
        event(new UserEditInfo($request->user()));
        return back();
    }
}
