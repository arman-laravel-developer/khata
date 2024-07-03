<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\PaymentReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class PaymentReceivedController extends Controller
{

    public function index()
    {
        $sells = PaymentReceived::latest()->get();
        $payAmount = DB::table('details')->sum('details.amount');
        return view('admin.pages.received', compact('sells', 'payAmount'));
    }

    public function create(Request $request)
    {
        $sell = new PaymentReceived();
        $sell->member_id = $request->member_id;
        $sell->dollar = $request->dollar;
        $sell->rate = $request->rate;
        $sell->add_by = Auth::user()->id;
        // Check the paying amount against the selling amount
        if ($request->paying_amount < $request->amount) {
            $dueAmount = $request->amount - $request->paying_amount;
            $sell->payment_status = 2;
            $sell->amount = $dueAmount;
        } else {
            $sell->payment_status = 1;
        }
        $sell->save();

        $detail = new Detail();
        $detail->payment_received_id = $sell->id;
        $detail->amount = $request->paying_amount;
        $detail->payment_gateway = $request->payment_gateway;
        $detail->save();

        flash()->success('Dollar Sell Add', 'Dollar Sell Add Successful');
        return redirect()->back();
    }

    public function edit($id)
    {
        $sell = PaymentReceived::find($id);

        return response()->json([
            'status' => 200,
            'sell' => $sell
        ]);
    }

    public function delete($id)
    {
        $sell = PaymentReceived::find($id);
        $details = Detail::where('payment_received_id', $sell->id)->get();
        foreach ($details as $detail)
        {
            $detail->delete();
        }
        $sell->delete();

        flash()->success('Dollar Sell Delete', 'Dollar Sell Delete Successful');
        return redirect()->back();
    }
}
