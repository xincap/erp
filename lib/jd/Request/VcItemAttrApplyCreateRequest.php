<?php
namespace Jd\Request;
class VcItemAttrApplyCreateRequest
{
	private $apiParas = array();
	
	public function getApiMethodName(){
	  return "jingdong.vc.item.attr.apply.create";
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
                                    	                                            		                                    	                   			private $wareGroupId;
    	                                                                        
	public function setWareGroupId($wareGroupId){
		$this->wareGroupId = $wareGroupId;
         $this->apiParas["ware_group_id"] = $wareGroupId;
	}

	public function getWareGroupId(){
	  return $this->wareGroupId;
	}

                        	                   			private $publicName;
    	                                                            
	public function setPublicName($publicName){
		$this->publicName = $publicName;
         $this->apiParas["public_name"] = $publicName;
	}

	public function getPublicName(){
	  return $this->publicName;
	}

                                                 	                        	                                                                                                                                                                                                                                                                                                                                                                                                       private $wareIds;
                              public function setWareIds($wareIds ){
                 $this->wareIds=$wareIds;
                 $this->apiParas["ware_ids"] = $wareIds;
              }

              public function getWareIds(){
              	return $this->wareIds;
              }
                                                                                                                                                                                                                                                                                                                                                                                                                                      private $colorNames;
                              public function setColorNames($colorNames ){
                 $this->colorNames=$colorNames;
                 $this->apiParas["color_names"] = $colorNames;
              }

              public function getColorNames(){
              	return $this->colorNames;
              }
                                                                                                                                                                                                                                                                                                                                                                                                                                      private $colorSorts;
                              public function setColorSorts($colorSorts ){
                 $this->colorSorts=$colorSorts;
                 $this->apiParas["color_sorts"] = $colorSorts;
              }

              public function getColorSorts(){
              	return $this->colorSorts;
              }
                                                                                                                                                                                                                                                                                                                                                                                                                                      private $sizeNames;
                              public function setSizeNames($sizeNames ){
                 $this->sizeNames=$sizeNames;
                 $this->apiParas["size_names"] = $sizeNames;
              }

              public function getSizeNames(){
              	return $this->sizeNames;
              }
                                                                                                                                                                                                                                                                                                                                                                                                                                      private $sizeSorts;
                              public function setSizeSorts($sizeSorts ){
                 $this->sizeSorts=$sizeSorts;
                 $this->apiParas["size_sorts"] = $sizeSorts;
              }

              public function getSizeSorts(){
              	return $this->sizeSorts;
              }
                                                                                                                                                                    	}





        
 

