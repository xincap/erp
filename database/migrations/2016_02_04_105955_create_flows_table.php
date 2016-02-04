<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flow', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('自动编号');
            $table->unsignedInteger('form_id')->comment('表单编号');
            $table->unsignedTinyInteger('flow_type')->comment('0固定,1自由');
            $table->string('flow_name',50)->comment('流程名称');
            $table->string('flow_desc',255)->comment('流程描述');
            $table->unsignedBigInteger('sort_order')->comment('排序')->default(0);
            $table->boolean('status')->comment('0不可用1正常')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flow');
    }
}
