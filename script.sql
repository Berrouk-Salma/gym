CREATE DATABASE GYM;

USE GYM;

CREATE TABLE membres (
    idMembre int not null PRIMARY KEY,
    nom varchar(50),
    prenom varchar(50),
    Email varchar(100),
    telephone varchar(15)
);

CREATE TABLE activite (
    idActivite int not null PRIMARY KEY,
    nom varchar(50),
    description text,
    capacite int,
    date_Debut date,
    date_fin date,
    Disponiblite tinyint
);

CREATE TABLE reservation (
    idReservation int not null PRIMARY KEY,
    idMembre int,
    idActivite int,
    date_reservation timestamp,
    STATUS ENUM(
        "confirme",
        "En attent",
        "Anuller"
    ),
    FOREIGN KEY (idMembre) REFERENCES membres (idMembre),
    FOREIGN KEY (idActivite) REFERENCES activite (idActivite)
);
CREATE DATABASE GYM_1;
USE GYM_1;

CREATE TABLE membres(
    idMembre int not null PRIMARY KEY,
    nom varchar(50),
    prenom varchar(50),
    Email varchar(100),
    telephone varchar(15)
);



 INSERT INTO
     membres (Nom, Prenom, Telephone, Email)
VALUES (
        'amina',
        'berr',
        '212-636-253939',
        'aminaberr1@gmail.com'     );

INSERT INTO
    activite (Nom, Description,capacite,date_Debut,date_fin,Disponiblite)
VALUES (
        'Yoga',
        'A relaxing activity focusing on stretching and mindfulness.',
    	12,
    	'2024-12-10',
    	'2024-12-29',
    	10
    );
INSERT INTO
    reservation (
        idMembre,
        idActivite,
        date_reservation,
        STATUS
    )
VALUES (1, 1, '2024-12-15 09:00:00','Anuller');


UPDATE membres
SET nom = 'John', prenom = 'Doe', Email = 'john.doe@example.com', telephone = '1234567890'
WHERE idMembre = 1;

DELETE FROM membres WHERE idMembre = 2;

UPDATE activite
SET nom = 'Yoga', description = 'A relaxing yoga class', capacite = 30, date_Debut = '2024-01-01', date_fin = '2024-12-31', Disponiblite = 1, location = 'Room 101'
WHERE idActivite = 1;


DELETE FROM activite WHERE idActivite = 3;



ALTER TABLE reservation ADD payment_status ENUM('paid', 'unpaid') DEFAULT 'unpaid';


UPDATE reservation
SET STATUS = 'confirme', payment_status = 'paid'
WHERE idReservation = 1;

DELETE FROM reservation WHERE idReservation = 2;

SELECT r.idReservation, m.nom, m.prenom, a.nom AS activite, r.date_reservation, r.STATUS
FROM
    reservation r
    JOIN membres m ON r.idMembre = m.idMembre
    JOIN activite a ON r.idActivite = a.idActivite
ORDER BY r.date_reservation;