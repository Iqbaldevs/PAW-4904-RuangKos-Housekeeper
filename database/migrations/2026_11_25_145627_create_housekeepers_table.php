<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('housekeepers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_staff');
            $table->string('tugas');
            $table->string('area');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('housekeepers');
    }
};