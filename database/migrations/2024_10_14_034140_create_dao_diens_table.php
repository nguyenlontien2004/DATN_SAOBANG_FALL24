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
        Schema::create('dao_diens', function (Blueprint $table) {
            $table->id();
            $table->string('ten_dao_dien');
            $table->date('nam_sinh');
            $table->string('gioi_tinh');
            $table->string('quoc_tich');
            $table->string('anh_dao_dien')->nullable();
            $table->text('tieu_su')->nullable();
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dao_diens');
    }
};