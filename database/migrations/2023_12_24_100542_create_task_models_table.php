<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskModelsTable extends Migration
{   
    public function up()
    {
        Schema::create('Task', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lessonId');
            $table->foreignId('subjectId');
            $table->foreignId('classId');
            $table->dateTime('deadline');
            $table->string('TaskfilePath');
            $table->boolean('verified')->default(false);
            $table->boolean('downloaded')->default(false);
            
            
            $table->foreign('lessonId')->references('id')->on('lesson');
            $table->foreign('subjectId')->references('id')->on('Subject');
            $table->foreign('classId')->references('id')->on('ClassTable');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Task');
    }
}
