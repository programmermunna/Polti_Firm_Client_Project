<?php

namespace App\Http\Controllers;

use App\Models\Polti;
use App\Models\Food;
use App\Models\Shed;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreFoodRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\PoltiFeed;
use App\Models\PoltiVaccine;
use App\Service\FoodService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use PhpParser\Node\Stmt\Return_;

class FoodController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('login.us');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $foods = Food::where('status', '1')->get();
        return view('food.food_list', compact('foods'));
    }

    public function unitIndex()
    {
        $units = Unit::where('status', '1')->get();

        return view('unit.unit_list', compact('units'));
    }

    public function feedIndex()
    {
        $data['poltis'] = polti::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->where('flag', 0)->get();

        return view('poltiFeed.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sheds = Shed::with('poltis')->where('branch_id', session('branch_id'))->get();
        $foods = Food::all();
        $units = Unit::all();
        return view('poltiFeed.create', compact('sheds', 'foods', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodRequest $request)
    {
        try {
            DB::beginTransaction();

            $foodObj = new Food;

            $foodObj->name   = $request->input('name');
            $foodObj->status = '1';

            $res = $foodObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Food Created');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function feedStore(Request $request)
    {
        $foodServiceObj = new FoodService;
        $shedId         = $request->input('shed_id');
        $poltiId          = $request->input('polti_id');
        $description    = $request->input('description');
        $foodIds        = $request->input('food_id');
        $foodQuantities = $request->input('food_quantity');
        $unitIds        = $request->input('unit_id');

        $res = $foodServiceObj->create($shedId, $poltiId, $description, $foodIds, $foodQuantities, $unitIds);
        if($res == true){
            return redirect()->back()->with('message', 'Food assign to the polti');
        }
    }

    public function unitStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $unitObj = new Unit;

            $unitObj->name   = $request->input('name');
            $unitObj->status = '1';

            $res = $unitObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Unit Created');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function shedpoltis($id)
    {
        $shedId = $id;
        $poltis = Polti::where('shed_id', $shedId)->where('branch_id', session('branch_id'))->get();
        return response()->json($poltis);
    }

    public function getpoltiInfo($id)
    {
        $feeds = poltiFeed::with('food:id,name', 'unit:id,name')->where('branch_id', session('branch_id'))->where('polti_tag', $id)->get();

        return response()->json(['feeds' => $feeds]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodRequest $request, Food $food)
    {
        try {
            DB::beginTransaction();

            $validateData = $request->validated();
            $foodId       = $request->input('food_id');
            $food         = Food::find($foodId);

            if($food){
                $res = $food->update($validateData);

                DB::commit();
                if($res){
                    return redirect()->back()->with('message', 'Food Update successfully');
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function unitUpdate(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'name'   => ['required'],
                'status' => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }


            $validateData = [
                'name'   => $request->input('name'),
                'status' => $request->input('status'),
            ];

            $unitId       = $request->input('unit_id');
            $unit         = Unit::find($unitId);

            if($unit){
                $res = $unit->update($validateData);

                DB::commit();
                if($res){
                    return redirect()->back()->with('message', 'Unit Update successfully');
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function unitDestroy($id)
    {
        try {
            DB::beginTransaction();

            $unit = Unit::find($id);

            if(!$unit){
                return response()->json(['message' => 'Unit not found']);
            }

            $res = $unit->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Unit deleted']);
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function getpoltiVaccine($id)
    {
        $vaccines = poltiVaccine::with('branch:id,branch_name', 'vaccine:id,name')->where('branch_id', session('branch_id'))->where('polti_tag', $id)->get();

        return response()->json(['vaccines' => $vaccines]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food, $id)
    {
        try {
            DB::beginTransaction();

            $food = Food::find($id);

            if(!$food){
                return response()->json(['message' => 'Food not found']);
            }

            $res = $food->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Food deleted']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}
