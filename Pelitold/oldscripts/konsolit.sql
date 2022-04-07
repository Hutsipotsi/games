CREATE TABLE `konsolit` (
  `konsolit_id` int(2) NOT NULL AUTO_INCREMENT,
  `valmistaja` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `malli` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kpl` int(2) DEFAULT NULL,
  `tunniste` int(2) DEFAULT NULL,
  `vari` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`konsolit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_sv_0900_ai_ci