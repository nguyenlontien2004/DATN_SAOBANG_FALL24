<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PhongChieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('phong_chieus')->insert([
            [
                'rap_id' => 1, // Giả sử rạp với id = 1
                'ten_phong_chieu' => 'Phòng chiếu 1',
                'gio_chieu' => '2024-11-21 10:00:00',
                'trang_thai' => 1, // 1 có thể là "đang hoạt động", 0 là "đã đóng cửa"
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null, // null nếu phòng chiếu chưa bị xóa
            ],
            [
                'rap_id' => 1, // Giả sử rạp với id = 1
                'ten_phong_chieu' => 'Phòng chiếu 2',
                'gio_chieu' => '2024-11-21 14:00:00',
                'trang_thai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'rap_id' => 2, // Giả sử rạp với id = 2
                'ten_phong_chieu' => 'Phòng chiếu 1',
                'gio_chieu' => '2024-11-21 17:00:00',
                'trang_thai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            // Thêm các bản ghi khác nếu cần
        ]);
    }
}
