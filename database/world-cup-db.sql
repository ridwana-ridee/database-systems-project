-- create database
DROP DATABASE IF EXISTS `world-cup-db`;
CREATE DATABASE `world-cup-db`;
USE `world-cup-db`;

-- create tables
CREATE TABLE venue(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
venue_name VARCHAR(100),
location VARCHAR(100),
capacity INT);

-- renamed 'match' entity to 'game'
/* 
added match_name column to specify
whcih teams are playing i.e. "Brazil v Argentina"

added 'match_round' column to specify
what stage the match is for i.e.
group stage, knockouts, quarter-final, 
semi-final, play-off for 3rd place, or final
*/
CREATE TABLE game(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
match_name VARCHAR(100),
match_round VARCHAR(50),
match_date DATE);

CREATE TABLE ticket(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
ticket_type VARCHAR(100),
price DECIMAL(10,2),
ticket_status VARCHAR(50));

CREATE TABLE accommodation (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    hotel_name VARCHAR(100),
    location VARCHAR(100),
    room_type VARCHAR(50)
);

CREATE TABLE transportation (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    transport_type VARCHAR(100),
    location VARCHAR(100),
    availability VARCHAR(100)
);

-- create relationships between tables

/* one-to-many relationship 
   venue and game
   one venue hosts many matches */
ALTER TABLE game
ADD COLUMN venue_id INT,
ADD CONSTRAINT fk_game_venue
FOREIGN KEY (venue_id) REFERENCES venue(id);

/* one-to-many relationship 
   venue and accomodation
   one venue located near many accomodations */
ALTER TABLE accommodation
ADD COLUMN venue_id INT,
ADD CONSTRAINT fk_accommodation_venue
FOREIGN KEY (venue_id) REFERENCES venue(id);

/* one-to-many relationship 
   venue and transportation
   many transport methods commute to one venue */
ALTER TABLE transportation
ADD COLUMN venue_id INT,
ADD CONSTRAINT fk_transportation_venue
FOREIGN KEY (venue_id) REFERENCES venue(id);

/* one-to-many relationship 
   game and ticket
   many tickets provide admission for one game */
ALTER TABLE ticket
ADD COLUMN game_id INT,
ADD CONSTRAINT fk_ticket_game
FOREIGN KEY (game_id) REFERENCES game(id);
