<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'utilisateurs';
    protected $primaryKey = 'idUtilisateur';
    protected $allowedFields = ['nom', 'mail', 'password', 'idRole'];
    protected $returnType = 'array';

    public function getUserWithRole(string $email)
    {
        return $this->select('utilisateurs.*, roles.libelle AS role_libelle')
                    ->join('roles', 'roles.idRole = utilisateurs.idRole')
                    ->where('utilisateurs.mail', $email)
                    ->first();
    }
}
