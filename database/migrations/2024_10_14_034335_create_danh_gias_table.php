<?php

use App\Models\NguoiDung;
use App\Models\Phim;
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
        Schema::create('danh_gias', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(NguoiDung::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Phim::class)->constrained()->cascadeOnDelete();
            $table->integer('diem_danh_gia');
            $table->text('noi_dung')->nullable();
            $table->date('ngay_danh_gia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danh_gias');
    }
};