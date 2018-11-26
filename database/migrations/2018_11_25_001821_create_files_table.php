<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('type')->default(0)->comment('类型id');
            $table->string('name')->comment('文件名');
            $table->string('url')->comment('具体文件地址');
            $table->string('file_size')->nullable()->comment('文件大小');
            $table->string('path')->comment('路径');
            $table->unsignedInteger('filetable_id')->comment('关联的模型id');
            $table->string('filetable_type')->comment('关联模型的名字');
            $table->unsignedInteger('pid')->nullable()->comment('关联附件表');
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
        Schema::dropIfExists('files');
    }
}
