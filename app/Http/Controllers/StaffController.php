<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\StaffSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreStaffRequest;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\UpdateStaffRequest;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = Staff::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->get();

        // return $staffs;

        return view('staff.staff_list', compact('staffs'));
    }

    public function salaryIndex()
    {
        $currentMonth = Carbon::now();

        $salaries = StaffSalary::with('branch:id,branch_name', 'staff:id,name,salary')->whereDate('paid_on', $currentMonth)->get();

        return view('staff.salary_list', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.create_staff');
    }

    public function storeStaffSalary(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'salary'      => 'required|numeric|min:' . $request->input('basic_salary'),
            'salary_date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 422);
        }

        $salaryDate = $request->input('salary_date');
        $salary     = $request->input('salary');
        $month      = $request->input('month');
        $year       = $request->input('year');
        $amount     = $request->input('salary');
        $paidOn     = $request->input('salary_date');

        $staffSalaryObj = new StaffSalary;

        $staffSalaryObj->branch_id = session('branch_id');
        $staffSalaryObj->staff_id  = $id;
        $staffSalaryObj->month     = $month;
        $staffSalaryObj->year      = $year;
        $staffSalaryObj->amount    = $amount;
        $staffSalaryObj->paid_on   = $paidOn;

        $res = $staffSalaryObj->save();

        if($res){
            $result = $this->staffFlagUpdate($id);
            if($result == true){
                return response()->json(['message' => 'Salary Paid']);
            }
        }
    }

    protected function staffFlagUpdate($id)
    {
        $staff = Staff::find($id);

        if($staff){
            $res = $staff->update(['flag' => 1]);
            if($res){
                return true;
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStaffRequest $request)
    {
        try {
            DB::beginTransaction();

            $staffObj = new Staff;

            $staff_image = $request->file('staff_image');

            if ($staff_image) {
                // Generate a unique name for the image
                $image_name = time() . '.' . $staff_image->getClientOriginalExtension();

                // Set path for storing the image
                $image_path = public_path('images/staffs') . DIRECTORY_SEPARATOR . $image_name;

                if (!is_dir(public_path('images/staffs'))) {
                    // Create the directory if it does not exist
                    mkdir(public_path('images/staffs'), 0777, true);
                }

                if (!is_writable(public_path('images/staffs'))) {
                    // Log an error or handle the issue appropriately
                    return response()->json(['error' => 'Directory is not writable'], 500);
                }

                // Resize and compress the image
                Image::make($staff_image->getRealPath())
                    ->resize(300, 200, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save($image_path, 60); // 60 is the quality of the compressed image (0-100)

                // Assign the image name to the branch object property
            }

            $name             = $request->input('name');
            $salary           = $request->input('salary');
            $fatherName       = $request->input('father_name');
            $motherName       = $request->input('mother_name');
            $email            = $request->input('email');
            $nidNo            = $request->input('nid_no');
            $birthCertificate = $request->input('birth_certificate');
            $presentAddress   = $request->input('present_address');
            $permanentAddress = $request->input('permanent_address');
            $bloodGroup       = $request->input('blood_group');
            $gender           = $request->input('gender');
            $birthDate        = $request->input('birth_date');

            $staffObj->branch_id         = session('branch_id');
            $staffObj->name              = $name;
            $staffObj->salary            = $salary;
            $staffObj->father_name       = $fatherName;
            $staffObj->mother_name       = $motherName;
            $staffObj->email             = $email;
            $staffObj->nid_no            = $nidNo;
            $staffObj->birth_certificate = $birthCertificate;
            $staffObj->present_address   = $presentAddress;
            $staffObj->permanent_address = $permanentAddress;
            $staffObj->blood_group       = $bloodGroup;
            $staffObj->gender            = $gender;
            $staffObj->birth_date        = $birthDate;
            $staffObj->staff_image       = $image_name;
            $staffObj->status            = '1';

            $res = $staffObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Staff created successfully');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function storeSalary(Request $request)
    {
        return $request->all();
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:1900',
            'amount' => 'required|numeric|min:0',
        ]);

        StaffSalary::create([
            'staff_id' => $request->staff_id,
            'month' => $request->month,
            'year' => $request->year,
            'amount' => $request->amount,
            'paid_on' => now() // or you can get the payment date from the form if provided
        ]);

        return redirect()->back()->with('success', 'Salary stored successfully.');
    }

    public function salaryCreate()
    {
        $staffs = Staff::where('branch_id', session('branch_id'))->where('status', '1')->get();

        return view('staff.create_salary', compact('staffs'));
    }

    public function salaryReport()
    {
        return view('staff.salary_report_create');
    }

    public function salaryReportView(Request $request)
    {
        $month = $request->input('month');
        $year  = $request->input('year');

        $salaries = StaffSalary::where('branch_id', session('branch_id'))->where('month', $month)->where('year', $year)->get();

        return view('staff.salary_report_view', compact('salaries'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff, $id)
    {
        $staff = Staff::where('branch_id', session('branch_id'))->where('id', $id)->first();

        return view('staff.staff_profile', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff, $id)
    {
        $staff = Staff::where('branch_id', session('branch_id'))->where('id', $id)->first();

        return view('staff.staff_edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStaffRequest $request, Staff $staff)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        //
    }
}