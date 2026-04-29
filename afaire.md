## SETUP
- [X] Créer le projet CodeIgniter 4
- [X] Configurer `.env` (base de données `relevenotes`, host, user, password)
- [X] Importer `schema.sql` puis `data_insert.sql` dans MySQL

---

## AUTHENTIFICATION

### Login
- [ ] Créer le Controller `AuthController` avec méthode `login()`
- [ ] Créer la vue `login.php` avec le formulaire
- [ ] **Pré-remplir** le formulaire avec les valeurs par défaut (`admin` / `admin`)
- [ ] Implémenter la vérification en base (`users` table)
- [ ] Stocker la session utilisateur connecté
- [ ] Rediriger vers la liste des étudiants après login
- [ ] Protéger toutes les routes avec un filtre de session

---

## FORMULAIRE — AJOUTER UNE NOTE — MODIFIER UNE NOTE — SUPPRIMER UNE NOTE

- [ ] Créer le Controller `NoteController` avec méthode `add()`
- [ ] Créer la vue `add_note.php`
  - [ ] Sélecteur étudiant (liste déroulante)
  - [ ] Sélecteur UE
  - [ ] Champ note (float, 0–20)
- [ ] **Permettre la saisie multiple** : on peut enregistrer plusieurs fois une note pour la même UE (la règle de gestion prend le max)
- [ ] Insérer dans `releve_note`
- [ ] Creer la vue `supp_note.php`
  - [ ] selectionner une note pour la supprimer
  - [ ] condition si supprimer et qu'elle est vide, la note sur la matiere en question reste 0(toujours 0 s'il y a rien meme apres supprimer, car note existe meme si elle n'a pas de valeur)
- [ ] **Selection multiple de note** : on peut selectionner plusieurs notes pour les supprimer
- [ ] Creer la vue `modif_note.php`
  - [ ] selection de note et modification par manipulation dynamique du DOM
---

## LISTE DES ÉTUDIANTS

- [ ] Créer le Controller `EtudiantController` avec méthode `index()`
- [ ] Afficher la liste de tous les étudiants
- [ ] Chaque étudiant est un lien cliquable

---

## NOTES PAR ÉTUDIANT — VUES DÉTAIL

### Architecture des liens (par étudiant)
Quand on clique sur un étudiant, afficher des liens :

| Lien | Contenu |
|---|---|
| S3 | Notes du Semestre 3 |
| S4 option dev | Notes S4 parcours Développement |
| S4 option bddres | Notes S4 parcours BDD & Réseaux |
| S4 option web | Notes S4 parcours Web & Design |
| L2 option dev | S3 + S4 dev + moyenne globale |
| L2 option bddres | S3 + S4 bddres + moyenne globale |
| L2 option web | S3 + S4 web + moyenne globale |

### Vue S3
- [ ] Afficher les 6 UEs du S3 avec note et coefficient
- [ ] Calculer la moyenne pondérée S3 (Σ note×coeff / Σ coeff)

### Vue S4 (dev / bddres / web)
- [ ] Afficher les UEs du semestre selon l'option
- [ ] Calculer la moyenne pondérée S4

### Vue L2 (dev / bddres / web)
- [ ] Afficher les notes des 2 semestres (S3 + S4 option)
- [ ] Calculer la moyenne L2 = (moyenne S3 + moyenne S4) / 2

---

## RÈGLES DE GESTION

- [ ] **Note maximale par matière** : si plusieurs notes existent pour une même UE + étudiant → `MAX(note)`
- [ ] **Matières optionnelles** : parmi les UEs d'un groupe, retenir celle avec la meilleure note

  Groupes optionnels par option :

  S4 Dev :
  - groupe INF : meilleure parmi INF204, INF205, INF206 (coeff 6)
  - groupe MTH : meilleure parmi MTH204, MTH205, MTH206 (coeff 4)

  S4 BDD :
  - groupe INF opt : meilleure parmi INF204, INF206, INF207 (coeff 6)
  - groupe MTH : meilleure parmi MTH202, MTH205, MTH206 (coeff 4)

  S4 Web :
  - groupe INF opt : meilleure parmi INF204, INF205, INF206 (coeff 6)
  - groupe MTH : meilleure parmi MTH202, MTH204, MTH206 (coeff 4)

---

## DESIGN

- [ ] Intégrer le fichier SCSS fourni pour personnaliser le thème
- [ ] Compiler le SCSS en CSS (`sass custom.scss custom.css`)
- [ ] Appliquer le CSS dans le layout principal
- [ ] S'assurer que login, liste, formulaire et relevés sont stylisés
- [ ] Baser sur le template dans `/Design-template`
- [ ] les fichiers design .scss se trouve normalement dans `assets/scss`

---

## STRUCTURE CONTROLLERS SUGGÉRÉE

```
app/Controllers/
├── AuthController.php       → login / logout
├── EtudiantController.php   → index (liste), show (détail + liens)
├── NoteController.php       → add (formulaire + save)
└── ReleveController.php     → s3, s4, l2 (paramètre option)
```

---

## DONNÉES EN BASE (data_insert.sql)

- 3 options : Développement, BDD et Réseaux, Web et Design
- 4 semestres : S3 (commun), S4-Dev, S4-BDD, S4-Web
- 19 UEs déclarées
- Toutes les matières avec coefficients selon les PDFs
- Utilisateur admin / admin pré-chargé