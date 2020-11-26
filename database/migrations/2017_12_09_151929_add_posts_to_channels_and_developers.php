<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostsToChannelsAndDevelopers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('posts', function (Blueprint $table) {
        $table->integer('channel_id')->unsigned()->nullable();
        $table->foreign('channel_id')
          ->references('id')->on('channels')
          ->onDelete('cascade');
        $table->integer('developer_id')->unsigned();
        $table->foreign('developer_id')
        ->references('id')->on('developers')
          ->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('posts', function (Blueprint $table) {
        $table->dropForeign(['channel_id']);
        $table->dropColumn('channel_id');
        $table->dropForeign(['developer_id']);
        $table->dropColumn('developer_id');
      });
    }
}
