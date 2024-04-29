<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Match</title>
    <link rel="stylesheet" href="Update.css">
</head>
<body>
    <div class="container">
        <?php
        require 'db_config.php';

        if(isset($_GET['id']) && !empty($_GET['id'])) {

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_GET['id'];
                $match_name = $_POST['match_name'];
                $match_round = $_POST['match_round'];
                $match_date = $_POST['match_date'];
                $venue_id = $_POST['venue_id'];

                $sql = "UPDATE game SET match_name='$match_name', match_round='$match_round', match_date='$match_date', venue_id='$venue_id' WHERE id='$id'";

                if ($conn->query($sql) === TRUE) {
                    echo "<h2>Venue record updated successfully</h2>";
                    echo "<p><a href='viewgames.php'>
                    <button>All Match Data</button>
                  </a></p>";
                } else {
                    echo "<p>Error updating record: " . $conn->error . "</p>";
                }
            }

            $id = $_GET['id'];
            $sql = "SELECT * FROM game WHERE id='$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post">
                <label for="match_name">Match Name:</label><br>
                <input type="text" id="match_name" name="match_name" value="<?php echo $row['match_name']; ?>"><br>
                
                <label for="match_round">Match Round:</label><br>
                <input type="text" id="match_round" name="match_round" value="<?php echo $row['match_round']; ?>"><br>
                
                <label for="match_date">Match Date:</label><br>
                <input type="date" id="match_date" name="match_date" value="<?php echo $row['match_date']; ?>"><br>
                
                <label for="venue_id">Venue ID:</label><br>
                <input type="text" id="venue_id" name="venue_id" value="<?php echo $row['venue_id']; ?>"><br>
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
