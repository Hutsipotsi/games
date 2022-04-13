CREATE TABLE istunto_kayttaja (
id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
tunnus varchar(15) NOT NULL,
salasana varchar(150) NOT NULL,
email varchar(35) DEFAULT NULL,
admin varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_sv_0900_ai_ci
