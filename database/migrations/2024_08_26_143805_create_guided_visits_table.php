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
        Schema::create('guided_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId("visitor_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('phone');
            $table->integer('number_of_people');
            $table->text('message')->nullable();
            $table->boolean('pending')->default(true);
            $table->boolean('approved')->default(false);
            $table->dateTime("date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guided_visits');
    }
};