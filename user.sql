USE `world-cup-db`;

CREATE TABLE user(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(100),
pass_word VARCHAR(100),
user_role VARCHAR(50),
fName VARCHAR(100),
lName VARCHAR(100) );

