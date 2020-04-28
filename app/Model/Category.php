<?php

namespace App\Model;

use App\Exceptions\TypeException;

class Category{
    public function __construct($id, $name){
        if(!is_int($id)){
			throw new TypeException("Page", "ID", "int", gettype($id));
        }
        if(!is_string($name)){
			throw new TypeException("Page", "Name", "int", gettype($id));
        }

        $this->id = $id;
        $this->name = $name;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }
}
