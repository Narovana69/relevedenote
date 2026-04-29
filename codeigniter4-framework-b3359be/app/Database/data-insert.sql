USE relevenotes;

-- ------------------------------------------------------------
-- 1. OPTIONS (3 parcours S4 / L2)
-- ------------------------------------------------------------
INSERT INTO option (id, nom, responsable) VALUES
(1, 'Développement',          'Razafinjoelina Tahina'),
(2, 'BDD et Réseaux',         'Rakotomalala Vahatriniaina'),
(3, 'Web et Design',          'Rabenanahary Rojo');

-- ------------------------------------------------------------
-- 2. SOUS-OPTIONS  (une par option, idOption référence option.id)
-- ------------------------------------------------------------
INSERT INTO sousOption (id, idOption) VALUES
(1, 1),   -- sous-option Développement
(2, 2),   -- sous-option BDD et Réseaux
(3, 3);   -- sous-option Web et Design

-- ------------------------------------------------------------
-- 3. SEMESTRES
--    S3 = commun à toutes les options (pas de sousOption obligatoire
--         => on utilise sousOption 1 comme référence commune)
--    S4 = un semestre par sous-option
-- ------------------------------------------------------------
INSERT INTO semestre (id, nom, idOption, idSousOption) VALUES
(1, 'S3',    1, 1),   -- Semestre 3  (commun, rattaché à option Dev par défaut)
(2, 'S4-Dev',  1, 1),   -- Semestre 4 option Développement
(3, 'S4-BDD',  2, 2),   -- Semestre 4 option BDD et Réseaux
(4, 'S4-Web',  3, 3);   -- Semestre 4 option Web et Design

-- ------------------------------------------------------------
-- 4. UNITÉS D'ENSEIGNEMENT (UE)
-- ------------------------------------------------------------
INSERT INTO UE (libelle) VALUES
-- S3 commun
('INF201'),
('INF202'),
('INF203'),
('INF208'),
('MTH201'),
('ORG201'),
-- S4 commun aux 3 options
('INF204'),
('INF205'),
('INF206'),
('INF207'),
('MTH203'),
-- S4 spécifiques option Dev
('INF210'),
('MTH204'),
('MTH205'),
('MTH206'),
-- S4 spécifiques option BDD et Réseaux
('INF211'),
('MTH202'),
-- S4 spécifiques option Web et Design
('INF209'),
('INF212');

-- ------------------------------------------------------------
-- 5. MATIERES  (coefficient = crédits d'après les PDFs)
-- ------------------------------------------------------------

-- === SEMESTRE 3 (commun — sousOption 1) ===
INSERT INTO matiere (UE, coefficient, idSousOption) VALUES
('INF201',  6, 1),   -- Programmation orientée objet
('INF202',  6, 1),   -- Bases de données objets
('INF203',  4, 1),   -- Programmation système
('INF208',  6, 1),   -- Réseaux informatiques
('MTH201',  4, 1),   -- Méthodes numériques
('ORG201',  4, 1);   -- Bases de gestion

-- === SEMESTRE 4 — option Développement (sousOption 1) ===
-- Groupe optionnel 1 : 1 UE parmi INF204 / INF205 / INF206  → crédits 6
INSERT INTO matiere (UE, coefficient, idSousOption) VALUES
('INF204',  6, 1),   -- Système d'information géographique  (optionnel)
('INF205',  6, 1),   -- Système d'information               (optionnel)
('INF206',  6, 1),   -- Interface Homme/Machine             (optionnel)
('INF207',  6, 1),   -- Éléments d'algorithmique
('INF210', 10, 1),   -- Mini-projet de développement
-- Groupe optionnel 2 : 1 UE parmi MTH204 / MTH205 / MTH206 → crédits 4
('MTH204',  4, 1),   -- Géométrie                           (optionnel)
('MTH205',  4, 1),   -- Équations différentielles           (optionnel)
('MTH206',  4, 1),   -- Optimisation                        (optionnel)
('MTH203',  4, 1);   -- MAO

-- === SEMESTRE 4 — option BDD et Réseaux (sousOption 2) ===
INSERT INTO matiere (UE, coefficient, idSousOption) VALUES
('INF205',  6, 2),   -- Système d'information
-- Groupe optionnel : 1 UE parmi INF204 / INF206 / INF207 → crédits 6
('INF204',  6, 2),
('INF206',  6, 2),
('INF207',  6, 2),
('INF211', 10, 2),   -- Mini-projet BDD/Réseaux
-- Groupe optionnel MTH : MTH202 / MTH205 / MTH206 → crédits 4
('MTH202',  4, 2),   -- Analyse des données                 (optionnel)
('MTH205',  4, 2),   -- Équations différentielles           (optionnel)
('MTH206',  4, 2),   -- Optimisation                        (optionnel)
('MTH203',  4, 2);   -- MAO

INSERT INTO matiere (UE, coefficient, idSousOption) VALUES
-- Groupe optionnel : 1 UE parmi INF204 / INF205 / INF206 → crédits 6
('INF204',  6, 3),
('INF205',  6, 3),
('INF206',  6, 3),
('INF209',  6, 3),   -- Web dynamique
('INF212', 10, 3),   
('MTH202',  4, 3),   
('MTH204',  4, 3),   
('MTH206',  4, 3),   
('MTH203',  4, 3);   

INSERT INTO users (username, password) VALUES
('admin', 'admin');
