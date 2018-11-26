<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homeworks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacher_id')->unsigned()->comment('发布人id');
            $table->integer('class_id')->unsigned()->comment('发布到的班级');
            $table->string('title')->comment('作业标题');
            $table->text('content')->comment('作业内容');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('stop_time')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('homeworks');
    }
}
