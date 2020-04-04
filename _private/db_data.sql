CREATE TABLE Carte(
   id_carte INT AUTO_INCREMENT PRIMARY KEY,
   type ENUM('white', 'black1', 'black2') NOT NULL,
   content VARCHAR(255) NOT NULL
);

CREATE TABLE Salon(
   id_salon INT AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(50) NOT NULL,
   id_carte INT REFERENCES Carte(id_carte)
);

CREATE TABLE Joueur(
   id_joueur INT AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(50) NOT NULL,
   pass VARCHAR(50) NOT NULL,
   id_salon INT REFERENCES Salon(id_salon)
);

CREATE TABLE posseder(
   id_joueur INT REFERENCES Joueur(id_joueur),
   id_carte INT REFERENCES Carte(id_carte),
   PRIMARY KEY(id_joueur, id_carte),
   isSelected BOOLEAN NOT NULL
);
