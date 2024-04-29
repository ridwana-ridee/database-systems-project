<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Accommodation</title>
    <link rel="stylesheet" href="Update.css">
</head>
<body>
    <div class="container">
        <?php
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $host = "localhost";
            $user = "root";
            $pass = "";
            $dbname = "world-cup-db";

            $conn = new mysqli($host, $user, $pass, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_GET['id'];
                $hotel_name = $_POST['hotel_name'];
                $location = $_POST['location'];
                $room_type = $_POST['room_type'];
                $venue_id = $_POST['venue_id'];

                $sql = "UPDATE accommodation SET hotel_name='$hotel_name', location='$location', room_type='$room_type', venue_id='$venue_id' WHERE id='$id'";

                if ($conn->query($sql) === TRUE) {
                    echo "<h2>Venue record updated successfully</h2>";
                    echo "<p><a href='viewaccomodation.php'>All Match Data</a></p>";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }

            $id = $_GET['id'];
            $sql = "SELECT * FROM accommodation WHERE id='$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post">
                <label for="hotel_name">Hotel Name:</label><br>
                <input type="text" id="hotel_name" name="hotel_name" value="<?php echo $row['hotel_name']; ?>"><br>
                
                <label for="location">Location:</label><br>
                <input type="text" id="location" name="location" value="<?php echo $row['location']; ?>"><br>
                
                <label for="room_type">Venue ID :</label><br>
                <input type="date" id="room_type" name="room_type" value="<?php echo $row['room_type']; ?>"><br>
                
                <label for="venue_id">Venue ID:</label><br>
                <input type="text" id="venue_id" name="venue_id" value="<?php echo $row['venue_id']; ?>"><br>
                <br><button type="submit">Update</button>
            </form>
            <?php
            $conn->close();
        } else {
            echo "<h2>Error: No ID specified for updating</h2>";
        }
        ?>
    </div>
</body>
</html>
