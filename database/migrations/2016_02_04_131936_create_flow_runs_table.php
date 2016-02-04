<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowRunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flow_run', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('自动编号');
            $table->unsignedBigInteger('pid')->commment('值大于0则这个是子流程，完成后或者要返回父流程');
            $table->unsignedBigInteger('flow_id')->commment('流程编号')->nullable(true);
            $table->unsignedBigInteger('run_flow_id')->commment('流转到什么流程')->default(0);
            $table->unsignedBigInteger('run_flow_process')->commment('流转到第几步')->default(0);
            $table->unsignedBigInteger('pid_flow_step')->commment('父pid的flow_id中的第几步骤进入的,取回这个work_flow_step的child_over决定结束子流程的动作')->default(0);
            $table->unsignedBigInteger('cache_run_id')->commment('父pid的flow_id中的第几步骤进入的,取回这个work_flow_step的child_over决定结束子流程的动作')->default(0);
            $table->unsignedTinyInteger('status')->comment('0未审核，1通过,2不通过')->default(0);
            $table->string('att_ids',255)->commment('流转到第几步')->default(0);
            $table->string('run_name',50)->comment('公文名称');
            $table->timestamps();
            $table->index('flow_id');
            $table->index('pid_flow_step');
            $table->index('cache_run_id');
            $table->foreign('flow_id')->references('id')->on('flow')
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
        Schema::drop('flow_run');
    }
}
