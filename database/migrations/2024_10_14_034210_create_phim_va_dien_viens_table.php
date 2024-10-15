<?php

use App\Models\DienVien;
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
        Schema::create('phim_va_dien_viens', function (Blueprint $table) {
            $table->foreignIdFor(Phim::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(DienVien::class)->constrained()->cascadeOnDelete();
            $table->string('vai_tro_dien_vien');
            $table->primary(['phim_id', 'dien_vien_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phim_va_dien_viens');
    }
};