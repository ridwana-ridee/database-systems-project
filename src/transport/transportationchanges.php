<html>
<head>
    <title>Transportation Records</title>
    <link rel="stylesheet" type="text/css" href="viewvenue.css">
</head>
<body>
    <?php
    require 'db_config.php';

    if (isset($_POST['id']) && !empty($_POST['id']) &&
        isset($_POST['transport_type']) && !empty($_POST['transport_type']) &&
        isset($_POST['location']) && !empty($_POST['location']) &&
        isset($_POST['availability']) && !empty($_POST['availability']) &&
        isset($_POST['venue_id']) && !empty($_POST['venue_id'])) {
        
        $id = $_POST['id'];
        $transport_type = $_POST['transport_type'];
        $location = $_POST['location'];
        $availability = $_POST['availability'];
        $venue_id = $_POST['venue_id'];
        
        $sql = "INSERT INTO transportation (id, transport_type, location, availability, venue_id)
                VALUES ('$id', '$transport_type', '$location', '$availability', '$venue_id')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<h2>Transport record inserted successfully</h2>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<h2>Sorry! You didn’t complete the form. Please try again.</h2>";
    }

    echo "<p><a href='Transportation.html'>
            <button>Enter New Venue</button>
        </a></p>";
    echo "<h2>All Match data</h2>";

    ?>
    <?php
    
    $sql = "SELECT * FROM transportation";
    
    $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Transportation ID</th><th>Transportation Type</th><th>Location</th><th>Availability</th><th>Venue ID</th><th>Update</th><th>Delete</th></tr>";            // output data of each row
        // output data of each row
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
</body>
</html>
