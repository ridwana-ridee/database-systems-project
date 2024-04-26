<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Ticket</title>
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
                $ticket_type = $_POST['ticket_type'];
                $price = $_POST['price'];
                $ticket_status = $_POST['ticket_status'];
                $game_id = $_POST['game_id'];

                $sql = "UPDATE ticket SET ticket_type='$ticket_type', price='$price', ticket_status='$ticket_status', game_id='$game_id' WHERE id='$id'";

                if ($conn->query($sql) === TRUE) {
                    echo "<h2>Ticket record updated successfully</h2>";
                    echo "<p><a href='viewticket.php'>All Match Data</a></p>";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }

            $id = $_GET['id'];
            $sql = "SELECT * FROM ticket WHERE id='$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post">
                <label for="ticket_type">Ticket Type:</label><br>
                <input type="text" id="ticket_type" name="ticket_type" value="<?php echo $row['ticket_type']; ?>"><br>
                <label for="price">Price</label><br>
                <input type="text" id="price" name="price" value="<?php echo $row['price']; ?>"><br>
                <label for="ticket_status">Ticket Status</label><br>
                <input type="text" id="ticket_status" name="ticket_status" value="<?php echo $row['ticket_status']; ?>"><br>
                <label for="game_id">Game ID</label><br>
                <input type="text" id="game_id" name="game_id" value="<?php echo $row['game_id']; ?>"><br>
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
