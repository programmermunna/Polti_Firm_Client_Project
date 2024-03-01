<?php

namespace App\Service;

use App\Models\Cost;
use App\Models\Buyer;
use App\Models\Account;
use Illuminate\Support\Facades\DB;


class BalanceService
{
    public function balanceUpdate($id, $due)
    {
        $buyer = Buyer::where('branch_id', session('branch_id'))->where('id', $id)->first();

        if(!$buyer){
            return false;
        }

        if($buyer){
            $balance = $buyer->balance;
            $newBalance = $balance + $due;

            $res = DB::table('buyers')->where('branch_id', session('branch_id'))->where('id', $id)->update(['balance' => $newBalance]);
            if($res){
                return true;
            }
        }

        return false;
    }

    public function accountDecrement($lastInsertedId,$expenseType, $total)
    {
        $accountObj = new Account;

        $accountObj->buy_id       = $lastInsertedId;
        $accountObj->branch_id    = session('branch_id');
        $accountObj->expense_type = $expenseType;
        $accountObj->amount       = $total;

        $res = $accountObj->save();
        if($res){
            return true;
        }
    }
}