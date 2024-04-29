<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Transport</title>
    <link rel="stylesheet" href="Delete.css">
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

            $id = $_GET['id'];
            $sql = "DELETE FROM transportation WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo "<h2>Venue record with ID $id deleted successfully</h2>";
                echo "<p><a href='viewtransport.php'>All Transport Data</a></p>";
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
