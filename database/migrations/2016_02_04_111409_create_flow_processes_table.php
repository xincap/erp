<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flow_process', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('自动编号');
            $table->unsignedBigInteger('flow_id')->comment('流程编号');
            $table->unsignedBigInteger('process_to')->comment('下一步骤号');
            $table->unsignedBigInteger('child_id')->comment('is_child 子流程id有return_step_to结束后继续父流程下一步');
            $table->unsignedBigInteger('child_back_process')->comment('子流程结束返回的步骤id');
            $table->unsignedBigInteger('setleft')->comment('左 坐标');
            $table->unsignedBigInteger('settop')->comment('上 坐标');
            $table->unsignedTinyInteger('child_after')->comment('子流程 结束后动作 0结束并更新父流程节点为结束  1结束并返回父流程步骤')->default(0);
            $table->unsignedTinyInteger('auto_person')->comment('本步骤的自动选主办人规则')->default(0);
            $table->unsignedTinyInteger('auto_unlock')->comment('是否允许修改主办人')->default(0);
            $table->unsignedTinyInteger('receive_type')->comment('0明确指定主办人1先接收者为主办人')->default(0);
            $table->unsignedTinyInteger('is_user_end')->comment('允许主办人在非最后步骤也可以办结流程')->default(0);
            $table->unsignedTinyInteger('is_userop_pass')->comment('经办人可以转交下一步')->default(0);
            $table->unsignedTinyInteger('is_sing')->comment('0禁止会签1允许会签（默认） 2强制会签')->default(0);
            $table->unsignedTinyInteger('sign_look')->comment('会签可见性0总是可见（默认）,1本步骤经办人之间不可见2针对其他步骤不可见')->default(0);
            $table->unsignedTinyInteger('is_back')->comment('是否允许回退0不允许（默认） 1允许退回上一步2允许退回之前步骤')->default(0);
            $table->string('process_name',30)->comment('步骤名称');
            $table->string('process_type',20)->comment('步骤类型');
            $table->string('auto_sponsor_ids',255)->comment('指定步骤主办人ids');
            $table->string('auto_sponsor_text',255)->comment('指定步骤主办人text');
            $table->string('auto_respon_ids',255)->comment('指定步骤主办人ids');
            $table->string('auto_respon_text',255)->comment('指定步骤主办人text');
            $table->string('auto_role_ids',255)->comment('指定步骤主办人ids');
            $table->string('auto_role_text',255)->comment('指定步骤主办人text');
            $table->text('child_relation')->comment('父子流程字段映射关系');
            $table->text('return_sponsor_ids')->comment('[保留功能]主办人 子流程结束后下一步的主办人');
            $table->text('return_respon_ids')->comment('[保留功能]经办人 子流程结束后下一步的经办人');
            $table->text('write_fields')->comment('可写的字段');
            $table->text('secret_fields')->comment('隐藏的字段');
            $table->text('lock_fields')->comment('锁定不能更改宏控件的值');
            $table->text('check_fields')->comment('字段验证规则');
            $table->text('range_user_ids')->comment('经办人授权范围ids');
            $table->text('range_user_text')->comment('经办人授权范围text');
            $table->text('range_dept_ids')->comment('经办部门授权范围ids');
            $table->text('range_dept_text')->comment('经办部门授权范围text');
            $table->text('range_role_ids')->comment('经办角色授权范围ids');
            $table->text('range_role_text')->comment('经办角色授权范围text');
            $table->text('out_condition')->comment('转出条件');
            $table->text('style')->comment('样式');
            $table->timestamps();
            $table->index('flow_id');
            $table->index('process_to');
            $table->index('child_id');
            $table->index('child_back_process');
            
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
        Schema::drop('flow_process');
    }
}
