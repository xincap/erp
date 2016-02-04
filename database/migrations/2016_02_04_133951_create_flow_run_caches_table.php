<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowRunCachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flow_run_cache', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('自动编号');
            $table->unsignedBigInteger('run_id')->comment('缓存run工作的全部流程模板步骤等信息');
            $table->unsignedBigInteger('form_id')->comment('表单编号')->nullable(true);
            $table->unsignedBigInteger('flow_id')->comment('工作流编号')->nullable(true);
            $table->text('run_form')->commnet('模板信息');
            $table->text('run_flow')->commnet('流程信息');
            $table->text('run_flow_process')->commnet('流程步骤信息');
            $table->timestamps();
            $table->index('run_id');
            $table->index('flow_id');
            
            $table->foreign('flow_id')->references('id')->on('flow')
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
        Schema::drop('flow_run_cache');
    }
}
