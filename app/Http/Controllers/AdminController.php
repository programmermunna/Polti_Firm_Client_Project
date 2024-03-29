<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Branch;
use App\Models\Cost;
use App\Models\Income;
use App\Models\Polti;
use App\Models\PoltiSell;
use App\Models\Setting;
use App\Models\Shed;
use App\Models\Staff;
use App\Models\StaffSalary;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('login.us');
        }
    }

    public function dashboard()
    {
        $currentDate   = Carbon::today();

        $poltis        = Polti::where('branch_id', session('branch_id'))->where('status', '1')->sum('piece');
        $deth          = Polti::where('branch_id', session('branch_id'))->where('status', '1')->sum('deth');
        $polti_kg_delivered  = Poltisell::where('branch_id', session('branch_id'))->where('status', '0')->sum('kg');
        $polti_sell_delivered  = Poltisell::where('branch_id', session('branch_id'))->where('status', '0')->sum('price');
        $polti_kg_booking  = Poltisell::where('branch_id', session('branch_id'))->where('status', '1')->sum('kg');
        $polti_sell_booking  = Poltisell::where('branch_id', session('branch_id'))->where('status', '1')->sum('price');

        $costs_today  = Cost::where('branch_id', session('branch_id'))->where('cost_date', $currentDate)->where('status', '1')->sum('cost_amount');
        $costs_total  = Cost::where('branch_id', session('branch_id'))->where('status', '1')->sum('cost_amount');
        
        $sell_today  = Poltisell::where('branch_id', session('branch_id'))->where('sell_date', $currentDate)->where('status', '0')->sum('price');
        $sell_total  = Poltisell::where('branch_id', session('branch_id'))->where('status', '0')->sum('price');
        $sell_due  = Poltisell::where('branch_id', session('branch_id'))->where('status', '0')->sum('due');

        $poltiInfo = ([
            'polti_all' => $poltis,
            'polti_deth' => $deth,
            'polti_kg_delivered' => $polti_kg_delivered,
            'polti_sell_delivered' => $polti_sell_delivered,
            'polti_kg_booking' => $polti_kg_booking,
            'polti_sell_booking' => $polti_sell_booking,
            'costs_today' => $costs_today,
            'costs_total' => $costs_total,
            'sell_today' => $sell_today,
            'sell_total' => $sell_total,
            'sell_due' => $sell_due,
        ]);       


        $branchName    = Branch::where('id', session('branch_id'))->first();
        $permanetCost  = Cost::where('branch_id', session('branch_id'))->where('expense_type', 2)->sum('cost_amount');
        $farm1Cost     = Cost::where('branch_id', session('branch_id'))->where('expense_type', 1)->sum('cost_amount');
        $staffs        = Staff::where('branch_id', session('branch_id'))->where('status', 1)->count();
        $farmCosts     = Account::where('branch_id', session('branch_id'))->where('expense_type', 1)->sum('amount');
        $settings = Setting::first();
        $totalCost = $permanetCost + $farm1Cost + $farmCosts;

        $incomes  = Income::where('branch_id', session('branch_id'))->sum('amount');
        $dues     = Income::where('branch_id', session('branch_id'))->sum('due');

        $staffSalaryAmount = StaffSalary::where('branch_id', session('branch_id'))->sum('amount');

        return view('welcome', compact('settings','dues','poltiInfo', 'staffSalaryAmount', 'branchName', 'permanetCost', 'staffs', 'farmCosts','incomes', 'totalCost', 'farm1Cost'));
    }

    public function branch()
    {
        if (session('branch_id')) {
            session()->forget('branch_id');
            // Redirect to the branch selection page with a message if needed
            return redirect()->route('branch')->with('success', 'Previous branch selection removed.');
        }

        $branches = Branch::where('status', '1')->get();

        // return $branches;

        return view('branch.branch', compact('branches'));
    }

    public function SupplierIndex()
    {
        $data['suppliers'] = Supplier::where('status', '1')->get();

        return view('supplier.index')->with($data);
    }

    public function SupplierCreate()
    {
        return view('supplier.create');
    }

    public function supplierStore(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'company_name'   => 'nullable',
            'phone_number'   => 'nullable',
            'email'          => 'nullable|email',
            'address'        => 'nullable',
            // 'supplier_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        // $imagePath = $request->file('supplier_image')->store('supplierImage', 'public');

          // Create new Supplier record
        Supplier::create([
            'branch_id'      => session('branch_id'),
            'supplier_name'  => $request->input('name'),
            'company_name'   => $request->input('company_name'),
            'phone_number'   => $request->input('phone_number'),
            'email'          => $request->input('email'),
            'address'        => $request->input('address'),
            // 'supplier_image' => $imagePath,
        ]);

        return redirect()->back()->with('message', 'Supplier created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function SupplierDestroy($id)
    {
        try {
            DB::beginTransaction();

            $supplier = Supplier::find($id);

            if(!$supplier){
                return response()->json(['message' => 'Supplier not found']);
            }

            $res = $supplier->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Supplier deleted']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}
