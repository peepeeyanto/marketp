<?php

namespace App\Http\Controllers\backend;

use App\DataTables\withdrawAccDataTable;
use App\DataTables\withdrawLogDataTable;
use App\Http\Controllers\Controller;
use App\Models\beneficiaries;
use App\Models\vendor;
use App\Models\withdraw_log;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use function Termwind\render;

class payoutController extends Controller
{
    public function index(withdrawAccDataTable $datatable){
        return $datatable->render('seller.payout.index');
    }

    public function create(){
        return view('seller.payout.create');
    }

    public function store(Request $request){
        $request->validate([
            'vendor_id'=> ['required', 'integer'],
            'acc_number' => ['required'],
            'bank' => ['required'],
            'name' => ['required'],
            'email' => ['required'],
            'alias' => ['required']
        ]);


        $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
        'Authorization' => env('IRIS_BASIC_AUTH_API_KEY')
        ];

        $body = [
            "name" => $request->name,
            "account"=> $request->acc_number,
            'bank' => $request->bank,
            'email'=>  $request->email,
            'alias_name' =>$request->alias,
        ];


        $response = Http::withHeaders($headers)->post('https://app.sandbox.midtrans.com/iris/api/v1/beneficiaries', $body);

        // dd($response)->all();

        if($response->failed()){
            toastr($response->body(), 'error');
            return redirect()->back();
        }

        $account = new beneficiaries();
        $account->vendor_id = $request->vendor_id;
        $account->acc_number = $request->acc_number;
        $account->bank = $request->bank;
        $account->name = $request->name;
        $account->email = $request->email;
        $account->alias = $request->alias;
        $account->save();
        toastr('Rekening berhasil ditambahkan','success');
        return redirect()->route('seller.payout.index');

    }

    public function withdrawIndex(string $id){
        $account = beneficiaries::findOrFail($id);

        if($account->vendor_id != auth()->user()->vendor->id ){
            abort('404');
        }

        return view('seller.payout.withdraw', compact('account'));
    }

    public function withdraw(Request $request){
        $request->validate([
            'beneficiary_id'=>'required',
            'amount'=>'required',
            'notes'=>'required'
        ]);

        $account = beneficiaries::findOrFail($request->beneficiary_id);



        if($account->vendor_id != auth()->user()->vendor->id ){
            abort('404');
        }

        if(Auth::user()->vendor->balance < $request->amount ){
            toastr('Saldo tidak mencukupi', 'error');
            return redirect()->back();
        }

        // dd($request);

        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => env('IRIS_CREATOR_BASIC_AUTH_API_KEY')
        ];

        $body = [
            'payouts' => [[
                "beneficiary_name" => $account->name,
                "beneficiary_account" => $account->acc_number,
                "beneficiary_bank" => $account->bank,
                "beneficiary_email" => $account->email,
                "amount" => $request->amount,
                "notes" => $request->notes
            ]]
        ];

        // dd(json_encode($body));

        $response = Http::withHeaders($headers)->post('https://app.sandbox.midtrans.com/iris/api/v1/payouts', $body);

        // dd($response);

        if($response->failed()){
            toastr('Penarikan Gagal', 'error');
            return redirect()->back();
        }

        $data = $response->json();

        $log = new withdraw_log();
        $log->vendor_id = $account->vendor->id;
        $log->amount = $request->amount;
        $log->beneficiary_id = $account->id;
        $log->notes = $request->notes;
        $log->status = $data['payouts'][0]['status'];
        $log->reference = $data['payouts'][0]['reference_no'];

        $log->save();

        toastr('Permintaan penarikan berhasil dibuat, mohon tunggu approval dari admin', 'Success');
        return redirect()->route('seller.payout.index');
    }

    public function log(withdrawLogDataTable $datatable){
        return $datatable->render('seller.payout.log');
    }
}
