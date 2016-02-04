<?php

namespace XinGroup\Model;

use Illuminate\Database\Eloquent\Model;

class Form extends Model {

    protected $table = 'form';
    
//    protected $cast = [
//        'content_data'  => 'json'
//    ];
    
    protected $fillable = [
      'fields','content','content_parse','content_data'
    ];
    
    public function getContentDatAttribute(){
        return json_decode($this->content_data);
    }

}
