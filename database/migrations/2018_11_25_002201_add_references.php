<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_users', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('classes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['user_id','class_id']);
        });

        Schema::table('homeworks', function (Blueprint $table) {
            $table->foreign('teacher_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('classes')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('stu_homeworks', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('homework_id')->references('id')->on('homeworks')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['user_id','homework_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_users', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['class_id']);
        });

        Schema::table('homeworks', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->dropForeign(['class_id']);
        });

        Schema::table('stu_homeworks', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['homework_id']);
        });
    }
}
