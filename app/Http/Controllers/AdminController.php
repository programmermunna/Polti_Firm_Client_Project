<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cow;
use App\Models\Beef;
use App\Models\Cost;
use App\Models\Milk;
use App\Models\Shed;
use App\Models\Staff;
use App\Models\Branch;
use App\Models\Income;
use App\Models\Account;
use App\Models\BeefSell;
use App\Models\MilkSell;
use App\Models\Supplier;
use App\Models\Designation;
use App\Models\StaffSalary;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('login.us');
        }
    }

    public function index()
    {
        $data['designations'] = Designation::where('status', 1)->get();

        return view('designation.index')->with($data);
    }

    public function dashboard()
    {
        $cows          = Cow::where('branch_id', session('branch_id'))->where('status', '1')->where('flag', '0')->count();
        $currentDate   = Carbon::today();
        $beefsForToday = Beef::whereDate('created_at', $currentDate)->where('branch_id', session('branch_id'))->get();
        $totalBeef     = $this->beefCount($beefsForToday);
        $branchName    = Branch::where('id', session('branch_id'))->first();
        $permanetCost  = Cost::where('branch_id', session('branch_id'))->where('expense_type', 2)->sum('cost_amount');
        $farm1Cost     = Cost::where('branch_id', session('branch_id'))->where('expense_type', 1)->sum('cost_amount');
        $staffs        = Staff::where('branch_id', session('branch_id'))->where('status', 1)->count();
        $farmCosts     = Account::where('branch_id', session('branch_id'))->where('expense_type', 1)->sum('amount');

        $totalCost = $permanetCost + $farm1Cost + $farmCosts;

        $incomes  = Income::where('branch_id', session('branch_id'))->sum('amount');
        $dues     = Income::where('branch_id', session('branch_id'))->sum('due');
        $beefDues = BeefSell::where('branch_id', session('branch_id'))->sum('due');

        $beefSellAmount    = BeefSell::where('branch_id', session('branch_id'))->sum('payment');
        $todayIncome       = BeefSell::where('branch_id', session('branch_id'))->whereDate('created_at', $currentDate)->sum('payment');
        $staffSalaryAmount = StaffSalary::where('branch_id', session('branch_id'))->sum('amount');
        $totalMilk = Milk::where('branch_id', session('branch_id'))->sum('quantity');
        $todayMilkCount = Milk::where('branch_id', session('branch_id'))->whereDate('milk_date', $currentDate)->sum('quantity');
        $milkIncome = MilkSell::where('branch_id', session('branch_id'))->sum('payment');
        $milkIdue = MilkSell::where('branch_id', session('branch_id'))->sum('due');

        return view('welcome', compact('dues','cows','milkIncome', 'milkIdue','staffSalaryAmount', 'todayMilkCount', 'totalMilk', 'beefDues','todayIncome', 'beefSellAmount', 'totalBeef', 'branchName', 'permanetCost', 'staffs', 'farmCosts','incomes', 'totalCost', 'farm1Cost'));
    }

    protected function beefCount($beefsForToday)
    {
        $beefs = array();
        foreach($beefsForToday as $key => $beef){
            $beefs[] = $beef->total_beef;
        }
        return array_sum($beefs);
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

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $designationObj = new Designation();

            $designationObj->name = $request->input('name');
            $designationObj->slug = Str::slug($request->input('name'), '-');
            $designationObj->description = $request->input('description');

            $res = $designationObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Designation created');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $designationId = $request->input('designation_id');

            $designation = Designation::where('id', $designationId)->first();

            if(!$designation){
                return redirect()->back()->with('message', 'Designation Not Found');
            }

            $validData = [
                'name'        => $request->input('name'),
                'description' => $request->input('description'),
                'status'      => $request->input('status'),
            ];

            $res = $designation->update($validData);

            DB::commit();

            if($res){
                return redirect()->back()->with('message', 'Designation updated');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $designation = Designation::find($id);

            if(!$designation){
                return response()->json(['message' => 'Designation not found']);
            }

            $res = $designation->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Designation deleted']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
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