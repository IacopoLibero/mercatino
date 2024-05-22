CREATE TABLE Utente (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(50),
    cognome VARCHAR(50),
	email VARCHAR(50) UNIQUE,
    eta date,
	password VARCHAR(64),
	classe VARCHAR(2),
	username VARCHAR(50),
    foto_profilo VARCHAR(100) DEFAULT '../img/empty.png',
	data_n DATETIME
);
CREATE TABLE Categoria (
	id INT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(50)
);
CREATE TABLE Foto(
	url_foto VARCHAR(100) PRIMARY KEY,
	idAnnuncio INT
);
CREATE TABLE Annuncio (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idUtente INT,
    nome VARCHAR(50),
    idCategoria INT,
    stato BOOLEAN DEFAULT TRUE,
    descrizione VARCHAR(150),
    FOREIGN KEY (idUtente) REFERENCES Utente(id) ON DELETE CASCADE,
    FOREIGN KEY (idCategoria) REFERENCES Categoria(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Proposta (
    id INT PRIMARY KEY AUTO_INCREMENT,
    prezzo INT,
    data_pubblicazione DATETIME,
    /*statoAnnuncio BOOLEAN,*/
    idAnnuncio INT,
    idUtente INT,
    /*FOREIGN KEY (statoAnnuncio) REFERENCES Annuncio(stato) ON UPDATE CASCADE,*/
    FOREIGN KEY (idAnnuncio) REFERENCES Annuncio(id) ON DELETE CASCADE,
    FOREIGN KEY (idUtente) REFERENCES Utente(id) ON DELETE CASCADE
);

ALTER TABLE Foto
	ADD FOREIGN KEY (idAnnuncio) REFERENCES Annuncio(id) 
		ON DELETE CASCADE 
		ON UPDATE CASCADE;

INSERT INTO Categoria (nome) VALUES ('telefonia'),('videogiochi'),('informatica'),('libri');