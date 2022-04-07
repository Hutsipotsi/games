/*CREATE TABLE yhdistelmagenre (
id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
genre_id int NOT NULL,
peli_id int NOT NULL,
FOREIGN KEY (peli_id) REFERENCES peli(id),
FOREIGN KEY (genre_id) REFERENCES genre(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_sv_0900_ai_ci
*/


CREATE TABLE yhdistelmagenre (
genre_id int NOT NULL REFERENCES peli(id),
peli_id int NOT NULL REFERENCES genre(id),
PRIMARY KEY (genre_id, peli_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_sv_0900_ai_ci