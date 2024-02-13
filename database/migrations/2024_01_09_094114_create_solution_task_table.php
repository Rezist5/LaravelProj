<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolutionTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SolutionTask', function (Blueprint $table) {
            $table->id();
            $table->foreignId('TaskId');
            $table->foreignId('StudentId');
            $table->string('SolutionFilePath');
            $table->boolean('verified')->default(false);
            $table->boolean('downloaded')->default(false);
            
           
            $table->foreign('TaskId')->references('id')->on('Task');
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
        Schema::dropIfExists('SolutionTask');
    }
}
