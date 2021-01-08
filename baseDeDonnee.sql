-- Utilisateurs
CREATE TABLE users(
    id_users INT PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    username VARCHAR(20) COLLATE utf8_bin NOT NULL ,
    password VARCHAR(50) COLLATE utf8_bin NOT NULL 
);

INSERT INTO users(username, password) VALUES("root", "root");


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


CREATE TABLE participant(
    Id_rencontre INT NOT NULL AUTO_INCREMENT,
    numLicence CHAR(10),
    Position VARCHAR(50),
    Commentaire TEXT,
    Note TINYINT,
    Titulaire BOOLEAN,
    PRIMARY KEY(Id_rencontre, numLicence),
    FOREIGN KEY(Id_rencontre) REFERENCES rencontre(Id_rencontre),
    FOREIGN KEY(numLicence) REFERENCES players(numLicence)
);