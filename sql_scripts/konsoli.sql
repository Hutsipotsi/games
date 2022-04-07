CREATE TABLE konsoli (
id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
konsolitunniste int NOT NULL,
kpl int NOT NULL,
vari varchar(55) NOT NULL,
FOREIGN KEY (konsolitunniste) REFERENCES konsolitunniste(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_sv_0900_ai_ci