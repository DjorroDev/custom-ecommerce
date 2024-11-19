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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('kelurahan', 100)->nullable();
            $table->string('kota', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('provinsi', 100)->nullable();
            $table->string('kodepos', 10)->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('full_address', 255);
            $table->string('phone_number_1', 20)->unique();
            $table->string('phone_number_2', 20)->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
