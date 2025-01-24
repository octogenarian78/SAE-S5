DROP DATABASE GestionCalculs;
CREATE DATABASE IF NOT EXISTS GestionCalculs;
USE GestionCalculs;

-- Création de la table Utilisateurs
CREATE TABLE Utilisateurs (
    util_id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(255) NOT NULL,
    mdp VARCHAR(255) NOT NULL,
    admin BOOLEAN NOT NULL DEFAULT FALSE
);

-- Création de la table Programmes
CREATE TABLE Programmes (
    prog_id INT AUTO_INCREMENT PRIMARY KEY,
    nom_programme TEXT NOT NULL,
    chemin_acces TEXT NOT NULL,
    fonction_entree TEXT NOT NULL -- Chemin d'accès à la fonction de lancement
);

-- Création de la table Calculs
CREATE TABLE Calculs (
    calc_id INT AUTO_INCREMENT PRIMARY KEY,
    util_id INT NOT NULL,
    prog_id INT NOT NULL,
    epingle BOOLEAN NOT NULL DEFAULT FALSE,
    entree TEXT,
    sortie TEXT,
    tps_calcul VARCHAR(20), 
    date DATE NOT NULL DEFAULT CURRENT_DATE,
    FOREIGN KEY (util_id) REFERENCES Utilisateurs(util_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (prog_id) REFERENCES Programmes(prog_id)
        ON UPDATE CASCADE
);

INSERT INTO `Programmes` (`prog_id`, `nom_programme`, `chemin_acces`, `fonction_entree`) 
VALUES (NULL, 'Nombres Premiers', 'src/cluster-prime-master/prime.py', ''), (NULL, 'Monte Carlo', 'src/MPI_MC/MonteCarlo.py', '');