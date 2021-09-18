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

        $result = $conn->query("SELECT * FROM payment WHERE roll_no = '$r' LIMIT 1");
        
        if($result->num_rows != 0)
        {
            $row1 = mysqli_fetch_assoc($result);
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
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        .readonly
        {
            background-color: #8080804f;
            padding: 5px;
        }
        #form_login
        {
            font-size: 25px;
            text-align: center;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
    <div id="parent">
        <form method="POST" action="#" id="form_login">
        
            <h3>Online Payment</h3>

                <label for="name"> Student's Name : </label>
                <input type="text" name="name" id="name" class="readonly" required value="<?php echo $row['name']; ?>" readonly="readonly" > 

                <label for="roll">Roll No :</label>
                <input type="text" name="roll" id="roll" class="readonly" required value="<?php echo $row['roll_no']; ?>" readonly="readonly">

                <label for="batch">Batch :</label>
                <input type="text" name="batch" id="batch" class="readonly" required value="<?php echo $row['dept'].'['.$row['batch'] . '-' . $v.']'; ?>" readonly="readonly">

                <label for="date">Date :</label>
                <input type="text" name="date" id="date" class="readonly" required value="<?php echo  date("d/m/Y"); ?>" readonly="readonly">
        </form>
    </div>

    <div>
        <h3>Fees Head</h3>
        <table>
        <tr>
            <th>Semester</th>
            <th>Tution Fees</th>
            <th>Exam Fees</th>
            <th>Payable Amount</th>
            <th>Pay Now</th>
        </tr>
        <tr>
            <td>1</td>
            <td><?php echo $row1['sem1']-1000; ?></td>
            <td>1000</td>
            <td><?php if($row1['sem1'] == 0){echo 0;} else{echo $row1['sem1'];} ?></td>
            <td><input type="button" name="btn" id="btn" value="Pay Now" <?php if ($row1['sem1'] == 0){ ?> disabled <?php   } ?> onclick="pay_now(1, <?php echo $row1['sem1'];?>)"> </td>
        </tr>
        <tr>
            <td>2</td>
            <td><?php echo $row1['sem2']-1000; ?></td>
            <td>1000</td>
            <td><?php if($row1['sem2'] == 0){echo 0;} else{echo $row1['sem2'];} ?></td>
            <td><input type="button" name="btn" id="btn" value="Pay Now" <?php if ($row1['sem2'] == 0){ ?> disabled <?php   } ?> onclick="pay_now(2, <?php echo $row1['sem2'];?>)"> </td>
        </tr>
        <tr>
            <td>3</td>
            <td><?php echo $row1['sem3']-1000; ?></td>
            <td>1000</td>
            <td><?php if($row1['sem3'] == 0){echo 0;} else{echo $row1['sem3'];} ?></td>
            <td><input type="button" name="btn" id="btn" value="Pay Now" <?php if ($row1['sem3'] == 0){ ?> disabled <?php   } ?> onclick="pay_now(3, <?php echo $row1['sem3'];?>)"> </td>
        </tr>
        <tr>
            <td>4</td>
            <td><?php echo $row1['sem4']-1000; ?></td>
            <td>1000</td>
            <td><?php if($row1['sem4'] == 0){echo 0;} else{echo $row1['sem4'];} ?></td>
            <td><input type="button" name="btn" id="btn" value="Pay Now" <?php if ($row1['sem4'] == 0){ ?> disabled <?php   } ?> onclick="pay_now(4, <?php echo $row1['sem4'];?>)"> </td>
        </tr>
        <tr>
            <td>5</td>
            <td><?php echo $row1['sem5']-1000; ?></td>
            <td>1000</td>
            <td><?php if($row1['sem5'] == 0){echo 0;} else{echo $row1['sem5'];} ?></td>
            <td><input type="button" name="btn" id="btn" value="Pay Now" <?php if ($row1['sem5'] == 0){ ?> disabled <?php   } ?> onclick="pay_now(5, <?php echo $row1['sem5'];?>)"> </td>
        </tr>
        <tr>
            <td>6</td>
            <td><?php echo $row1['sem6']-1000; ?></td>
            <td>1000</td>
            <td><?php if($row1['sem6'] == 0){echo 0;} else{echo $row1['sem6'];} ?></td>
            <td><input type="button" name="btn" id="btn" value="Pay Now" <?php if ($row1['sem6'] == 0){ ?> disabled <?php   } ?> onclick="pay_now(6, <?php echo $row1['sem6'];?>)"> </td>
        </tr>
        <tr>
            <td>7</td>
            <td><?php echo $row1['sem7']-1000; ?></td>
            <td>1000</td>
            <td><?php if($row1['sem7'] == 0){echo 0;} else{echo $row1['sem7'];} ?></td>
            <td><input type="button" name="btn" id="btn" value="Pay Now" <?php if ($row1['sem7'] == 0){ ?> disabled <?php   } ?> onclick="pay_now(7, <?php echo $row1['sem7'];?>)"> </td>
        </tr>
        <tr>
            <td>8</td>
            <td><?php echo $row1['sem8']-1000; ?></td>
            <td>1000</td>
            <td><?php if($row1['sem8'] == 0){echo 0;} else{echo $row1['sem8'];} ?></td>
            <td><input type="button" name="btn" id="btn" value="Pay Now" <?php if ($row1['sem8'] == 0){ ?> disabled <?php   } ?> onclick="pay_now(8, <?php echo $row1['sem8'];?>)"> </td>
        </tr>
        </table>
    </div>
</body>
</html>

<script>
    function pay_now(sem, amt)
    {
        
        jQuery.ajax({
            type:'post',
            url:'payment_process.php',
            data:"&amt="+amt+"&sem="+sem,
            success:function(result){
                var options = {
                    "key": "rzp_test_zrbhKmmJsFHMEt", 
                    "amount": amt*100, 
                    "currency": "INR",
                    "name": "GCECT",
                    "description": "Test Transaction",
                    "image": "logo.png",
                    "handler": function (response){
                        jQuery.ajax({
                            type:'post',
                            url:'payment_process.php',
                            data:"payment_id="+response.razorpay_payment_id+"&sem="+sem,
                            success:function(result){
                                window.location.href="thank_you.php"
                            }
                        });
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();

            }
        }); 

    }

</script>