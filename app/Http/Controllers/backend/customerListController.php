<?php

namespace App\Http\Controllers\backend;

use App\DataTables\customerListDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class customerListController extends Controller
{
    public function index(customerListDataTable $datatable){
        return $datatable->render('admin.customers-list.index');
    }

    public function changeStatus(Request $request){
        $user = User::findOrFail($request->id);
        $user->status = $request->status == 'true' ? 'active' : 'inactive';
        $user->save();
        return response(['status' => 'succcess', 'message' => 'status berhasil diupdate']);
    }
}
