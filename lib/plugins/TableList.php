<?php

namespace XinGroup\Plugin;

use Request;
use Schema;

class TableList {

    static function process(Request $request) {
        $table = Request::get('table', null);
        $josnp = Request::get('jsonp', null);
        if (!$table) {
            return response()->json(['ret' => 0, 'msg' => '表不存在!']);
        }

        $conn = Schema::getConnection();
        $manager = $conn->getDoctrineSchemaManager();
        $preFix = $conn->getTablePrefix();
        $table = $preFix . $table;

        if (!$manager->tablesExist($table)) {
            return response()->json(['ret' => 0, 'msg' => '错误的表名!']);
        }
        $list = $manager->listTableColumns($table);
        $source = [];
        foreach ($list as $key => $v) {
            $comment = $v->getComment();
            if (!$comment) {
                continue;
            }
            $source[] = ['id' => $v->getName(), 'comment' => $comment];
        }
        if ($josnp) {
            return response()->jsonp('callback', ['ret' => 200, 'data' => $source]);
        }
        return response()->json(['ret' => 200, 'data' => $source]);
    }

}
