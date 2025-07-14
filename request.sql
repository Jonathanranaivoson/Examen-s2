CREATE TABLE Gmembre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255),
    ddn DATE,
    genre VARCHAR(50),
    email VARCHAR(100),
    ville VARCHAR(100),
    mdp VARCHAR(255) NOT NULL,
    image_profil VARCHAR(255)
);

CREATE TABLE Gcategorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100)
);

CREATE TABLE Gobjet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES Gcategorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES Gmembre(id_membre)
);

CREATE TABLE Gimages_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(255),
    FOREIGN KEY (id_objet) REFERENCES Gobjet(id_objet) 
);

CREATE TABLE Gemprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES Gobjet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES Gmembre(id_membre) 
);

----------
INSERT INTO Gmembre (nom, ddn, genre, email, ville, mdp) VALUES
('Bema', '1995-03-22', 'M', 'Bema@email.com', 'Betafo', 'bb'),
('Koto', '1988-09-10', 'F', 'Bema@email.com', 'antsirabe', 'kk');

-----------
INSERT INTO Gcategorie_objet (nom_categorie) VALUES ('esthetique'),('bricolage'),('mecanique'),('cuisine');
-----------

INSERT INTO Gemprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2025-07-01', NULL),
(5, 3, '2025-07-02', '2025-07-10'),
(10, 4, '2025-07-03', NULL),
(15, 1, '2025-07-04', '2025-07-12'),
(20, 3, '2025-07-05', NULL),
(25, 2, '2025-07-06', NULL),
(30, 1, '2025-07-07', '2025-07-13'),
(35, 2, '2025-07-08', NULL),
(40, 3, '2025-07-09', NULL),
(2, 4, '2025-07-10', NULL);
---------------------------------------

CREATE VIEW VueObjets AS
SELECT 
    o.id_objet,
    o.nom_objet,
    o.id_categorie,
    c.nom_categorie,
    o.id_membre,
    m.nom AS nom_membre,
    e.id_emprunt,
    e.date_emprunt,
    e.date_retour
FROM Gobjet o
LEFT JOIN Gcategorie_objet c ON o.id_categorie = c.id_categorie
LEFT JOIN Gmembre m ON o.id_membre = m.id_membre
LEFT JOIN Gemprunt e ON o.id_objet = e.id_objet;