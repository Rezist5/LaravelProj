<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolutionExamModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SolutionExam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ExamId');
            $table->foreignId('StudentId');
            $table->string('SolutionFilePath');
            $table->boolean('verified')->default(false);
            $table->boolean('downloaded')->default(false);
            
           
            $table->foreign('ExamId')->references('id')->on('Exam');
            $table->foreign('StudentId')->references('id')->on('Student');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SolutionExam');
    }
}
