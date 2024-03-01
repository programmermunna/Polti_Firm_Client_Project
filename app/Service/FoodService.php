<?php

namespace App\Service;

use App\Models\CowFeed;
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

    public function create($shedId, $cowId, $description, $foodIds, $foodQuantities, $unitIds)
    {
        try {
            DB::beginTransaction();

            foreach($foodIds as $key => $foodId){
                $cowFeedObj = new CowFeed();

                $cowFeedObj->branch_id       = session('branch_id');
                $cowFeedObj->cow_tag       = $cowId;
                $cowFeedObj->description   = $description;
                $cowFeedObj->shed_id       = $shedId;
                $cowFeedObj->food_id       = $foodId;
                $cowFeedObj->food_quantity = $foodQuantities[$key];
                $cowFeedObj->unit_id       = $unitIds[$key];

                DB::commit();
                $cowFeedObj->save();
            }

            return true;

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}