<?php

use App\Models\DanhMucBaiVietTinTuc;
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
        Schema::create('bai_viet_tin_tucs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DanhMucBaiVietTinTuc::class)->constrained()->cascadeOnDelete();
            $table->string('tieu_de');
            $table->text('noi_dung');
            $table->text('tom_tat')->nullable();
            $table->string('hinh_anh')->nullable();
            $table->integer('luot_xem')->default(0);
            $table->date('ngay_dang');
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bai_viet_tin_tucs');
    }
};