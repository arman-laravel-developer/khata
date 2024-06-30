<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentGiveController extends Controller
{
    public function index()
    {
        return view('admin.pages.give');
    }
}
