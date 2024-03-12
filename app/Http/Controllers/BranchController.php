<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::where('status', 1)->where('flag', '0')->get();

        return view('branch.branch_list', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branch.create_branch');
    }

    public function selectBranch(Request $request, $branch_id)
    {
        $request->session()->put('branch_id', $branch_id);

        // Redirect to dashboard or another route after selection
        return redirect()->route('dashboard');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRequest $request)
    {
        try {
            DB::beginTransaction();

            $branchObj = new Branch;

            $branch_image = $request->file('branch_image');

            if ($branch_image) {
                // Generate a unique name for the image
                $image_name = time() . '.' . $branch_image->getClientOriginalExtension();

                // Set path for storing the image
                $image_path = public_path('images/branches') . DIRECTORY_SEPARATOR . $image_name;

                if (!is_dir(public_path('images/branches'))) {
                    // Create the directory if it does not exist
                    mkdir(public_path('images/branches'), 0777, true);
                }

                if (!is_writable(public_path('images/branches'))) {
                    // Log an error or handle the issue appropriately
                    return response()->json(['error' => 'Directory is not writable'], 500);
                }

                // Resize and compress the image
                // Image::make($branch_image->getRealPath())
                //     ->resize(300, 200, function ($constraint) {
                //         $constraint->aspectRatio();
                //     })
                //     ->save($image_path, 60); // 60 is the quality of the compressed image (0-100)

                // Assign the image name to the branch object property
            }

            $branchObj->branch_name = $request->input('branch_name');
            $branchObj->slug        = Str::slug($request->input('branch_name'), '-');
            $branchObj->branch_email   = $request->input('branch_email');
            $branchObj->branch_address = $request->input('branch_address');
            $branchObj->branch_image   = $image_name;
            $branchObj->status         = '1';
            $branchObj->created_at     = Carbon::now();

            $res = $branchObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Branch Created Successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        try {
            DB::beginTransaction();

            $validateData = $request->validated();
            $branchId     = $request->input('branch_id');
            $branch       = Branch::find($branchId);

            $validateData = [
                'branch_name' => $request->input('branch_name'),
                'slug'        => Str::slug($request->input('branch_name'), '-'),
                'status'      => $request->input('status'),
            ];

            if($branch){
                $res = $branch->update($validateData);

                DB::commit();
                if($res){
                    return redirect()->back()->with('message', 'Branch Update successfully');
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch, $id)
    {
        try {
            DB::beginTransaction();

            $branch = Branch::find($id);

            if(!$branch){
                return response()->json(['message' => 'Branch not found']);
            }

            $res = $branch->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Branch deleted']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}