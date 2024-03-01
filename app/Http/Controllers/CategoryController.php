<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('status', '1')->get();

        return view('category.category_list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            DB::beginTransaction();

            $categoryObj = new Category;

            $categoryObj->name = $request->input('name');
            $categoryObj->status = '1';
            $categoryObj->created_at = Carbon::now();

            $res = $categoryObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Category Created successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            DB::beginTransaction();

            $validateData = $request->validated();
            $categoryId   = $request->input('category_id');
            $category     = Category::find($categoryId);

            if($category){
                $res = $category->update($validateData);

                DB::commit();
                if($res){
                    return redirect()->back()->with('message', 'Category Update successfully');
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
    public function destroy(Category $category, $id)
    {
        try {
            DB::beginTransaction();

            $category = Category::find($id);

            if(!$category){
                return response()->json(['message' => 'Catgeory not found']);
            }

            $res = $category->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Catgeory deleted']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}
