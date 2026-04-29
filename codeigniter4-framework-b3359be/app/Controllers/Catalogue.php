<?php

namespace App\Controllers;

use App\Models\EmpruntModel;
use App\Models\LivreModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Catalogue extends BaseController
{
    private function getCategoriesStatiques(): array
    {
        return [
            'Roman',
            'Science-fiction',
            'Fantastique',
            'Policier',
            'Biographie',
            'Histoire',
            'Developpement personnel',
        ];
    }

    public function index()
    {
        $livreModel = new LivreModel();
        $empruntModel = new EmpruntModel();

        $motCle = trim((string) $this->request->getGet('search'));
        $categorie = trim((string) $this->request->getGet('category'));

        if ($motCle !== '' || $categorie !== '') {
            $livres = $livreModel->rechercherLivres($motCle ?: null, $categorie ?: null);
            $pager = null;
        } else {
            $livres = $livreModel->getLivresPagine(10, 'livres');
            $pager = $livreModel->pager;
        }

        foreach ($livres as &$livre) {
            if (($livre['statut'] ?? '') === 'prêté') {
                $dernier = $empruntModel->getDernierEmpruntParLivre((int) $livre['id']);
                $livre['dernier_emprunteur'] = $dernier['nom_emprunteur'] ?? 'Inconnu';
            }
        }

        $categories = $this->getCategoriesStatiques();

        $data['livres'] = $livres;
        $data['search'] = $motCle;
        $data['categories'] = $categories;
        $data['selected_category'] = $categorie;
        $data['pager'] = $pager;

        return view('catalogue', $data);
    }

    public function details($id)
    {
        $livreModel = new LivreModel();
        $empruntModel = new EmpruntModel();

        $livre = $livreModel->find($id);

        if (!$livre) {
            throw PageNotFoundException::forPageNotFound('Livre introuvable.');
        }

        $data['livre'] = $livre;
        $data['dernier_emprunt'] = $empruntModel->getDernierEmpruntParLivre((int) $id);

        return view('details', $data);
    }

    public function ajouter()
    {
        $data['categories'] = $this->getCategoriesStatiques();

        return view('ajouter', $data);
    }

    public function enregistrer()
    {
        $livreModel = new LivreModel();

        $anneePublication = (int) $this->request->getPost('annee_publication');

        if (!$livreModel->anneePublicationValide($anneePublication)) {
            return redirect()->back()->withInput()->with('errors', [
                'annee_publication' => 'L\'annee de publication ne peut pas etre dans le futur.',
            ]);
        }

        $data_livre = [
            'titre'             => $this->request->getPost('titre'),
            'auteur'            => $this->request->getPost('auteur'),
            'isbn'              => $this->request->getPost('isbn'),
            'annee_publication' => $anneePublication,
            'categorie'         => $this->request->getPost('categorie'),
            'resume'            => $this->request->getPost('resume'),
            'statut'            => 'disponible',
        ];

        $file = $this->request->getFile('couverture');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $validationRegles = [
                'couverture' => [
                    'rules' => 'uploaded[couverture]'
                             . '|is_image[couverture]'
                             . '|max_size[couverture,2048]'
                             . '|ext_in[couverture,png,jpg,jpeg,webp]',
                    'errors' => [
                        'max_size' => 'L\'image est trop grande (maximum 2 Mo).',
                        'is_image' => 'Le fichier doit etre une image.',
                        'ext_in'   => 'L\'extension n\'est pas supportee (.png, .jpg, .jpeg, .webp)',
                    ],
                ],
            ];

            if (!$this->validate($validationRegles)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/', $newName);

            $data_livre['couverture'] = $newName;
        }

        if ($livreModel->insert($data_livre)) {
            return redirect()->to('/catalogue')->with('success', 'Le livre a ete ajoute avec succes.');
        } else {
            return redirect()->back()->withInput()->with('errors', $livreModel->errors());
        }
    }

    public function supprimer($id)
    {
        $livreModel = new LivreModel();
        $livre = $livreModel->find($id);

        if (!$livre) {
            return redirect()->to('/catalogue')->with('error', 'Livre introuvable.');
        }

        $livreModel->delete($id);

        return redirect()->to('/catalogue')->with('success', 'Le livre a ete supprime avec succes.');
    }
}



