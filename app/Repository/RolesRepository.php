<?php


namespace App\Repository;


use App\Interfaces\Roles;
use App\Models\Role;
use App\Traits\ApiResponser;

class RolesRepository implements Roles
{
    use ApiResponser;
    public function getRoles()
    {
        return $this->showAll(Role::where('name','!=','Admin')->get());
    }
}
