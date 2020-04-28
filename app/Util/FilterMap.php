<?php

namespace App\Util;

class FilterMap implements \Iterator {
    public function __construct($func, \Traversable $iter){
        $this->func = $func;
        $iter2 = $iter;
        if(is_array($iter2)){
            $iter2 = new \ArrayObject($iter2);
        }
        while(!($iter2 instanceof \Iterator)){
            $iter2 = $iter2->getIterator();
        }
        $this->iter = $iter2;
    }
    public function current(){
        return ($this->func)($this->iter->key(), $this->iter->current());
    } 
    public function key(){
        return $this->iter->key();
    } 
    public function next(){
        $this->iter->next();
        while($this->iter->valid() && $this->current() === NULL){
            $this->iter->next();
        }
    } 
    public function rewind(){
        $this->iter->rewind();
    }
    public function valid(){
        return $this->iter->valid();
    }
}