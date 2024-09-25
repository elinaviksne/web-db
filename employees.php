<?php 

//mysql

$host = "localhost";
$user = "php_app";
$password = "1234";
$database = "sql_hr";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error){
    die("connection failed" . $conn->connect_error);
};

echo "connection succesful";


$sql = "
    SELECT 
        e.first_name,
        e.last_name,
        m.first_name AS 'manager_name'
    FROM employees e
    JOIN employees m ON e.reports_to = m.employee_id;
";
$result = $conn->query($sql);

var_dump($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Employees</h1>

    <?php

    if($result->num_rows > 0) {
        echo "<ul>";
        while($row = $result->fetch_assoc()){
            //print_r($row);
            
            echo "<li> Employee = " . $row['first_name'] . " " . $row['last_name'] . "<br>" ."Manager = " .$row['manager_name'] . "</li>";
            
        }
        echo "</ul>";
    }else {
        echo"No customers found";
    }

    ?>
    
</body>
</html>