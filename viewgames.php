<html>
<head>
    <title>Match Records</title>
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
        $sql = "SELECT * FROM game";
        
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Game ID</th><th>Match Name</th><th>Match Round</th><th>Match Date</th><th>venue_id</th><th>Update</th><th>Delete</th></tr>";
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
    <br><a href="Games.html">
        <button>Back to Add Matches</button>
    </a>
    
</body>
</html>