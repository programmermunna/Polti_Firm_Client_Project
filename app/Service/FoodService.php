<?php

namespace App\Service;

use App\Models\PoltiFeed;
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
                $PoltiFeedObj = new PoltiFeed();

                $PoltiFeedObj->branch_id       = session('branch_id');
                $PoltiFeedObj->polti_tag       = $poltiId;
                $PoltiFeedObj->description   = $description;
                $PoltiFeedObj->shed_id       = $shedId;
                $PoltiFeedObj->food_id       = $foodId;
                $PoltiFeedObj->food_quantity = $foodQuantities[$key];
                $PoltiFeedObj->unit_id       = $unitIds[$key];

                DB::commit();
                $PoltiFeedObj->save();
            }

            return true;

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}
