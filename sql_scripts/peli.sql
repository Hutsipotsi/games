CREATE TABLE peli (
id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
nimi varchar(50) NOT NULL,
ikasuositus int NOT NULL,
konsolitunniste int NOT NULL,
FOREIGN KEY (konsolitunniste) REFERENCES konsolitunniste(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_sv_0900_ai_ci