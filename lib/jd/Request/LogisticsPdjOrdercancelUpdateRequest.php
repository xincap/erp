<?php
namespace Jd\Request;
class LogisticsPdjOrdercancelUpdateRequest
{
	private $apiParas = array();
	
	public function getApiMethodName(){
	  return "jingdong.logistics.pdj.ordercancel.update";
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
         $this->apiParas["orderId"] = $orderId;
	}

	public function getOrderId(){
	  return $this->orderId;
	}

                        	                   			private $operator;
    	                        
	public function setOperator($operator){
		$this->operator = $operator;
         $this->apiParas["operator"] = $operator;
	}

	public function getOperator(){
	  return $this->operator;
	}

                        	                   			private $orderCancelRemark;
    	                        
	public function setOrderCancelRemark($orderCancelRemark){
		$this->orderCancelRemark = $orderCancelRemark;
         $this->apiParas["orderCancelRemark"] = $orderCancelRemark;
	}

	public function getOrderCancelRemark(){
	  return $this->orderCancelRemark;
	}

}





        
 

