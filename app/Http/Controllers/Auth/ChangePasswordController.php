<?php

namespace IVSales\Http\Controllers\Auth;

use IVSales\Http\Controllers\Controller;
use IVSales\Http\Requests\ChangePasswordRequest;
use Hash;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('auth.passwords.change');
    }

    public function update(ChangePasswordRequest $request)
    {
        $request->user()->fill([
            'password' => Hash::make($request->password)
        ])->save();
        return back();
    }
}
