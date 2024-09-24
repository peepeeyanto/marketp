<?php

namespace App\Http\Controllers\backend;

use App\DataTables\sellersListDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class sellerListController extends Controller
{
    public function index(sellersListDataTable $datatable){
        return $datatable->render('admin.sellers-list.index');
    }

    public function changeStatus(Request $request){
        $user = User::findOrFail($request->id);
        $user->status = $request->status == 'true' ? 'active' : 'inactive';
        $user->save();
        return response(['status' => 'succcess', 'message' => 'status berhasil diupdate']);
    }
}
