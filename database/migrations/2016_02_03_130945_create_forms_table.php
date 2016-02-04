<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('自动编号');
            $table->string('form_name',50)->comment('表单名称');
            $table->string('form_desc',50)->comment('表单描述');
            $table->text('content')->comment('未处理表单内容');
            $table->text('content_parse')->comment('已表单内容');
            $table->text('content_data')->comment('表单中字段数据');
            $table->unsignedTinyInteger('fields')->comment('字段总数');
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
        Schema::drop('form');
    }
}
