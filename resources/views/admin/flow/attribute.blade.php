<!DOCTYPE HTML>
<html>
    <head>
        <title>流程设计器 Flowdesign.leipi.org</title>
        <meta name="keyword" content="流程设计器,Web Flowdesign,Flowdesigner,专业流程设计器,WEB流程设计器">
        <meta name="description" content="国内最容易使用和开发的流程设计器，你可以在此基础上任意修改使功能无限强大！">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="author" content="leipi.org">
    </head>
    <body>
        <ul class="nav nav-tabs" id="attributeTab">
            @if ($op == 'basic')
            <li class="active" ><a href="#attrBasic">常规</a></li>
            @else
            <li><a href="#attrBasic">常规</a></li>
            @endif
            @if ($op == 'form')
            <li class="active" ><a href="#attrForm">表单</a></li>
            @else
            <li><a href="#attrForm">表单</a></li>
            @endif

            <li><a href="#attrPower">权限</a></li>
            <li><a href="#attrOperate">操作</a></li>
            @if ($op == 'judge')
            <li class="active" id="tab_attrJudge"><a href="#attrJudge">转出条件</a></li>
            @else
            <li id="tab_attrJudge"><a href="#attrJudge">转出条件</a></li>
            @endif
            @if ($op == 'style')
            <li class="active"><a href="#attrStyle">样式</a></li>
            @else
            <li><a href="#attrStyle">样式</a></li>
            @endif
        </ul>

        <form class="form-horizontal" target="hiddeniframe" method="post" id="flow_attribute" name="flow_attribute" action="/admin/flow/save_attribute">
            <input type="hidden" name="flow_id" value="{{$one['flow_id']}}"/>
            <input type="hidden" name="process_id" value="{{$one['id']}}"/>
            <div class="tab-content">
                @if($op == 'basic')
                <div class="tab-pane active" id="attrBasic">
                @else
                <div class="tab-pane" id="attrBasic">
                @endif

                    <div class="control-group">
                        <label class="control-label" for="process_name">步骤名称</label>
                        <div class="controls">
                            <input type="text" id="process_name" placeholder="步骤名称" name="process_name" value="{{$one['process_name']}}">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">步骤类型</label>
                        <div class="controls">
                            <label class="radio inline">
                                @if($one['process_type'] == 'is_step')
                                <input type="radio" name="process_type" value="is_step" checked="checked">正常步骤
                                @else
                                <input type="radio" name="process_type" value="is_step">正常步骤
                                @endif
                            </label>
                            <label class="radio inline">
                                @if($one['process_type'] == 'is_child')
                                <input type="radio" name="process_type" value="is_child" checked="checked">转入子流程
                                @else
                                <input type="radio" name="process_type" value="is_child">转入子流程
                                @endif
                            </label>
                            <label class="radio inline">
                                @if($one['process_type'] == 'is_one')
                                <input type="radio" name="process_type" value="is_one" checked="checked">设为第一步
                                @else
                                <input type="radio" name="process_type" value="is_one">转入子流程
                                @endif
                            </label>

                        </div>
                    </div>
                    <hr/>

                    <div id="current_flow">
                        <div class="offset1">
                            <!--未按顺序的bug 2012-12-12-->
                            <select multiple="multiple" size="6" name="process_to[]" id="process_multiple" >
                                @foreach($process_to_list as $vo)
                                    @if($one['id'] != $vo->id)
                                        @if($vo->id == $one['process_to']))
                                            <option value="{{$vo->id}}" selected="selected">{{$vo->process_name}}</option>
                                        @else
                                        <option value="{{$vo->id}}">{{$vo->process_name}}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div><!-- current_flow end -->

                    <div id="child_flow" class="hide">
                        <div class="control-group">
                            <label class="control-label" >子流程</label>
                            <div class="controls">
                                <select name="child_id" >
                                    <option value="0">--请选择--</option>
                                    @foreach($child_flow_list as $vo)
                                        @if($vo->id == $one['child_id'])
                                            <option value="{{$vo->id}}" selected="selected">{{$vo->flow_name}}</option>
                                        @else
                                            <option value="{{$vo->id}}">{{$vo->flow_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" >子流程结束后动作</label>
                            <div class="controls">
                                <label class="radio inline">
                                    @if($one['child_after'] == 1)
                                        <input type="radio" name="child_after" value="1" checked="checked">
                                    @else
                                        <input type="radio" name="child_after" value="1" >
                                    @endif
                                    
                                    同时结束父流程
                                </label>
                                <label class="radio inline">
                                    @if($one['child_after'] == 2)
                                        <input type="radio" name="child_after" value="2" checked="checked">
                                    @else
                                        <input type="radio" name="child_after" value="2">
                                    @endif
                                    返回父流程步骤
                                </label>
                            </div>
                        </div>

                        <div class="control-group hide" id="child_back_id">
                            <label class="control-label" >返回步骤</label>
                            <div class="controls">
                                <select name="child_back_process" >
                                    <option value="0">--默认--</option>
                                    @foreach($process_to_list as $key => $vo)
                                        @if($vo->id == $one['child_back_process'])
                                            <option value="{{$vo->id}}" selected="selected">{{$vo->process_name}}</option>
                                        @else
                                            <option value="{{$vo->id}}">{{$vo->process_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="help-inline">默认为当前步骤下一步</span>
                            </div>
                        </div>

                    </div><!-- child_flow end -->



                </div><!-- attrBasic end -->

                @if($op == 'form')
                <div class="tab-pane active" id="attrForm">
                @else
                <div class="tab-pane" id="attrForm">
                @endif

                    <table class="table table-condensed table-bordered table-hover" >
                        <tr>
                            <th style="text-align:center">字段名称</th>
                            <th style="text-align:center">控件类型</th>
                            <!--
                              预留功能：
                              1.是否必填
                              2.锁定内容不能修改
                            -->
                            <th style="width:100px;"><label title="本步骤可写字段"  class="checkbox"><input type="checkbox" id="write">可写字段</label></th>
                            <th style="width:100px;"><label title="保密字段对于本步骤主办人、经办人均为不可见"  class="checkbox"><input type="checkbox" id="secret">保密字段</label></th>
                        </tr>
                        <tbody>
                            <!-- 这里是表单设计器的字段 start -->
                         @foreach($form_one['content_data'] as $key =>$vo)
                         
                            @if($vo['leipiplugins'] == 'checkboxs')
                                <tr>
                                    <th>{{$vo['title']}}</th>
                                    <td>{{$form_plugin[$vo['leipiplugins']]}}</td>
                                    @if(in_array($vo['parse_name'], $one['write_fields']))
                                        <td><label class="checkbox"><input type="checkbox" name="write_fields[]" checked="checked" value="{{$vo['parse_name']}}" key="{{$key}}" id="write_{{$key}}"></label></td>
                                    @else
                                        <td><label class="checkbox"><input type="checkbox" name="write_fields[]" value="{{$vo['parse_name']}}" key="{{$key}}" id="write_{{$key}}"></label></td>
                                    @endif
                                    @if(in_array($vo['parse_name'],$one['secret_fields']))
                                        <td><label class="checkbox"><input type="checkbox" name="secret_fields[]" checked="checked" value="{{$vo['parse_name']}}" key="{{$key}}" id="secret_{{$key}}"></label></td>
                                    @else
                                        <td><label class="checkbox"><input type="checkbox" name="secret_fields[]" value="{{$vo['parse_name']}}" key="{{$key}}" id="secret_{{$key}}"></label></td>
                                    @endif
                                </tr>
                            @else
                                 <tr>
                                    <th>{{$vo['title']}}</th>
                                    <td>{{$form_plugin[$vo['leipiplugins']]}}</td>
                                    @if(in_array($vo['name'],$one['write_fields']))
                                        <td><label class="checkbox"><input type="checkbox" name="write_fields[]" checked="checked" value="{{$vo['name']}}" key="{{$key}}" id="write_{{$key}}"></label></td>
                                    @else
                                        <td><label class="checkbox"><input type="checkbox" name="write_fields[]" value="{{$vo['name']}}" key="{{$key}}" id="write_{{$key}}"></label></td>
                                    @endif
                                    @if(in_array($vo['name'],$one['secret_fields']))
                                        <td><label class="checkbox"><input type="checkbox" name="secret_fields[]" checked="checked" value="{{$vo['name']}}" key="{{$key}}" id="secret_{{$key}}"></label></td>
                                    @else
                                        <td><label class="checkbox"><input type="checkbox" name="secret_fields[]" value="{{$vo['name']}}" key="{{$key}}" id="secret_{{$key}}"></label></td>
                                    @endif
                                </tr>
                            @endif
                         @endforeach
                         <!-- 这里是表单设计器的字段 end -->
                        </tbody>
                    </table>
                </div><!-- attrForm end -->

                <div class="tab-pane" id="attrPower">

                    <div class="control-group">
                        <label class="control-label" >自动选人</label>
                        <div class="controls">
                            <select name="auto_person" id="auto_person_id">
                                <option value="0">不自动选人</option>
                                <option value="1" @if($one['auto_person'] == 1) selected="selected" @endif>发起人</option>
                                <option value="2" @if($one['auto_person'] == 2) selected="selected" @endif>发起人的部门主管</option>
                                <option value="3" @if($one['auto_person'] == 3) selected="selected" @endif>处理人的部门主管</option>
                                <option value="5" @if($one['auto_person'] == 5) selected="selected" @endif>指定角色</option>
                                <option value="4" @if($one['auto_person'] == 4) selected="selected" @endif>指定人员</option>
                            </select>
                            <span class="help-inline">预先设置自动选人，更方便转交工作</span>
                        </div>
                        <div class="controls @if($one['auto_person'] == 0) hide @endif" id="auto_unlock_id" >
                            <label class="checkbox">
                                <input type="checkbox" name="auto_unlock" value="1" @if($one['auto_unlock'] == 1) checked="checked" @endif>允许更改
                            </label>
                        </div>

                        <div id="auto_person_4" @if($one['auto_person'] != 4) class="hide" @endif>
                            <div class="control-group">
                                <label class="control-label">指定主办人</label>
                                <div class="controls">
                                    <input type="hidden" name="auto_sponsor_ids" id="auto_sponsor_ids" value="{{$one['auto_sponsor_ids']}}">
                                    <input class="input-xlarge" readonly="readonly" type="text" placeholder="指定主办人" name="auto_sponsor_text" id="auto_user_text" value="{{$one['auto_sponsor_text']}}"> <a href="javascript:void(0);" class="btn" onclick="superDialog(\'/demo/super_dialog/op/user\', \'auto_user_text\', \'auto_sponsor_ids\');">选择</a>
                                </div> 
                            </div>
                            <div class="control-group">
                                <label class="control-label">指定经办人</label>
                                <div class="controls">
                                    <input type="hidden" name="auto_respon_ids" id="auto_respon_ids" value="{{$one['auto_respon_ids']}}">
                                    <input class="input-xlarge" readonly="readonly" type="text" placeholder="指定经办人" name="auto_respon_text" id="auto_userop_text" value="{{$one['auto_respon_text']}}"> <a href="javascript:void(0);" class="btn" onclick="superDialog(\'/demo/super_dialog/op/user\', \'auto_userop_text\', \'auto_respon_ids\');">选择</a>
                                </div> 
                            </div>
                        </div>
                        <div id="auto_person_5" @if($one['auto_person'] != 5) class="hide" @endif>
                            <div class="control-group">
                                <label class="control-label">指定角色</label>
                                <div class="controls">
                                    <input type="hidden" name="auto_role_ids" id="auto_role_value" value="{{$one['auto_role_ids']}}">
                                    <input class="input-xlarge" readonly="readonly" type="text" placeholder="指定角色" name="auto_role_text" id="auto_role_text" value="{{$one['auto_role_text']}}"> <a href="javascript:void(0);" class="btn" onclick="superDialog(\'/demo/super_dialog/op/role\', \'auto_role_text\', \'auto_role_value\');">选择</a>
                                </div> 
                            </div>
                        </div>

                    </div>
                    <hr/>
                    <h4>授权范围</h4>
                    <div class="control-group">
                        <label class="control-label">授权人员</label>
                        <div class="controls">
                            <input type="hidden" name="range_user_ids" id="range_user_ids" value="{{$one['range_user_ids']}}">
                            <input class="input-xlarge" readonly="readonly" type="text" placeholder="选择人员" name="range_user_text" id="range_user_text" value="{{$one['range_user_text']}}"> <a href="javascript:void(0);" class="btn" onclick="superDialog(\'/demo/super_dialog/op/user\', \'range_user_text\', \'range_user_ids\');">选择</a>
                        </div> 
                    </div>

                    <div class="control-group">
                        <label class="control-label">授权部门</label>
                        <div class="controls">
                            <input type="hidden" name="range_dept_ids" id="range_dept_ids" value="{{$one['range_dept_ids']}}">
                            <input class="input-xlarge" readonly="readonly" type="text" placeholder="选择部门" name="range_dept_text" id="range_dept_text" value="{{$one['range_dept_text']}}"> <a href="javascript:void(0);" class="btn" onclick="superDialog(\'/demo/super_dialog/op/dept\', \'range_dept_text\', \'range_dept_ids\');">选择</a>
                        </div> 
                    </div>

                    <div class="control-group">
                        <label class="control-label">授权角色</label>
                        <div class="controls">
                            <input type="hidden" name="range_role_ids" id="range_role_ids" value="{{$one['range_role_ids']}}">
                            <input class="input-xlarge" readonly="readonly" type="text" placeholder="选择角色" name="range_role_text" id="range_role_text" value="{{$one['range_role_text']}}"> <a href="javascript:void(0);" class="btn" onclick="superDialog(\'/demo/super_dialog/op/role\', \'range_role_text\', \'range_role_ids\');">选择</a>
                        </div> 
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <span class="help-block">当需要手动选人时，则授权范围生效</span>
                        </div> 
                    </div>

                </div><!-- attrPower end -->


                <div class="tab-pane" id="attrOperate">

                    <div class="control-group">
                        <label class="control-label" >交接方式</label>
                        <div class="controls">
                            <select name="receive_type" >
                                <option value="0" @if($one['receive_type'] == 0) selected="selected" @endif>明确指定主办人</option>
                                <option value="1" @if($one['receive_type'] == 1) selected="selected" @endif>先接收为主办人</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <label class="checkbox">
                                <input type="checkbox" name="is_user_end" value="1" @if($one['is_user_end'] == 1)checked="checked" @endif>允许主办人办结流程(最后步骤默认允许)
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="is_userop_pass" value="1" @if($one['is_userop_pass'] == 0)checked="checked" @endif>经办人可以转交下一步
                            </label>
                        </div>
                    </div>
                    <hr/>

                    <div class="control-group">
                        <label class="control-label" >会签方式</label>
                        <div class="controls">
                            <select name="is_sing" >
                                <option value="1" @if($one['is_sing'] == 1) selected="selected" @endif>允许会签</option>
                                <option value="2" @if($one['is_sing'] == 2) selected="selected" @endif>禁止会签</option>
                                <option value="3" @if($one['is_sing'] == 3) selected="selected" @endif>强制会签</option>
                            </select>
                            <span class="help-inline">如果设置强制会签，则本步骤全部人都会签后才能转交或办结</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" >可见性</label>
                        <div class="controls">
                            <select name="sign_look" >
                                <option value="1" @if($one['sign_look'] == 1) selected="selected" @endif>总是可见</option>
                                <option value="2" @if($one['sign_look'] == 2) selected="selected" @endif>本步骤之间经办人不可见</option>
                                <option value="3" @if($one['sign_look'] == 3) selected="selected" @endif>其它步骤不可见</option>
                            </select>
                        </div>
                    </div>
                    <hr/>
                    <div class="control-group">
                        <label class="control-label" >回退方式</label>
                        <div class="controls">
                            <select name="is_back" >
                                <option value="1" @if($one['is_back'] == 1) selected="selected" @endif>不允许</option>
                                <option value="2" @if($one['is_back'] == 2) selected="selected" @endif>允许回退上一步</option>
                                <option value="3" @if($one['is_back'] == 3) selected="selected" @endif>允许回退之前步骤</option>
                            </select>
                        </div>
                    </div>
                </div>


                @if($op == 'judge')
                <div class="tab-pane active" id="attrJudge">
                @else
                <div class="tab-pane" id="attrJudge">
                @endif


                    <table class="table" >
                        <thead>
                            <tr>
                                <th style="width:100px;">转出步骤</th>
                                <th>转出条件设置</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!--模板-->
                            <tr id="tpl" class="hide">    
                                <td style="width: 100px;">\@text</td>
                                <td>
                                    <table class="table table-condensed">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select id="field_\@a" class="input-medium">
                                                        <option value="">选择字段</option>
                                                        <!-- 表单字段 start -->
                                                        @foreach($form_one['content_data'] as $vo)
                                                            @if($vo['leipiplugins'] == 'checkboxs')
                                                                <option value="{{$vo['parse_name']}}">{{$vo['title']}}</option>
                                                            @else
                                                                <option value="{{$vo['name']}}">{{$vo['title']}}</option>
                                                            @endif
                                                        @endforeach
                                                        <!-- 表单字段 end -->  
                                                    </select>
                                                    <select id="condition_\@a" class="input-small">
                                                        <option value="=">等于</option>
                                                        <option value="&lt;&gt;">不等于</option>
                                                        <option value="&gt;">大于</option>
                                                        <option value="&lt;">小于</option>
                                                        <option value="&gt;=">大于等于</option>
                                                        <option value="&lt;=">小于等于</option>
                                                        <option value="include">包含</option>
                                                        <option value="exclude">不包含</option>
                                                    </select>
                                                    <input type="text" id="item_value_\@a" class="input-small">
                                                    <select id="relation_\@a" class="input-small">
                                                        <option value="AND">与</option>
                                                        <option value="OR">或者</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-small" onclick="fnAddLeftParenthesis("#a")">（</button>
                                                        <button type="button" class="btn btn-small" onclick="fnAddRightParenthesis("#a")">）</button>
                                                        <button type="button" onclick="fnAddConditions("#a")" class="btn btn-small">新增</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select id="conList_\@a" multiple="" style="width: 100%;height: 80px;"></select>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" onclick="fnDelCon("#a")" class="btn btn-small">删行</button>
                                                        <button type="button" onclick="fnClearCon("#a")" class="btn btn-small">清空</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input id="process_in_desc_#a" type="text" name="process_in_desc_#a" style="width:98%;">
                                                    <input name="process_in_set_#a" id="process_in_set_#a" type="hidden">
                                                </td>
                                                <td>
                                                    <span class="xc1">不符合条件时的提示</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>


                        </tbody>
                        <tbody id="ctbody">

                        </tbody>
                    </table>
                    <input type="hidden" name="process_condition" id="process_condition">


                </div><!-- attrJudge end -->
                @if($op == 'style')
                <div class="tab-pane style " id="attrStyle">
                @else
                <div class="tab-pane" id="attrStyle">
                @endif

                    <div class="control-group">
                        <label class="control-label" for="process_name">尺寸</label>
                        <div class="controls">
                            <input type="text" class="input-small" name="style[width]" id="style_width" placeholder="宽度PX" value="{{$one['style']['width']}}"> X <input type="text" class="input-small" name="style[height]" id="style_height" placeholder="高度PX"  value="{{$one['style']['height']}}">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="process_name">字体颜色</label>
                        <div class="controls">
                            <input type="text" class="input-small" name="style[color]" id="style_color" placeholder="#000000" value="{{$one['style']['color']}}">
                            <div class="colors" org-bind="style_color">
                                <ul>
                                    <li class="Black active" org-data="#000" title="Black">1</li>
                                    <li class="red" org-data="#d54e21" title="Red">2</li>
                                    <li class="green" org-data="#78a300" title="Green">3</li>
                                    <li class="blue" org-data="#0e76a8" title="Blue">4</li>
                                    <li class="aero" org-data="#9cc2cb" title="Aero">5</li>
                                    <li class="grey" org-data="#73716e" title="Grey">6</li>
                                    <li class="orange" org-data="#f70" title="Orange">7</li>
                                    <li class="yellow" org-data="#fc0" title="Yellow">8</li>
                                    <li class="pink" org-data="#ff66b5" title="Pink">9</li>
                                    <li class="purple" org-data="#6a5a8c" title="Purple">10</li>
                                </ul>
                            </div>

                        </div>
                    </div>



                    <div class="control-group">
                        <label class="control-label" for="process_name"><span class="process-flag badge badge-inverse"><i class="icon-star-empty icon-white" id="style_icon_preview"></i></span> 图标</label>
                        <div class="controls">
                            <input type="text" class="input-medium" name="style[icon]" id="style_icon" placeholder="icon" value="{{$one['style']['icon']}}">
                            <div class="colors" org-bind="style_icon">
                                <ul>
                                    <li class="Black active" org-data="icon-star-empty" title="Black"><i class="icon-star-empty icon-white"></i></li>
                                    <li class="red" org-data="icon-ok" title="Red"><i class="icon-ok icon-white"></i></li>
                                    <li class="green" org-data="icon-remove" title="Green"><i class="icon-remove icon-white"></i></li>
                                    <li class="blue" org-data="icon-refresh" title="Blue"><i class="icon-refresh icon-white"></i></li>
                                    <li class="aero" org-data="icon-plane" title="Aero"><i class="icon-plane icon-white"></i></li>
                                    <li class="grey" org-data="icon-play" title="Grey"><i class="icon-play icon-white"></i></li>
                                    <li class="orange" org-data="icon-heart" title="Orange"><i class="icon-heart icon-white"></i></li>
                                    <li class="yellow" org-data="icon-random" title="Yellow"><i class="icon-random icon-white"></i></li>
                                    <li class="pink" org-data="icon-home" title="Pink"><i class="icon-home icon-white"></i></li>
                                    <li class="purple" org-data="icon-lock" title="Purple"><i class="icon-lock icon-white"></i></li>
                                </ul>
                                <a href="http://v2.bootcss.com/base-css.html#icons" target="_blank">更多</a>
                            </div>
                        </div>
                    </div>

                    <!-- 不太完善，隐藏
                     <div class="control-group">
                      <label class="control-label">CSS3 图形</label>
                      <div class="controls">
                        <select name="style_graph" id="style_graph">
                          <option value="">矩形</option>
                          <option value="circle">圆形</option>
                          <option value="oval">椭圆</option>
                          <option value="hexagon">菱形</option>
                        </select>
                        <span class="help-inline">CSS3仅支持部分浏览器</span>
                      </div>
                    </div> -->


                </div><!-- attrStyle end -->
            </div>


            <div>
                <hr/>
                <span class="pull-right">
                    <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">取消</a>
                    <button class="btn btn-primary" type="submit" id="attributeOK">确定保存</button>
                </span>
            </div>
        </form>
        <script type="text/javascript">
            var _out_condition_data = {{$one['out_condition']}};</script>
        <script type="text/javascript" src="/js/flowdesign/attribute.js"></script>
    </body>
</html>
