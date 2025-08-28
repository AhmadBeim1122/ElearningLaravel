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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name');
            $table->text('course_desc');
            $table->string('course_author');
            $table->string('course_img');
            $table->string('course_duration');
            $table->string('course_level');
            $table->string('course_language');


            // $table->integer('course_price')->nullable();
            // $table->integer('course_org_price')->nullable();

            $table->unsignedBigInteger('course_category');
            $table->foreign('course_category')
            ->references('id')
            ->on('categorys')
            ->onDelete('cascade');
            
            $table->foreignId('Ins_id')
            ->references('id')
            ->on('users')
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
