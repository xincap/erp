<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowRunSignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flow_run_sign', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('自动编号');
            $table->unsignedBigInteger('user_id')->comment('用户编号');
            $table->unsignedBigInteger('run_id')->comment('用户编号');
            $table->unsignedBigInteger('run_flow')->comment('流程编号');
            $table->unsignedBigInteger('run_flow_process')->comment('步骤编号');
            $table->unsignedBigInteger('sign_att_id')->comment('审核意见')->default(false);
            $table->unsignedBigInteger('sign_look')->comment('步骤设置的会签可见性,0总是可见（默认）,1本步骤经办人之间不可见2针对其他步骤不可见');
            $table->boolean('is_agree')->comment('审核意见')->default(false);
            $table->text('content')->comment('会签内容');
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('run_id');
            $table->index('run_flow');
            $table->index('run_flow_process');
            
            $table->foreign('user_id')->references('id')->on('user')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('run_id')->references('id')->on('flow_run')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('run_flow')->references('id')->on('flow')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('run_flow_process')->references('id')->on('flow_process')
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
        Schema::drop('flow_run_sign');
    }
}
