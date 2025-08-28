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
        Schema::create('quiz_results', function (Blueprint $table) {
            $table->id();
            $table->string('quiz_result');
            
            
            $table->foreignId('quiz_id')
            ->references('id')
            ->on('quizzes')
            ->cascadeOnDelete();
            

             $table->foreignId('student_id')
            ->references('id')
            ->on('users')
            ->cascadeOnDelete();

            

             $table->foreignId('course_id')
            ->references('id')
            ->on('courses')
            ->cascadeOnDelete();


            
            


            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_results');
    }
};
