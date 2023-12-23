<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Student', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name');
            $table->string('Surname');
            $table->string('Thirdname');
            $table->decimal('AvgMark', 5, 2);
            $table->bigInteger('ClassId')->unsigned();
            $table->integer('Grade');
            
            $table->timestamps();

            // Foreign key constraint for ClassId column
            // $table->foreign('ClassId')->references('id')->on('classes')->onDelete('CASCADE');
        });
        Schema::table('Student', function(Blueprint $table)
        {
            $table->foreign('ClassId')->references('id')->on('ClassTable')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Student');
    }
}
