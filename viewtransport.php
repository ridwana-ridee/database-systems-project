<html>
<head>
    <title>Transportation Records</title>
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
        $sql = "SELECT * FROM transportation";
        
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Transportation ID</th><th>Transportation Type</th><th>Location</th><th>Availability</th><th>Venue ID</th><th>Update</th><th>Delete</th></tr>";            // output data of each row
            while($row = $result->fetch_assoc()) {
                ?>
                <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['transport_type']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['availability']; ?></td>
                <td><?php echo $row['venue_id']; ?></td>
                <td><a href="update_transport.php?id=<?php echo $row['id']; ?>">
                    <button>Update</button>
                </a></td>
                <td><a href="delete_transport.php?id=<?php echo $row['id']; ?>">
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
    <br><a href="Transportation.html">
        <button>Back to Add Transportation</button>
    </a>
    
</body>
</html>