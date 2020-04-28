<?php

namespace App\Model;

use App\Exceptions\TypeException;
use App\Model\Category;

class Page{
    public function __construct($id, $name, $contents, $url, Category $category){
        if(!is_int($id)){
			throw new TypeException("Page", "ID", "int", gettype($id));
        }
        if(!is_string($name)){
			throw new TypeException("Page", "Name", "int", gettype($id));
        }
        if(!is_string($contents)){
			throw new TypeException("Page", "Contents", "int", gettype($id));
        }
        if(!is_string($url)){
			throw new TypeException("Page", "Url", "int", gettype($id));
        }
        
        $this->id = $id;
        $this->name = $name;
        $this->contents = $contents;
        $this->url = $url;
        $this->category = $category;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($value){
        $this->name = $value;
    }

    public function getContents(){
        return $this->contents;
    }

    public function setContents($value){
        $this->contents = $value;
    }

    public function getUrl(){
        return $this->url;
    }

    public function setUrl($value){
        $this->url = $value;
    }

    public function getCategory(){
        return $this->category;
    }

    public function setCategory($value){
        $this->category = $value;
    }
}
