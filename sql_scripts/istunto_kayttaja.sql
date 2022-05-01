CREATE TABLE istunto_kayttaja (
id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
tunnus varchar(150) NOT NULL UNIQUE,
email varchar(35) DEFAULT NULL,
oikat int NOT NULL,
password varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_sv_0900_ai_ci;
