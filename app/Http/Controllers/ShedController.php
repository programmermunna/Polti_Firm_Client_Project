<?php

namespace App\Http\Controllers;

use App\Models\Shed;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreShedRequest;
use App\Http\Requests\UpdateShedRequest;

class ShedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sheds = Shed::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->get();
        // return $sheds;
        return view('shed.index', compact('sheds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShedRequest $request)
    {
        try {
            DB::beginTransaction();

            $shedObj = new Shed;

            $shedObj->branch_id   = session('branch_id');
            $shedObj->name        = $request->input('name');
            $shedObj->description = $request->input('description');
            $shedObj->status      = '1';

            $res = $shedObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Shed created');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Shed $shed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shed $shed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShedRequest $request, Shed $shed)
    {
        try {
            DB::beginTransaction();
            $shedId = $request->input('shed_id');
            $branchId = session('branch_id');
            $shed = Shed::where('branch_id', $branchId)->where('id', $shedId)->first();

            if(!$shed){
                return redirect()->back()->with('message', 'Shed Not Found');
            }

            $validData = $request->validationData();

            $res = $shed->update($validData);

            DB::commit();

            if($res){
                return redirect()->back()->with('message', 'Shed updated');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shed $shed, $id)
    {
        try {
            DB::beginTransaction();

            $shed = Shed::find($id);

            if(!$shed){
                return response()->json(['message' => 'Shed not Found.']);
            }

            $res = $shed->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Shed deleted successfully.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}