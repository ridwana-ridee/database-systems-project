<!DOCTYPE html>
<html>
<head>
    <title>Ticket Records</title>
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
        } else {
            echo "connection successful";
        }

        if (isset($_POST['ticket_type']) && !empty($_POST['ticket_type']) &&
            isset($_POST['price']) && !empty($_POST['price']) &&
            isset($_POST['ticket_status']) && !empty($_POST['ticket_status'])) {
            
            $id = $_POST['id'];
            $ticket_type = $_POST['ticket_type'];
            $price = $_POST['price'];
            $ticket_status = $_POST['ticket_status'];

            $sql = "INSERT INTO ticket (ticket_type, price, ticket_status)
                    VALUES ('$ticket_type', '$price', '$ticket_status')";
            
            if ($conn->query($sql) === TRUE) {
                echo "<h2>Ticket record inserted successfully</h2>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<h2>Sorry! You didn’t complete the form. Please try again.</h2>";
        }

        echo "<p><a href='AddTicket.html'>Enter new ticket.</a></p>";
        echo "<h2>All ticket data</h2>";

        $sql = "SELECT * FROM ticket";
        
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Ticket ID</th><th>Ticket Type</th><th>Price</th><th>Ticket Status</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["ticket_type"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["ticket_status"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
</body>
</html>
