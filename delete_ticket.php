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
    $sql = "DELETE FROM ticket WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>Ticket record with ID $id deleted successfully</h2>";
        echo "<p><a href='ticketchanges.php'>All Match Data</a></p>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
} else {
    echo "<h2>Error: No ID specified for deletion</h2>";
}
?>
