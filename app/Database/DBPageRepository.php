<?php

namespace App\Database;

use App\Model\Category;
use App\Model\Page;
use App\Exceptions\TypeException;
use App\Exceptions\DuplicatedException;
use App\EloquentCategory;
use App\EloquentPage;
use App\Util;
use Illuminate\Database\QueryException;

class DBPageRepository extends PageRepository
{

    function getAll(){
        return iterator_to_array(Util::filterMap(function($k, $v){
            return $v->intoModel();
        }, EloquentPage::all()));
    }

    function getById($id){
        return EloquentPage::find($id)->intoModel();
    }

    function getByName($name){
        $arr = iterator_to_array(Util::filterMap(function($k, $v){
            return $v->intoModel();
        }, EloquentPage::where('name',1)->get()));
        if(count($arr) === 0) return NULL;
        else return $arr[0];
    }

    function getAllByCategory(Category $category){
        $arr = iterator_to_array(Util::filterMap(function($k, $v){
            return $v->intoModel();
        }, EloquentPage::where('category',$category->getId())->get()));
        return $arr;
    }

    function makePage($name, Category $category, $contents, $url){
        try{
            $epage = new EloquentPage();
            $epage->name = $name;
            $epage->contents = $contents;
            $epage->url = $url;
            $epage->category = $category->getId();
            $epage->save();
            return $epage->intoModel();
        }catch(QueryException $e){
            $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                throw new DuplicatedException("Category", "Name");
            }
            throw $e;
        }
    }

    function editPage($page){
        $epage = EloquentPage::find($page->getId());
        $epage->name = $page->getName();
        $epage->contents = $page->getContents();
        $epage->url = $page->getUrl();
        $epage->category = $page->getCategory()->getId();
        $epage->save();
    }

    function deletePage($page){
        $epage = EloquentPage::find($page->getId());
        $epage->delete();
    }
}
