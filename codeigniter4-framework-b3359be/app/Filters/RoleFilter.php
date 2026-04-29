<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Vérifie si l'utilisateur est connecté, sinon retour au login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter.');
        }

        // Vérification du rôle d'accès si des arguments sont fournis dans la route
        if ($arguments !== null) {
            $userRole = $session->get('role_libelle'); // Ex: 'admin', 'bibliothecaire', 'utilisateur'
            
            if (!in_array($userRole, $arguments)) {
                // L'utilisateur n'a pas le droit d'accéder à cette page
                return redirect()->to('/')->with('error', 'Accès refusé : privilèges insuffisants.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Pas d'action particulière après la requête
    }
}
