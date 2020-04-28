<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Page;
use App\Database\DBPageRepository;
use App\Database\DBCategoryRepository;
use App\EloquentPage;
use App\Exceptions\DuplicatedException;

class PageController extends Controller
{
    private $pages;
    private $categories;
    public function __construct(DBPageRepository $pages, DBCategoryRepository $categories){
        $this->pages = $pages;
        $this->categories = $categories;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
                $this->pages->getAll()
            ),
            "title" => "Pages"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view("page.form", [
            "categories" => array_map(function($x){
                return ["name"=> $x->getName(), "id"=>$x->getId()];
              }, $this->categories->getAll()),
            "mode" => "add",
            "title" => "Add Pages"
        ]);
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
            $category = $this->categories->getById($request->category);
            if($category === NULL){
                return response(\json_encode(["reason"=>"noCategory"]), 406)->header('Content-Type', 'application/json');
            }
            $this->pages->makePage($request->name, $category, $request->contents, $request->url);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = $this->pages->getById($id);
        if($page === NULL){
            return response('', 404);
        }
        return \view("page.form", [
            "categories" => array_map(function($x){
                return ["name"=> $x->getName(), "id"=>$x->getId()];
              }, $this->categories->getAll()),
            "mode" => "edit",
            "obj" => [
                "id" => $page->getId(),
                "name" => $page->getName(),
                "url" => $page->getUrl(),
                "contents" => $page->getContents(),
                "category" => $page->getCategory()->getId(),
            ],
            "title" => "Edit Page"
        ]);
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
        $category = $this->categories->getById($request->category);
        if($category === NULL){
            return response(\json_encode(["reason"=>"noCategory"]), 406)->header('Content-Type', 'application/json');
        }
        $page = $this->pages->getById($request->id);
        $page->setName($request->name);
        $page->setCategory($category);
        $page->setContents($request->contents);
        $page->setUrl($request->url);
        $this->pages->editPage($page);
        return response(\json_encode([]), 200)->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = $this->pages->getById($id);
        if($page === NULL){
            return response(\json_encode(["reason"=>"noPage"]), 406)->header('Content-Type', 'application/json');
        }
        $this->pages->deletePage($page);
        return response(\json_encode([]), 200)->header('Content-Type', 'application/json');
    }
}
