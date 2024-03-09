<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Buyer;
use App\Models\poltiSell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreBuyerRequest;
use App\Http\Requests\UpdateBuyerRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyers = Buyer::with('branch')->where('branch_id', session('branch_id'))->where('status', '1')->get();

        return view('buyer.buyer_list', compact('buyers'));
    }

    public function buyerDue()
    {
        $buyerDue = poltiSell::with('branch:id,branch_address', 'buyer:id,name,balance')->where('branch_id', session('branch_id'))->where('due', '>', 0)->get();

        // return $buyerDue;

        return view('buyer.buyer_due', compact('buyerDue'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buyer.create_buyer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBuyerRequest $request)
    {
        try {
            DB::beginTransaction();

            $buyerObj = new Buyer;

            $buyerObj->branch_id    = session('branch_id');
            $buyerObj->name         = $request->input('name');
            $buyerObj->phone_number = $request->input('phone_number');
            $buyerObj->address      = $request->input('address');
            $buyerObj->balance      = $request->input('balance');
            $buyerObj->status       = '1';
            $buyerObj->created_at   = Carbon::now();

            $res = $buyerObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Buyer created successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Buyer $buyer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buyer $buyer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBuyerRequest $request, Buyer $buyer)
    {        
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();
            $buyerId       = $request->input('buyer_id');

            $buyer = Buyer::where('branch_id', session('branch_id'))->where('id', $buyerId)->where('status', '1')->first();

            if(!$buyer){
                return redirect()->back()->with('message', 'Buyer not found');
            }

            $res = $buyer->update($validatedData);
            DB::commit();
            if ($res) {
                return redirect()->back()->with('message', 'Update successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buyer $buyer, $id)
    {
        try {
            DB::beginTransaction();

            $buyer = Buyer::find($id);

            if(!$buyer){
                return response()->json(['message' => 'Buyer not Found.']);
            }

            $res = $buyer->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Buyer deleted successfully.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}
