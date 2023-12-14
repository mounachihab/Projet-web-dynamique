CREATE TABLE formations (
    NumFormations INT PRIMARY KEY AUTO_INCREMENT,
    ID INT,
    Lieu VARCHAR(255),
    competence VARCHAR(255),
    domaine VARCHAR(255),
    dateDebut DATE,
    dateFin DATE,
    FOREIGN KEY (ID) REFERENCES utilisateurs(ID)
);

CREATE TABLE projets (
    NumProjet INT PRIMARY KEY AUTO_INCREMENT,
    ID INT,
    Lieu VARCHAR(255),
    competence VARCHAR(255),
    domaine VARCHAR(255),
    dateDebut DATE,
    dateFin DATE,
    FOREIGN KEY (ID) REFERENCES utilisateurs(ID)
);
