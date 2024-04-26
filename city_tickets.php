<?php
// Set up database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "world-cup-db";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form handling
$selectedCity = isset($_POST['city']) ? $_POST['city'] : '';

echo '<h1>Select a City to View Available Tickets</h1>';
echo '<form method="post" action="">';
echo '<select name="city">';
echo '<option value="">Select a City</option>';

// Retrieve venue locations from the database
$cityQuery = "SELECT DISTINCT location FROM venue";
$cityResult = $conn->query($cityQuery);
while ($row = $cityResult->fetch_assoc()) {
    $isSelected = ($selectedCity == $row['location']) ? ' selected' : '';
    echo "<option value='{$row['location']}'$isSelected>{$row['location']}</option>";
}
echo '</select>';
echo '<input type="submit" value="Show Tickets">';
echo '</form>';

// Display tickets if a city is selected
if ($selectedCity) {
    // Query to find venue ID for the selected city
    $venueQuery = "SELECT id FROM venue WHERE location = ?";
    $stmt = $conn->prepare($venueQuery);
    $stmt->bind_param("s", $selectedCity);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $venueRow = $result->fetch_assoc();
        $venueId = $venueRow['id'];

        // Query to count available tickets for games in this venue
        $ticketCountQuery = "SELECT COUNT(*) AS available_tickets FROM ticket 
                             WHERE ticket_status = 'available' AND game_id IN (
                                 SELECT id FROM game WHERE venue_id = $venueId
                             )";
        $countResult = $conn->query($ticketCountQuery);

        if ($countResult->num_rows > 0) {
            $countRow = $countResult->fetch_assoc();
            echo "<p>Available Tickets in " . htmlspecialchars($selectedCity) . ": " . $countRow['available_tickets'] . "</p>";
        }

        // Query to display tickets for games in this venue
        $ticketsQuery = "SELECT * FROM ticket WHERE game_id IN (
                            SELECT id FROM game WHERE venue_id = $venueId
                         )";
        $ticketsResult = $conn->query($ticketsQuery);

        if ($ticketsResult->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Type</th><th>Price</th><th>Status</th></tr>";
            while ($ticket = $ticketsResult->fetch_assoc()) {
                echo "<tr>
                        <td>" . $ticket['id'] . "</td>
                        <td>" . $ticket['ticket_type'] . "</td>
                        <td>" . $ticket['price'] . "</td>
                        <td>" . $ticket['ticket_status'] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No tickets found for games in " . htmlspecialchars($selectedCity) . ".</p>";
        }
    } else {
        echo "<p>No venue found for " . htmlspecialchars($selectedCity) . ".</p>";
    }
}

// Close the connection
$conn->close();
?>
