USE relevenotes;

INSERT INTO option (id, nom, responsable) VALUES
(1, 'Développement',  'Razafinjoelina Tahina'),
(2, 'BDD et Réseaux', 'Rakotomalala Vahatriniaina'),
(3, 'Web et Design',  'Rabenanahary Rojo');

INSERT INTO sousOption (id, idOption, nom) VALUES
(1, 1, 'dev'),
(2, 2, 'bddres'),
(3, 3, 'web');

-- ------------------------------------------------------------
-- 3. SEMESTRES
-- S3 est commun → on crée 1 entrée S3 par sous-option
-- pour pouvoir lier les notes par sous-option correctement
-- ------------------------------------------------------------
INSERT INTO semestre (id, nom, idOption, idSousOption) VALUES
(1, 'S3', 1, 1),
(2, 'S3', 2, 2),
(3, 'S3', 3, 3),
(4, 'S4', 1, 1),
(5, 'S4', 2, 2),
(6, 'S4', 3, 3);

INSERT INTO UE (libelle) VALUES
-- S3 commun
('INF201'),
('INF202'),
('INF203'),
('INF208'),
('MTH201'),
('ORG201'),
-- S4 partagées entre plusieurs options
('INF204'),
('INF205'),
('INF206'),
('INF207'),
('MTH203'),
('MTH205'),
('MTH206'),
-- S4 spécifiques Dev
('INF210'),
('MTH204'),
-- S4 spécifiques BDD et Réseaux
('INF211'),
('MTH202'),
-- S4 spécifiques Web et Design
('INF209'),
('INF212');


-- === S3 commun — dupliqué pour chaque sous-option ===

-- sous-option dev (1)
INSERT INTO matiere (UE, coefficient, idSousOption) VALUES
('INF201', 6, 1),
('INF202', 6, 1),
('INF203', 4, 1),
('INF208', 6, 1),
('MTH201', 4, 1),
('ORG201', 4, 1);

-- sous-option bddres (2)
INSERT INTO matiere (UE, coefficient, idSousOption) VALUES
('INF201', 6, 2),
('INF202', 6, 2),
('INF203', 4, 2),
('INF208', 6, 2),
('MTH201', 4, 2),
('ORG201', 4, 2);

-- sous-option web (3)
INSERT INTO matiere (UE, coefficient, idSousOption) VALUES
('INF201', 6, 3),
('INF202', 6, 3),
('INF203', 4, 3),
('INF208', 6, 3),
('MTH201', 4, 3),
('ORG201', 4, 3);

-- === S4 option Développement (sousOption 1) ===
-- groupe optionnel INF : 1 parmi INF204, INF205, INF206 → coeff 6
INSERT INTO matiere (UE, coefficient, idSousOption) VALUES
('INF204',  6, 1),
('INF205',  6, 1),
('INF206',  6, 1),
('INF207',  6, 1),   -- obligatoire
('INF210', 10, 1),   -- Mini-projet dev
-- groupe optionnel MTH : 1 parmi MTH204, MTH205, MTH206 → coeff 4
('MTH204',  4, 1),
('MTH205',  4, 1),
('MTH206',  4, 1),
('MTH203',  4, 1);   -- MAO obligatoire

-- === S4 option BDD et Réseaux (sousOption 2) ===
-- INF205 obligatoire
-- groupe optionnel INF : 1 parmi INF204, INF206, INF207 → coeff 6
INSERT INTO matiere (UE, coefficient, idSousOption) VALUES
('INF205',  6, 2),
('INF204',  6, 2),
('INF206',  6, 2),
('INF207',  6, 2),
('INF211', 10, 2),   -- Mini-projet BDD/Réseaux
-- groupe optionnel MTH : 1 parmi MTH202, MTH205, MTH206 → coeff 4
('MTH202',  4, 2),
('MTH205',  4, 2),
('MTH206',  4, 2),
('MTH203',  4, 2);   -- MAO obligatoire

-- === S4 option Web et Design (sousOption 3) ===
-- groupe optionnel INF : 1 parmi INF204, INF205, INF206 → coeff 6
INSERT INTO matiere (UE, coefficient, idSousOption) VALUES
('INF204',  6, 3),
('INF205',  6, 3),
('INF206',  6, 3),
('INF209',  6, 3),   -- Web dynamique obligatoire
('INF212', 10, 3),   -- Mini-projet Web et design
-- groupe optionnel MTH : 1 parmi MTH202, MTH204, MTH206 → coeff 4
('MTH202',  4, 3),
('MTH204',  4, 3),
('MTH206',  4, 3),
('MTH203',  4, 3);   -- MAO obligatoire

INSERT INTO users (username, password) VALUES
('admin', 'admin');
