<?php
    $error=NULL;
    $insert=false;
    session_start();
    if(isset($_SESSION['update_profile']) && isset($_SESSION['roll_no']))
    {
        $conn = mysqli_connect('localhost','root','','college_system');
        
        $r = $conn->real_escape_string($_SESSION['roll_no']);
        
        if(!isset($_POST['submit']))
        {
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
        }
        else
        {
            $mob_no = $conn->real_escape_string($_POST['mobile']);
            $address = $conn->real_escape_string($_POST['address']);
            $p_name = $conn->real_escape_string($_POST['p_name']);
            $p_mob_no = $conn->real_escape_string($_POST['p_mob_no']);
            $p_email = $conn->real_escape_string($_POST['p_email']);

            $resultset = $conn->query("UPDATE student_info SET mob_no='$mob_no', address='$address', p_name='$p_name', p_mob_no='$p_mob_no', p_email='$p_email' WHERE roll_no='$r' ");

            
            header('location:profile.php');
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
    <title>Update Profile</title>
    <style>
        .readonly
        {
            background-color: #8080804f;
        }
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
        <form method="POST" action="profile.php" id="form_login">
        
            <h3>Student Profile</h3>
            <div>
                <label for="name"> Student's Name : </label>
                <input type="text" name="name" id="name" class="readonly" required value="<?php echo $row['name']; ?>" readonly="readonly" > 
            </div>
            <br>
            <div>
                <label for="roll">Roll No :</label>
                <input type="text" name="roll" id="roll" class="readonly" required value="<?php echo $row['roll_no']; ?>" readonly="readonly">
            </div>
            <br>
            <div>
                <label for="dept">Department :</label>
                <input type="text" name="dept" id="dept" class="readonly" required value="<?php echo $row['dept']; ?>" readonly="readonly">
            </div>
            <br>
            <div>
                <label for="reg">Registration No :</label>
                <input type="number" name="reg" id="reg" class="readonly" required value="<?php echo $row['reg_no']; ?>" readonly="readonly">
            </div>
            <br>
            <div>
                <label for="batch">Batch :</label>
                <input type="text" name="batch" id="batch" class="readonly" required value="<?php echo $row['batch'] . '-' . $v; ?>" readonly="readonly">
            </div>
            <br>
            <div>
                <label for="mobile">Student's Mobile No:</label>
                <input type="number" name="mobile" id="mobile" required value="<?php echo $row['mob_no']; ?>">
            </div>
            <br>
            <div>
                <label for="email">Student's Email Id :</label>
                <input type="email" name="email" id="email" class="readonly" required value="<?php echo $row['email']; ?>" readonly="readonly">
            </div>
            <br>
            <div>
                <label for="address">Address :</label>
                <input type="text" name="address" id="address" value="<?php echo $row['address']; ?>">
            </div>
            <br>
            <div>
                <label for="p_name">Guardian's Name :</label>
                <input type="text" name="p_name" id="p_name" class="readonly" value="<?php echo $row['p_name']; ?>"  readonly="readonly">
            </div>
            <br>
            <div>
                <label for="p_mob_no">Guardian's Mobile No :</label>
                <input type="number" name="p_mob_no" id="p_mob_no"value="<?php echo $row['p_mob_no']; ?>">
            </div>
            <br>
            <div>
                <label for="p_email">Guardian's Email Id :</label>
                <input type="email" name="p_email" id="p_email" value="<?php echo $row['p_email']; ?>">
            </div>
            <br>

            <div>
                 <input type="submit" name="submit" value="Update Profile"> 
                 <br></br>
            </div>

        </form>
    </div>
</body>
</html>