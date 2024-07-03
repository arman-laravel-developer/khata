<?php

namespace App\Http\Controllers;

use App\Models\PaymentGive;
use Illuminate\Http\Request;
use Auth;
use DB;

class PaymentGiveController extends Controller
{
    public function index()
    {
        $gives = PaymentGive::latest()->get();
        $bdt = DB::table('payment_gives')->sum('payment_gives.amount');
        $dollar = DB::table('payment_gives')->sum('payment_gives.dollar');
        return view('admin.pages.give', compact('gives', 'bdt', 'dollar'));
    }

    public function create(Request $request)
    {
        $give = new PaymentGive();
        $give->member_id = $request->member_id;
        $give->dollar = $request->dollar;
        $give->rate = $request->rate;
        $give->amount = $request->amount;
        $give->payment_status = 1;
        $give->add_by = Auth::user()->id;
        $give->save();
        flash()->success('Payment give add', 'Payment give add successful');
        return redirect()->back();
    }

    public function edit($id)
    {
        $give = PaymentGive::find($id);
        return response()->json([
            'status' => 200,
            'give' => $give
        ]);
    }

    public function update(Request $request)
    {
        $give = PaymentGive::find($request->give_id);
        $give->member_id = $request->member_id;
        $give->dollar = $request->dollar;
        $give->rate = $request->rate;
        $give->amount = $request->amount;
        $give->update_by = Auth::user()->id;
        $give->save();
        flash()->success('Payment give update', 'Payment give update successful');
        return redirect()->back();
    }

    public function delete($id)
    {
        $give = PaymentGive::find($id);
        $give->delete();
        flash()->success('Payment give delete', 'Payment give delete successful');
        return redirect()->back();
    }
}
