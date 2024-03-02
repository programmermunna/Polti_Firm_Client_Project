<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cost;
use App\Models\Staff;
use App\Models\StaffSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function farmExpenseReport()
    {
        return view('report.farm_expense_report');
    }

    public function farmExpenseReportShow(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => ['required'],
            'end_date'   => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

        $farmCosts = Cost::with('branch:id,branch_name', 'expenseTypes:id,name')
        ->where('branch_id', session('branch_id'))
        ->whereBetween('cost_date', [$startDate,$endDate])
        ->where('expense_type', 1)->get();

        return view('report.farm_expense_report', ['farmCosts' => $farmCosts, 'startDate' => $startDate, 'endDate' => $endDate]);
    }

    public function employeeSalaryReport()
    {
        $staffs = Staff::where('branch_id', session('branch_id'))->get();

        return view('report.employee_salary_report', compact('staffs'));
    }

    public function employeeSalaryReportShow(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'month'    => ['required'],
            'year'     => ['required'],
            'staff_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $month    = $request->input('month');
        $year     = $request->input('year');
        $staff_id = $request->input('staff_id');

        $salaries = StaffSalary::with('branch:id,branch_name', 'staff:id,name')
        ->where('month', $month)->where('year', $year)->where('staff_id', $staff_id)
        ->where('branch_id', session('branch_id'))->get();

        return view('report.employee_salary_report_view', compact('salaries', 'month', 'year'));
    }
}
