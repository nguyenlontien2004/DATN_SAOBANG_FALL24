<?php

use App\Models\NguoiDung;
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
        Schema::create('thanh_toans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(NguoiDung::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Ve::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('thanh_toans');
    }
};