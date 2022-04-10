CREATE TABLE konsolitunniste (
id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
valmistaja varchar(25) NOT NULL,
malli varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_sv_0900_ai_ci;

INSERT INTO konsolitunniste (id,  valmistaja, malli) VALUES
(1, 'Sega', 'Mega Drive II'),
(2, 'Nintendo', '8-bit (NES)'),
(3, 'Nintendo', 'SNES'),
(4, 'Nintendo', 'N64'),
(5, 'Nintendo', 'GameCube'),
(6, 'Nintendo', 'Wii'),
(7, 'Sony', 'PlayStation'),
(8, 'Sony', 'PlayStation One'),
(9, 'Sony', 'PlayStation 2'),
(10, 'Microsoft', 'Xbox'),
(11, 'Microsoft', 'Xbox 360'),
(12, 'PC', 'PC'),
(13, 'PC/MAC', 'PC/MAC'),
(14, 'Nintendo', 'Game Boy Pocket'),
(15, 'Nintendo', 'Game Boy Color'),
(16, 'Nintendo', 'Game Boy Advance'),
(17, 'Nintendo', 'Game Boy Micro'),
(18, 'Nintendo', 'Game Boy Advance SP Groudon'),
(19, 'Nintendo', 'DS Lite'),
(20, 'Nintendo', 'DS Guitar Hero: On Tour'),
(21, 'Sony', 'PlayStation 3'),
(22, 'Sony', 'PSP-E1000'),
(23, 'Sony', 'PlayStation 4 Pro');