-- Utilisateurs
CREATE TABLE users(
    id_users INT PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    username VARCHAR(20) COLLATE utf8_bin NOT NULL ,
    password VARCHAR(50) COLLATE utf8_bin NOT NULL 
);

INSERT INTO users(username, password) VALUES("root", "root");

DELETE FROM users;

-- Joueurs
CREATE TABLE players(
   numLicence VARCHAR(10),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   photo VARCHAR(255),
   dateDeNaissance DATE,
   taille SMALLINT,
   poids SMALLINT,
   postePrefere char(2),
   statut VARCHAR(50),
   PRIMARY KEY(numLicence)
);

INSERT INTO football.players(numLicence, nom, prenom, photo, dateDeNaissance, taille, poids, postePrefere, statut) VALUES
("0234567891", "Beyssen", "Antoine", "antoine-beyssen.png", "2002-04-06", 184, 74, "AD", "Actif"),
("2345678910", "Princeau", "Matthieu", "matthieu-princeau.png", "1998-02-15", 172, 70, "GB", "Actif"),
("9876543210", "Aymeric", "Anthony", "anthony-aymeric.png", "2001-05-04",169, 53, "DC", "Actif");

DELETE FROM `players`;

-- rencontre
CREATE TABLE rencontre(
    Id_rencontre INT NOT NULL AUTO_INCREMENT,
    Date_rencontre DATE,
    Heure_rencontre TIME,
    Nom_adversaire VARCHAR(50),
    Lieu_de_rencontre VARCHAR(50),
    Points_equipe SMALLINT,
    Points_adversaire SMALLINT,
    PRIMARY KEY(Id_rencontre)
);

INSERT INTO rencontre(Date_rencontre, Heure_rencontre, Nom_adversaire, Lieu_de_rencontre, Points_equipe, Points_adversaire) VALUES
("2020-12-16", "14:39:00", "Les bleus", "Stade de France", 9, 8),
("2020-12-15", "18:00:00", "Les rouges", "Stade de France", 6, 9),
("2020-12-31", "18:00:00", "Les verts", "Stade de France", -1, -1),
("2020-12-17", "18:00:00", "Les oranges", "Stade de France", -1, -1)
;

CREATE TABLE participant(
    Id_rencontre INT NOT NULL AUTO_INCREMENT,
    numLicence VARCHAR(10),
    Position VARCHAR(50),
    Commentaire TEXT,
    PRIMARY KEY(Id_rencontre, numLicence),
    FOREIGN KEY(Id_rencontre) REFERENCES rencontre(Id_rencontre),
    FOREIGN KEY(numLicence) REFERENCES players(numLicence)
);