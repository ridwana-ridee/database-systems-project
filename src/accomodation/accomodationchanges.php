<html>
<head>
    <title>Accomodation Records</title>
    <link rel="stylesheet" type="text/css" href="viewvenue.css">
</head>
<body>
    <?php
    require 'db_config.php';

    if (isset($_POST['id']) && !empty($_POST['id']) &&
        isset($_POST['hotel_name']) && !empty($_POST['hotel_name']) &&
        isset($_POST['location']) && !empty($_POST['location']) &&
        isset($_POST['room_type']) && !empty($_POST['room_type']) &&
        isset($_POST['venue_id']) && !empty($_POST['venue_id'])) {
        
        $id = $_POST['id'];
        $hotel_name = $_POST['hotel_name'];
        $location = $_POST['location'];
        $room_type = $_POST['room_type'];
        $venue_id = $_POST['venue_id'];
        
        $sql = "INSERT INTO accommodation (id, hotel_name, location, room_type, venue_id)
                VALUES ('$id', '$hotel_name', '$location', '$room_type', '$venue_id')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<h2>Transport record inserted successfully</h2>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<h2>Sorry! You didn’t complete the form. Please try again.</h2>";
    }

    echo "<p><a href='Accomodation.html'>
            <button>Enter New Venue</button>
        </a></p>";
    echo "<h2>All Match data</h2>";

    ?>
    <?php
    
    $sql = "SELECT * FROM accommodation";
    
    $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Accomodation ID</th><th>Hotel Name</th><th>Location</th><th>Room Type</th><th>Venue ID</th><th>Update</th><th>Delete</th></tr>";        // output data of each row
        while($row = $result->fetch_assoc()) {
            ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['hotel_name']; ?></td>
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
</body>
</html>
