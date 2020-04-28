<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EloquentCategory;
use App\Util;
use App\Database\DBCategoryRepository;

class TestController extends Controller
{
    protected $categories;
    function __construct(DBCategoryRepository $categories){
        $this->categories = $categories;
    }

    function run($name){
        if(method_exists($this, $name)){
            call_user_func([$this, $name]);
        }else{
            abort(404);
        }
    }
    function hello(){
        echo "hello";
    }

    function categories(){
        //var_dump(iterator_to_array(EloquentCategory::all()));
        var_dump(iterator_to_array(Util::filterMap(function ($k, $v){return $v->intoModel();}, EloquentCategory::all())));
    }

    function one_category(){
        var_dump(EloquentCategory::where('id', 1)->get());
    }

    function add_category(){
        var_dump($this->categories->makeCategory("big"));
    }
}
