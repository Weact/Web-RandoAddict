ALTER TABLE ESCALE
ADD CONSTRAINT FK_EP FOREIGN KEY(idProgramme)
REFERENCES PROGRAMME (idProgramme) 
ON DELETE CASCADE 