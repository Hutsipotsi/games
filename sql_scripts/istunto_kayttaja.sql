drop table if exists istunto_kayttaja;
CREATE TABLE istunto_kayttaja (
id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
tunnus varchar(150) NOT NULL,
email varchar(35) DEFAULT NULL,
oikat VARCHAR(150) NOT NULL,
password varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_sv_0900_ai_ci
