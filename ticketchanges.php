<html>
<head>
    <title>Ticket Records</title>
    <link rel="stylesheet" type="text/css" href="viewvenue.css">
</head>
<body>
    <?php
        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "world-cup-db";

        $conn = new mysqli($host, $user, $pass, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_POST['id']) && !empty($_POST['id']) &&
            isset($_POST['ticket_type']) && !empty($_POST['ticket_type']) &&
            isset($_POST['price']) && !empty($_POST['price']) &&
            isset($_POST['ticket_status']) && !empty($_POST['ticket_status']) &&
            isset($_POST['game_id']) && !empty($_POST['game_id'])) {

            $id = $_POST['id'];
            $ticket_type = $_POST['ticket_type'];
            $price = $_POST['price'];
            $ticket_status = $_POST['ticket_status'];
            $game_id = $_POST['game_id'];

            $sql = "INSERT INTO ticket (id, ticket_type, price, ticket_status, game_id)
                    VALUES ('$id', '$ticket_type', '$price', '$ticket_status', '$game_id')";
            
            if ($conn->query($sql) === TRUE) {
                echo "<h2>Match record inserted successfully</h2>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<h2>Sorry! You didn’t complete the form. Please try again.</h2>";
        }

        echo "<p><a href='Ticket.html'>Enter New Ticket.</a></p>";
        echo "<h2>All Match data</h2>";

        ?>
        <?php
        
        $sql = "SELECT * FROM ticket";
        
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Ticket Type</th><th>Price</th><th>Ticket Status</th><th>Game ID</th><th>Update</th><th>Delete</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['ticket_type']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['ticket_status']; ?></td>
                <td><?php echo $row['game_id']; ?></td>
                <td><a href="update_ticket.php?id=<?php echo $row['id']; ?>">
                    <button>Update</button>
                </a></td>
                <td><a href="delete_ticket.php?id=<?php echo $row['id']; ?>">
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