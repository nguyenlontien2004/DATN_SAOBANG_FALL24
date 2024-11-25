<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\SuatChieu;
use App\Models\PhongChieu;
use App\Models\DoAn;
use App\Models\Ve;
use App\Http\Resources\SeatsRowResource;
use App\Models\GheNgoi;
use App\Models\ThanhToan;
use App\Models\ChiTietVe;
use App\Models\MaGiamGia;
use App\Models\DoAnVaChiTietVe;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use App\Events\OrderSuccess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DatVeController extends Controller
{
    function datve($id, $date)
    {
        $formattedDate = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
        $suatchieu = SuatChieu::query()
            ->select('id', 'phong_chieu_id', 'phim_id', DB::raw("TIME_FORMAT(gio_bat_dau,'%H:%i') as gio_bat_dau"), DB::raw("TIME_FORMAT(gio_ket_thuc,'%H:%i') as gio_ket_thuc"))
            ->with([
                'phim:id,ten_phim,gia',
                'phongChieu:id,ten_phong_chieu,rap_id',
                'rap'
            ])
            ->find($id);
        //dd($suatchieu->toArray());
        $ghePhongChieu = PhongChieu::query()
            ->select(['id'])
            ->with([
                'ghe_ngoi' => function ($query) use ($formattedDate, $id) {
                    $query->select(['ghe_ngois.id', 'ghe_ngois.phong_chieu_id', 'ghe_ngois.hang_ghe', 'ghe_ngois.the_loai', 'ghe_ngois.so_hieu_ghe', 'ghe_ngois.isDoubleChair', 'ghe_ngois.trang_thai'])
                        ->withCount([
                            'chitietve' => function ($q) use ($formattedDate, $id) {
                                $q->join('ves', 'chi_tiet_ves.ve_id', '=', 'ves.id')
                                    ->whereDate('ngay_ve_mo', '=', $formattedDate)
                                    ->where('suat_chieu_id', $id);
                            }
                        ])
                        ->orderBy('hang_ghe')
                        ->orderBy('so_hieu_ghe');
                }
            ])
            ->find($suatchieu->phongChieu->id);
        //dd($ghePhongChieu->ghe_ngoi->groupBy('hang_ghe')->toArray());
        $hangghe = new SeatsRowResource($ghePhongChieu->ghe_ngoi->groupBy('hang_ghe'));
        //dd($hangghe->toArray(request()));
        $doAn = DoAn::query()->get();
        //dd($doAn->toArray());
        return view('user.vedat', compact(['suatchieu', 'id', 'date', 'hangghe', 'doAn']));
    }
    public function thanhToan($id, $date)
    {
        //dd(session('thong-tin-dat'));
        $idsuauChieu = $id;
        $tong = session('thong-tin-dat')['tong'];
        $listIdGhe = array_column(session('thong-tin-dat')['hangghe'], 'id');

        $ghe = GheNgoi::query()
            ->select('id', 'hang_ghe', 'the_loai', 'so_hieu_ghe', 'isDoubleChair')
            ->whereIn('id', $listIdGhe)
            ->orderBy('hang_ghe')
            ->orderBy('so_hieu_ghe')
            ->get()->groupBy('the_loai');

        $suatChieu = SuatChieu::query()->with([
            'phim:id,ten_phim,gia'
        ])->find($id);

        // foreach ($ghe as $key => $value) {
        //     for ($i=0; $i < count($value); $i++) { 
        //        if($key=='thuong'){
        //           $tong+=$suatChieu->phim->gia;
        //        }elseif($key=='vip'){
        //         $tong+=$suatChieu->phim->gia + 10000;
        //        }else{
        //         $tong+=$suatChieu->phim->gia*2 + 15000;
        //         $i++;
        //        }
        //     }
        // }
        $listIdDoan = array_column(session('thong-tin-dat')['doan'], 'idFood');
        $dataSoluongDoAn = session('thong-tin-dat')['doan'];
        $doAn = DoAn::query()->select('id', 'ten_do_an', 'gia')->whereIn('id', $listIdDoan)->get();
        // dd($suatChieu->toArray(),$ghe->toArray(),$tong);
        // $a = array_filter($dataSoluongDoAn,function($value){
        //     return $value['idFood'] == 3;
        // });
        // dd(reset($a));
        return view('user.thanhtoan', compact(['id','idsuauChieu', 'date', 'ghe', 'suatChieu', 'tong', 'doAn', 'dataSoluongDoAn']));
    }

    public function checkViOnline(Request $request)
    {
        $uuid = Str::uuid();
        $uuid = substr(str_replace('-', '', $uuid), 0, 22);

        switch ($request->viOline) {
            case 'momo':
                return $this->MoMo($request, $uuid);
            case 'vnpay':
                return $this->vnpay($request, $uuid);
            case 'zalopay':
                return $this->zalopay($request, $uuid);
            default:
                return true;
        }
    }
    public function luuThongTinVeMua(Request $request)
    {
        // dd($request->all());
        try {
            $thongtinVeluu = session('thong-tin-dat');
            $ve = Ve::query()->orderBy('id', 'desc')->get()->first();
            $formattedDate = Carbon::createFromFormat('d-m-Y', $thongtinVeluu['ngayvemo'])->format('Y-m-d');
            $date = Carbon::parse($formattedDate);
            //dd(date("Y/m/d"),$date);
            //dd($request->extraData);  
            DB::beginTransaction();
            // if (!empty($request->extraData)) {
            //     $ma = MaGiamGia::query()->find($request->extraData);
            //     $ma->so_luong = $ma->so_luong - 1;
            //     $ma->save();
            // }
            $createVe = $this->checkRequestThanhtoanOn($request, $ve, $thongtinVeluu, $date);
            // $macode = $request->orderId . $ve->id + 1;
            // $createVe = $this->createVe($macode, $request->extraData, $thongtinVeluu['idSuatChieu'], $date, $request->amount, $request->orderInfo);
            // $this->checkMagiamgia($request->extraData);
            // $this->ChiTietVeMua($thongtinVeluu, $createVe->id);
            // $this->thanhtoanVe($createVe->id);
            // $this->DoAnVaChiTietVeMua($thongtinVeluu, $createVe->id);
            // $createVe = Ve::query()->create([
            //     'ma_code_ve' => $request->orderId . $ve->id + 1,
            //     'nguoi_dung_id' => 1,
            //     'suat_chieu_id' => $thongtinVeluu['idSuatChieu'],
            //     'ma_giam_gia_id' => $request->extraData,
            //     'ngay_thanh_toan' => date("Y-m-d"),
            //     'ngay_ve_mo' => $date,
            //     'tong_tien' => $request->amount,
            //     'phuong_thuc_thanh_toan' => $request->orderInfo
            // ]);

            // $qrCodeData = asset('check-qrCode/' . $createVe->id);
            // $qrCode = new QrCode($qrCodeData);
            // $writer = new PngWriter();
            // $fileName = 'qrcode_' . time() . '.png';
            // $path = 'qrcodes/' . $fileName;
            // Storage::disk('public')->put($path, $writer->write($qrCode)->getString());

            // $createVe->qr_code = $path;
            // $createVe->save();


            // ThanhToan::query()->create([
            //     'nguoi_dung_id' => 1,
            //     've_id' => $createVe->id,
            //     'ngay_thanh_toan' => date("Y-m-d")
            // ]);


            // foreach ($thongtinVeluu['hangghe'] as $value) {
            //     ChiTietVe::query()->create([
            //         've_id' => $createVe->id,
            //         'ghe_ngoi_id' => $value['id'],
            //         'so_luong_ghe_ngoi' => 1,
            //     ]);
            // }


            // foreach ($thongtinVeluu['doan'] as $value) {
            //     DoAnVaChiTietVe::query()->create([
            //         'do_an_id' => $value['idFood'],
            //         've_id' => $createVe->id,
            //         'so_luong_do_an' => $value['soluong'],
            //     ]);
            // }
            DB::commit();

            $this->guiThongtinVeMail($createVe->id);
            return redirect()->route('thongtinve', [$createVe->id, $createVe->ma_code_ve]);
            //dd($request->all(), $ve->toArray(), $thongtinVeluu);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/');
        }
    }
    public function checkRequestThanhtoanOn($request, $ve, $thongtinVeluu, $date)
    {
        $theloaivi = '';
        if (isset($request->orderInfo)) {
            $theloaivi = $request->orderInfo;
        } elseif (isset($request->vnp_OrderInfo)) {
            $theloaivi = json_decode($request->vnp_OrderInfo)->description;
        }elseif(isset($request->thanhtoan)){
            $theloaivi = $request->thanhtoan;
        }
        switch ($theloaivi) {
            case 'MoMo':
                if ($request->resultCode != 0) {
                    return abort('404', 'Không thể thực hiện được giao dịch');
                }
                $this->checkMagiamgia($request->extraData);
                $macode = $request->orderId . $ve->id + 1;
                $createVe = $this->createVe($macode, $request->extraData, $thongtinVeluu['idSuatChieu'], $date, $request->amount, $request->orderInfo);
                $this->ChiTietVeMua($thongtinVeluu, $createVe->id);
                $this->thanhtoanVe($createVe->id);
                $this->DoAnVaChiTietVeMua($thongtinVeluu, $createVe->id);
                return $createVe;
            case 'VNPAY':
                if ($request->vnp_ResponseCode != 00) {
                    return abort('404', 'Không thể thực hiện được giao dịch');
                }
                $this->checkMagiamgia(json_decode($request->vnp_OrderInfo)->magiamgia);
                $macode = $request->vnp_TxnRef . $ve->id + 1;
                $createVe = $this->createVe($macode, json_decode($request->vnp_OrderInfo)->magiamgia, $thongtinVeluu['idSuatChieu'], $date, $request->vnp_Amount / 100, json_decode($request->vnp_OrderInfo)->description);
                $this->ChiTietVeMua($thongtinVeluu, $createVe->id);
                $this->thanhtoanVe($createVe->id);
                $this->DoAnVaChiTietVeMua($thongtinVeluu, $createVe->id);
                return $createVe;
            case 'ZALOPAY':
                if ($request->status != 1) {
                    return abort('404', 'Không thể thực hiện được giao dịch');
                }
                $this->checkMagiamgia($request->magiamgia);
                $macode = $request->zlpay_orderid . $ve->id + 1;
                $createVe = $this->createVe($macode, $request->magiamgia, $thongtinVeluu['idSuatChieu'], $date, $request->amount, $request->thanhtoan);
                $this->ChiTietVeMua($thongtinVeluu, $createVe->id);
                $this->thanhtoanVe($createVe->id);
                $this->DoAnVaChiTietVeMua($thongtinVeluu, $createVe->id);
                return $createVe;
            default:
                return true;
        }
    }
    public function createVe($macode, $idMagiam, $suatChieuId, $date, $tongTien, $phuongthuc)
    {
        //$thongtinVeluu['idSuatChieu'],$request->orderId . $ve->id + 1,$request->extraData,$request->amount,$request->orderInfo
        $createVe = Ve::query()->create([
            'ma_code_ve' => $macode,
            'nguoi_dung_id' => Auth::user()->id,
            'suat_chieu_id' => $suatChieuId,
            'ma_giam_gia_id' => $idMagiam,
            'ngay_thanh_toan' => date("Y-m-d"),
            'ngay_ve_mo' => $date,
            'tong_tien' => $tongTien,
            'phuong_thuc_thanh_toan' => $phuongthuc
        ]);

        $qrCodeData = asset('check-qrCode/' . $createVe->id);
        $qrCode = new QrCode($qrCodeData);
        $writer = new PngWriter();
        $fileName = 'qrcode_' . time() . '.png';
        $path = 'qrcodes/' . $fileName;
        Storage::disk('public')->put($path, $writer->write($qrCode)->getString());

        $createVe->qr_code = $path;
        $createVe->save();
        return $createVe;
    }
    public function thanhtoanVe($idVe)
    {
        //$createVe->id
        ThanhToan::query()->create([
            'nguoi_dung_id' => Auth::user()->id,
            've_id' => $idVe,
            'ngay_thanh_toan' => date("Y-m-d")
        ]);
    }
    public function ChiTietVeMua($thongtinVeluu, $idVe)
    {
        //$createVe->id
        foreach ($thongtinVeluu['hangghe'] as $value) {
            ChiTietVe::query()->create([
                've_id' => $idVe,
                'ghe_ngoi_id' => $value['id'],
                'so_luong_ghe_ngoi' => 1,
            ]);
        }
    }
    public function DoAnVaChiTietVeMua($thongtinVeluu, $idVe)
    {
        //$createVe->id
        foreach ($thongtinVeluu['doan'] as $value) {
            DoAnVaChiTietVe::query()->create([
                'do_an_id' => $value['idFood'],
                've_id' => $idVe,
                'so_luong_do_an' => $value['soluong'],
            ]);
        }
    }
    public function checkMagiamgia($idMagiam)
    {
        //$request->extraData
        if (!empty($idMagiam)) {
            $ma = MaGiamGia::query()->find($idMagiam);
            $ma->so_luong = $ma->so_luong - 1;
            $ma->save();
        }
    }
    public function checkqrCode($id)
    {
        dd($id);
    }
    public function guiThongtinVeMail($id)
    {
        $ve = Ve::query()->with([
            'chiTietVe',
            'suatChieu' => function ($query) {
                $query->select('id', 'phong_chieu_id', 'phim_id', DB::raw("TIME_FORMAT(gio_bat_dau,'%H:%i') as gio_bat_dau"), DB::raw("TIME_FORMAT(gio_ket_thuc,'%H:%i') as gio_ket_thuc"))
                    ->with([
                        'phim',
                        'rap',
                        'phongChieu'
                    ]);
            },
            'maGiamGia'
        ])->find($id);
        $food = DoAnVaChiTietVe::query()->with([
            'food'
        ])->where('ve_id', $ve->id)->get();
        $ghe = $ve->chiTietVe->pluck('seat')->groupBy('the_loai');
        $urlCode = asset('storage/' . $ve->qr_code);
        $emaiUser = Auth::user()->email;

        OrderSuccess::dispatch($ve->toArray(), $food->toArray(), $ghe->toArray(), $urlCode, $emaiUser);
    }

    public function thongtinve($id, $macodeve)
    {
        $ve = Ve::query()->with([
            'chiTietVe',
            'suatChieu' => function ($query) {
                $query->select('id', 'phong_chieu_id', 'phim_id', DB::raw("TIME_FORMAT(gio_bat_dau,'%H:%i') as gio_bat_dau"), DB::raw("TIME_FORMAT(gio_ket_thuc,'%H:%i') as gio_ket_thuc"))
                    ->with([
                        'phim',
                        'rap',
                        'phongChieu'
                    ]);
            },
            'maGiamGia'
        ])
            ->where('ma_code_ve', $macodeve)
            ->where('id', $id)->first();
        if (empty($ve)) {
            return abort(404, 'Trang không tồn tại!');
        }
        $food = DoAnVaChiTietVe::query()->with([
            'food'
        ])->where('ve_id', $ve->id)->get();
        $ghe = $ve->chiTietVe->pluck('seat')->groupBy('the_loai');

        // dd($ghe,$ve->toArray());
        return view('user.thongtinve', compact(['ve', 'ghe', 'food']));
    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function MoMo($request, $uuid)
    {
        //    dd($request->all());
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "MoMo";
        $amount = (string) $request->tongGia;
        $orderId = (string) $uuid;
        $codeId = $request->magiamgia;
        $redirectUrl = asset("luu-thong-tin-ve");
        $ipnUrl = asset("luu-thong-tin-ve");
        $extraData = (string) $codeId;


        $requestId = time() . "";
        $requestType = "payWithATM";
        //$extraData = (isset($_POST["extraData"]) ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        ;
        $jsonResult = json_decode($result, true);  // decode json

        //Just a example, please check more in there
        return redirect()->to($jsonResult['payUrl']);
    }
    public function vnpay($request, $uuid)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = asset("luu-thong-tin-ve");
        $vnp_TmnCode = "MOCKDTJC";//Mã website tại VNPAY 
        $vnp_HashSecret = "Y0MT8SQNMSCKZZMNFKJY12S3MMCSADXZ"; //Chuỗi bí mật

        $vnp_TxnRef = $uuid; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY

        $vnp_OrderInfo = json_encode([
            'description' => 'VNPAY',
            'magiamgia' => $request->magiamgia
        ]);
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->tongGia * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        //$vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);
        // if (isset($fullName) && trim($fullName) != '') {
        //     $name = explode(' ', $fullName);
        //     $vnp_Bill_FirstName = array_shift($name);
        //     $vnp_Bill_LastName = array_pop($name);
        // }
        // $vnp_Bill_Address = $_POST['txt_inv_addr1'];
        // $vnp_Bill_City = $_POST['txt_bill_city'];
        // $vnp_Bill_Country = $_POST['txt_bill_country'];
        // $vnp_Bill_State = $_POST['txt_bill_state'];
        // // Invoice
        // $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
        // $vnp_Inv_Email = $_POST['txt_inv_email'];
        // $vnp_Inv_Customer = $_POST['txt_inv_customer'];
        // $vnp_Inv_Address = $_POST['txt_inv_addr1'];
        // $vnp_Inv_Company = $_POST['txt_inv_company'];
        // $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
        // $vnp_Inv_Type = $_POST['cbo_inv_type'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate" => $vnp_ExpireDate,
            // "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
            // "vnp_Bill_Email" => $vnp_Bill_Email,
            // "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
            // "vnp_Bill_LastName" => $vnp_Bill_LastName,
            // "vnp_Bill_Address" => $vnp_Bill_Address,
            // "vnp_Bill_City" => $vnp_Bill_City,
            // "vnp_Bill_Country" => $vnp_Bill_Country,
            // "vnp_Inv_Phone" => $vnp_Inv_Phone,
            // "vnp_Inv_Email" => $vnp_Inv_Email,
            // "vnp_Inv_Customer" => $vnp_Inv_Customer,
            // "vnp_Inv_Address" => $vnp_Inv_Address,
            // "vnp_Inv_Company" => $vnp_Inv_Company,
            // "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
            // "vnp_Inv_Type" => $vnp_Inv_Type
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        // }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00'
            ,
            'message' => 'success'
            ,
            'data' => $vnp_Url
        );
        if ($request->viOline == 'vnpay') {
            return redirect()->to($vnp_Url);
            // die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
    }
    public function zalopay($request, $uuid)
    {
        $config = [
            "app_id" => 2553,
            "key1" => "PcY4iZIKFCIdgZvA6ueMcMHHUbRLYjPL",
            "key2" => "KLtgPl8HHhfvMUDHPwKfgfsY4Ydm9eIz",
            "endpoint" => "https://sb-openapi.zalopay.vn/v2/create",
        ];
        $embeddata = json_encode([
            "redirecturl" => asset('luu-thong-tin-ve?'.'zlpay_orderid='.$uuid.'&magiamgia='.$request->magiamgia."&thanhtoan=ZALOPAY"), // URL chuyển hướng sau khi thanh toán
        ]);
        $items = '[]';
        $transID = $uuid;
        $order = [
            "app_id" => $config['app_id'],
            "app_time" => round(microtime(true) * 1000),
            "app_trans_id" => date("ymd") . "_" . $transID,
            "app_user" => "user123",
            "item" => $items,
            "embed_data" => $embeddata,
            "amount" => $request->tongGia,
            "description" => "Lazada - Payment for the order #$transID",
            'bank_code' => "CC"
        ];
        $data = $order['app_id'] . "|" . $order['app_trans_id'] . "|" . $order['app_user'] . "|" . $order['amount']
            . "|" . $order['app_time'] . "|" . $order['embed_data'] . "|" . $order['item'];
        $order['mac'] = hash_hmac("sha256", $data, $config['key1']);
        
        $context = stream_context_create([
            "http" => [
                "header" => "Content-Type: application/x-www-form-urlencoded\r\n",
                "method" => "POST",
                "content" => http_build_query($order),
        
            ],
        ]);
        $res = file_get_contents($config["endpoint"], false, $context);
        $result = json_decode($res,true);
        if($result['return_code'] == 1){
            return redirect()->to($result['order_url']);
        }
        return back();
    }
    public function testMail()
    {
        $this->guiThongtinVeMail(57);
    }
}
