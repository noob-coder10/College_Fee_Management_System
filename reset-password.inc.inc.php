<?php

    if(isset($_POST['submit']))
    {
        $conn = mysqli_connect('localhost','root','','college_system');

        $r = $conn->real_escape_string($_POST['roll_no']);
        $new_pass = md5($conn->real_escape_string($_POST['new_pass']));
        $con_pass = md5($conn->real_escape_string($_POST['con_pass']));

        if($new_pass != $con_pass)
        {
            echo "Passwords donot match";
            $insert=2;
        }
        else
        {
            $result = $conn->query("UPDATE student_info SET passwd='$new_pass' WHERE roll_no='$r' ");
            if($result)
            {
                $vkey = md5($r.time());

                $update = $conn->query("UPDATE student_info SET vkey='$vkey' WHERE roll_no='$r' ");
                
                echo "Password Updated";

                echo "<br></br><a href='login.php'>Click here to Login again</a>";
            }
            else

            echo "ERROR";
            $insert=3;
        }

        
    }

?>