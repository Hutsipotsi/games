| tunnisteet | 
CREATE TABLE 'tunnisteet' (
'tunniste_id' int NOT NULL AUTO_INCREMENT,
'valmistaja' varchar(25) NOT NULL,
'malli' varchar(30) NOT NULL,
PRIMARY KEY ('tunniste_id')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_sv_0900_ai_ci