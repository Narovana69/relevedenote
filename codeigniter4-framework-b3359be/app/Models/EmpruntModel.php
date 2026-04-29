<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpruntModel extends Model
{
    protected $table            = 'emprunts';
    protected $primaryKey       = 'id';

    protected $returnType       = 'array';

    protected $allowedFields    = [
        'livre_id',
        'nom_emprunteur',
        'date_emprunt',
        'date_retour',
    ];

    protected $validationRules      = [
        'livre_id'        => 'required|integer',
        'nom_emprunteur'  => 'required|min_length[2]|max_length[255]',
        'date_emprunt'    => 'required|valid_date',
        'date_retour'     => 'permit_empty|valid_date',
    ];

    protected $validationMessages   = [
        'livre_id' => [
            'required' => 'Le champ livre_id est obligatoire.',
            'integer'  => 'Le champ livre_id doit etre un nombre entier.',
        ],
        'nom_emprunteur' => [
            'required'   => 'Le nom de l\'emprunteur est obligatoire.',
            'min_length' => 'Le nom de l\'emprunteur doit contenir au moins 2 caracteres.',
            'max_length' => 'Le nom de l\'emprunteur ne doit pas depasser 255 caracteres.',
        ],
        'date_emprunt' => [
            'required'   => 'Le champ date_emprunt est obligatoire.',
            'valid_date' => 'Le champ date_emprunt doit etre une date valide.',
        ],
        'date_retour' => [
            'valid_date' => 'Le champ date_retour doit etre une date valide.',
        ],
    ];

    protected $skipValidation       = false;

    protected string $actionError = '';

    public function getDernierEmpruntParLivre(int $livreId): ?array
    {
        return $this->where('livre_id', $livreId)
            ->orderBy('date_emprunt', 'DESC')
            ->first();
    }

    public function getActionError(): string
    {
        return $this->actionError;
    }

    protected function setActionError(string $message): void
    {
        $this->actionError = $message;
    }

    public function retournerLivre(int $livreId): bool
    {
        $this->setActionError('');
        $livreModel = new LivreModel();
        $livre = $livreModel->find($livreId);

        if (!$livre) {
            $this->setActionError('Livre introuvable.');
            return false;
        }

        if (($livre['statut'] ?? '') !== 'prêté') {
            $this->setActionError('Action impossible : le livre est deja disponible.');
            return false;
        }

        $empruntActif = $this->where('livre_id', $livreId)
            ->where('date_retour', null)
            ->orderBy('date_emprunt', 'DESC')
            ->first();

        if (!$empruntActif) {
            $this->setActionError('Aucun emprunt actif trouve pour ce livre.');
            return false;
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $this->update($empruntActif['id'], ['date_retour' => date('Y-m-d H:i:s')]);
        $livreModel->update($livreId, ['statut' => 'disponible']);

        $db->transComplete();

        if (!$db->transStatus()) {
            $this->setActionError('Impossible d\'enregistrer le retour du livre.');
            return false;
        }

        return true;
    }

    public function preterLivre(int $livreId, string $nomEmprunteur): bool
    {
        $this->setActionError('');
        $livreModel = new LivreModel();
        $livre = $livreModel->find($livreId);
        $nomEmprunteur = trim($nomEmprunteur);

        if (!$livre) {
            $this->setActionError('Livre introuvable.');
            return false;
        }

        if (($livre['statut'] ?? '') !== 'disponible') {
            $this->setActionError('Action impossible : le livre est deja prete.');
            return false;
        }

        if ($nomEmprunteur === '') {
            $this->setActionError('Le nom de l\'emprunteur est requis.');
            return false;
        }

        $data = [
            'livre_id' => $livreId,
            'nom_emprunteur' => $nomEmprunteur,
            'date_emprunt' => date('Y-m-d H:i:s'),
            'date_retour' => null,
        ];

        $db = \Config\Database::connect();
        $db->transStart();

        $insertOk = (bool) $this->insert($data);
        if ($insertOk) {
            $livreModel->update($livreId, ['statut' => 'prêté']);
        }

        $db->transComplete();

        if (!$insertOk || !$db->transStatus()) {
            $erreurs = $this->errors();
            $this->setActionError($erreurs ? implode(' ', $erreurs) : 'Impossible d\'enregistrer l\'emprunt.');
            return false;
        }

        return true;
    }
}