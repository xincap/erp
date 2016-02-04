<?php

namespace XinGroup\Http\Logic;

use Event;

class XZQ {

    private static $url = 'http://www.stats.gov.cn/tjsj/tjbz/xzqhdm/201504/t20150415_712722.html';
    
    static function proccess(){
        $data   = file_get_contents(self::$url);
        preg_match_all('~<p class="MsoNormal" style="line-height: 150%">(.*?)</p>~s', $data, $matches);
        foreach ($matches[1] as $key => $matches) {
            event('spider.area', strip_tags($matches));
        }
    }

}
