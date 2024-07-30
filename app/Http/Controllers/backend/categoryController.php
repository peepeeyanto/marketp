<?php

namespace App\Http\Controllers\backend;

use App\DataTables\categoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Str;
use App\Models\subCategory;
class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(categoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => ['required', 'not_in:empty'],
            'name' => ['required', 'max:200', 'unique:categories,name'],
            'status' => ['required']
        ]);

        $category = new category();
        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->status = $request->status;
        $category->slug = Str::slug($request->name);
        $category->save();

        toastr('Berhasil Dibuat', 'success');
        return redirect()->route('admin.category.index');
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
        $category = category::findOrFail($id);
        return view('admin.category.edit', compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => ['required', 'not_in:empty'],
            'name' => ['required', 'max:200', 'unique:categories,name,'.$id],
            'status' => ['required']
        ]);

        $category = category::findOrFail($id);
        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->status = $request->status;
        $category->slug = Str::slug($request->name);
        $category->save();

        toastr('Berhasil Diedit', 'success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = category::findOrFail($id);
        $subCategory = subCategory::where('category_id', $category->id)->count();
        if($subCategory > 0){
            return response(['status' => 'error', 'message' => 'Kategori tidak bisa dihapus karena masih ada subkategori yang bersangkutan!']);
        }
        $category->delete();
        return response(['status' => 'success', 'message' => 'Berhasil Dihapus']);
    }

    public function changeStatus(Request $request){
       $category = category::findOrFail($request->id);
       $category->status = $request->status == 'true' ? 1 : 0;
       $category->save();
       return response(['status' => 'succcess', 'message' => 'status berhasil diupdate']);
    }
}
