<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Database\CategoryRepository;
use App\Database\DBCategoryRepository;
use App\Database\DBPageRepository;
use App\Exceptions\DuplicatedException;

class CategoryController extends Controller
{
    private $categories;
    private $pages;
    public function __construct(DBCategoryRepository $categories, DBPageRepository $pages){
        $this->categories = $categories;
        $this->pages = $pages;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \view("category.list", ["categories" => $this->categories->getAll()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view("category.create", ["categories" => $this->categories->getAll(), "is_dialog" => false]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->categories->makeCategory($request->name);
            return response(\json_encode([]), 200)->header('Content-Type', 'application/json');
        }catch(DuplicatedException $e){
            return response(json_encode(["reason"=>"duplicated"]), 406)
                          ->header('Content-Type', 'application/json');
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->categories->getById($id);
        if($category === NULL){
            return response('', 404);
        }
        return \view("page.list", [
            "pages" => array_map(
                function($x){
                    return [
                        "id" => $x->getId(),
                        "name" => $x->getName(),
                        "catid" => $x->getCategory()->getId(),
                        "catname"=> $x->getCategory()->getName(),
                        "url" => $x->getUrl(),
                        "contents" => $x->getContents()
                    ];
                },
                $this->pages->getAllByCategory($this->categories->getById($id))
            ),
            "title" => "Pages with category ".$category->getName()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response("", 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response("", 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response("", 403);
    }
}
