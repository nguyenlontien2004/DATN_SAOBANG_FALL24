<?php

use App\Models\GheNgoi;
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
        Schema::create('chi_tiet_ves', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ve::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(GheNgoi::class)->constrained()->cascadeOnDelete();
            $table->integer('so_luong_ghe_ngoi');
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_ves');
    }
};