<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamMarkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ExamMark', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('MarkNumber');
            $table->date('MarkDate');
            $table->unsignedInteger('MaxMarkNumber')->default(10);
            $table->foreignId('ExamId');
            $table->foreignId('StudentId');

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
        Schema::dropIfExists('ExamMark');
    }
}
