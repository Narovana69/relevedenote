<?php

namespace App\Controllers;

use App\Models\EmpruntModel;

class Mouvements extends BaseController
{
    public function preter($id)
    {
        $empruntModel = new EmpruntModel();

        $nomEmprunteur = trim((string) $this->request->getPost('emprunteur'));

        if (!$empruntModel->preterLivre((int) $id, $nomEmprunteur)) {
            return redirect()->to('/catalogue')->with('error', $empruntModel->getActionError());
        }

        return redirect()->to('/catalogue')->with('success', 'Livre prete avec succes a ' . esc($nomEmprunteur) . '.');
    }

    public function retourner($id)
    {
        $empruntModel = new EmpruntModel();

        if (!$empruntModel->retournerLivre((int) $id)) {
            return redirect()->to('/catalogue')->with('error', $empruntModel->getActionError());
        }

        return redirect()->to('/catalogue')->with('success', 'Livre retourne avec succes.');
    }
}
