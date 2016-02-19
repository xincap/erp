<?php

namespace XinGroup\Respository;

interface RepositoryInterface {
    
    public function all();
    
    public function find($id);
    
    public function findBy($name, $value);
    
    public function findOneBy($name, $value);
    
}
