-- Utilisateurs
CREATE TABLE users(
    id_users INT PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    username VARCHAR(20) COLLATE utf8_bin NOT NULL ,
    password VARCHAR(50) COLLATE utf8_bin NOT NULL 
);

INSERT INTO users(username, password) VALUES("root", "root");

DELETE * FROM users;

-- Joueurs
CREATE TABLE players(
   Numero_de_licence VARCHAR(50),
   Nom VARCHAR(50),
   Prenom VARCHAR(50),
   Photo VARCHAR(255),
   Date_de_naissance DATE,
   Taille SMALLINT,
   Poids SMALLINT,
   Poste_prefere char(2),
   Statut VARCHAR(50),
   PRIMARY KEY(Numero_de_licence)
);

INSERT INTO players(Numero_de_licence, Nom, Prenom, Photo, Date_de_naissance, Taille, Poids, Poste_prefere, Statut) VALUES
("A2345678", "Beyssen", "Antoine", "antoine-beyssen.png", "2002-04-06", 184, 74, "DH", "Actif"),
("B3456789", "Princeau", "Matthieu", "matthieu-princeau.png", "1998-02-15", 172, 70, "CT", "Actif");

DELETE * FROM players;

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
("2020-12-16", "14:39:00", "Ta mere", "Stade de France", 9, 8),
("2020-12-15", "18:00:00", "Ton pere", "Stade de France", 6, 9),
("2020-12-31", "18:00:00", "Ton pere", "Stade de France", -1, -1),
("2020-12-17", "18:00:00", "Ton pere", "Stade de France", -1, -1)
;