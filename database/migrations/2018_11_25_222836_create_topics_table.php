<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('type_id')->comment('类型id');
            $table->string('title')->comment('消息标题');
            $table->text('content')->comment('消息内容');
            $table->unsignedInteger('level')->comment('排序等级');
            $table->unsignedInteger('user_id')->comment('发送人id');
            $table->unsignedInteger('class_id')->comment('班级id');
            $table->string('att_url')->nullable()->comment('关联附件地址');
            $table->string('att_name')->nullable()->comment('关联附件地址');
            $table->unsignedSmallInteger('can_reply')->comment('能否被回复');
            $table->unsignedSmallInteger('read_num')->default(0)->comment('阅读次数');
            $table->timestamps();
            $table->softDeletes()->comment('软删除');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
