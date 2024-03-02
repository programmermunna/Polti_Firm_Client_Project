<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CowController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\MilkController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\SemenController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PregnancyController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShedController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/link', function () {
    Artisan::call('storage:link');
    return 'Storage Link Successfully';
});

Route::get('/clear', function(){
    Artisan::call('optimize:clear');
    return 'Optimize Clear!.';
})->name('clear');

Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');

Route::get('/', [AuthController::class, 'create'])->name('login.us');
Route::post('login/store', [AuthController::class, 'store'])->name('login.store');

Route::middleware(['auth'])->group(function(){
    Route::get('/branch', [AdminController::class, 'branch'])->name('branch');
    Route::get('/select/branch/{branch_id}', [BranchController::class, 'selectBranch'])->name('select.branch');
});

Route::middleware(['auth', 'auth.branch'])->group(function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::controller(AdminController::class)->group(function(){
        Route::get('/designation/list', 'index')->name('designation.list');
        Route::post('/designation/store', 'store')->name('designation.store');
        Route::post('/designation/update', 'update')->name('designation.edit');
        Route::get('/designation/delete/{id}', 'destroy');

        //For Supplier Route
        Route::get('/supplier/list', 'SupplierIndex')->name('supplier.list');
        Route::get('/supplier/create', 'SupplierCreate')->name('supplier.create');
        Route::post('/supplier/store', 'supplierStore')->name('supplier.store');
        Route::get('/supplier/delete/{id}', 'SupplierDestroy');
    });

    //User Route
    Route::get('/user/list', [UserController::class, 'index'])->name('user.list')->middleware('role:admin|role:super-admin');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create')->middleware('role:admin');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store')->middleware('role:admin|role:super-admin');

    Route::get('/user/profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::post('/user/edit', [UserController::class, 'update'])->name('user.edit');
    Route::post('/own/user/edit', [UserController::class, 'ownUserUpdate'])->name('ownuser.edit');
    Route::post('/own/pass/edit', [UserController::class, 'passUpdate'])->name('ownpass.edit');

    // For Category Route
    Route::get('/catgeory/list', [CategoryController::class, 'index'])->name('category.list');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('category.edit');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->middleware('role:admin|role:super-admin');

    // For Branch Route
    Route::get('/branch/list', [BranchController::class, 'index'])->name('branch.list')->middleware('role:admin');
    Route::get('/branch/create', [BranchController::class, 'create'])->name('branch.create')->middleware('role:admin');
    Route::post('/branch/store', [BranchController::class, 'store'])->name('branch.store')->middleware('role:admin');
    Route::post('/branch/edit', [BranchController::class, 'update'])->name('branch.edit')->middleware('role:admin');
    Route::get('/branch/delete/{id}', [BranchController::class, 'destroy'])->middleware('role:admin');

    // For Staff Route
    Route::get('/staff/list', [StaffController::class, 'index'])->name('staff.list');
    Route::get('/salary/list', [StaffController::class, 'salaryIndex'])->name('salary.list');
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.us');
    Route::get('/staff/show/{id}', [StaffController::class, 'show'])->name('staff.view');
    Route::get('/salary/report', [StaffController::class, 'salaryReport'])->name('salary.report');
    Route::post('/salary/report/view', [StaffController::class, 'salaryReportView'])->name('salary.report_view');
    Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit')->middleware('role:admin,super-admin');
    Route::get('/staff/salary', [StaffController::class, 'salaryCreate'])->name('staff.salary')->middleware('role:admin');
    Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');
    Route::post('/salary/store', [StaffController::class, 'storeSalary'])->name('store.salary');
    Route::post('/staff/salary/add/{id}', [StaffController::class, 'storeStaffSalary']);

    // For Role Route
    Route::get('/role/list', [RoleController::class, 'index'])->name('role.list');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit')->middleware('role:admin|super-admin');
    Route::post('/role/update', [RoleController::class, 'update'])->name('role.update')->middleware('role:admin|super-admin');
    Route::get('/role/delete/{id}', [RoleController::class, 'destroy'])->middleware('role:admin');
    Route::get('/get-permissions/{id}', [RoleController::class, 'getPermissions'])->name('get.permissions')->middleware('role:admin|super-admin');

    // For Pregnancy Route
    Route::get('/pregnancy/monitoring', [PregnancyController::class, 'create'])->name('pregnancy.monitoring');
    Route::post('/pregnancy/store', [PregnancyController::class, 'store'])->name('pregnancy.store');

    // For Semen Route
    Route::get('/semen/list', [SemenController::class, 'index'])->name('semen.list');
    Route::get('/semen/create', [SemenController::class, 'create'])->name('semen.create');
    Route::post('/semen/store', [SemenController::class, 'store'])->name('semen.store');

    //For Shed Route
    Route::controller(ShedController::class)->group(function(){
        Route::get('/shed/list', 'index')->name('shed.list');
        Route::post('/shed/store', 'store')->name('shed.store');
        Route::post('/shed/edit', 'update')->name('shed.edit');
        Route::get('/shed/delete/{id}', 'destroy');
    });

    // For Expense Route
    Route::get('/expense/list', [ExpenseController::class, 'index'])->name('expense.list');
    Route::get('/expense/type', [ExpenseController::class, 'expenseType'])->name('expense.type');
    Route::post('/expense/store', [ExpenseController::class, 'store'])->name('expense.store');
    Route::post('/expense/edit', [ExpenseController::class, 'update'])->name('expense.edit');
    Route::get('/expense/delete/{id}', [ExpenseController::class, 'destroy'])->middleware('role:admin');

    // For Cost Route
    Route::get('/cost/list', [CostController::class, 'index'])->name('cost.list');
    Route::get('/cost/create', [CostController::class, 'create'])->name('cost.create');
    Route::post('/cost/store', [CostController::class, 'store'])->name('cost.store');
    Route::post('/cost/edit', [CostController::class, 'update'])->name('cost.edit');
    Route::get('/bachur/list', [CowController::class, 'bachurIndex'])->name('bachur.list');

    // For Cow Route
    Route::get('/cow/list', [CowController::class, 'index'])->name('cow.list');
    Route::get('/cow/create', [CowController::class, 'create'])->name('cow.create');
    Route::get('/cow/sell', [CowController::class, 'sellCreate'])->name('cow.sell');
    Route::post('/cow/sell/store', [CowController::class, 'sellStore'])->name('sell.store');
    Route::post('/cow/store', [CowController::class, 'store'])->name('cow.store');
    Route::post('/cow/update', [CowController::class, 'update'])->name('cow.edit');
    Route::get('/sell/cow/list', [CowController::class, 'sellIndex'])->name('cow_sell.list');
    Route::post('/sell/edit', [CowController::class, 'sellEdit'])->name('cow_sell.edit');
    Route::post('/payment/store', [CowController::class, 'paymentStore'])->name('payment.store');
    Route::get('/cow/sell/collect', [CowController::class, 'sellCollect'])->name('cow_sell.collect');
    Route::get('/cow/sell/invoice/{id}', [CowController::class, 'sellInvoice'])->name('sell.invoice');
    Route::get('/get/cow/info/{id}', [CowController::class, 'cowInfo']);
    Route::get('/cow/delete/{id}', [CowController::class, 'destroy'])->middleware('role:admin');
    Route::get('/sell/cow/delete/{id}', [CowController::class, 'sellDestroy'])->middleware('role:admin');

    // For Invoice Controller
    Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');

    // For Food Route
    Route::get('/food/list', [FoodController::class, 'index'])->name('food.list');
    Route::get('cow/feed/list', [FoodController::class, 'feedIndex'])->name('cow.feed');
    Route::get('cow/feed/create', [FoodController::class, 'create'])->name('cow_feed.create');
    Route::post('/food/store', [FoodController::class, 'store'])->name('food.store');
    Route::post('/feed/store', [FoodController::class, 'feedStore'])->name('feed.store');
    Route::post('/food/edit', [FoodController::class, 'update'])->name('food.edit');
    Route::get('/get/shed/cows/{id}', [FoodController::class, 'shedCows']);
    Route::get('/get/cow/feed/{id}', [FoodController::class, 'getCowInfo']);
    Route::get('/get/cow/vaccine/{id}', [FoodController::class, 'getCowVaccine']);
    Route::get('/food/delete/{id}', [FoodController::class, 'destroy'])->middleware('role:admin');

    // For Unit Route
    Route::get('/unit/list', [FoodController::class, 'unitIndex'])->name('unit.list');
    Route::post('/unit/store', [FoodController::class, 'unitStore'])->name('unit.store');
    Route::post('/unit/edit', [FoodController::class, 'unitUpdate'])->name('unit.edit');
    Route::get('/unit/delete/{id}', [FoodController::class, 'unitDestroy'])->middleware('role:admin');

    //Monitoring Route
    Route::controller(MonitoringController::class)->group(function(){
        Route::get('/routine/monitoring', 'index')->name('routine.monitoring');
        Route::get('/vaccine/monitoring', 'vaccineIndex')->name('vaccine.monitoring');
        Route::post('/monitoring/vaccine/store', 'vaccineMonitoringStore')->name('vaccine_monitoring.store');
        Route::get('/monitoring/create', 'create')->name('monitoring.create');
        Route::get('/vaccine/create', 'vaccineCreate')->name('vaccine.create');

        // For Vaccine Model
        Route::get('/vaccine/list', 'vaccineList')->name('vaccine.list');
        Route::post('/vaccine/store', 'vaccineStore')->name('vaccine.store');
        Route::post('/vaccine/edit', 'vaccineUpdate')->name('vaccine.edit');
        Route::get('/vaccine/delete/{id}', 'vaccineDestroy');
    });

    // For Buyer Route
    Route::get('/buyer/list', [BuyerController::class, 'index'])->name('buyer.list');
    Route::get('/buyer/create', [BuyerController::class, 'create'])->name('buyer.us');
    Route::post('/buyer/edit', [BuyerController::class, 'update'])->name('buyer.edit');
    Route::post('/buyer/store', [BuyerController::class, 'store'])->name('buyer.store');
    Route::get('/buyer/due', [BuyerController::class, 'buyerDue'])->name('buyer.due');
    Route::get('/buyer/delete/{id}', [BuyerController::class, 'destroy'])->middleware('role:admin');

    // For Languge Route
    Route::get('lang/{lang}', [LanguageController::class, 'languageChange'])->name('lang.switch');

    // For Report Route
    Route::get('/milk/sale/report', [ReportController::class, 'milkSaleReport'])->name('milk.sale_report');
    Route::post('/show/milk/sale/report', [ReportController::class, 'milkSaleReportShow'])->name('show.milk_sale_report');
    Route::get('/farm/expense/report', [ReportController::class, 'farmExpenseReport'])->name('farm.expense_report');
    Route::post('/show/farm/expense/report', [ReportController::class, 'farmExpenseReportShow'])->name('show.farm_expense_report');
    Route::get('/emplyoee/salary/report', [ReportController::class, 'employeeSalaryReport'])->name('employee.salary_report');
    Route::post('/show/employee/salary/report', [ReportController::class, 'employeeSalaryReportShow'])->name('show.employee_salary_report');

    Route::get('/settings', [SettingController::class, 'create'])->name('setting.create');
    Route::post('/project/home', [SettingController::class, 'store'])->name('project.home');

    // Logout Route
    Route::get('/logout', [AuthController::class, 'logout']);
});
