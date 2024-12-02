<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dữ liệu giả lập cho bảng 'ves'
        DB::table('ves')->insert([
            [
                'nguoi_dung_id' => 1, // ID người dùng
                'suat_chieu_id' => 3, // ID suất chiếu
                'ngay_thanh_toan' => Carbon::now(), // Ngày thanh toán
                'tong_tien' => 160000, // Tổng tiền
                'phuong_thuc_thanh_toan' => 'VNPAY', // Phương thức thanh toán
                'trang_thai' => '3', // Trạng thái của vé
                'created_at' => Carbon::now(), // Thời gian tạo
                'updated_at' => Carbon::now(), // Thời gian cập nhật
            ],

            // Thêm nhiều dữ liệu giả lập nữa nếu cần
        ]);
    }
}
