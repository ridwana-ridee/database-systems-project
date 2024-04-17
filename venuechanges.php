<html>
<head>
    <title>Venue Records</title>
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

        // Insert functionality
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $venue_name = $_POST['venue_name'];
            $location = $_POST['location'];
            $capacity = $_POST['capacity'];
            
            $sql = "INSERT INTO venue (id, venue_name, location, capacity)
                    VALUES ('$id', '$venue_name', '$location', '$capacity')";
            
            if ($conn->query($sql) === TRUE) {
                echo "<h2>Match record inserted successfully</h2>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Update functionality
        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $venue_name = $_POST['venue_name'];
            $location = $_POST['location'];
            $capacity = $_POST['capacity'];
            
            $sql = "UPDATE venue SET venue_name='$venue_name', location='$location', capacity='$capacity' WHERE id='$id'";
            
            if ($conn->query($sql) === TRUE) {
                echo "<h2>Match record updated successfully</h2>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Delete functionality
        if (isset($_POST['delete'])) {
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
        
                $sql = "DELETE FROM venue WHERE id='$id'";
        
                if ($conn->query($sql) === TRUE) {
                    echo "<h2>Match record deleted successfully</h2>";
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            } else {
                echo "<h2>Please enter the ID of the record you want to delete</h2>";
            }
        }



        echo "<p><a href='Venue.html'>Enter new venue.</a></p>";
        echo "<h2>All Venue data</h2>";

        $sql = "SELECT * FROM venue";
        
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Venue ID</th><th>Venue Name</th><th>Location</th><th>Capacity</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["venue_name"] . "</td>";
                echo "<td>" . $row["location"] . "</td>";
                echo "<td>" . $row["capacity"] . "</td>";
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
