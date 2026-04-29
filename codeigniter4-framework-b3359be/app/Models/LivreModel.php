<?php

namespace App\Models;

use CodeIgniter\Model;

class LivreModel extends Model
{
    protected $table            = 'livres';
    protected $primaryKey       = 'id';

    protected $returnType       = 'array';

    protected $allowedFields    = [
        'titre',
        'auteur',
        'isbn',
        'annee_publication',
        'categorie',
        'resume',
        'couverture',
        'statut',
    ];

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $validationRules      = [
        'titre'              => 'required|min_length[3]|max_length[255]',
        'auteur'             => 'required|max_length[255]',
        'isbn'               => 'required|max_length[20]|is_unique[livres.isbn,id,{id}]',
        'annee_publication'  => 'required|integer|exact_length[4]',
    ];

    protected $validationMessages   = [
        'titre' => [
            'required'   => 'Le titre est obligatoire.',
            'min_length' => 'Le titre doit comporter au moins 3 caracteres.',
            'max_length' => 'Le titre ne doit pas depasser 255 caracteres.',
        ],
        'auteur' => [
            'required'   => 'L\'auteur est obligatoire.',
            'max_length' => 'Le nom de l\'auteur ne doit pas depasser 255 caracteres.',
        ],
        'isbn' => [
            'required'   => 'L\'ISBN est obligatoire.',
            'max_length' => 'L\'ISBN ne doit pas depasser 20 caracteres.',
            'is_unique'  => 'Cet ISBN existe deja en base de donnees.',
        ],
        'annee_publication' => [
            'required'     => 'L\'annee de publication est obligatoire.',
            'integer'      => 'L\'annee de publication doit etre un nombre entier.',
            'exact_length' => 'L\'annee de publication doit contenir exactement 4 chiffres.',
        ],
    ];

    protected $skipValidation       = false;

    public function anneePublicationValide(int $anneePublication): bool
    {
        $anneeCourante = (int) date('Y');

        return $anneePublication <= $anneeCourante;
    }

    public function rechercherLivres(?string $motCle = null, ?string $categorie = null): array
    {
        $builder = $this->builder();

        if (!empty($motCle)) {
            $builder->like('titre', $motCle);
        }

        if (!empty($categorie)) {
            $builder->where('categorie', $categorie);
        }

        return $builder->orderBy('titre', 'ASC')->get()->getResultArray();
    }

    public function getLivresPagine(int $parPage = 10, string $group = 'livres')
    {
        return $this->orderBy('titre', 'ASC')->paginate($parPage, $group);
    }
}
