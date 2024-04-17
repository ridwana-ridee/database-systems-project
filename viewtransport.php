<!DOCTYPE html>
<html>
<head>
    <title>Transportation Records</title>
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
        } else {
            echo "connection successful";
        }

        if (isset($_POST['transport_type']) && !empty($_POST['transport_type']) &&
            isset($_POST['location']) && !empty($_POST['location']) &&
            isset($_POST['availability']) && !empty($_POST['availability']) &&
            isset($_POST['venue_id']) && !empty($_POST['venue_id'])) {
            
            $transport_type = $_POST['transport_type'];
            $location = $_POST['location'];
            $availability = $_POST['availability'];
            $venue_id = $_POST['venue_id'];
            

            $sql = "INSERT INTO transportation (transport_type, location, availability, venue_id)
                    VALUES ('$transport_type', '$location', '$availability', '$venue_id')";
            
            if ($conn->query($sql) === TRUE) {
                echo "<h2>Transportation record inserted successfully</h2>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<h2>Sorry! You didn’t complete the form. Please try again.</h2>";
        }

        echo "<p><a href='AddTransport.html'>Enter new transportation.</a></p>";
        echo "<h2>All transportation data</h2>";

        $sql = "SELECT * FROM transportation";
        
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Transport ID</th><th>Transport Type</th><th>Location</th><th>Availability</th><th>v=Venue ID</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["transport_type"] . "</td>";
                echo "<td>" . $row["location"] . "</td>";
                echo "<td>" . $row["availability"] . "</td>";
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
