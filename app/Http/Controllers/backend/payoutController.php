<?php

namespace App\Http\Controllers\backend;

use App\DataTables\withdrawAccDataTable;
use App\Http\Controllers\Controller;
use App\Models\beneficiaries;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function withdrawIndex(){

    }
}
