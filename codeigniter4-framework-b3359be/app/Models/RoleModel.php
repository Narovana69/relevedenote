<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'idRole';
    protected $allowedFields = ['libelle'];
    protected $returnType = 'array';
}
