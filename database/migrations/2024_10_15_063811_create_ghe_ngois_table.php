<?php

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
        Schema::create('ghe_ngois', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PhongChieu::class)->constrained()->cascadeOnDelete();
            $table->string('loai_ghe');
            $table->integer('so_hieu_ghe');
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ghe_ngois');
    }
};