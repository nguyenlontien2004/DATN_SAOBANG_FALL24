<?php

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
        Schema::create('phims', function (Blueprint $table) {
            $table->id();
            $table->string('ten_phim');
            $table->integer('do_tuoi');
            $table->string('anh_phim')->nullable();
            $table->text('mo_ta');
            $table->integer('thoi_luong');
            $table->integer('luot_xem_phim')->default(0);
            $table->date('ngay_khoi_chieu');
            $table->date('ngay_ket_thuc')->nullable();
            $table->string('trailer')->nullable();
            $table->integer('gia')->nullable();
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phims');
    }
};
