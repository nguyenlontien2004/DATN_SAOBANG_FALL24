<?php

namespace App\Console\Commands;

use App\Models\NguoiDung;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendResetLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-reset-link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gửi link đặt lại mật khẩu theo email của bạn:';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email =  $this->argument('email');

        $user = NguoiDung::where('email', $email)
            ->first();

        if (!$user) {
            $this->error('Email không tồn tại trong hệ thống');
            return 1;
        }

        $token = Str::random(64);

        /**
         * @var 
         */

        PasswordReset::updateOrCreate(
            ['email' => $email],
            ['token' => $token, 'create_at' => now()]
        );

        $resetLink = url('/reset-password/' . $token);
        
        try {
            Mail::send('emails.reset-password', ['link' => $resetLink], function ($message) use ($email) {
                $message->to($email)
                    ->subject('Yêu cầu đặt lại mật khẩu');
            });

            $this->info("Link đặt lại mật khẩu đã được gửi đến: $email");
        } catch (\Exception $e) {
            $this->error('Có lỗi xảy ra khi gửi email: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}