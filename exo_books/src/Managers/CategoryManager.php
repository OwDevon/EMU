<?php

namespace Src\Managers;

use Core\Manager;
use Src\Models\Category;

class CategoryManager extends Manager
{
    public function __construct()
    {
        $this->model = Category::class;
    }
}