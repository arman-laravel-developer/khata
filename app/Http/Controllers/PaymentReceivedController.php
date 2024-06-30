<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentReceivedController extends Controller
{

    public function index()
    {
        return view('admin.pages.received');
    }
}
