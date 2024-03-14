<?php

use App\Constants\AssessmentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('title', 64)->default('Asesmen Tanpa Judul');
            $table->string('status', 11)->default(AssessmentStatus::INACTIVE);
            $table->text('description')->nullable();
            $table->string('cover')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
