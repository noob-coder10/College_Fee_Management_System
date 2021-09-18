<?php
    $error=NULL;
    $insert=false;
    session_start();
    if(isset($_POST['submit']))
    {
        $conn = mysqli_connect('localhost','root','','college_system');

        $r = $conn->real_escape_string($_POST['r']);
        $p = $conn->real_escape_string($_POST['p']);
        $p = md5($p);

        $resultset = $conn->query("SELECT * FROM student_info WHERE roll_no = '$r' AND passwd = '$p' LIMIT 1");

        if($resultset->num_rows != 0)
        {
            $_SESSION['roll_no'] = $r;
            header ('location:home.php');
        } 
        else 
        {
            $insert=true;
        }
        $conn->close();
        
    }

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        #form_login {
            left      : 50%;
            top       : 50%;
            position  : absolute;
            transform : translate(-50%, -50%);
            text-align: center;
            border: 2px solid black;
            padding: 40px
        }
    </style>
</head>
<body>
    <div id="parent">
        <form method="POST" action="login.php" id="form_login">
        <?php
            if($insert==true)
            {
                echo "<script>alert('Incorrect email or passward')</script>";
            }
            ?>
            <h3>Student Login</h3>
            <div>
                <label for="username"> Roll No : </label>
                <input type="text" name="r" id="username" required>
            </div>
            <br>
            <div>
                <label for="pass">Passward :</label>
                <input type="password" name="p" id="pass" required>
            </div>
            <br>
            <div>
                 <input type="submit" name="submit" value="Login"> 
                 <br></br>
            </div>
            <a href="reset-password.php">Forgot your Password?</a>

        </form>
    </div>

    <?php
        echo $error;
    ?>
</body>
</html>