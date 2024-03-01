<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cow;
use App\Models\Milk;
use App\Models\MilkSell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreMilkRequest;
use App\Http\Requests\UpdateMilkRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class MilkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $milks = DB::table(DB::raw('(SELECT milk_date, SUM(quantity) as total_quantity FROM milks WHERE branch_id = ' . session('branch_id') . ' GROUP BY milk_date) as subquery'))
            ->select('milk_date', 'total_quantity')
            ->get();

        // return $milks;

        return view('milk.milk_list', compact('milks'));
    }

    public function sellIndex()
    {
        $sellList = MilkSell::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->get();
        // return $sellList;
        return view('milk.sell_list', compact('sellList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cows = Cow::where('branch_id', session('branch_id'))->where('category_id', 1)->where('flag', 0)->get();

        return view('milk.create_milk', compact('cows'));
    }

    public function milkSellCreate()
    {
        $currentDate = Carbon::today();

        // Retrieve records from the 'beefs' table where the 'created_at' field matches the current date
        // $milksForToday = Milk::whereDate('created_at', $currentDate)->where('branch_id', session('branch_id'))->sum('quantity');

        $milks = Milk::select('milk_date', DB::raw('SUM(quantity) as total_quantity'))->groupBy('milk_date')->get();

        return view('milk.sell_milk', compact('milks'));
    }

    public function milkSellEdit(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'name'         => ['required'],
                'quantity'     => ['required'],
                'price'        => ['required'],
                'payment'      => ['required'],
                'due'          => ['required'],
                'phone_number' => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $updateData = [
                'name'     => $request->input('name'),
                'quantity' => $request->input('quantity'),
                'price'    => $request->input('price'),
                'payment'  => $request->input('payment'),
                'due'      => $request->input('due'),
            ];

            $sellId   = $request->input('sell_id');
            $quantity = $request->input('quantity');
            $payment  = $request->input('payment');
            $due      = $request->input('due');

            $beefSell  = MilkSell::find($sellId);

            if($beefSell){
                $res = $beefSell->update($updateData);

                DB::commit();
                if($res){
                    return redirect()->back()->with('message', 'Data update successfully');
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function milkSellCollect()
    {
        $dueList = MilkSell::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->where('due', '>', 0)->get();

        return view('milk.sell_collect', compact('dueList'));
    }

    public function milkSellStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'name'         => ['required'],
                'due'          => ['required'],
                'payment'      => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $sellId   = $request->input('sell_id');
            $due      = $request->input('due');
            $payment  = $request->input('payment');

            $milkSell  = MilkSell::find($sellId);

            if($milkSell){
                $previousDue = $milkSell->due;
                $newDue = $previousDue - $payment;
                $previousPayment = $milkSell->payment;
                $newPayment = $previousPayment + $payment;

                $updateData = [
                    'name'     => $request->input('name'),
                    'due'      => $newDue,
                    'payment'  => $newPayment,
                ];

                $res = $milkSell->update($updateData);

                DB::commit();
                if($res){
                    return redirect()->back()->with('message', 'Payment update successfully');
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function milkInfo($date)
    {
        $milk = Milk::where('branch_id', session('branch_id'))->whereDate('milk_date', $date)->sum('quantity');

        return response()->json($milk);
    }

    public function sellView($date)
    {
        $milks = Milk::with('branch:id,branch_name', 'cow:id,tag')->where('branch_id', session('branch_id', session('branch_id')))->whereDate('milk_date', $date)->get();

        $cows = Cow::where('branch_id', session('branch_id'))->where('category_id', 1)->where('flag', 0)->get();
        // return $milks;

        if($milks){
            return view('milk.milk_view', compact('milks', 'date', 'cows'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMilkRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $date = $request->input('date');

            $ifMilkExist = Milk::where('branch_id', session('branch_id'))->where('cow_id', $id)->whereDate('milk_date', $date)->exists();

            if($ifMilkExist){
                return response()->json(['status' => 'error', 'message' => 'Already stored.']);
            }

            $milkObj = new Milk;

            $milkObj->branch_id = session('branch_id');
            $milkObj->cow_id    = $id;
            $milkObj->milk_date = $request->input('date');
            $milkObj->quantity  = $request->input('quantity');
            $milkObj->flag      = '1';

            $res = $milkObj->save();

            DB::commit();
            if ($res) {
                return response()->json(['status' => 'success', 'message' => 'Milk stored.']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Failed to store milk.']);
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return response()->json(['message' => 'Failed to store milk. Please try again.'], 500);
        }
    }

    public function milkSellPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => ['required'],
            'sale_date'    => ['required'],
            'quantity'     => ['required'],
            'price'        => ['required'],
            'payment'      => ['required'],
            'due'          => ['required'],
            'phone_number' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $milkSellObj = new MilkSell;

        $milkSellObj->branch_id    = session('branch_id');
        $milkSellObj->name         = $request->input('name');
        $milkSellObj->sale_date    = $request->input('sale_date');
        $milkSellObj->quantity     = $request->input('quantity');
        $milkSellObj->price        = $request->input('price');
        $milkSellObj->payment      = $request->input('payment');
        $milkSellObj->due          = $request->input('due');
        $milkSellObj->phone_number = $request->input('phone_number');

        $res = $milkSellObj->save();

        if($res){
            $date = $request->input('milk_date');
            $this->updateMilkInfo($date, $request->input('quantity'));
            return redirect()->back()->with('message', 'Milk Sell Successfully');
        }
    }

    public function updateMilkInfo($date, $quantity)
    {
        $milkData = Milk::whereDate('milk_date', $date)->where('branch_id', session('branch_id'))->get();

        $inputQuantity = $quantity; // User input quantity

        $remainingQuantity = $inputQuantity; // Initialize remaining quantity

        foreach ($milkData as $row) {
            $currentQuantity = $row->quantity; // Quantity from the current row

            // If the remaining quantity is greater than or equal to the current row's quantity
            if ($remainingQuantity >= $currentQuantity) {
                $row->quantity = 0; // Set the current row's quantity to 0
                $remainingQuantity -= $currentQuantity; // Update the remaining quantity
            } else {
                $row->quantity -= $remainingQuantity; // Subtract remaining quantity from the current row
                $remainingQuantity = 0; // Set remaining quantity to 0
                break; // Exit the loop as the remaining quantity is now zero
            }
        }

        // Update the database with the modified quantities
        foreach ($milkData as $row) {
            $row->save();
        }

        return $milkData; // Return the updated milkData

    }

    /**
     * Display the specified resource.
     */
    public function show(Milk $milk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Milk $milk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMilkRequest $request, Milk $milk)
    {
        try {
            DB::beginTransaction();

            $sellId       = $request->input('sell_id');
            $milk         = Milk::find($sellId);
            $validtedData = $request->validated();

            if($milk){
                $res = $milk->update($validtedData);
                DB::commit();
                if($res){
                    return redirect()->back()->with('message', 'Update Successfully');
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
    public function destroy(Milk $milk)
    {
        //
    }
}
