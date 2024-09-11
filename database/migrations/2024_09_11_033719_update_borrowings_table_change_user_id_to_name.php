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
        Schema::table('borrowing', function (Blueprint $table) {
            // Hapus foreign key
        $table->dropForeign(['user_id']); // Hapus foreign key untuk user_id

        // Hapus kolom user_id
        $table->dropColumn('user_id');

        // Tambahkan kolom name
        $table->string('name')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrowing', function (Blueprint $table) {
            // Tambahkan kembali kolom user_id
        $table->unsignedBigInteger('user_id');

        // Tambahkan foreign key kembali
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        // Hapus kolom name
        $table->dropColumn('name');
        });
    }
};
