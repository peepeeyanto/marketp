<?php

namespace App\Http\Controllers\backend;

use App\DataTables\adminPayoutRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\vendor;
use App\Models\withdraw_log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class adminPayoutRequest extends Controller
{
    public function index(adminPayoutRequestDataTable $datatable){
        return $datatable->render('admin.payoutRequest.index');
    }

    public function approve(String $id){
        $log = withdraw_log::findOrFail($id);

        return view('admin.payoutRequest.approve', compact('log'));

    }

    public function storeApprove(Request $request){
        $request->validate([
            'otp' => 'required',
            'withdraw_id' => 'required',
        ]);

        $log = withdraw_log::findOrfail($request->withdraw_id);
        $vendor = vendor::findOrFail($log->vendor_id);
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => env('IRIS_BASIC_AUTH_API_KEY')
        ];

        $body = [
            'reference_nos' => [$log->reference],
            'otp' => $request->otp
        ];


        // dd($body);

        $response = Http::withHeaders($headers)->post('https://app.sandbox.midtrans.com/iris/api/v1/payouts/approve', $body);


        // dd($response)->all();
        if (!$response->successful()){
            toastr('Penarikan gagal', 'error');
            return redirect()->back();
        }

        $log->status = 'approved';
        $log->save();

        $current_balance = $vendor->balance;
        $new_balance = $current_balance - $log->amount;

        $vendor->balance = $new_balance;
        $vendor->save();

        toastr('penarikan berhasil', 'success');
        return redirect()->route('admin.payout.index');
    }

    public function deny(String $id){
        $log = withdraw_log::findOrFail($id);

        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => env('IRIS_BASIC_AUTH_API_KEY')
        ];

        $body = [
            'reference_nos' => $log->reference_no,
            'reject_reason' => 'Penarikan gagal'
        ];

        $response = Http::withHeaders($headers)->post('https://app.sandbox.midtrans.com/iris/api/v1/payouts/approve', $body);

        if (!$response->successful()){
            toastr('Terjadi Error', 'error');
            return redirect()->back();
        }

        $log->status = 'rejected';
        $log->save();

        toastr('penolakan transaksi berhasil', 'success');
        return redirect()->route('admin.payout.index');
    }
}
