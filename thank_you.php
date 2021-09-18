<?php
    require('fpdf184/fpdf.php');

    session_start();
    $conn = mysqli_connect('localhost','root','','college_system');
        
    $r = $conn->real_escape_string($_SESSION['roll_no']);
    
    if(isset($_SESSION['OID']))
    {
        $resultset = $conn->query("SELECT * FROM payments_statements WHERE serial_no='".$_SESSION['OID']."'"); 

        $result = $conn->query("SELECT * FROM student_info WHERE roll_no='$r'"); 

        if($resultset->num_rows != 0 && $result->num_rows != 0)
        {
            $invoice = mysqli_fetch_assoc($resultset);
            $info = mysqli_fetch_assoc($result);

            $v = $info['batch']+4;

            $k = $invoice['amount']-1000;

            $pdf = new FPDF('P','mm','A4');

            $pdf->AddPage();

            $pdf->SetFont('Arial','B',20);


            $pdf->Cell(5 ,10,'',0,0);
            $pdf->Cell(59 ,5,'Govt College of Engineering and Ceramic Technology',0,0);
            $pdf->Cell(59 ,10,'',0,1);

            $pdf->SetFont('Arial','',15);
            $pdf->Cell(40 ,10,'',0,0);
            $pdf->Cell(59 ,5,'73, A. C. Banerjee Lane, Kolkata-10',0,0);
            $pdf->Cell(59 ,7,'',0,1);

            $pdf->Cell(50 ,10,'',0,0);
            $pdf->Cell(59 ,5,'GOVT. OF WEST BENGAL',0,0);
            $pdf->Cell(59 ,7,'',0,1);

            $pdf->Cell(60 ,10,'',0,0);
            $pdf->Cell(59 ,5,'Phone : 2370 1264',0,0);
            $pdf->Cell(59 ,7,'',0,1);
            
            $pdf->Cell(71 ,5,'',0,0);
            $pdf->Cell(45 ,5,'',0,0);
            $pdf->Cell(59 ,10,'Date : ' . date("d/m/Y"),0,1);

            $pdf->SetFont('Arial','',12);
            $pdf->Cell(71 ,7,'Name of Student : '. $info['name'],0,0);
            $pdf->Cell(59, 7,'',0,1);
            $pdf->Cell(71 ,7,'Branch : '. $info['dept'],0,0);
            $pdf->Cell(25, 7,'',0,0);
            $pdf->Cell(71 ,7,'Semester : '. $invoice['sem'],0,0);
            $pdf->Cell(59, 7,'',0,1);
            $pdf->Cell(71 ,7,'Roll No : '. $info['roll_no'],0,0);
            $pdf->Cell(25, 7,'',0,0);
            $pdf->Cell(71 ,7,'Reg No : '. $info['reg_no'] ,0,0);
            $pdf->Cell(59, 7,'',0,1);
            $pdf->Cell(71 ,7,'Batch : '. $info['batch'] . '-' .  $v,0,0);
            $pdf->Cell(59, 7,'',0,1);
            $pdf->Cell(71 ,7,'Phone : '. $info['mob_no'],0,0);
            $pdf->Cell(25, 7,'',0,0);
            $pdf->Cell(71 ,7,'Email ID : '. $info['email'],0,0);
            $pdf->Cell(59, 7,'',0,1);


            $pdf->Cell(50 ,20,'',0,1);

            $pdf->SetFont('Arial','B',10);

            $pdf->Cell(15 ,6,'Sl',1,0,'C');
            $pdf->Cell(100 ,6,'Details of Fees',1,0,'C');
            $pdf->Cell(40 ,6,'Rs.',1,0,'C');
            $pdf->Cell(35 ,6,'P.',1,1,'C');

            $pdf->SetFont('Arial','',10);

            $pdf->Cell(15 ,6,'1',1,0);
            $pdf->Cell(100 ,6,'Admission Fees',1,0);
            $pdf->Cell(40 ,6,'0',1,0,'R');
            $pdf->Cell(35 ,6,'00',1,1,'R');
                    
            $pdf->Cell(15 ,6,'2',1,0);
            $pdf->Cell(100 ,6,'Tution Fee',1,0);
            $pdf->Cell(40 ,6,$k,1,0,'R');
            $pdf->Cell(35 ,6,'00',1,1,'R');
                    
            $pdf->Cell(15 ,6,'3',1,0);
            $pdf->Cell(100 ,6,'Caution Money',1,0);
            $pdf->Cell(40 ,6,'0',1,0,'R');
            $pdf->Cell(35 ,6,'00',1,1,'R');
                    
            $pdf->Cell(15 ,6,'4',1,0);
            $pdf->Cell(100 ,6,'University Dev. Fee',1,0);
            $pdf->Cell(40 ,6,'0',1,0,'R');
            $pdf->Cell(35 ,6,'00',1,1,'R');
                    
            $pdf->Cell(15 ,6,'5',1,0);
            $pdf->Cell(100 ,6,'University Reg. Fee',1,0);
            $pdf->Cell(40 ,6,'0',1,0,'R');
            $pdf->Cell(35 ,6,'00',1,1,'R');
                    
            $pdf->Cell(15 ,6,'6',1,0);
            $pdf->Cell(100 ,6,'Exam Fee',1,0);
            $pdf->Cell(40 ,6,'1000',1,0,'R');
            $pdf->Cell(35 ,6,'00',1,1,'R');
                    
            $pdf->Cell(15 ,6,'7',1,0);
            $pdf->Cell(100 ,6,'Hostel Rent',1,0);
            $pdf->Cell(40 ,6,'0',1,0,'R');
            $pdf->Cell(35 ,6,'00',1,1,'R');
                    
            $pdf->Cell(15 ,6,'8',1,0);
            $pdf->Cell(100 ,6,'Hostel Electric Charge',1,0);
            $pdf->Cell(40 ,6,'0',1,0,'R');
            $pdf->Cell(35 ,6,'00',1,1,'R');

            $pdf->Cell(15 ,6,'9',1,0);
            $pdf->Cell(100 ,6,'Late Fee',1,0);
            $pdf->Cell(40 ,6,'0',1,0,'R');
            $pdf->Cell(35 ,6,'00',1,1,'R');

            $pdf->Cell(15 ,6,'10',1,0);
            $pdf->Cell(100 ,6,'Other',1,0);
            $pdf->Cell(40 ,6,'0',1,0,'R');
            $pdf->Cell(35 ,6,'00',1,1,'R');

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(15 ,6,'',1,0);
            $pdf->Cell(100 ,6,'TOTAL',1,0);
            $pdf->Cell(40 ,6,$invoice['amount'],1,0,'R');
            $pdf->Cell(35 ,6,'00',1,1,'R');

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(59 ,30,'Payment Mode : Online',0,0);
            $pdf->Cell(59 ,7,'',0,1);

            $pdf->Cell(59 ,30,'Payment ID : ' . $invoice['payment_id'],0,0);
            $pdf->Cell(59 ,7,'',0,1);

            $pdf->Cell(59 ,30,'Payment Status : ' . $invoice['status'],0,0);
            $pdf->Cell(59 ,7,'',0,1);


            $pdf->Output('invoice.pdf', 'D');



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

