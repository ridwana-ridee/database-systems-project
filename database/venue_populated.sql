USE `world-cup-db`;

INSERT INTO venue (venue_name, location, capacity)
VALUES ('BMO Field', 'Toronto, Ontario, Canada', 45000),
('BC Place','Vancouver, British Colombia, Canada', 54000),
('Estadio Azteca','Mexico City, Mexico', 83000),
('Estadio Akron','Zapopan, Jalisco, Mexico', 48000),
('Estadio BBVA','Guadalupe, Nuevo Leon, Mexico', 53500),
('Mercedes-Benz Stadium','Atlanta, Georgia, USA', 75000),
('Gillette Stadium','Foxborough, Massachusetts, USA', 65000),
('AT&T Stadium','Arlington, Texas, USA', 94000),
('NRG Stadium','Houston, Texas, USA', 72000),
('Arrowhead Stadium','Kansas City, Missouri, USA', 73000),
('SoFi Stadium','Inglewood, California, USA', 70000),
('Hard Rock Stadium','Miami Gardens, Florida, USA', 65000),
('MetLife Stadium','East Rutherford, New Jersey, USA', 82500),
('Lincoln Financial Field','Philadelphia, Pennsylvania, USA', 69000),
("Levi's Stadium",'Santa Clara, California, USA', 71000),
('Lumen Field','Seattle, Washington, USA', 69000);

SELECT * FROM venue;
