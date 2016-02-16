<?php

namespace XinGroup\Jobs;

use XinGroup\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Taobao\TopClient;
use Taobao\Request\AlibabaAliqinFcSmsNumSendRequest;
use Log;

class Ali extends Job implements ShouldQueue {

    use InteractsWithQueue,
        SerializesModels;

    protected $data;
    protected $phone;
    protected $sign;
    protected $templateCode;

    /**
     * 
     * @param type $data 短信模版变量
     * @param type $phone 手机号码
     * @param type $sign 短信签名
     * @param type $templateCode 模版代码
     * @return void
     */
    public function __construct($data, $phone, $sign, $templateCode) {
        $this->data = $data;
        $this->phone    = $phone;
        $this->sign     = $sign;
        $this->templateCode = $templateCode;
    }

    public function handle() {

        if (is_array($this->data)) {
            $this->data = json_encode($this->data, JSON_UNESCAPED_UNICODE);
        }

        if (is_array($this->phone)) {
            $this->phone = implode(',', $this->phone);
        }
        $conf = config('taobao');
        $c = new TopClient();
        $c->appkey = $conf['app_key'];
        $c->secretKey = $conf['app_secret'];
        $req = new AlibabaAliqinFcSmsNumSendRequest();
        $req->setSmsType("normal");
        $req->setSmsFreeSignName($this->sign);
        $req->setSmsParam($this->data);
        $req->setRecNum($this->phone);
        $req->setSmsTemplateCode($this->templateCode);
        $resp = $c->execute($req);
        if (isset($resp['result']['success']) && $resp['result']['success'] == true) {
            return true;
        }
        $this->release(1);
        Log::error(var_export($resp, true));
        return false;
    }

}
