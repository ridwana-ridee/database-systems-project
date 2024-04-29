<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Match</title>
    <link rel="stylesheet" href="Delete.css">
</head>
<body>
    <div class="container">
        <?php
        require 'db_config.php';

        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "DELETE FROM game WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo "<h2>Match record with ID $id deleted successfully</h2>";
                echo "<p><a href='viewgames.php'>
                        <button>All Match Data</button>
                      </a></p>";
            } else {
                echo "<p>Error deleting record: " . $conn->error . "</p>";
            }

            $conn->close();
        } else {
            echo "<h2>Error: No ID specified for deletion</h2>";
        }
        ?>
    </div>
</body>
</html>
