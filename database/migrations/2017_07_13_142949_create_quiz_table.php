<?php
/**
 * Created by PhpStorm.
 * User: Pr0ph3t
 * Date: 2017/7/13
 * Time: 22:11
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz', function(Blueprint $table){
            $table->increments('id');
            $table->integer('type'); //0 for web, 1 for pwn, 2 for re, 3 for misc, 4 for crypto
            $table->string('title');
            $table->string('content');
            $table->string('addr');
            $table->string('value');
//            $table->integer('first_blood')->nullable();//MariaDB外键有毒
//            $table->integer('second_blood')->nullable();
//            $table->integer('third_blood')->nullable();//想了想还是觉得根据时间获取比较好。。。避免各种并发问题
            $table->string('flag');
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
        Schema::dropIfExists('quiz');
    }
}
