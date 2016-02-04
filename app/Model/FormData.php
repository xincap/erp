<?php

namespace XinGroup\Model;

use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    protected $table;
    
    public $timestamps = false;
            
    function getTable() {
        return $this->table;
    }

    function setTable($table) {
        $this->table = 'form_data_' . $table ;
    }


}
