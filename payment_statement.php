<?php
    $error=NULL;
    $insert=false;
    session_start();
    if(isset($_SESSION['roll_no']))
    {
        $conn = mysqli_connect('localhost','root','','college_system');
        
        $r = $conn->real_escape_string($_SESSION['roll_no']);
        
        $resultset = $conn->query("SELECT * FROM payments_statements WHERE roll_no = '$r'");

        $conn->close();
    }
    else
    {
        header('location:index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Statements</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
            margin:auto;
        }

        td, th, h2 {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: center;
        }

        tr:nth-child(odd) {
            background-color: #dddddd;
        }

    </style>
</head>
<body>
    <h2>Payment Details</h2>
    <table>
        <tr>
            <th>Date and Time</th>
            <th>Semester</th>
            <th>Amount</th>
            <th>Status</th>
        </tr>
        <?php
            while($row = mysqli_fetch_assoc($resultset))
            {
                echo "<tr><td>{$row['added_on']}</td><td>{$row['sem']}</td><td>{$row['amount']}</td><td>{$row['status']}</td></tr>\n";
            }
        ?>
        
    </div>
</body>
</html>