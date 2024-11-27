<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuatChieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('suat_chieus')->insert([
            [
                'phong_chieu_id' => 1, // ID của phòng chiếu, đảm bảo rằng phòng chiếu này đã tồn tại trong bảng phong_chieus
                'phim_id' => 1, // ID của phim, đảm bảo rằng phim này đã tồn tại trong bảng phim
                'gio_bat_dau' => '2024-11-21 10:00:00',
                'gio_ket_thuc' => '2024-11-21 12:00:00',
                'trang_thai' => 1, // trạng thái suất chiếu, ví dụ: 1 có thể là "đang chiếu"
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'phong_chieu_id' => 2,
                'phim_id' => 2,
                'gio_bat_dau' => '2024-11-21 13:00:00',
                'gio_ket_thuc' => '2024-11-21 15:00:00',
                'trang_thai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm các bản ghi khác nếu cần
        ]);
    }
}
