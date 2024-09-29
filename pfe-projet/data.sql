CREATE TABLE `dossiermed` (
  `id_dossier` int(11) NOT NULL AUTO_INCREMENT,
  `id_pat` int(11)NOT NULL,
  `id_doct` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp(),
  `consultation` text(500) NOT NULL,
  PRIMARY KEY (`id_dossier`),
  CONSTRAINT FK_patient FOREIGN KEY (id_pat) REFERENCES patientmed(id_patient),
  CONSTRAINT FK_docteur FOREIGN KEY (id_doct)REFERENCES docteurmed(id_docteur)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4