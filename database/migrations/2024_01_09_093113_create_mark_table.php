<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Mark', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('MarkNumber');
            $table->date('MarkDate');
            $table->foreignId('TaskId');
            $table->foreignId('StudentId');

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
        Schema::dropIfExists('Mark');
    }
}
