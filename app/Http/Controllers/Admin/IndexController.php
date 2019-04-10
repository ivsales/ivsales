<?php

namespace IVSales\Http\Controllers\Admin;

use Illuminate\Http\Request;
use IVSales\Http\Controllers\Controller;
use IVSales\Order;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.main')
            ->with("orders",Order::all());
    }
}
