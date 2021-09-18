<?php
    $insert=0;
    // $vkey = $_GET['vkey'];
    // echo $vkey;
    if(isset($_GET['vkey']) && isset($_GET['roll']))
    {
        $conn = mysqli_connect('localhost','root','','college_system');
        
        $vkey = $_GET['vkey'];
        $r = $_GET['roll'];

        $resultset = $conn->query("SELECT * FROM student_info WHERE roll_no = '$r' AND vkey='$vkey' LIMIT 1");

        if($resultset->num_rows == 0)
        {
            die("This link is invalid");
        }
    }
    else
    {
        die('Something went Worng');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
    <form method="POST" action="reset-password.inc.inc.php" id="form_login">
        <h3>Reset Password</h3>
        <div>
            <input type="hidden" name="roll_no" id="roll_no" value="<?php echo $r; ?>" >
        </div>
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
            <button type="submit" name="submit" >Change Password</button>
            <br></br>
        </div>

    </form>
</body>
</html>