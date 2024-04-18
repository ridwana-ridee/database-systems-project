<html>
<head>
    <title>Venue Records</title>
    <link rel="stylesheet" type="text/css" href="viewvenue.css">
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
        $sql = "SELECT * FROM venue";
        
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Venue ID</th><th>Venue Name</th><th>Location</th><th>room_type</th><th>Update</th><th>Delete</th></tr>";            // output data of each row
            while($row = $result->fetch_assoc()) {
                ?>
                <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['venue_name']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['capacity']; ?></td>
                <td><a href="update_venue.php?id=<?php echo $row['id']; ?>">
                    <button>Update</button>
                </a></td>
                <td><a href="delete_venue.php?id=<?php echo $row['id']; ?>">
                    <button>Delete</button>
                </a></td>
                <?php
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
    <br><a href="Venue.html">
        <button>Back to Add Venue</button>
    </a>
    
</body>
</html>