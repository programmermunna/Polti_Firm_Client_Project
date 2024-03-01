<?php

namespace App\Http\Controllers;

use App\Models\Semen;
use App\Models\Cow;
use App\Models\Pregnancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreSemenRequest;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\UpdateSemenRequest;
use Illuminate\Support\Facades\Validator;

class SemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semens = Semen::where('status', '1')->get();

        return view('semen.semen_list', compact('semens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('semen.create_semen');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSemenRequest $request)
    {
        try {
            DB::beginTransaction();

            $semenObj = new Semen;

            $semenObj->branch_id = session('branch_id');
            $semenObj->name      = $request->input('name');
            $semenObj->status    = '1';
            $semenObj->flag      = 0;

            $res = $semenObj->save();
            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Semen Created successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Semen $semen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Semen $semen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSemenRequest $request, Semen $semen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semen $semen)
    {
        //
    }
}
