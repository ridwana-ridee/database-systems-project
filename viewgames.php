<html>
<head>
    <title>Employee Records</title>
</head>
<body>
    <?php
        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "world-cup-db";

        $conn = new mysqli($host, $user, $pass, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_POST['match_name']) && !empty($_POST['match_name']) &&
            isset($_POST['match_round']) && !empty($_POST['match_round']) &&
            isset($_POST['match_date']) && !empty($_POST['match_date']) &&
            isset($_POST['venue_id']) && !empty($_POST['venue_id'])) {
            
            $match_name = $_POST['match_name'];
            $match_round = $_POST['match_round'];
            $match_date = $_POST['match_date'];
            $venue_id = $_POST['venue_id'];

            $sql = "INSERT INTO game (match_name, match_round, match_date, venue_id)
                    VALUES ('$match_name', '$match_round', '$match_date', '$venue_id')";
            
            if ($conn->query($sql) === TRUE) {
                echo "<h2>Match record inserted successfully</h2>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<h2>Sorry! You didn’t complete the form. Please try again.</h2>";
        }

        echo "<p><a href='Match.html'>Enter new employee.</a></p>";
        echo "<h2>All Match data</h2>";

        $sql = "SELECT * FROM game";
        
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Game ID</th><th>Match Name</th><th>Match Round</th><th>Match Data</th><th>venue_id</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["game_id"] . "</td>";
                echo "<td>" . $row["match_name"] . "</td>";
                echo "<td>" . $row["match_round"] . "</td>";
                echo "<td>" . $row["match_date"] . "</td>";
                echo "<td>" . $row["venue_id"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
</body>
</html>