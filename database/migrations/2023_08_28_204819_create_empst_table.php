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
        Schema::create('empst', function (Blueprint $table) {
            $table->integer('HID');
            $table->integer('DID');
            $table->integer('PID');
            $table->integer('KOSU')->nullable();
            $table->string('HNM')->nullable();
            $table->primary(['HID', 'DID', 'PID']); // 複合主キーの設定
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empst');
    }
};
