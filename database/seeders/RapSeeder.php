<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('raps')->insert([
            [
                'ten_rap' => 'Rạp Galaxy Cinema',
                'dia_diem' => 'Quận 1, TP.HCM',
                'trang_thai' => 1, // 1 có thể là "hoạt động", 0 là "ngừng hoạt động"
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_rap' => 'Rạp CGV Lotte',
                'dia_diem' => 'Quận 3, TP.HCM',
                'trang_thai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_rap' => 'Rạp BHD Star',
                'dia_diem' => 'Quận Bình Thạnh, TP.HCM',
                'trang_thai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm các bản ghi khác nếu cần
        ]);
    }
}
