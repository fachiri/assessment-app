<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->text('question');
            $table->string('type', 32);
            $table->unsignedTinyInteger('required');
            $table->foreignId('assessment_id')->constrained('assessments')->onDelete('cascade');;
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
