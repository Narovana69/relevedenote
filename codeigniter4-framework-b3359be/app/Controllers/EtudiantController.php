<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EtudiantModel;
use CodeIgniter\HTTP\ResponseInterface;

class EtudiantController extends BaseController
{
    public function index()
    {
        $etudiantModel = new EtudiantModel();
        $etudiants = $etudiantModel->findAll();

        return view('etudiant/index', [
            'title' => 'Liste des Étudiants',
            'etudiants' => $etudiants
        ]);
    }

    public function show($id)
    {
        $etudiantModel = new EtudiantModel();
        $etudiant = $etudiantModel->find($id);

        if (!$etudiant) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('etudiant/show', [
            'title' => 'Détails Étudiant : ' . esc($etudiant['prenom'] . ' ' . $etudiant['nom']),
            'etudiant' => $etudiant
        ]);
    }
}
