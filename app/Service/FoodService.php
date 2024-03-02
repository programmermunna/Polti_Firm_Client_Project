<?php

namespace App\Service;

use App\Models\poltiFeed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FoodService
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('login.us');
        }
    }

    public function create($shedId, $poltiId, $description, $foodIds, $foodQuantities, $unitIds)
    {
        try {
            DB::beginTransaction();

            foreach($foodIds as $key => $foodId){
                $poltiFeedObj = new poltiFeed();

                $poltiFeedObj->branch_id       = session('branch_id');
                $poltiFeedObj->polti_tag       = $poltiId;
                $poltiFeedObj->description   = $description;
                $poltiFeedObj->shed_id       = $shedId;
                $poltiFeedObj->food_id       = $foodId;
                $poltiFeedObj->food_quantity = $foodQuantities[$key];
                $poltiFeedObj->unit_id       = $unitIds[$key];

                DB::commit();
                $poltiFeedObj->save();
            }

            return true;

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}
