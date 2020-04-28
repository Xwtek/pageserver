<?php

namespace App\Database;

use App\Model\Category;

abstract class CategoryRepository
{
    abstract function getAll();
    abstract function makeCategory($name);
    abstract function getById($id);
}
