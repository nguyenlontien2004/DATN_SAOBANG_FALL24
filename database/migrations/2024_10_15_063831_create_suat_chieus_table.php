<?php

use App\Models\Phim;
use App\Models\PhongChieu;
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
        Schema::create('suat_chieus', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PhongChieu::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Phim::class)->constrained()->cascadeOnDelete();
            $table->timestamp('gio_bat_dau');
            $table->timestamp('gio_ket_thuc');
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suat_chieus');
    }
};
