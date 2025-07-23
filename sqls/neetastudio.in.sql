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

---
--- Add User
---

SHOW GRANTS FOR 'neetastudio'@'%';

---
--- mysql --user=root --password=p@SSW0rd --host=mysqlserver.sandbox.net --database=NEETASTUDIO
--- mysql --user=neetastudio --password=Accoo7@k47 --host=mysqlserver.sandbox.net --database=NEETASTUDIO
---

---
---
---
create database IF NOT EXISTS NEETASTUDIO;

USE NEETASTUDIO;

show tables;

---
--- PARTNER_COLLABORATION
---

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

DELIMITER $$

DROP PROCEDURE IF EXISTS proc_add_partner_collaboration$$
CREATE PROCEDURE proc_add_partner_collaboration(
    input_name VARCHAR(256), 
    input_email VARCHAR(64), 
    input_phone VARCHAR(16),
    input_stype VARCHAR(16),
    input_message VARCHAR(512),   
    OUT out_code INT,
    OUT out_message VARCHAR(256)
)
BEGIN
    
    INSERT INTO `NEETASTUDIO`.`PARTNER_COLLABORATION` (`NAME`, `EMAIL`, `PHONE`, `SERVICE`, `MESSAGE`, `ADD_TS`) VALUES
    (input_name, input_email, input_phone, input_stype, input_message, now());

    SET @code = SQRT(2);
    SET out_code = (SELECT last_insert_id());
    SET out_message= 'Recodred successfully added.';

END$$

DELIMITER ;

SET @code = 0;
SET @message = "";
call proc_add_partner_collaboration(
    'Tejas D.', 
    'tejasdhaker@gmail.com', 
    '+91 9820937445', 
    'props-rental', 
    'We want to collaborate for our services.', 
    @code, 
    @message
);

SELECT @code,@message ;

----
---- CUSTOMER_ENQUIRIES
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

DELIMITER $$

DROP PROCEDURE IF EXISTS proc_add_customer_enquiry$$
CREATE PROCEDURE proc_add_customer_enquiry(
    input_name VARCHAR(256), 
    input_email VARCHAR(64), 
    input_phone VARCHAR(16),
    input_stype VARCHAR(16),
    input_message VARCHAR(512),   
    OUT out_code INT,
    OUT out_message VARCHAR(256)
)
BEGIN
    
    INSERT INTO `NEETASTUDIO`.`CUSTOMER_ENQUIRIES` (`NAME`, `EMAIL`, `PHONE`, `SESSION_TYPE`, `MESSAGE`, `ADD_TS`) VALUES
    (input_name, input_email, input_phone, input_stype, input_message, now());

    SET @code = SQRT(2);
    SET out_code = (SELECT last_insert_id());
    SET out_message= 'Recodred successfully added.';

END$$

DELIMITER ;

SET @code = 0;
SET @message = "";
call proc_add_customer_enquiry(
    'Tejas D.', 
    'tejasdhaker@gmail.com', 
    '+91 9820937445', 
    'maternity', 
    'I am looking for maternity photoshoot', 
    @code, 
    @message
);

SELECT @code,@message ;

----
---- CUSTOMER_SUBSCRIPTIONS
----

CREATE TABLE `NEETASTUDIO`.`CUSTOMER_SUBSCRIPTIONS`(
    `ID` MEDIUMINT NOT NULL AUTO_INCREMENT,
    `NAME` VARCHAR(255) NOT NULL,
    `EMAIL` VARCHAR(64) NOT NULL,
    `PHONE` VARCHAR(16) NOT NULL,
    `INTERSET_TYPE` VARCHAR(16) NOT NULL,
    `MESSAGE` VARCHAR(512),
    `ADD_TS` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`ID`)
);

INSERT INTO `NEETASTUDIO`.`CUSTOMER_SUBSCRIPTIONS` (`NAME`, `EMAIL`, `PHONE`, `INTERSET_TYPE`, `MESSAGE`, `ADD_TS`) VALUES
    ('Deepika D.', 'deepikadhaker@gmail.com', '+91 9820937445', 'maternity', 'I am looking for maternity photoshoot', now()),
    ('Swati R.', 'swatir@gmail.com', '+91 9820937448', 'kids', 'I am looking for kid photography', now());

select * from `NEETASTUDIO`.`CUSTOMER_SUBSCRIPTIONS`;

----

DELIMITER $$

DROP PROCEDURE IF EXISTS proc_add_customer_subscription$$
CREATE PROCEDURE proc_add_customer_subscription(
    input_name VARCHAR(256), 
    input_email VARCHAR(64), 
    input_phone VARCHAR(16),
    input_interest VARCHAR(16),
    input_message VARCHAR(512),   
    OUT out_code INT,
    OUT out_message VARCHAR(256)
)
BEGIN
    
    INSERT INTO `NEETASTUDIO`.`CUSTOMER_SUBSCRIPTIONS` (`NAME`, `EMAIL`, `PHONE`, `INTERSET_TYPE`, `MESSAGE`, `ADD_TS`) VALUES
    (input_name, input_email, input_phone, input_interest, input_message, now());

    SET @code = SQRT(2);
    SET out_code = (SELECT last_insert_id());
    SET out_message= 'Recodred successfully added.';

END$$

DELIMITER ;

SET @code = 0;
SET @message = "";
call proc_add_customer_subscription(
    'Tejas D.', 
    'tejasdhaker@gmail.com', 
    '+91 9820937445', 
    'maternity', 
    'I am looking for maternity news letters', 
    @code, 
    @message
);

SELECT @code,@message ;