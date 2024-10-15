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
        Schema::create('xem_thong_tin_phims', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(NguoiDung::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Phim::class)->constrained()->cascadeOnDelete();
            $table->integer('so_lan_xem');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xem_thong_tin_phims');
    }
};