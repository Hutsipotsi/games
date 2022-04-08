CREATE TABLE pelitback (
pelit_id int NOT NULL AUTO_INCREMENT,
pelin_nimi varchar(50) NOT NULL,
tyylilaji varchar(70) NOT NULL,
ikasuositus int NOT NULL,
tunniste int NOT NULL,
PRIMARY KEY (pelit_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_sv_0900_ai_ci