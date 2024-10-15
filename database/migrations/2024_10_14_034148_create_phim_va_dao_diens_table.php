<?php

use App\Models\DaoDien;
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
        Schema::create('phim_va_dao_diens', function (Blueprint $table) {
            $table->foreignIdFor(Phim::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(DaoDien::class)->constrained()->cascadeOnDelete();
            $table->primary(['phim_id', 'dao_dien_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phim_va_dao_diens');
    }
};