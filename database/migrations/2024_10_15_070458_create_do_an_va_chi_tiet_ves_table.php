<?php

use App\Models\ChiTietVe;
use App\Models\DoAn;
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
        Schema::create('do_an_va_chi_tiet_ves', function (Blueprint $table) {
            $table->foreignIdFor(DoAn::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Ve::class)->constrained()->cascadeOnDelete();
            $table->integer('so_luong_do_an');
            $table->primary(['do_an_id', 'chi_tiet_ve_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('do_an_va_chi_tiet_ves');
    }
};