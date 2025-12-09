<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
    Schema::create('cars', function (Blueprint $table) {
        $table->id();
        $table->string('brand');
        $table->string('model');
        $table->string('year')->nullable();
        $table->string('engine_size')->nullable();
        $table->integer('mileage')->nullable();
        $table->integer('price')->nullable();
        $table->string('url')->unique();
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
