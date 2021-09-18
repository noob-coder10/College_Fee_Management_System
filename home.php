<?php
    $error=NULL;
    $insert=false;
    session_start();
    if(isset($_SESSION['roll_no']))
    {
        $conn = mysqli_connect('localhost','root','','college_system');
        
        $r = $conn->real_escape_string($_SESSION['roll_no']);
        $resultset = $conn->query("SELECT * FROM student_info WHERE roll_no = '$r' LIMIT 1");

        if($resultset->num_rows != 0)
        {
            $row = mysqli_fetch_assoc($resultset);
            $v = $row['batch']+4;
        } 
        else 
        {
            $insert=true;
        }
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
    <title>Home</title>
    <style>
        .cls
        {
            font-size: 50px;
        }
        .form-login {
            text-align: center;
            margin: 60px;
        }
        button{
            padding: 10px;
            background-color: rgb(128 128 128 / 38%);
            font-size: 20px;
            margin: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
   <div class='form-login'>
        <?php echo "<span class='cls'>".$row['name'] .  "   (" . $row['roll_no'] . ")" . "</span>";?>
        <br></br>
        <?php echo "<span class='cls'>" . $row['dept'] . "   [" . $row['batch'] . "-" . $v . "]" . "</span>";?>
   </div>
   <div class='form-login '>
       <button type="submit" name="update_profile" onclick="<?php $_SESSION['update_profile']='true' ?> location.href='http://localhost/Fees_Payment_System/GCECT/profile.php'"  >Update Profile</button>

       <button type="submit" name="reset-request-submit" onclick="location.href='http://localhost/Fees_Payment_System/GCECT/payment.php'" >Online Pay</button>

       <button type="submit" name="reset-request-submit" onclick="location.href='http://localhost/Fees_Payment_System/GCECT/payment_statement.php'" >Payment Statements</button>

       <button type="submit" name="reset-request-submit" onclick="location.href='http://localhost/Fees_Payment_System/GCECT/change_password.php'" >Change Password</button>

       <button type="submit" name="reset-request-submit" onclick="location.href='http://localhost/Fees_Payment_System/GCECT/logout.php'" >Logout</button>
   </div>
</body>
</html>
