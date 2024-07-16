<?php

namespace App\Http\Controllers\backend;

use App\DataTables\subCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Str;
class subCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(subCategoryDataTable $datatable)
    {
        return $datatable->render('admin.subcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = category::all();
        return view('admin.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required'],
            'name' => ['required', 'max:200', 'unique:sub_categories,name'],
            'status' => ['required'],
        ]);

        $subcategory = new subCategory();
        $subcategory->category_id = $request->category;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->status = $request->status;
        $subcategory->save();

        toastr('berhasil dibuat', 'success');
        return redirect()->route('admin.subcategory.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = category::all();
        $subcategories = subCategory::findOrFail($id);
        return view('admin.subcategory.edit', compact('categories', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => ['required'],
            'name' => ['required', 'max:200', 'unique:sub_categories,name,'.$id],
            'status' => ['required'],
        ]);

        $subcategory = subCategory::findOrFail($id);
        $subcategory->category_id = $request->category;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->status = $request->status;
        $subcategory->save();

        toastr('berhasil diubah', 'success');
        return redirect()->route('admin.subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = subCategory::findOrFail($id);
        $subcategory->delete();

        return response(['status' => 'success', 'message' => 'data berhasil dihapus']);
    }

    public function changeStatus(Request $request){
        $subcategory = subCategory::findOrFail($request->id);
        $subcategory->status = $request->status == 'true' ? 1 : 0;
        $subcategory->save();
        return response(['status' => 'success', 'message' => 'status berhasil diubah']);
    }
}
