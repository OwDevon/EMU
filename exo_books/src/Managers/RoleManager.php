<?php

namespace Src\Managers;

use Core\Manager;
use Src\Models\Role;

class RoleManager extends Manager
{
    public function __construct()
    {
        $this->model = Role::class;
    }
}