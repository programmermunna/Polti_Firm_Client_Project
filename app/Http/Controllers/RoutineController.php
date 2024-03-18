<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoutineStoreRequest;
use App\Models\Food;
use App\Models\Polti;
use App\Models\Routine;
use App\Models\Vaccine;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RoutineController extends Controller
{
    public function routineIndex(){
        return "index";
        return view('routine.list');
    }

    
    public function routineCreate($id){
        
        $foods = Food::all();
        $vaccines = Vaccine::all();

        $data = [
            "ref" => $id,
            "foods" => $foods,
            "vaccines" => $vaccines,
        ];

        return view('routine.routine_create',compact('data'));
    }


    public function routineStore(RoutineStoreRequest $request,$id){
        try {
            DB::beginTransaction();

            $food_item = null;
            $vaccine_item = null;

            $request->input('food') ? $food_item = implode(",",$request->input('food')) : null;
            $request->input('vaccine') ? $vaccine_item = implode(",",$request->input('vaccine')) : null;

            if(Routine::where('polti_id',$id)->first()){
                return redirect()->back()->with('error', 'Routine Already Exits');
            }
            
            $polti = Polti::findOrFail($id);
            
            $routineObj = new Routine;

            $routineObj->branch_id    = session('branch_id');
            $routineObj->shed_id     = $polti->shed_id;
            $routineObj->polti_id       = $polti->id;
            $routineObj->title  = $request->input('title');
            $routineObj->food_item  = $food_item;
            $routineObj->food_period  = $request->input('food_period');
            $routineObj->vaccine_item  = $vaccine_item;
            $routineObj->vaccine_period  = $request->input('vaccine_period');
            $routineObj->description  = $request->input('description');
            $routineObj->date  = $request->input('date');
            $routineObj->status  = $request->input('status');
            $routineObj->created_at   = Carbon::now();

            $res = $routineObj->save();

            DB::commit();

            if($res == true){
                return redirect()->back()->with('message', 'Routine Created successfully');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }

    }


    public function routineEdit(){
    return "edit";       
        return view('routine.edit');
    }

    public function routineUpdate(){
        return "update";
    }

    public function routineDestroy(){
        return "destroy";
    }
}
