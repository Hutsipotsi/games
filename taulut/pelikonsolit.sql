CREATE TABLE pelikonsoli (
id int NOT NULL AUTO_INCREMENT,
tunniste int NOT NULL,
valmistaja varchar(25) NOT NULL,
malli varchar(25) NOT NULL,
kpl int NOT NULL,
vari varchar(55) NOT NULL,
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_sv_0900_ai_ci
