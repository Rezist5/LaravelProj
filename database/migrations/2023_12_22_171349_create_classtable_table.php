<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ClassTable', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigInteger('id')->unsigned();
            $table->string('ClassName', 50);
            $table->string('grade', 10);
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
        Schema::dropIfExists('ClassTable');
    }
}
