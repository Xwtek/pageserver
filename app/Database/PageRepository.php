<?php

namespace App\Database;

use App\Model\Category;
use App\Model\Page;

abstract class PageRepository
{
    abstract function getAll();
    abstract function getById($id);
    abstract function getByName($name);
    abstract function getAllByCategory(Category $category);
    abstract function makePage($name, Category $category, $contents, $url);
    abstract function editPage(Page $page);
    abstract function deletePage(Page $page);
}
