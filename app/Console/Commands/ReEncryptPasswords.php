<?php

namespace App\Console\Commands;

use App\Models\NguoiDung;
use Illuminate\Console\Command;

class ReEncryptPasswords extends Command
{
    protected $signature = 'passwords:encrypt';
    protected $description = 'Mã hóa lại mật khẩu bằng Bcrypt';

    public function handle()
    {
        $nguoiDungs = NguoiDung::all();

        foreach ($nguoiDungs as $nguoiDung) {
            // Kiểm tra nếu mật khẩu chưa được mã hóa bằng Bcrypt
            if (!password_get_info($nguoiDung->password)['algo']) {
                $nguoiDung->password = bcrypt($nguoiDung->password);
                $nguoiDung->save();
                $this->info("Đã mã hóa mật khẩu cho người dùng ID: {$nguoiDung->id}");
            }
        }

        $this->info("Mã hóa lại mật khẩu hoàn tất!");
        return 0;
    }
}
