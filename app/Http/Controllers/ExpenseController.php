<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::latest()->get();
        $total_cost = DB::table('expenses')->sum('expenses.amount');
        return view('admin.pages.expense', compact('expenses', 'total_cost'));
    }

    public function create(Request $request)
    {
        $expense = new Expense();
        $expense->purpose = $request->purpose;
        $expense->amount = $request->amount;
        $expense->add_by = Auth::user()->id;
        $expense->save();

        flash()->success('Expense add', 'expense add successful');
        return redirect()->back();
    }

    public function edit($id)
    {
        $expense = Expense::find($id);

        return response()->json([
            'status' => 200,
            'expense' => $expense
        ]);
    }

    public function update(Request $request)
    {
        $expense = Expense::find($request->expense_id);
        $expense->purpose = $request->purpose;
        $expense->amount = $request->amount;
        $expense->update_by = Auth::user()->id;
        $expense->save();

        flash()->success('Expense update', 'expense update successful');
        return redirect()->back();
    }

    public function delete($id)
    {
        $expense = Expense::find($id);
        $expense->delete();

        flash()->success('Expense delete', 'expense delete successful');
        return redirect()->back();
    }
}
