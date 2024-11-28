<?php

use App\Models\DoAn;
use App\Models\MaGiamGia;
use App\Models\NguoiDung;
use App\Models\SuatChieu;
use App\Models\Ve;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ves', function (Blueprint $table) {
            $table->id(); 
            $table->string('ma_code_ve')->nullable();
            $table->text('qr_code')->nullable();

            $table->foreignIdFor(NguoiDung::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SuatChieu::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(MaGiamGia::class)->nullable()->constrained()->cascadeOnDelete();
            $table->date('ngay_thanh_toan');
            $table->date('ngay_ve_mo')->nullable();
            $table->integer('tong_tien');
            $table->string('phuong_thuc_thanh_toan')->nullable();
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ves');
    }
};
