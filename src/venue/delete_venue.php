<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Venue</title>
    <link rel="stylesheet" href="Delete.css">
</head>
<body>
    <div class="container"> 
        <?php
        require 'db_config.php';

        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "DELETE FROM venue WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo "<h2>Venue record with ID $id deleted successfully</h2>";
                echo "<p><a href='viewvenue.php'>All Match Data</a></p>";
            } else {
                echo "Error deleting record: " . $conn->error;
            }

            $conn->close();
        } else {
            echo "<h2>Error: No ID specified for deletion</h2>";
        }
        ?>
    </div>
</body>
</html>
