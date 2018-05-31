CREATE TABLE `school` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `name` varchar(40) NOT NULL
);

INSERT INTO school values(1,"Nome da primeira escola");

ALTER TABLE chegando ADD COLUMN idschool INT(11);
ALTER TABLE chegando ADD FOREIGN KEY (idschool) REFERENCES school(id);
UPDATE chegando SET idschool=1 WHERE 1=1;
ALTER TABLE chegando MODIFY idschool INT(11) NOT NULL;

ALTER TABLE markers ADD COLUMN idschool INT(11);
ALTER TABLE markers ADD FOREIGN KEY (idschool) REFERENCES school(id);
UPDATE markers SET idschool=1 WHERE 1=1;
ALTER TABLE markers MODIFY idschool INT(11) NOT NULL;

ALTER TABLE turma ADD COLUMN idschool INT(11);
ALTER TABLE turma ADD FOREIGN KEY (idschool) REFERENCES school(id);
UPDATE turma SET idschool=1 WHERE 1=1;
ALTER TABLE turma MODIFY idschool INT(11) NOT NULL;

ALTER TABLE user ADD COLUMN idschool INT(11);
ALTER TABLE user ADD FOREIGN KEY (idschool) REFERENCES school(id);
UPDATE user SET idschool=1 WHERE 1=1;
ALTER TABLE user MODIFY idschool INT(11) NOT NULL;

ALTER TABLE user_filhos ADD COLUMN idschool INT(11);
ALTER TABLE user_filhos ADD FOREIGN KEY (idschool) REFERENCES school(id);
UPDATE user_filhos SET idschool=1 WHERE 1=1;
ALTER TABLE user_filhos MODIFY idschool INT(11) NOT NULL;

ALTER TABLE user_filhos_avisos ADD COLUMN idschool INT(11);
ALTER TABLE user_filhos_avisos ADD FOREIGN KEY (idschool) REFERENCES school(id);
UPDATE user_filhos_avisos SET idschool=1 WHERE 1=1;
ALTER TABLE user_filhos_avisos MODIFY idschool INT(11) NOT NULL;

ALTER TABLE user_msg ADD COLUMN idschool INT(11);
ALTER TABLE user_msg ADD FOREIGN KEY (idschool) REFERENCES school(id);
UPDATE user_msg SET idschool=1 WHERE 1=1;
ALTER TABLE user_msg MODIFY idschool INT(11) NOT NULL;

ALTER TABLE user_responsavel ADD COLUMN idschool INT(11);
ALTER TABLE user_responsavel ADD FOREIGN KEY (idschool) REFERENCES school(id);
UPDATE user_responsavel SET idschool=1 WHERE 1=1;
ALTER TABLE user_responsavel MODIFY idschool INT(11) NOT NULL;