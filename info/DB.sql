CREATE TABLE Utente (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(50),
    cognome VARCHAR(50),
	email VARCHAR(50) UNIQUE,
    eta date,
	password VARCHAR(64),
	classe VARCHAR(2),
	username VARCHAR(50),
	data_n DATETIME
);
CREATE TABLE Categoria (
	id INT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(50)
);
CREATE TABLE Foto(
	url_foto VARCHAR(50) PRIMARY KEY,
	idAnnuncio INT
);
CREATE TABLE Annuncio (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idUtente INT,
    idCategoria INT,
    urlFoto VARCHAR(50),
    FOREIGN KEY (idUtente) REFERENCES Utente(id) ON DELETE CASCADE,
    FOREIGN KEY (idCategoria) REFERENCES Categoria(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (urlFoto) REFERENCES Foto(url_foto) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Proposta (
    id INT PRIMARY KEY AUTO_INCREMENT,
    prezzo INT,
    data_pubblicazione DATETIME,
    stato BOOLEAN,
    idAnnuncio INT,
    idUtente INT,
    FOREIGN KEY (idAnnuncio) REFERENCES Annuncio(id) ON DELETE CASCADE,
    FOREIGN KEY (idUtente) REFERENCES Utente(id) ON DELETE CASCADE
);

ALTER TABLE Foto
	ADD FOREIGN KEY (idAnnuncio) REFERENCES Annuncio(id) 
		ON DELETE CASCADE 
		ON UPDATE CASCADE;
