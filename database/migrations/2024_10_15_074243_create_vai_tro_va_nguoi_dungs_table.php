<?php

use App\Models\NguoiDung;
use App\Models\VaiTro;
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
        Schema::create('vai_tro_va_nguoi_dungs', function (Blueprint $table) {
            $table->foreignIdFor(NguoiDung::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(VaiTro::class)->constrained()->cascadeOnDelete();
            $table->primary(['nguoi_dung_id', 'vai_tro_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vai_tro_va_nguoi_dungs');
    }
};