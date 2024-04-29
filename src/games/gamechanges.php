<html>
<head>
    <title>Match Records</title>
    <link rel="stylesheet" type="text/css" href="viewvenue.css">
</head>
<body>
    <?php
        require 'db_config.php';

        if (isset($_POST['id']) && !empty($_POST['id']) &&
            isset($_POST['match_name']) && !empty($_POST['match_name']) &&
            isset($_POST['match_round']) && !empty($_POST['match_round']) &&
            isset($_POST['match_date']) && !empty($_POST['match_date']) &&
            isset($_POST['venue_id']) && !empty($_POST['venue_id'])) {
            
            $id = $_POST['id'];
            $match_name = $_POST['match_name'];
            $match_round = $_POST['match_round'];
            $match_date = $_POST['match_date'];
            $venue_id = $_POST['venue_id'];
            
            $sql = "INSERT INTO game (id, match_name, match_round, match_date, venue_id)
                    VALUES ('$id', '$match_name', '$match_round', '$match_date', '$venue_id')";
        
            if ($conn->query($sql) === TRUE) {
                echo "<h2>Match record inserted successfully</h2>";
                
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<h2>Sorry! You didn’t complete the form. Please try again.</h2>";
        }

        echo "<p><a href='Games.html'>
                <button>Enter New Match</button>
            </a></p>";
        echo "<h2>All Match data</h2>";

        ?>
        <?php
        
        $sql = "SELECT * FROM game";
        
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Match ID</th><th>Match Name</th><th>Match Round</th><th>Match Date</th><th>Venue ID</th><th>Update</th><th>Delete</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['match_name']; ?></td>
                <td><?php echo $row['match_round']; ?></td>
                <td><?php echo $row['match_date']; ?></td>
                <td><?php echo $row['venue_id']; ?></td>
                <td><a href="update_games.php?id=<?php echo $row['id']; ?>">
                    <button>Update</button>
                </a></td>
                <td><a href="delete_games.php?id=<?php echo $row['id']; ?>">
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
