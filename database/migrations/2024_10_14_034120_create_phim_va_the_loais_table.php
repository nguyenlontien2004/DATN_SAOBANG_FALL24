<?php

use App\Models\Phim;
use App\Models\TheLoaiPhim;
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
        Schema::create('phim_va_the_loais', function (Blueprint $table) {
            $table->foreignIdFor(Phim::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(TheLoaiPhim::class)->constrained()->cascadeOnDelete();
            $table->primary(['phim_id', 'the_loai_phim_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phim_va_the_loais');
    }
};