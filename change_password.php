<?php
    $error=NULL;
    $insert=0;
    session_start();
    if(isset($_SESSION['roll_no']) )
    {
        if(isset($_POST['submit']))
        {
            $conn = mysqli_connect('localhost','root','','college_system');
            
            $r = $conn->real_escape_string($_SESSION['roll_no']);
            $c_pass = md5($conn->real_escape_string($_POST['c_pass']));
            $new_pass = md5($conn->real_escape_string($_POST['new_pass']));
            $con_pass = md5($conn->real_escape_string($_POST['con_pass']));

            $resultset = $conn->query("SELECT passwd FROM student_info WHERE roll_no = '$r' ");
            $row = mysqli_fetch_assoc($resultset);
            if($row['passwd'] != $c_pass)
            {
                $insert=1;
            } 
            else 
            {
                if($new_pass != $con_pass)
                {
                    // echo $new_pass . '\n';
                    // echo $con_pass;
                    $insert=2;
                }
                else
                {
                    $result = $conn->query("UPDATE student_info SET passwd='$new_pass' WHERE roll_no='$r' ");
                    $insert=3;
                }
            }
            $conn->close();
        }
        
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
    <title>Change Password</title>
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
        <?php
            if($insert==1)
            {
                echo "<script>alert('Incorrect passward')</script>";
                $insert=0;
            }
            else if($insert==2)
            {
                echo "<script>alert('Passwords do not match')</script>";
                $insert=0;
            }
            else if($insert==3)
            {
                echo "<script>alert('Password changed successfully')</script>";
                $insert=0;
            }
        ?>
        <form method="POST" action="change_password.php" id="form_login">
            <h3>Change Password</h3>
            <div>
                <label for="c_pass"> Current Password : </label>
                <input type="password" name="c_pass" id="c_pass" required>
            </div>
            <br>
            <div>
                <label for="new_pass">New Password :</label>
                <input type="password" name="new_pass" id="new_pass" required>
            </div>
            <br>
            <div>
                <label for="con_pass">Confirm New Password :</label>
                <input type="password" name="con_pass" id="con_pass" required>
            </div>
            <br>
            <div>
                 <input type="submit" name="submit" value="Change Password"> 
                 <br></br>
            </div>

        </form>
</body>
</html>