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
        Schema::create('ves', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\NguoiDung::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Ve::class)->constrained()->cascadeOnDelete();
            $table->date('ngay_thanh_toan');
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