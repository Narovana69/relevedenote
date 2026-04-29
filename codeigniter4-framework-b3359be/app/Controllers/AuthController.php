<?php
namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        $session = session();
        $email = $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->getUserWithRole($email);
    
        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'isLoggedIn'    => true,
                'idUtilisateur' => $user['idUtilisateur'],
                'role_libelle'  => $user['role_libelle'],
                'nom'           => $user['nom']
            ]);
            return redirect()->to('/');
        }

        return redirect()->back()->with('error', 'Identifiants invalides');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function profil()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        
        $data = [
            'nom' => $session->get('nom'),
            'historique' => []
        ];

        return view('auth/profil_user', $data);
    }
}