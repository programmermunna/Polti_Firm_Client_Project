<?php

namespace App\Http\Controllers;

use App\Models\Polti;
use App\Models\Food;
use App\Models\Shed;
use App\Models\Unit;
use App\Models\Vaccine;
use Illuminate\Http\Request;
use App\Service\VaccineService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('login.us');
        }
    }

    public function index()
    {
        $data['poltis'] = polti::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->where('flag', 0)->get();

        return view('monitor.index')->with($data);
    }

    public function vaccineList()
    {
        $vaccineServiceObj = new VaccineService;

        return $vaccineServiceObj->index();
    }

    public function vaccineStore(Request $request)
    {
        $name          = $request->input('name');
        $periodDay     = $request->input('period_day');
        $repeatVaccine = $request->input('repeat_vaccine');
        $doseQty       = $request->input('dose_qty');
        $note          = $request->input('note');

        $vaccineServiceObj = new VaccineService;

        $res = $vaccineServiceObj->store($name, $periodDay, $repeatVaccine, $doseQty, $note);

        if($res == true){
            return redirect()->back()->with('message', 'Vaccine created');
        }
    }

    public function vaccineIndex()
    {
        $data['poltis'] = polti::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->where('flag', 0)->get();

        return view('vaccine.index')->with($data);
    }

    public function vaccineUpdate(Request $request)
    {
        $vaccineId     = $request->input('vaccine_id');
        $name          = $request->input('name');
        $periodDay     = $request->input('period_day');
        $repeatVaccine = $request->input('repeat_vaccine');
        $doseQty       = $request->input('dose_qty');
        $note          = $request->input('note');

        $vaccineServiceObj = new VaccineService;

        $res = $vaccineServiceObj->update($vaccineId,$name, $periodDay, $repeatVaccine, $doseQty, $note);

        if($res == true){
            return redirect()->back()->with('message', 'Vaccine updated');
        }
    }

    public function vaccineDestroy($id)
    {
        $vaccineServiceObj = new VaccineService;

        $res = $vaccineServiceObj->destroy($id);

        if($res == true){
            return response()->json(['message', 'Vaccine Deleted']);
        }
    }

    public function create()
    {
        $sheds = Shed::with('poltis')->where('branch_id', session('branch_id'))->get();
        $foods = Food::all();
        $units = Unit::all();

        return view('monitor.create', compact('sheds', 'foods', 'units'));
    }

    public function vaccineCreate()
    {
        $sheds = Shed::with('poltis')->where('branch_id', session('branch_id'))->get();
        $foods = Food::all();
        $units = Unit::all();
        $vaccines = Vaccine::all();

        return view('vaccine.create', compact('sheds', 'foods', 'units', 'vaccines'));
    }

    public function vaccineMonitoringStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $vaccineServiceObj = new VaccineService;

            $shedId     = $request->input('shed_id');
            $poltiId      = $request->input('polti_id');
            $date       = $request->input('date');
            $note       = $request->input('note');
            $vaccineIds = $request->input('vaccine_id');
            $remarks    = $request->input('remarks');
            $givenTime  = $request->input('given_time');

            $res = $vaccineServiceObj->vaccineStore($shedId, $poltiId, $date, $note, $vaccineIds, $remarks, $givenTime);

            if($res == true){
                return redirect()->back()->with('message', 'Vaccine created');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}
