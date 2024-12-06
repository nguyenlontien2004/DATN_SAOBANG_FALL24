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
        Schema::table('phims', function (Blueprint $table) {
            // Thêm cột the_loai_id
            $table->unsignedBigInteger('the_loai_id')->nullable();

            // Thêm khóa ngoại cho the_loai_id, liên kết với bảng the_loais
            $table->foreign('the_loai_id')
                ->references('id')
                ->on('the_loai_phims')
                ->onDelete('cascade'); // Tùy chọn, ví dụ: xóa phim khi thể loại bị xóa
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phims', function (Blueprint $table) {
            // Hủy bỏ khóa ngoại và cột the_loai_id
            $table->dropForeign(['the_loai_id']);
            $table->dropColumn('the_loai_id');
        });
    }
};
