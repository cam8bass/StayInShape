# Database

Database initialisation


## Create table "user"

```bash
CREATE TABLE `your database name`.`user` (
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
```

## Create table "session"

```bash
CREATE TABLE `your database name`.`session` (
`idSession` CHAR(64) NOT NULL,
`idUser` INT NOT NULL,
PRIMARY KEY (`idSession`));
```

#### Create timestamp

```bash
ALTER TABLE yourDatabaseName.session ADD createdAt timestamp DEFAULT CURRENT_TIMESTAMP
CREATE EVENT ClearExpiredSessions
ON SCHEDULE EVERY 1 DAY
COMMENT 'Nettoie la table session tous les jours'
DO
DELETE FROM yourDatabaseName.session WHERE DATE_ADD(createdAt, INTERVAL 2 WEEK) < NOW();
```

## Create table "partner"

```bash
CREATE TABLE `yourDatabaseName`.`partner` (
`idPartner` INT NOT NULL AUTO_INCREMENT,
`franchiseName` VARCHAR(255) NOT NULL,
`attachedClub` LONGTEXT NULL,
`img` VARCHAR(255) NULL,
`description` LONGTEXT NULL,
PRIMARY KEY (`idPartner`));
```

#### Add foreign KEY

```bash
ALTER TABLE `yourDatabaseName`.`partner`
ADD CONSTRAINT `fk_partner_user`
FOREIGN KEY (`idPartner`)
REFERENCES `yourDatabaseName`.`user` (`id`)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
```

## Create table "club"

```bash
CREATE TABLE `yourDatabaseName`.`club` (
`idClub` INT NOT NULL,
`idPermission` INT NOT NULL,
`idPartnerParent` INT NOT NULL,
`clubName` VARCHAR(255) NOT NULL,
`nameFranchiseOwner` VARCHAR(255) NOT NULL,
`img` VARCHAR(255) NULL,
`description` LONGTEXT NULL,
`numActive` VARCHAR(255) NOT NULL,
PRIMARY KEY (`idClub`));
```

#### Add foreign KEY

```bash
ALTER TABLE `yourDatabaseName`.`club`
ADD CONSTRAINT `fk_club_user`
FOREIGN KEY (`idClub`)
REFERENCES `yourDatabaseName`.`user` (`id`)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
```