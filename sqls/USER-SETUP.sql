/**
 * Author:  Brijesh K. Dhaker
 * Created: Jul 23, 2025
 */

---
--- mysql --user=root --password=paSSW0rd --host=mysqlserver.sandbox.net
---

create database IF NOT EXISTS NEETASTUDIO;


---
--- Add User
---
CREATE USER 'neetastudio'@'%' IDENTIFIED BY 'paSSW0rd';
GRANT CREATE, ALTER, DROP, INSERT, UPDATE, DELETE, SELECT, REFERENCES, RELOAD on *.* TO 'neetastudio'@'%' WITH GRANT OPTION;
REVOKE ALL PRIVILEGES, GRANT OPTION FROM 'neetastudio'@'%';
GRANT ALL PRIVILEGES ON *.* TO 'neetastudio'@'%' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON NEETASTUDIO.* TO 'neetastudio'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;

SHOW GRANTS FOR 'neetastudio'@'%';

---
--- Validate User
---
--- mysql --user=neetastudio --password=paSSW0rd --host=mysqlserver.sandbox.net --database=NEETASTUDIO
---

USE NEETASTUDIO;
show tables;
