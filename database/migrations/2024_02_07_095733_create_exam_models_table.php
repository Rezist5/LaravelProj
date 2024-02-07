<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Exam', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('subjectId');
            $table->foreignId('classId');
            $table->integer('duration');
            $table->string('ExamfilePath');
            $table->boolean('verified')->default(false);
            $table->boolean('opened')->default(true);
            $table->boolean('downloaded')->default(false);
            
            
            $table->foreign('subjectId')->references('id')->on('Subject');
            $table->foreign('classId')->references('id')->on('ClassTable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_models');
    }
}
