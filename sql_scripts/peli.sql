CREATE TABLE peli (
id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
nimi varchar(50) NOT NULL,
tyylilaji varchar(70) NOT NULL,
ikasuositus int NOT NULL,
tunniste int NOT NULL,
FOREIGN KEY (tunniste) REFERENCES tunniste(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_sv_0900_ai_ci