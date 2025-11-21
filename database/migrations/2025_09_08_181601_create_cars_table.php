<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
    Schema::create('cars', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('year')->nullable();
        $table->string('engine_size')->nullable();
        $table->string('mileage')->nullable();
        $table->string('price')->nullable();
        $table->string('url')->unique();
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
