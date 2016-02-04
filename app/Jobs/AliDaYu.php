<?php

namespace XinGroup\Jobs;

use XinGroup\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Taobao\TopClient;
use Taobao\Request\AlibabaAliqinFcSmsNumSendRequest;
use Log;

class AliDaYu extends Job implements ShouldQueue {

    use InteractsWithQueue,
        SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }


    /**
     * 
     * @param type $data 短信模版变量
     * @param type $phone 手机号码
     * @param type $sign 短信签名
     * @param type $templateCode 模版代码
     * @return void
     */
    public function handle($data, $phone, $sign, $templateCode) {
        
        if(is_array($data)){
            $data   = json_encode($data,JSON_UNESCAPED_UNICODE);
        }
        
        if(is_array($phone)){
            $phone  = implode(',', $phone);
        }
        $conf = config('taobao');
        $c = new TopClient();
        $c->appkey = $conf['app_key'];
        $c->secretKey = $conf['app_secret'];
        $req = new AlibabaAliqinFcSmsNumSendRequest();
        $req->setSmsType("normal");
        $req->setSmsFreeSignName($sign);
        $req->setSmsParam($data);
        $req->setRecNum($phone);
        $req->setSmsTemplateCode($templateCode);
        $resp = $c->execute($req);
        if(isset($resp['result']['success']) && $resp['result']['success'] == true){
            return true;
        }
        $this->release(1);
        Log::error(var_export($resp,true));
        return false;
    }

}
