<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\polti;
use App\Models\Shed;
use App\Models\Buyer;
use App\Models\Income;
use App\Models\Account;
use App\Models\poltiSell;
use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Service\BalanceService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StorepoltiRequest;
use App\Http\Requests\UpdatepoltiRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class poltiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $poltis        = polti::with('branch:id,branch_name', 'category:id,name')->where('branch_id', session('branch_id'))->latest()->get();

        return view('polti.polti_list', compact('poltis', 'categories'));
    }

    public function sellIndex()
    {
        $sellList = poltiSell::with('branch:id,branch_name', 'buyer:id,name','polti:id,tag,category_id', 'polti.category:id,name')->where('branch_id', session('branch_id'))->latest()->get();
        $poltis     = polti::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->get();
        $buyers   = Buyer::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->where('status', '1')->latest()->get();

        // return $sellList;

        return view('polti.sell_list', compact('sellList', 'poltis', 'buyers'));
    }

    public function bacchaIndex()
    {
        $data['calfs'] = polti::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->where('category_id', 6)->get();

        return view('polti.bacchaIndex')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', '1')->get();
        $expenseType = Expense::all();
        $sheds = Shed::where('branch_id', session('branch_id'))->get();

        return view('polti.create_polti', compact('categories', 'expenseType', 'sheds'));
    }

    public function sellCreate()
    {
        $poltis   = polti::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->where('flag', '0')->get();
        $buyers = Buyer::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->where('status', '1')->latest()->get();

        return view('polti.sell_polti', compact('poltis', 'buyers'));
    }

    public function sellStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'polti_id'    => ['required'],
                'buyer_id'  => ['required'],
                'price'     => ['required'],
                'payment'   => ['required'],
                'sell_date' => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $poltiSellObj = new poltiSell;
            $poltiId      = $request->input('polti_id');
            $piece      = $request->input('piece');
            $price      = $request->input('price');
            $payment    = $request->input('payment');
            $buyerId    = $request->input('buyer_id');
            $due        = $request->input('due');

            $poltiSellObj->branch_id   = session('branch_id');
            $poltiSellObj->polti_id      = $poltiId;
            $poltiSellObj->buyer_id    = $buyerId;
            $poltiSellObj->piece       = $piece;
            $poltiSellObj->price       = $price;
            $poltiSellObj->payment     = $payment;
            $poltiSellObj->due         = $due;
            $poltiSellObj->sell_date   = $request->input('sell_date');
            $poltiSellObj->description = $request->input('description');
            $poltiSellObj->status      = $request->input('status');
            $poltiSellObj->created_at  = Carbon::now();


            $res = $poltiSellObj->save();

            DB::commit();
            if($res){
                $lastInsertedId    = $poltiSellObj->id;
                $this->incomeBalanceUpdate($lastInsertedId, $payment, $due);
                if($due >= 0){
                    $balanceServiceObj = new BalanceService;

                    $this->poltiFlagUpdate($poltiId);
                    $balanceServiceObj->balanceUpdate($buyerId, $due);
                }
                return redirect()->back()->with('message', 'Sell Created');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function poltiFlagUpdate($id)
    {
        $polti = polti::find($id);
        if($polti){
            $polti->update(['flag' => '1']);
        }
    }

    public function incomeBalanceUpdate($lastInsertedId, $payment, $due)
    {
        $incomeObj = new Income;

        $incomeObj->branch_id = session('branch_id');
        $incomeObj->sell_id   = $lastInsertedId;
        $incomeObj->amount    = $payment;
        $incomeObj->due       = $due;

        $res = $incomeObj->save();

        if($res){
            return true;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepoltiRequest $request)
    {
        try {
            DB::beginTransaction();

            $poltiObj = new polti;

            $price     = $request->input('price');
            $piece     = $request->input('piece');
            $transport = $request->input('transport');
            $hasil     = $request->input('hasil');

            $total = $price + $transport + $hasil;

            $poltiObj->branch_id    = session('branch_id');
            $poltiObj->price        = $price;
            $poltiObj->piece        = $piece;
            $poltiObj->category_id  = $request->input('category_id');
            $poltiObj->expense_type = $request->input('expense_type');
            $poltiObj->shed_id      = $request->input('shed_id');
            $poltiObj->tag          = $request->input('tag');
            $poltiObj->caste        = $request->input('caste');
            $poltiObj->weight       = $request->input('weight');
            $poltiObj->transport    = $transport;
            $poltiObj->hasil        = $hasil;
            $poltiObj->total        = $total;
            $poltiObj->color        = $request->input('color');
            $poltiObj->buy_date     = $request->input('buy_date');
            $poltiObj->age          = $request->input('age');
            $poltiObj->description  = $request->input('description');
            $poltiObj->status       = '1';
            $poltiObj->flag         = '0';
            $poltiObj->created_at   = Carbon::now();

            $res = $poltiObj->save();

            DB::commit();
            if($res){
                $balanceServiceObj = new BalanceService;

                $lastInsertedId = $poltiObj->id;
                $expenseType    = $request->input('expense_type');

                $result = $balanceServiceObj->accountDecrement($lastInsertedId,$expenseType, $total);
                if($result == true){
                    return redirect()->back()->with('message', 'polti Created successfully');
                }
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function sellCollect()
    {
        $dueCollect = poltiSell::with('branch:id,branch_name', 'buyer:id,name', 'polti:id,tag')->where('branch_id', session('branch_id'))->where('due', '>', 0)->get();

        return view('polti.sell_collect', compact('dueCollect'));
    }

    public function paymentStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'payment' => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $sellId = $request->input('sell_id');
            $payment = $request->input('payment');

            $sellInfo = poltiSell::where('branch_id', session('branch_id'))->find($sellId);

            if($sellInfo){
                $due = $sellInfo->due;
                $previousPayment = $sellInfo->payment;

                $newDue     = $due - $payment;
                $newPayment = $previousPayment + $payment;

                $res = $sellInfo->update(['payment' => $newPayment, 'due' => $newDue]);

                if($res){
                    $incomeData = Income::where('branch_id', session('branch_id'))->where('sell_id', $sellId)->first();
                    // return $incomeData;

                    if($incomeData){
                        $incomeAmount    = $incomeData->amount;
                        $newIncomeAmount = $incomeAmount + $payment;
                        $incomeDue       = $incomeData->due;
                        $newIncomeDue    = $incomeDue - $payment;

                        $data = Income::where('branch_id', session('branch_id'))->where('sell_id', $sellId)->update(['amount' => $newIncomeAmount, 'due' => $newIncomeDue]);

                        if($data){
                            DB::commit();
                            return redirect()->back()->with('message', 'Payment created successfully');
                        }
                    }
                }
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(polti $polti)
    {
        //
    }

    public function poltiInfo($id)
    {
        $polti = polti::where('branch_id', session('branch_id'))->where('id', $id)->first();

        return response()->json($polti);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(polti $polti)
    {
        //
    }

    public function sellEdit(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'polti_id'    => ['required'],
                'buyer_id'  => ['required'],
                'piece'     => ['required'],
                'price'     => ['required'],
                'payment'   => ['required'],
                'due'       => ['required'],
                'sell_date' => ['required'],
                'status'    => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $updateData = [
                'polti_id'    => $request->input('polti_id'),
                'buyer_id'  => $request->input('buyer_id'),
                'piece'     => $request->input('piece'),
                'price'     => $request->input('price'),
                'payment'   => $request->input('payment'),
                'due'       => $request->input('due'),
                'sell_date' => $request->input('sell_date'),
                'status'    => $request->input('status'),
            ];

            $sellId  = $request->input('sell_id');
            $payment = $request->input('payment');
            $due     = $request->input('due');
            $poltiSell = poltiSell::find($sellId);

            if($poltiSell){
                $res = $poltiSell->update($updateData);

                DB::commit();

                if($res){
                    $response = $this->incomeDataUpdate($sellId, $payment, $due);
                    if($response == true){
                        return redirect()->back()->with('message', 'Data update successfully');
                    }
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function incomeDataUpdate($sellId, $payment, $due)
    {
        $incomeData = Income::where('branch_id', session('branch_id'))->where('sell_id', $sellId)->first();

        if($incomeData){
            $res = $incomeData->update(['amount' => $payment, 'due' => $due, 'updated_at' => Carbon::now()]);
            if($res){
                return true;
            }
        }
    }

    public function sellInvoice($id)
    {
        $poltiSellInfo = poltiSell::with('branch:id,branch_name', 'buyer','polti:id,tag,category_id', 'polti.category:id,name')->where('branch_id', session('branch_id'))->where('id', $id)->first();

        // return $poltiSellInfo;

        if($poltiSellInfo){
            $buyerId = $poltiSellInfo->buyer->id;

            $poltis = poltiSell::with('branch:id,branch_name', 'buyer:id,name,phone_number','polti:id,tag,category_id', 'polti.category:id,name')->where('branch_id', session('branch_id'))->where('buyer_id', $buyerId)->where('due', '>', 0)->get();

            return view('invoice.invoice', compact('poltiSellInfo', 'poltis'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepoltiRequest $request)
    {
        try {
            DB::beginTransaction();

            $poltiId     = $request->input('polti_id');
            $price     = $request->input('price');
            $piece     = $request->input('piece');
            $transport = $request->input('transport');
            $hasil     = $request->input('hasil');
            $total     = $price + $transport + $hasil;

            $validatedData = [
                'price'       => $price,
                'piece'       => $piece,
                'category_id' => $request->input('category_id'),
                'tag'         => $request->input('tag'),
                'caste'       => $request->input('caste'),
                'weight'      => $request->input('weight'),
                'transport'   => $transport,
                'hasil'       => $hasil,
                'total'       => $total,
                'color'       => $request->input('color'),
                'buy_date'    => $request->input('buy_date'),
                'age'         => $request->input('age'),
                'description' => $request->input('description'),
            ];

            $polti = polti::find($poltiId);
            if (!$polti) {
                return redirect()->back()->with('message', 'polti not found');
            }

            $res = $polti->update($validatedData);

            DB::commit();
            if ($res) {
                $this->accountUpdate($poltiId,$total);
                return redirect()->back()->with('message', 'Update successfully');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function accountUpdate($poltiId, $total)
    {
        $accountObj = new Account;

        $account = $accountObj->where('buy_id', $poltiId)->where('branch_id', session('branch_id'))->first();

        if($account){
            $res = $account->update(['amount' => $total]);
            if($res){
                return true;
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(polti $polti, $id)
    {
        try {
            DB::beginTransaction();

            $polti = polti::find($id);

            if(!$polti){
                return response()->json(['message' => 'polti not Found.']);
            }

            $res = $polti->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'polti deleted successfully.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function sellDestroy($id)
    {
        try {
            DB::beginTransaction();

            $polti = poltiSell::find($id);

            if(!$polti){
                return response()->json(['message' => 'Data not Found.']);
            }

            $res = $polti->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Data deleted successfully.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}