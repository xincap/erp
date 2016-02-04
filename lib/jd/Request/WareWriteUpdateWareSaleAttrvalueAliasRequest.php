<?php
namespace Jd\Request;
class WareWriteUpdateWareSaleAttrvalueAliasRequest
{
	private $apiParas = array();
	
	public function getApiMethodName(){
	  return "jingdong.ware.write.updateWareSaleAttrvalueAlias";
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
                                                        		                                    	                        	                        	                                                    	                        	                   			private $wareId;
    	                        
	public function setWareId($wareId){
		$this->wareId = $wareId;
         $this->apiParas["wareId"] = $wareId;
	}

	public function getWareId(){
	  return $this->wareId;
	}

                                                 	                        	                                                                                                                                                                                                                                                                                                               private $attrId;
                              public function setAttrId($attrId ){
                 $this->attrId=$attrId;
                 $this->apiParas["attrId"] = $attrId;
              }

              public function getAttrId(){
              	return $this->attrId;
              }
                                                                                                                                                                                                                                                                                                                                              private $attrValues;
                              public function setAttrValues($attrValues ){
                 $this->attrValues=$attrValues;
                 $this->apiParas["attrValues"] = $attrValues;
              }

              public function getAttrValues(){
              	return $this->attrValues;
              }
                                                                                                                                                                                                                                                                                                                                              private $attrValueAlias;
                              public function setAttrValueAlias($attrValueAlias ){
                 $this->attrValueAlias=$attrValueAlias;
                 $this->apiParas["attrValueAlias"] = $attrValueAlias;
              }

              public function getAttrValueAlias(){
              	return $this->attrValueAlias;
              }
                                                                                                                }





        
 

