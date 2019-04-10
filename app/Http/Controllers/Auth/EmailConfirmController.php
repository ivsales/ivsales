<?php

namespace IVSales\Http\Controllers\Auth;

use Auth;
use IVSales\User;
use Illuminate\Http\Request;
use IVSales\Http\Controllers\Controller;

class EmailConfirmController extends Controller
{
    public function confirmEmail(User $user)
    {
        Auth::login($user->confirmEmail());
        return view('home');
    }
}
