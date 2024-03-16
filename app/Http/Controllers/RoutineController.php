<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Vaccine;
use Illuminate\Http\Request;

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
            "foods" => $foods,
            "vaccines" => $vaccines,
        ];

        // return $data;

        return view('routine.routine_create',compact('data'));
    }


    public function routineStore(Request $request){
        return $request;      

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
