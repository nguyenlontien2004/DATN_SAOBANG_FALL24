<?php

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
        Schema::create('anh_phims', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Phim::class)->constrained()->cascadeOnDelete();
            $table->string('hinh_anh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anh_phims');
    }
};