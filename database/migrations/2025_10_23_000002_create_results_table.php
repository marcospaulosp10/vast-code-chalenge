<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('passage_id')->constrained()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->decimal('wpm', 6, 2);
            $table->decimal('accuracy', 5, 2);
            $table->unsignedInteger('duration_ms');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
