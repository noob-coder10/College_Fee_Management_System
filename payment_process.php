<?php
    session_start();
    $conn = mysqli_connect('localhost','root','','college_system');
        
    $r = $conn->real_escape_string($_SESSION['roll_no']);
    
    if(isset($_POST['amt']) && isset($_POST['sem']))
    {
        $amt=$_POST['amt'];
        $sem=$_POST['sem'];
        $status="pending";
        $added_on=date('Y-n-d h:i:s');
        mysqli_query($conn, "insert into payments_statements (roll_no, sem, amount, added_on, status) values('$r', '$sem', '$amt', '$added_on', '$status')"); 

        $_SESSION['OID']=mysqli_insert_id($conn);
    }


    if(isset($_POST['payment_id']) && isset($_SESSION['OID']))
    {
        $payment_id=$_POST['payment_id'];
        $sem=$_POST['sem'];
        mysqli_query($conn, "update payments_statements set status='complete', payment_id='$payment_id' where serial_no='".$_SESSION['OID']."'"); 
       
         if($sem==1)
        {
            mysqli_query($conn, "update payment set sem1=0 where roll_no='$r' "); 
        }
        if($sem==2)
        {
            mysqli_query($conn, "update payment set sem2=0 where roll_no='$r' "); 
        }
        if($sem==3)
        {
            mysqli_query($conn, "update payment set sem3=0 where roll_no='$r' "); 
        }
        if($sem==4)
        {
            mysqli_query($conn, "update payment set sem4=0 where roll_no='$r' "); 
        }
        if($sem==5)
        {
            mysqli_query($conn, "update payment set sem5=0 where roll_no='$r' "); 
        }
        if($sem==6)
        {
            mysqli_query($conn, "update payment set sem6=0 where roll_no='$r' "); 
        }
        if($sem==7)
        {
            mysqli_query($conn, "update payment set sem7=0 where roll_no='$r' "); 
        }
        if($sem==8)
        {
            mysqli_query($conn, "update payment set sem8=0 where roll_no='$r' "); 
        }
        
    }
    


    


?>