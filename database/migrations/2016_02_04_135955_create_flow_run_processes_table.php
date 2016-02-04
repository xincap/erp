<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowRunProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flow_run_process', function (Blueprint $table) {
            
            $table->bigIncrements('id')->comment('自动编号');
            $table->unsignedBigInteger('user_id')->comment('用户编号');
            $table->unsignedBigInteger('run_id')->comment('当前流转编号');
            $table->unsignedBigInteger('run_flow')->comment('属于哪个流程');
            $table->unsignedBigInteger('run_flow_process')->comment('当前步骤');
            $table->unsignedBigInteger('parent_flow')->comment('上一步流程');
            $table->unsignedBigInteger('parent_flow_process')->comment('上一步骤');
            $table->unsignedBigInteger('run_child')->comment('开始转入子流程run_id 如果转入子流程，则在这里也记录');
            $table->unsignedTinyInteger('is_receive_type')->comment('是否先接收人为主办人')->default(0);
            $table->unsignedTinyInteger('is_sponsor')->comment('是否步骤主办人')->default(0);
            $table->unsignedTinyInteger('is_singpost')->comment('是否已会签过')->default(0);
            $table->unsignedTinyInteger('is_back')->comment('被退回的')->default(0);
            $table->unsignedTinyInteger('status')->comment('状态 0为未接收（默认），1为办理中 ,2为已转交,3为已结束4为已打回')->default(0);
            $table->text('remark')->comment('备注');
            $table->timestamp('js_time')->comment('接收时间');
            $table->timestamp('bl_time')->comment('接收时间');
            $table->timestamp('jj_time')->comment('转交时间,最后一步等同办结时间');
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('run_id');
            $table->index('run_flow');
            $table->index('run_flow_process');
            $table->index('parent_flow');
            $table->index('parent_flow_process');
            $table->index('run_child');
            $table->index('status');
            
            $table->foreign('user_id')->references('id')->on('user')
                ->onUpdate('cascade')->onDelete('cascade');
            
            $table->foreign('run_id')->references('id')->on('flow_run')
                ->onUpdate('cascade')->onDelete('cascade');
            
            $table->foreign('run_flow')->references('id')->on('flow')
                ->onUpdate('cascade')->onDelete('cascade');
            
            $table->foreign('run_flow_process')->references('id')->on('flow_process')
                ->onUpdate('cascade')->onDelete('cascade');
            
            $table->foreign('parent_flow')->references('id')->on('flow')
                ->onUpdate('cascade')->onDelete('cascade');
            
            $table->foreign('parent_flow_process')->references('id')->on('flow_process')
                ->onUpdate('cascade')->onDelete('cascade');
            
            $table->foreign('run_child')->references('id')->on('flow_run')
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
        Schema::drop('flow_run_process');
    }
}
