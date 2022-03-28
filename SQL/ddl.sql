DROP DATABASE IF EXISTS RandoAddict;
CREATE DATABASE IF NOT EXISTS RandoAddict;

USE RandoAddict;

DROP TABLE IF EXISTS Necessaire;
DROP TABLE IF EXISTS Participation;
DROP TABLE IF EXISTS Correspondance_Type;
DROP TABLE IF EXISTS Escale;
DROP TABLE IF EXISTS Traversee;
DROP TABLE IF EXISTS Photo;
DROP TABLE IF EXISTS Type;
DROP TABLE IF EXISTS Materiel;
DROP TABLE IF EXISTS Terrain;
DROP TABLE IF EXISTS Marcheur;
DROP TABLE IF EXISTS Programme;
DROP TABLE IF EXISTS Excursion;



CREATE TABLE IF NOT EXISTS Excursion(
	idExcursion int not null primary key auto_increment,
	labelExcursion varchar(128) not null,
	descExcursion text not null,
	departExcursion text not null,
	arriveeExcursion text not null,
	prixExcursion decimal not null CHECK(
		prixExcursion >= 0
	)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


CREATE TABLE IF NOT EXISTS Programme(
	idProgramme int not null primary key auto_increment,
	labelProgramme varchar(128) not null,
	descProgramme text not null,
	dateDepartProgramme datetime not null,
	dateArriveeProgramme datetime not null,
	capaciteProgramme int not null CHECK(
		capaciteProgramme > 0
	),
	difficulteProgramme int not null CHECK(
		difficulteProgramme > 0
		AND
		difficulteProgramme < 10
	),
	valideProgramme varchar(32) not null CHECK(
		valideProgramme = 'En attente'
		OR
		valideProgramme = 'Valide'
		OR
		valideProgramme = 'Annule'
		OR
		valideProgramme = 'Termine'
	)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


CREATE TABLE IF NOT EXISTS Marcheur(
	mailMarcheur varchar(320) not null primary key,
	pseudoMarcheur varchar(128) not null,
	telMarcheur varchar(12) not null,
	mdpMarcheur varchar(128) not null,
	roleMarcheur varchar(128) not null CHECK (
		roleMarcheur = 'Marcheur'
		OR
		roleMarcheur = 'Guide'
	)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


CREATE TABLE IF NOT EXISTS Terrain(
	labelTerrain varchar(128) not null primary key,
	descTerrain text not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


CREATE TABLE IF NOT EXISTS Materiel(
	labelMateriel varchar(128) not null primary key,
	descMateriel text not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


CREATE TABLE IF NOT EXISTS Type(
	labelType varchar(128) not null primary key,
	descType text not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


CREATE TABLE IF NOT EXISTS Photo(
	idPhoto int not null primary key auto_increment,
	lienPhoto varchar(256) not null,
	labelPhoto varchar(128) not null,
	idExcursion int not null,
	CONSTRAINT fk_PhotoExcursion FOREIGN KEY(idExcursion) REFERENCES Excursion(idExcursion)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


DROP TABLE IF EXISTS Necessaire;
DROP TABLE IF EXISTS Participation;
DROP TABLE IF EXISTS Correspondance_Type;
DROP TABLE IF EXISTS Escale;


CREATE TABLE IF NOT EXISTS Traversee(
	idExcursion int not null,
	labelTerrain varchar(128) not null,
	CONSTRAINT pk_Traversee PRIMARY KEY(idExcursion, labelTerrain),
	CONSTRAINT fk_TraverseeExcursion FOREIGN KEY(idExcursion) REFERENCES Excursion(idExcursion),
	CONSTRAINT fk_TraverseeTerrain FOREIGN KEY(labelTerrain) REFERENCES Terrain(labelTerrain)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


CREATE TABLE IF NOT EXISTS Escale(
	idExcursion int not null,
	idProgramme int not null,
	CONSTRAINT pk_Escale PRIMARY KEY(idExcursion, idProgramme),
	CONSTRAINT fk_EscaleExcursion FOREIGN KEY(idExcursion) REFERENCES Excursion(idExcursion),
	CONSTRAINT fk_EscaleProgramme FOREIGN KEY(idProgramme) REFERENCES Programme(idProgramme)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


CREATE TABLE IF NOT EXISTS Correspondance_Type(
	idProgramme int not null,
	labelType varchar(128) not null,
	CONSTRAINT pk_CorresType PRIMARY KEY(idProgramme, labelType),
	CONSTRAINT fk_CorresTypeProgramme FOREIGN KEY(idProgramme) REFERENCES Programme(idProgramme),
	CONSTRAINT fk_CorresTypeType FOREIGN KEY(labelType) REFERENCES Type(labelType)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


CREATE TABLE IF NOT EXISTS Participation(
	idProgramme int not null,
	mailMarcheur varchar(320) not null,
	roleMarcheur varchar(128) not null CHECK(
		roleMarcheur = 'Marcheur'
		OR
		roleMarcheur = 'Guide'
	),
	CONSTRAINT pk_Participation PRIMARY KEY(idProgramme, mailMarcheur),
	CONSTRAINT fk_ParticipationProgramme FOREIGN KEY(idProgramme) REFERENCES Programme(idProgramme),
	CONSTRAINT fk_ParticipationMarcheur FOREIGN KEY(mailMarcheur) REFERENCES Marcheur(mailMarcheur)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


CREATE TABLE IF NOT EXISTS Necessaire(
	idProgramme int not null,
	labelMateriel int not null,
	CONSTRAINT pk_Necessaire PRIMARY KEY(idProgramme, labelMateriel),
	CONSTRAINT fk_NecessaireProgramme FOREIGN KEY(idProgramme) REFERENCES Programme(idProgramme),
	CONSTRAINT fk_NecessaireMateriel FOREIGN KEY(labelMateriel) REFERENCES Materiel(labelMateriel)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;