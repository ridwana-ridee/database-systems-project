<?php
// Database configuration
require 'db_config.php';

// Fetch all cities from the venue table for the dropdown
$citiesQuery = "SELECT DISTINCT location FROM venue ORDER BY location";
$citiesResult = $conn->query($citiesQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select a City</title>
</head>
<body>
    <h1>Select a City to View Available Tickets</h1>
    <form method="POST">
        <label for="city">Choose a city:</label>
        <select name="city" id="city">
            <?php
            if ($citiesResult->num_rows > 0) {
                while ($row = $citiesResult->fetch_assoc()) {
                    echo "<option value=\"" . htmlspecialchars($row['location']) . "\">" . htmlspecialchars($row['location']) . "</option>";
                }
            } else {
                echo "<option>No cities available</option>";
            }
            ?>
        </select>
        <button type="submit" name="submit">Check Tickets</button>
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $selectedCity = $conn->real_escape_string($_POST['city']);

    // Query to find games in the selected city
    $gamesInCityQuery = "SELECT id FROM game WHERE venue_id IN (SELECT id FROM venue WHERE location = '$selectedCity')";

    // Execute the query
    $result = $conn->query($gamesInCityQuery);

    // Collect game IDs
    $gameIds = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $gameIds[] = $row['id'];
        }
    } else {
        echo "No games found in $selectedCity.<br>";
    }

    if (count($gameIds) > 0) {
        // Convert game IDs array into a string for the IN clause
        $gameIdsString = implode(',', $gameIds);

        // Query to count available tickets for these games
        $ticketCountQuery = "SELECT COUNT(*) as availableTickets FROM ticket WHERE ticket_status = 'Available' AND game_id IN ($gameIdsString)";
        $countResult = $conn->query($ticketCountQuery);
        $availableTickets = $countResult->fetch_assoc();

        // Display the number of available tickets
        echo "Number of available tickets for games in $selectedCity: " . $availableTickets['availableTickets'] . "<br>";

        // Query to display tickets for these games
        $ticketsQuery = "SELECT * FROM ticket WHERE game_id IN ($gameIdsString)";
        $ticketsResult = $conn->query($ticketsQuery);

        // Check and display the ticket details
        if ($ticketsResult->num_rows > 0) {
            echo "<table border='1'><tr><th>ID</th><th>Type</th><th>Price</th><th>Status</th></tr>";
            while ($ticket = $ticketsResult->fetch_assoc()) {
                echo "<tr><td>" . $ticket['id'] . "</td><td>" . $ticket['ticket_type'] . "</td><td>" . $ticket['price'] . "</td><td>" . $ticket['ticket_status'] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No tickets available for games in $selectedCity.";
        }
    }
}

// Close connection
$conn->close();
?>

</body>
</html>
