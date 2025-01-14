<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\vendor;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Zxing\QrReader;

class labelGeneratorController extends Controller
{

    public function index(){
        $products = product::where('vendor_id', Auth::user()->vendor->id)->get();

        return view('seller.label-generator.index', compact('products'));
    }

    public function qrGenerator($textData){
        $writer = new PngWriter;
        $qrCode = new QrCode(
            data: $textData,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Low,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255)
        );

        $result = $writer->write($qrCode);
        return $result;
    }

    public function encryptData(Request $request){
        $request->validate([
            'prod' => ['required'],
            'shop' => ['required'],
            'prod_date' => ['required']
        ]);

        $jsn = [
            'prod' => $request->prod,
            'shop' =>$request->shop,
            'prod_date' => $request->prod_date
        ];

        $productName = product::findOrFail($request->prod);

        $data = json_encode($jsn);

        // $text = '{
        // farmers_id: 12,
        // product_id: 13
        // prod: "11-02-2"
        // best_before: "-"
        // }';

        $iv_size        = openssl_cipher_iv_length('AES-128-CBC');
        $iv             = openssl_random_pseudo_bytes($iv_size);
        $ciphertext     = openssl_encrypt($data, 'AES-128-CBC', getenv('LABEL_SECRET'), OPENSSL_RAW_DATA, $iv);
        $ciphertext_hex = base64_encode($ciphertext);
        $iv_hex         = base64_encode($iv);

        $out =  $iv_hex.':'.$ciphertext_hex;
        $qr = $this->qrGenerator($out)->getDataUri();
        return view('seller.label-generator.label', compact('qr', 'jsn', 'productName'));
    }

    public function decryptIndex(){
        return view('frontend.label.index');
    }

    public function decryptData(Request $request){
        $parts = explode(':', $request->ciphertext);
        $iv = base64_decode($parts[0]);
        $ciphertext = base64_decode($parts[1]);

        try{
            $data = openssl_decrypt($ciphertext, 'AES-128-CBC', getenv('LABEL_SECRET'), OPENSSL_RAW_DATA, $iv);
        } catch(Exception $e){
            toastr('Kode Qr tidak valid', 'error');
            return redirect()->back();
        }

        $info = json_decode($data);

        $product = product::where('id', $info->prod)->value('name');
        $shop = vendor::where('id', $info->shop)->value('shop_name');
        $date = $info->prod_date;

        $responses = [
            'product_name' => $product,
            'shop_name' => $shop,
            'date' => $date,
        ];

        return response()->json($responses);
    }



}
