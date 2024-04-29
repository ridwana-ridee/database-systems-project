<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Venue</title>
    <link rel="stylesheet" href="Update.css">
</head>
<body>
    <div class="container">
        <?php
        require 'db_config.php';

        if(isset($_GET['id']) && !empty($_GET['id'])) {

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_GET['id'];
                $venue_name = $_POST['venue_name'];
                $location = $_POST['location'];
                $capacity = $_POST['capacity'];

                $sql = "UPDATE venue SET venue_name='$venue_name', location='$location', capacity='$capacity' WHERE id='$id'";

                if ($conn->query($sql) === TRUE) {
                    echo "<h2>Venue record updated successfully</h2>";
                    echo "<p><a href='viewvenue.php'>All Match Data</a></p>";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }

            $id = $_GET['id'];
            $sql = "SELECT * FROM venue WHERE id='$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post">
                <label for="venue_name">Venue Name:</label><br>
                <input type="text" id="venue_name" name="venue_name" value="<?php echo $row['venue_name']; ?>"><br>
                <label for="location">Location:</label><br>
                <input type="text" id="location" name="location" value="<?php echo $row['location']; ?>"><br>
                <label for="capacity">Capacity:</label><br>
                <input type="text" id="capacity" name="capacity" value="<?php echo $row['capacity']; ?>"><br>
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
