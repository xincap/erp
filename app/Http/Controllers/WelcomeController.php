<?php

namespace XinGroup\Http\Controllers;

use Illuminate\Http\Request;
use XinGroup\Http\Requests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use XinGroup\Events\FileUpload;
use XinGroup\Respository\UserRepository;
use Validator;

class WelcomeController extends Controller {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $request;
    
    /**
     *
     * @var UserRepository 
     */
    protected $repository;

    public function __construct(Request $request, UserRepository $repository) {
        $this->request      = $request;
        $this->repository   = $repository;
        $this->middleware('auth:customer',['except'=>['getIndex']]);
    }

    public function getIndex() {
//        $data   = ['code'=> (string)mt_rand(10000, 99999),'product'=>'腾讯科技'];
//        $mobile = '17717556505';
//        Event::fire('sms.send',[$data,$mobile]);
        $upload = new FileUpload('/uploads/scenery/201602/17/2008122101950696_2.jpg');
        //event($upload);
        //$user   = $this->repository->find(1);
        
        return view('welcome');
        
        $url        = 'https://chaoshi.detail.tmall.com/item.htm?id=523050058433';
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);  // 从证书中检查SSL加密算法是否存在  
        curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);  
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $header);  
        //curl_setopt($ch, CURLOPT_POST, true);  
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
        //curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);  

        $response = mb_convert_encoding(curl_exec($ch), 'utf-8', 'gbk');  
        preg_match('~TShop.Setup\((.*?)\);~s', $response, $json);
        //print_r(json_decode($json[1],true));
        preg_match_all('~<dt class="tb-metatit">(.+?)</dt>~', $response, $matches);
        print_r($matches);
        preg_match_all('~<li data-value="(\d+):(\d+)"><a href="#"><span>(.+?)</span></a></li>~s', $response, $data);
        print_r($data);
        exit;
    }

}
