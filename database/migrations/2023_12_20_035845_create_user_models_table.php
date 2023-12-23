<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100);
            $table->string('password', 100);
            $table->string('UserType', 100);
            $table->unsignedBigInteger('UserId')->nullable();
            $table->timestamps();
            
            // Foreign key constraint if UserId references another table
            // $table->foreign('UserId')->references('id')->on('related_table_name')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}

