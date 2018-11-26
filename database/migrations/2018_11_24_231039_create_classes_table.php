<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('avatar')->default('/storage/upload/class/default.png')->comment('班级名字');
            $table->integer('type_id')->comment('类型');
            $table->string('name')->comment('班级名字');
            $table->unsignedBigInteger('user_id')->comment('头目or创建者id');
            $table->unsignedInteger('numbers')->comment('数量');
            $table->unsignedSmallInteger('verification')->comment('是否需要验证');
            $table->string('password')->nullable()->comment('加入班级密码');
            $table->unsignedInteger('user_allow')->nullable()->comment('审核人');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
