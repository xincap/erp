<?php
namespace Jd\Request;
class OrderSoplOutstorageRequest
{
	private $apiParas = array();
	
	public function getApiMethodName(){
	  return "360buy.order.sopl.outstorage";
	}
	
	public function getApiParas(){
		return json_encode($this->apiParas);
	}
	
	public function check(){
		
	}
	
	public function putOtherTextParam($key, $value){
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
                                                        		                                    	                   			private $orderId;
    	                                                            
	public function setOrderId($orderId){
		$this->orderId = $orderId;
		$this->apiParas["order_id"] = $orderId;
	}

	public function getOrderId(){
	  return $this->orderId;
	}

                        	                   			private $packageNum;
    	                                                            
	public function setPackageNum($packageNum){
		$this->packageNum = $packageNum;
		$this->apiParas["package_num"] = $packageNum;
	}

	public function getPackageNum(){
	  return $this->packageNum;
	}

                        	                   			private $logisticsId;
    	                                                            
	public function setLogisticsId($logisticsId){
		$this->logisticsId = $logisticsId;
		$this->apiParas["logistics_id"] = $logisticsId;
	}

	public function getLogisticsId(){
	  return $this->logisticsId;
	}

                        	                   			private $waybill;
    	                        
	public function setWaybill($waybill){
		$this->waybill = $waybill;
		$this->apiParas["waybill"] = $waybill;
	}

	public function getWaybill(){
	  return $this->waybill;
	}

                        	                   			private $tradeNo;
    	                                                            
	public function setTradeNo($tradeNo){
		$this->tradeNo = $tradeNo;
		$this->apiParas["trade_no"] = $tradeNo;
	}

	public function getTradeNo(){
	  return $this->tradeNo;
	}

                            }





        
 

