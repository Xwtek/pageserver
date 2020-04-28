<?php

namespace App\Database;

use App\Model\Category;
use App\Model\Page;
use App\Exceptions\TypeException;
use App\Exceptions\DuplicatedException;
use App\EloquentCategory;
use App\Util;
use Illuminate\Database\QueryException;

class DBCategoryRepository extends CategoryRepository
{

    function getAll(){
        return iterator_to_array(Util::filterMap(function($k, $v){
            return $v->intoModel();
        }, EloquentCategory::all()));
    }
    function getById($id){
        $arr = iterator_to_array(Util::filterMap(function($k, $v){
            return $v->intoModel();
        }, EloquentCategory::where('id',$id)->get()));
        if(count($arr) === 0) return NULL;
        else return $arr[0];
    }
    function makeCategory($name){
        try{
            $cat = new EloquentCategory();
            $cat->name = $name;
            $cat->save();
            return $cat->intoModel();
        }catch(QueryException $e){
            $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                throw new DuplicatedException("Category", "Name");
            }
            throw $e;
        }
    }
}
