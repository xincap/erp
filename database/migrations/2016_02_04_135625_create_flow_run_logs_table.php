<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowRunLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flow_run_log', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('自动编号');
            $table->unsignedBigInteger('user_id')->comment('用户编号');
            $table->unsignedBigInteger('run_id')->comment('流转编号');
            $table->unsignedBigInteger('run_flow')->comment('流程ID,子流程时区分run step');
            $table->text('content')->comment('内容');
            $table->timestamps();
            $table->index('user_id');
            $table->index('run_id');
            
            $table->foreign('user_id')->references('id')->on('user')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('run_id')->references('id')->on('flow_run')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flow_run_log');
    }
}
