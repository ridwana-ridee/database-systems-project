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
        $sql = "SELECT * FROM ticket";
        
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Ticket Type</th><th>Price</th><th>Ticket Status</th><th>Game ID</th><th>Update</th><th>Delete</th></tr>";            // output data of each row
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
    <br><a href="Ticket.html">
        <button>Back to Add Ticket</button>
    </a>

</body>
</html>
