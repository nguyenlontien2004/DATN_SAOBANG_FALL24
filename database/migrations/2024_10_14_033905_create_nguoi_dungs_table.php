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
        Schema::create('nguoi_dungs', function (Blueprint $table) {
            $table->id();
            $table->string('ho_ten');
            $table->string('email')->unique();
            $table->string('so_dien_thoai')->nullable();
            $table->string('anh_dai_dien')->nullable();
            $table->string('mat_khau');
            $table->string('gioi_tinh');
            $table->text('dia_chi')->nullable();
            $table->date('nam_sinh');
            $table->date('ngay_dang_ky');
            $table->integer('gold')->default(0);
            $table->string('vai_tro');
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nguoi_dungs');
    }
};