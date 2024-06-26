<html>
<head>
    <title>Venue Records</title>
    <link rel="stylesheet" type="text/css" href="viewvenue.css">
</head>
<body>
    <?php
        require 'db_config.php';

        if (isset($_POST['id']) && !empty($_POST['id']) &&
            isset($_POST['venue_name']) && !empty($_POST['venue_name']) &&
            isset($_POST['location']) && !empty($_POST['location']) &&
            isset($_POST['capacity']) && !empty($_POST['capacity'])) {
            
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
        } else {
            echo "<h2>Sorry! You didn’t complete the form. Please try again.</h2>";
        }

        echo "<p><a href='Venue.html'>
                <button>Enter New Venue</button>
            </a></p>";
        echo "<h2>All Match data</h2>";
        ?>
        <?php
        
        $sql = "SELECT * FROM venue";
        
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Venue ID</th><th>Venue Name</th><th>Location</th><th>room_type</th><th>Update</th><th>Delete</th></tr>";
            // output data of each row
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
</body>
</html>
