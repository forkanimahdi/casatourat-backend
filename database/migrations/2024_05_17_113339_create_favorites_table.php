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
        Schema::create('favorite_building', function (Blueprint $table) {
            $table->id();
            $table->foreignId("building_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("visitor_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('favorite_circuit', function (Blueprint $table) {
            $table->id();
            $table->foreignId("circuit_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("visitor_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
