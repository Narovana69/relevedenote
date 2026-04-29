<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EtudiantModel;
use App\Models\UEModel;
use App\Models\SemestreModel;
use App\Models\ReleveNoteModel;

class NoteController extends BaseController
{
    public function add()
    {
        $etudiantModel = new EtudiantModel();
        $ueModel = new UEModel();
        $semestreModel = new SemestreModel();

        if ($this->request->getMethod() === 'POST' || $this->request->getMethod() === 'post') {
            $data = [
                'idEtudiant' => $this->request->getPost('idEtudiant'),
                'UE'         => $this->request->getPost('UE'),
                'idSemestre' => $this->request->getPost('idSemestre'),
                'note'       => $this->request->getPost('note'),
            ];

            $releveModel = new ReleveNoteModel();
            $releveModel->insert($data);

            return redirect()->to(base_url('notes/add'))->with('success', 'Note ajoutée avec succès ! (Peut être saisie plusieurs fois)');
        }

        return view('notes/add_note', [
            'title'     => 'Ajouter une Note',
            'etudiants' => $etudiantModel->findAll(),
            'ues'       => $ueModel->findAll(),
            'semestres' => $semestreModel->findAll()
        ]);
    }

    public function delete()
    {
        $db = \Config\Database::connect();
        
        if ($this->request->getMethod() === 'POST' || $this->request->getMethod() === 'post') {
            $ids = $this->request->getPost('notes_ids');
            if (!empty($ids)) {
                $releveModel = new ReleveNoteModel();
                foreach($ids as $id) {
                    $releveModel->delete($id);
                }
                return redirect()->to(base_url('notes/delete'))->with('success', 'Notes supprimées avec succès !');
            }
        }

        // Fetch notes with details
        $builder = $db->table('releve_note');
        $builder->select('releve_note.*, etudiant.nom, etudiant.prenom, UE.libelle as ue_nom, semestre.nom as sem_nom');
        $builder->join('etudiant', 'etudiant.id = releve_note.idEtudiant');
        $builder->join('UE', 'UE.id = releve_note.UE');
        $builder->join('semestre', 'semestre.id = releve_note.idSemestre');
        $builder->orderBy('releve_note.id', 'DESC');
        $notes = $builder->get()->getResultArray();

        return view('notes/supp_note', [
            'title' => 'Supprimer des Notes',
            'notes' => $notes
        ]);
    }

    public function edit()
    {
        $db = \Config\Database::connect();

        if ($this->request->getMethod() === 'POST' || $this->request->getMethod() === 'post') {
            $id = $this->request->getPost('id');
            $note = $this->request->getPost('note');
            
            if ($id && $note !== null) {
                $releveModel = new ReleveNoteModel();
                $releveModel->update($id, ['note' => $note]);
                return redirect()->to(base_url('notes/edit'))->with('success', 'Note modifiée avec succès !');
            }
        }

        // Fetch notes with details
        $builder = $db->table('releve_note');
        $builder->select('releve_note.*, etudiant.nom, etudiant.prenom, UE.libelle as ue_nom');
        $builder->join('etudiant', 'etudiant.id = releve_note.idEtudiant');
        $builder->join('UE', 'UE.id = releve_note.UE');
        $builder->orderBy('releve_note.id', 'DESC');
        $notes = $builder->get()->getResultArray();

        return view('notes/modif_note', [
            'title' => 'Modifier une Note',
            'notes' => $notes
        ]);
    }
}
