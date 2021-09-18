<?php
    $insert = false;
    if(isset($_POST["reset-request-submit"]))
    {
        $conn = mysqli_connect('localhost','root','','college_system');
        
        $r = $conn->real_escape_string($_POST['roll_no']);
        $resultset = $conn->query("SELECT * FROM student_info WHERE roll_no = '$r' LIMIT 1");

        if($resultset->num_rows != 0)
        {
            $row = mysqli_fetch_assoc($resultset);

            $email = $row['email'];

            $vkey = md5(time().$r);

            $update = $conn->query("UPDATE student_info SET vkey='$vkey' WHERE roll_no='$r' ");

            if($update)
            {
                $to = $email;
                $subject = "Forgot Password" ;
                $message = "<a href='http://localhost/Fees_Payment_System/GCECT/reset-password.inc.php?vkey=$vkey&roll=$r'>Change Your Password</a>";
                $headers = "From: rjsayan@gmail.com\r\n";
                $headers .= "MIME-Version:1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                mail($to,$subject,$message,$headers);
            }
            else
            {
                echo $conn->error;
            }
        }
        else 
        {
            $insert = true;
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
    <title>reset-password</title>
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
        <?php
            if($insert==true)
            {
                echo "<script>alert('Invalid Roll No')</script>";
                $insert=false;
            }
        ?>
        <form method="POST" action="reset-password.php" id="form_login">
            <h3>Reset your Password</h3>
            <p>An e-mail will be sent to your registered e-mail address with instruction on how to reset your password.</p>
            <div>
                <label for="roll_no"> Enter your Roll No : </label>
                <input type="text" name="roll_no" id="roll_no" required>
            </div>
            <br>
            <div>
                 <button type="submit" name="reset-request-submit" >Receive new password by email</button>
                 <br></br>
            </div>
        </form>
    </div>
</body>
</html>