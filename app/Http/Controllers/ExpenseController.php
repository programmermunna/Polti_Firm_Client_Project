<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Service\BalanceService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::where('status', '1')->get();

        return view('expense.expense_list', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    public function expenseType()
    {
        return view('expense.expense_type');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        try {
            DB::beginTransaction();

            $expenseObj = new Expense;

            $expenseObj->name = $request->input('name');
            $expenseObj->status = '1';
            $expenseObj->flag = '0';

            $res = $expenseObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Expense Type Created');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        try {
            DB::beginTransaction();

            $validateData = $request->validated();
            $expenseId    = $request->input('expense_id');
            $expense      = Expense::find($expenseId);

            if($expense){
                $res = $expense->update($validateData);

                DB::commit();
                if($res){
                    return redirect()->back()->with('message', 'Expense Update successfully');
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense, $id)
    {
        try {
            DB::beginTransaction();

            $expense = Expense::find($id);

            if(!$expense){
                return response()->json(['message' => 'Expense not found']);
            }

            $res = $expense->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Expense deleted']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}
