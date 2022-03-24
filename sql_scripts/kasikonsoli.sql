CREATE TABLE kasikonsoli (
id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
valmistaja varchar(25) DEFAULT NULL,
malli varchar(30) DEFAULT NULL,
kpl int DEFAULT NULL,
tunniste int NOT NULL,
vari varchar(20) NOT NULL,
FOREIGN KEY (tunniste) REFERENCES tunniste(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_sv_0900_ai_ci
