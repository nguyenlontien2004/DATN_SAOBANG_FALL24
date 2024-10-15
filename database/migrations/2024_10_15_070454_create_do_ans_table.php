<?php

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
        Schema::create('do_ans', function (Blueprint $table) {
            $table->id();
            $table->string('ten_do_an');
            $table->integer('gia');
            $table->string('hinh_anh')->nullable();
            $table->text('mo_ta')->nullable();
            $table->integer('luot_mua')->default(0);
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('do_ans');
    }
};