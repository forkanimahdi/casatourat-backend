<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('circuit_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->longText('content')->default("")->nullable();
            $table->enum('status', ['good', 'bad', 'normal']);
            $table->boolean('mark_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
