<html>
<head>
    <title>Accomodation Records</title>
    <link rel="stylesheet" type="text/css" href="viewvenue.css">
</head>
<body>
    <?php
        require 'db_config.php';

        $sql = "SELECT * FROM accommodation";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Accomodation ID</th><th>Hotel Name</th><th>Location</th><th>Room Type</th><th>Venue ID</th><th>Update</th><th>Delete</th></tr>";            // output data of each row
            while($row = $result->fetch_assoc()) {
                ?>
                <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['hotel_name	']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['room_type']; ?></td>
                <td><?php echo $row['venue_id']; ?></td>
                <td><a href="update_accomodation.php?id=<?php echo $row['id']; ?>">
                    <button>Update</button>
                </a></td>
                <td><a href="delete_accomodation.php?id=<?php echo $row['id']; ?>">
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
    <br><a href="Accomodation.html">
        <button>Back to Add Accomodation</button>
    </a>
    
</body>
</html>
