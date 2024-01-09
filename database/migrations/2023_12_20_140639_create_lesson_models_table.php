<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson', function (Blueprint $table) {
            $table->id();
            $table->date('LessonDate');
            $table->integer('LessonNumber');
            $table->foreignId('classId');
            $table->foreignId('TeacherId');
            $table->foreign('classId')->references('id')->on('ClassTable');
            $table->foreign('TeacherId')->references('id')->on('teacher');
            $table->integer('classroom');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson');
    }
}
