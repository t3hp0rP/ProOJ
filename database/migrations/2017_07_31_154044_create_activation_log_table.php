<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivationLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activationLog', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('uid')->unique();
            $table->string('email')->unique();
            $table->string('activeCode');
            $table->boolean('isActive')->default(False);
            $table->timestamp('activeTime')->nullable();
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
        Schema::dropIfExists('activationLog');
    }
}
