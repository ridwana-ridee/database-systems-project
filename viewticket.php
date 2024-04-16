<html>
<head>
    <title>Employee Records</title>
</head>
<body>
    <?php
        $host = "localhost";
        $user = "msyed11";
        $pass = "msyed11";
        $dbname = "msyed11";

        $conn = new mysqli($host, $user, $pass, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_POST['emp_name']) && !empty($_POST['emp_name']) &&
            isset($_POST['job_title']) && !empty($_POST['job_title']) &&
            isset($_POST['hire_date']) && !empty($_POST['hire_date']) &&
            isset($_POST['salary']) && !empty($_POST['salary'])) {
            
            $emp_name = $_POST['emp_name'];
            $job_title = $_POST['job_title'];
            $hire_date = $_POST['hire_date'];
            $salary = $_POST['salary'];

            $sql = "INSERT INTO EMPLOYEE (emp_name, job_title, hire_date, salary)
                    VALUES ('$emp_name', '$job_title', '$hire_date', '$salary')";
            
            if ($conn->query($sql) === TRUE) {
                echo "<h2>Employee record inserted successfully</h2>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<h2>Sorry! You didn’t complete the form. Please try again.</h2>";
        }

        echo "<p><a href='newemployee.php'>Enter new employee.</a></p>";
        echo "<h2>All employee data</h2>";

        $sql = "SELECT * FROM EMPLOYEE
        JOIN DEPARTMENT ON DEPARTMENT.name= EMPLOYEE.job_title";
        
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Employee ID</th><th>Employee Name</th><th>Job Title</th><th>Hire Date</th><th>Salary</th><th>Department</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["emp_id"] . "</td>";
                echo "<td>" . $row["emp_name"] . "</td>";
                echo "<td>" . $row["job_title"] . "</td>";
                echo "<td>" . $row["hire_date"] . "</td>";
                echo "<td>" . $row["salary"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
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
