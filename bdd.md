// === create user table ===

CREATE TABLE `u223495013_stayInShape`.`user` (
`id` INT NOT NULL AUTO_INCREMENT,
`firstName` VARCHAR(45) NOT NULL,
`lastName` VARCHAR(45) NOT NULL,
`email` VARCHAR(255) NOT NULL,
`password` VARCHAR(255) NOT NULL,
`type` VARCHAR(45) NOT NULL,
`status` VARCHAR(45) NOT NULL,
`read` TINYINT NOT NULL,
`write` TINYINT NOT NULL,
`create` TINYINT NOT NULL,
PRIMARY KEY (`id`),
UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE);

// create session table ===

CREATE TABLE `u223495013_stayInShape`.`session` (
`idSession` CHAR(64) NOT NULL,
`idUser` INT NOT NULL,
PRIMARY KEY (`idSession`));

// === add timestamp ===
ALTER TABLE u223495013_stayInShape.session ADD createdAt timestamp DEFAULT CURRENT_TIMESTAMP
CREATE EVENT ClearExpiredSessions
ON SCHEDULE EVERY 1 DAY
COMMENT 'Nettoie la table session tous les jours'
DO
DELETE FROM u223495013_stayInShape.session WHERE DATE_ADD(createdAt, INTERVAL 2 WEEK) < NOW();

// === create table partner ===

CREATE TABLE `u223495013_stayInShape`.`partner` (
`idPartner` INT NOT NULL AUTO_INCREMENT,
`franchiseName` VARCHAR(255) NOT NULL,
`attachedClub` LONGTEXT NULL,
`img` VARCHAR(255) NULL,
`description` LONGTEXT NULL,
PRIMARY KEY (`idPartner`));

// === add foreign key ===
ALTER TABLE `u223495013_stayInShape`.`partner`
ADD CONSTRAINT `fk_partner_user`
FOREIGN KEY (`idPartner`)
REFERENCES `u223495013_stayInShape`.`user` (`id`)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

// === create table club ===

CREATE TABLE `u223495013_stayInShape`.`club` (
`idClub` INT NOT NULL,
`idPermission` INT NOT NULL,
`idPartnerParent` INT NOT NULL,
`clubName` VARCHAR(255) NOT NULL,
`nameFranchiseOwner` VARCHAR(255) NOT NULL,
`img` VARCHAR(255) NULL,
`description` LONGTEXT NULL,
`numActive` VARCHAR(255) NOT NULL,
PRIMARY KEY (`idClub`));

// === add foreign key ===
ALTER TABLE `u223495013_stayInShape`.`club`
ADD CONSTRAINT `fk_club_user`
FOREIGN KEY (`idClub`)
REFERENCES `u223495013_stayInShape`.`user` (`id`)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
