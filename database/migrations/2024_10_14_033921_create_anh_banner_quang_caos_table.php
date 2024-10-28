<?php

use App\Models\BannerQuangCao;
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
        Schema::create('anh_banner_quang_caos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(BannerQuangCao::class)->constrained()->cascadeOnDelete();
            $table->string('hinh_anh');
            $table->integer('thu_tu')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anh_banner_quang_caos');
    }
};
