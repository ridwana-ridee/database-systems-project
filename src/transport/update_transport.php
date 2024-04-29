<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Transport</title>
    <link rel="stylesheet" href="Update.css">
</head>
<body>
    <div class="container">
    <?php
        require 'db_config.php';

        if(isset($_GET['id']) && !empty($_GET['id'])) {

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_GET['id'];
                $transport_type = $_POST['transport_type'];
                $location = $_POST['location'];
                $availability = $_POST['availability'];
                $venue_id = $_POST['venue_id'];

                $sql = "UPDATE transportation SET transport_type='$transport_type', location='$location', availability='$availability', venue_id='$venue_id' WHERE id='$id'";

                if ($conn->query($sql) === TRUE) {
                    echo "<h2>Transport record updated successfully</h2>";
                    echo "<p><a href='viewtransport.php'>All Match Data</a></p>";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }

            $id = $_GET['id'];
            $sql = "SELECT * FROM transportation WHERE id='$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post">
                <label for="transport_type">Transport Type:</label><br>
                <input type="text" id="transport_type" name="transport_type" value="<?php echo $row['transport_type']; ?>"><br>
                
                <label for="location">Location:</label><br>
                <input type="text" id="location" name="location" value="<?php echo $row['location']; ?>"><br>
                
                <label for="availability">Availability:</label><br>
                <input type="text" id="availability" name="availability" value="<?php echo $row['availability']; ?>"><br>
                
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
