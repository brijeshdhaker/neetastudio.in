/**
 * Author:  Brijesh K. Dhaker
 * Created: Jul 23, 2025
 */

---
--- Add User
---
CREATE USER 'neetastudio'@'%' IDENTIFIED BY 'Accoo7@k47';
GRANT CREATE, ALTER, DROP, INSERT, UPDATE, DELETE, SELECT, REFERENCES, RELOAD on *.* TO 'neetastudio'@'%' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'neetastudio'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;

SHOW GRANTS FOR 'neetastudio'@'%';

---
---
---
create database NEETASTUDIO;

USE NEETASTUDIO;

show tables;

commit;

---
--- mysql --user=root --password=p@SSW0rd --host=mysqlserver.sandbox.net --database=SANDBOXDB
--- mysql --user=brijeshdhaker --password=Accoo7@k47 --host=mysqlserver.sandbox.net --database=SANDBOXDB
---

USE NEETASTUDIO;

CREATE TABLE `NEETASTUDIO`.`PARTNER_COLLABORATION`(
    `ID` MEDIUMINT NOT NULL AUTO_INCREMENT,
    `NAME` VARCHAR(255) NOT NULL,
    `EMAIL` VARCHAR(64) NOT NULL,
    `PHONE` VARCHAR(16) NOT NULL,
    `SERVICE` VARCHAR(16) NOT NULL,
    `MESSAGE` VARCHAR(512),
    `ADD_TS` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`ID`)
);

INSERT INTO `NEETASTUDIO`.`PARTNER_COLLABORATION` (`NAME`, `EMAIL`, `PHONE`, `SERVICE`, `MESSAGE`, `ADD_TS`) VALUES
    ('Brijesh D.', 'brijeshdhaker@gmail.com', '+91 9820937445', 'photographer', 'I am looking for collaboration', now()),
    ('Neeta D.', 'neetadhk@gmail.com', '+91 9820937448', 'photographer', 'I am looking for collaboration', now());

select * from `NEETASTUDIO`.`PARTNER_COLLABORATION`;

----
----
----
----

CREATE TABLE `NEETASTUDIO`.`CUSTOMER_ENQUIRIES`(
    `ID` MEDIUMINT NOT NULL AUTO_INCREMENT,
    `NAME` VARCHAR(255) NOT NULL,
    `EMAIL` VARCHAR(64) NOT NULL,
    `PHONE` VARCHAR(16) NOT NULL,
    `SESSION_TYPE` VARCHAR(16) NOT NULL,
    `MESSAGE` VARCHAR(512),
    `ADD_TS` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`ID`)
);

INSERT INTO `NEETASTUDIO`.`CUSTOMER_ENQUIRIES` (`NAME`, `EMAIL`, `PHONE`, `SESSION_TYPE`, `MESSAGE`, `ADD_TS`) VALUES
    ('Deepika D.', 'deepikadhaker@gmail.com', '+91 9820937445', 'maternity', 'I am looking for maternity photoshoot', now()),
    ('Swati R.', 'swatir@gmail.com', '+91 9820937448', 'kids', 'I am looking for kid photography', now());

select * from `NEETASTUDIO`.`CUSTOMER_ENQUIRIES`;

----
----
----
----