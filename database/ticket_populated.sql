USE `world-cup-db`;

INSERT INTO ticket (ticket_type, price, ticket_status, game_id) VALUES
('Standard', 50.00, 'Available', 1),
('VIP', 150.00, 'Available', 2),
('General Admission', 30.00, 'Sold Out', 3),
('Student Discount', 25.00, 'Available', 4);
