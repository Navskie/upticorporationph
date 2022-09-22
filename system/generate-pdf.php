<?php
    session_start();
    include 'dbms/conn.php';
    include 'function.php';
    include 'fpdf/fpdf.php';

    $pdf = new FPDF();

    $PO = $_GET['pdfpdf'];

    // echo 'hello';
    #NOTE: 
    #Cell->("WIDTH", "HEIGHT", "CONTENT", "BORDER", "UP/DOWN", C);
    #1 means new line
    #0 means on line

    $po_sql = mysqli_query($connect, "SELECT * FROM stockist_vendor WHERE vendor_po = '$PO'");
    $po_fetch = mysqli_fetch_array($po_sql);

    $vendor_name = $po_fetch['vendor_name'];
    $vendor_person = $po_fetch['vendor_person'];
    $vendor_address = $po_fetch['vendor_address'];
    $vendor_number = $po_fetch['vendor_number'];
    $vendor_email = $po_fetch['vendor_email'];
    $vendor_date = $po_fetch['vendor_date'];
    $vendor_remarks = $po_fetch['vendor_remarks'];

    $pdf->AddPage();

    $pdf->SetFont("Arial", "", 12);
    // $pdf->Cell(95,5,"",0,1);
    $pdf->Cell(190,5,"UPTIMISED CORPORATION",1,1);
    $pdf->Cell(100,5,"Donghyup Bldg. Lot 18-20 Manila Ave. CBD Area",1,0);
    $pdf->SetFont("Arial", "B", 19);
    $pdf->Cell(90,5,"PURCHASE ORDER",1,1,'R');
    $pdf->SetFont("Arial", "", 12);
    $pdf->Cell(190,5,"Subic Bay Freeport Zone Philippines",1,1);
    $pdf->Cell(50,5,"(047) 252 0189",1,0);


    // $pdf->SetFont("Arial", "", 12);
    // $pdf->Cell(120,5,"Donghyup Bldg. Lot 18-20 Manila Ave. CBD Area",0,0);

    // $pdf->SetFont("Arial", "B", 19);
    // $pdf->Cell(50,5,"PURCHASE ORDER",0,1);
    
    // $pdf->SetFont("Arial", "", 12);
    // $pdf->Cell(95,5,"Subic Bay Freeport Zone Philippines",0,0);
    // $pdf->SetFont("Arial", "", 12);
    // $pdf->Cell(95,5,"",0,1);
    // $pdf->Cell(95,5,"",0,1);
    // $pdf->Cell(95,5,"Date",0,1);

    // $pdf->Cell(95,5,"(047) 252 0189",0,1);

    $pdf->Output();
?>