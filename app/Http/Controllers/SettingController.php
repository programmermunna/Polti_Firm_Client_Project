<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $homeSetting = Setting::first();

        return view('setting.create', compact('homeSetting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSettingRequest $request)
    {
        
        try {
            DB::beginTransaction();

            $settingObj = Setting::first();

            $data = [
                'project_name' => $request->input('project_name'),
                'project_title' => $request->input('project_title'),
            ];

            $res = $settingObj->update($data);

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Data updated');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function store_logo(Request $request)
    {
        try {
            DB::beginTransaction();

            $settingObj = Setting::first();           

            if($request->hasfile('project_logo'))
            {
                $file = $request->file('project_logo');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time().'.'.$extenstion;
                $file->move('custom/logos/', $filename);
                $settingObj->project_logo = $filename;
            }

            $data = [
                'project_logo' => $filename,
            ];

            $res = $settingObj->update($data);

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Data updated');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
