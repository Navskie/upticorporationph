<?php
    session_start();
    include 'dbms/conn.php';
    include 'function.php';
    include 'fpdf/fpdf.php';

    $pdf = new FPDF();

    $PO = $_GET['poidgenerate'];

    // echo 'hello';
    #NOTE: 
    #Cell->("WIDTH", "HEIGHT", "CONTENT", "BORDER", "UP/DOWN", C);
    #1 means new line
    #0 means on line

    $poid_info = mysqli_query($connect, "SELECT * FROM upti_transaction WHERE trans_poid = '$PO'");
    $poid_info_fetch = mysqli_fetch_array($poid_info);

    $customer_name = $poid_info_fetch['trans_fname'];
    $customer_mobile = $poid_info_fetch['trans_contact'];
    $customer_mop = $poid_info_fetch['trans_mop'];
    $customer_email = $poid_info_fetch['trans_email'];
    $customer_address = $poid_info_fetch['trans_address'];
    $customer_office = $poid_info_fetch['trans_office'];
    $customer_country = $poid_info_fetch['trans_country'];

    if ($customer_country == 'SOUTH KOREA') {
        $customer_country == 'KOREA';
    }

    $total = $poid_info_fetch['trans_subtotal'];
    $shipping = $poid_info_fetch['trans_ship'];
    $less_shipping = $poid_info_fetch['trans_less_ship'];

    $ol_info = mysqli_query($connect, "SELECT * FROM upti_order_list WHERE ol_poid = '$PO'");

    $pdf->AddPage();

    $pdf->Cell(190,5,"",0,1);
    $pdf->Cell(190,5,"",0,1);
    $pdf->Cell(190,5,"",0,1);

    $pdf->Image('images/logo.png',66,10, -950);

    $pdf->Cell(190,5,"",0,1);
    $pdf->Cell(190,5,"",0,1);
    $pdf->Cell(190,5,"",0,1);

    $pdf->SetFont("Arial", "", 14);
    // $pdf->Cell(95,5,"",0,1);
    $pdf->Cell(190,5,"Thank you for your Orders!",0,1, 'C');
    $pdf->Cell(190,5,"We hope you enjoyed shopping with us.",0,1, 'C');

    $pdf->Cell(190,5,"",0,1);
    $pdf->Cell(190,5,"",0,1);

    $pdf->SetFont("Arial", "B", 13);
    // $pdf->SetFillColor(0, 0, 0);
    // $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(5,10,"",0,0,'L');
    $pdf->Cell(185,10,"ORDER INFORMATION",0,1,'L');
    $pdf->Cell(190,5,"",0,1);
    $pdf->SetFont("Arial", "", 14);

    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(20,7,"Order No.: ",0,0);
    $pdf->Cell(75,7,$PO,0,0, 'C');
    $pdf->Cell(45,7,"Payment Method: ",0,0);
    $pdf->Cell(50,7,$customer_mop,0,1);

    $pdf->Cell(45,7,"Delivery Option: ",0,0);
    $pdf->Cell(50,7,$customer_office,0,0);
    $pdf->Cell(95,7,"",0,1);

    $pdf->Cell(190,5,"",0,1);
    $pdf->Cell(190,5,"",0,1);

    $pdf->SetFont("Arial", "B", 13);
    // $pdf->SetFillColor(0, 0, 0);
    // $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(5,10,"",0,0,'L');
    $pdf->Cell(185,10,"DELIVERY DETAILS",0,1,'L');
    $pdf->Cell(190,5,"",0,1);

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont("Arial", "", 14);
    $pdf->Cell(20,7,"Name: ",0,0);
    $pdf->Cell(75,7,$customer_name,0,0, 'C');
    $pdf->Cell(45,7,"Mobile: ",0,0);
    $pdf->Cell(50,7,$customer_mobile,0,1);

    $pdf->Cell(45,7,"Address: ",0,0);
    $pdf->Cell(145,7,$customer_address,0,1);

    $pdf->Cell(190,7,"",0,1);
    $pdf->Cell(190,7,"",0,1);

    $pdf->SetFont("Arial", "B", 13);
    // $pdf->SetFillColor(0, 0, 0);
    // $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(5,10,"",0,0,'L');
    $pdf->Cell(185,10,"ORDER SUMMARY",0,1,'L');
    $pdf->Cell(190,7,"",0,1);

    $pdf->SetTextColor(0, 0, 0);

    $pdf->SetFont("Arial", "B", 12);
    $pdf->Cell(7,7,"#",0,0,'C');
    $pdf->Cell(120,7,"DESCRIPTION",0,0,'C');
    $pdf->Cell(15,7,"QTY",0,0,'C');
    $pdf->Cell(23,7,"PRICE",0,0,'C');
    $pdf->Cell(25,7,"SUBTOTAL",0,1,'C');

    $pdf->SetFont("Arial", "", 12);

    $number = 1;
    while ($rows = mysqli_fetch_array($ol_info)) {

        $ol_desc = $rows['ol_desc'];
        $ol_qty = $rows['ol_qty'];
        $ol_price = $rows['ol_price'];
        $subtotal = $ol_qty * $ol_price;

    // loop
    $pdf->Cell(7,7,$number,0,0,'C');
    $pdf->Cell(120,7,$ol_desc,0,0,'C');
    $pdf->Cell(15,7,$ol_qty,0,0,'C');
    $pdf->Cell(23,7,number_format($ol_price, '2'),0,0,'R');
    $pdf->Cell(25,7,number_format($subtotal, '2'),0,1,'R');
    // loop
    $number++;
    }

    $pdf->Cell(190,7,"",0,1);

    $pdf->Cell(125,7,"",0,0,'C');
    $pdf->Cell(40,7,"Shipping Fee: ",0,0,'L');
    $pdf->Cell(25,7,number_format($shipping, '2'),0,1,'R');

    $pdf->Cell(125,7,"",0,0,'C');
    $pdf->Cell(40,7,"Less Shipping Fee: ",0,0,'L');
    $pdf->Cell(25,7,number_format($less_shipping, '2'),0,1,'R');

    $pdf->Cell(125,7,"",0,0,'C');
    $pdf->Cell(40,7,"Total Amount: ",0,0,'L');
    $pdf->Cell(25,7,number_format($total, '2'),0,1,'R');

    if ($customer_country == 'KOREA') {
        $bank = '김태광, 김마쉘';
    } elseif ($customer_country == 'TAIWAN') {
        $bank = 'Abner Lopez';
    } elseif ($customer_country == 'JAPAN') {
        $bank = 'Asahina Nastsuko';
    } elseif ($customer_country == 'SINGAPORE') {
        $bank = 'KAA-MILL ENTERPRISE PTE. LTD.';
    } elseif ($customer_country == 'CANADA') {
        $bank = 'D&J Go Glow Inc.';
    } elseif ($customer_country == 'HONGKONG') {
        $bank = 'Ads Konnect / Alipay HK';
    } elseif ($customer_country == 'UNITED ARAB EMIRATES' || $customer_country == 'OMAN' || $customer_country == 'BAHRAIN' || $customer_country == 'QATAR' || $customer_country == 'KUWAIT') {
        $bank = 'Mark Lopez';
    }

    if ($customer_country != 'PHILIPPINES') {
        $pdf->Cell(190,20,"",0,1);
        $pdf->SetFont("Arial", "", 14);
        $pdf->Cell(190,7,$bank." is an Uptimised Partner based in ".$customer_country.".",0,1,'C');
        $pdf->Cell(190,7,"We offer premium K-Beauty Skincare Products.",0,1,'C');
    }

    $pdf->Output();
?>