<?php
include_once('classes/cartClass.php');
include_once('classes/order_detailsClass.php');
require('assets/fpdf17/fpdf.php');
if(isset($_GET['o_no'])){
    // echo 'get kar liya';
    $o_no = $_GET['o_no'];
    $s_id = $_GET['s_id'];
}
$order_detail = new order_details();
$user1 = new cart();
$odr = $order_detail->fetch_data($o_no);

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',25);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130	,5,'                           Kiryano.com',0,1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(189	,10,'',0,1);
$pdf->Cell(59	,5,'CUSTOMER INVOICE',0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','B',12);


//order number
$pdf->Cell(31	,5,'Order Number:',0,0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(130	,5,$_GET['o_no'],0,1);

// name
$pdf->SetFont('Arial','B',12);
$pdf->Cell(14	,5,'Name:',0,0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(130	,5,$odr['name'],0,1);

//shipping address
$pdf->SetFont('Arial','B',12);
$pdf->Cell(39	,5,'Shipping Address:',0,0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(130	,5,$odr['address'],0,1);

//phone
$pdf->SetFont('Arial','B',12);
$pdf->Cell(15	,5,'Phone:',0,0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(130	,5,$odr['phone'],0,1);

//Order Date:
$pdf->SetFont('Arial','B',12);
$pdf->Cell(25	,5,'Order Date:',0,0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(130	,5,$odr['o_date'],0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line


//invoice contents
$pdf->SetFont('Arial','B',12);
$pdf->Cell(9	,5,'No.',1,0);
$pdf->Cell(100	,5,'Products',1,0);
$pdf->Cell(12	,5,'Qty',1,0);
$pdf->Cell(34	,5,'Price',1,0);//end of line
$pdf->Cell(22	,5,'Total',1,1);


$result = $user1->get_pending_order($o_no,$s_id);
$sub_total =0;
	foreach ($result as $row) {
		$pdf->SetFont('Arial','',12);
        $pdf->Cell(9	,5,$row['order_id'],1,0);
        $pdf->Cell(100	,5,$row['p_name'],1,0);
        $pdf->Cell(12	,5,$row['quantity'],1,0);
        $pdf->Cell(34	,5,$row['p_price'],1,0);//end of line
        $pdf->Cell(22	,5,$row['p_price']*$row['quantity'],1,1,'R');
        $sub_total = $sub_total + $row['p_price']*$row['quantity'];
	}

if($sub_total > 500){
    $shipping_fee = 0;
}else
    //$shipping_fee = 30;
    $shipping_fee =30;




//subtotal
$pdf->Cell(109	,5,'',0,0);
$pdf->Cell(35	,5,'Subtotal',1,0);

$pdf->Cell(33	,5,$sub_total,1,1,'R');//end of line

$pdf->Cell(109	,5,'',0,0);
$pdf->Cell(35	,5,'Voucher Discount',1,0);

$pdf->Cell(33	,5,$odr['coupan_value'],1,1,'R');//end of line

$pdf->Cell(109	,5,'',0,0);
$pdf->Cell(35	,5,'Shipping',1,0);

$pdf->Cell(33	,5,$shipping_fee,1,1,'R');//end of line

$pdf->Cell(109	,5,'',0,0);
$pdf->Cell(35	,5,'Prepaid Amount',1,0);
$pdf->Cell(33	,5,'0',1,1,'R');

$pdf->Cell(109	,5,'',0,0);
$pdf->Cell(35	,5,'Grass Total',1,0);
$pdf->Cell(33	,5,$sub_total + $shipping_fee-$odr['coupan_value'],1,1,'R');

//Return Policy
$pdf->Cell(180	,2,'',0,1,'R');
$pdf->Cell(177	,0,'',1,1,'R');

//return


$pdf->Cell(177	,0,'',1,1,'R');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(177	,2,'',0,1,'R');
$pdf->Cell(35	,5,'Return Guidlines',0,1);
//guidlines
$pdf->SetFont('Arial','',12);
$pdf->Cell(177	,1,'',0,1,'R');
$pdf->Cell(150	,5,'1.Only Those Products Are Returnable Which Are Mentioned With Tag "Returnable" on Kiryano.com.',0,1);

$pdf->Cell(177	,1,'',0,1,'R');
$pdf->Cell(150	,5,'2.Drop a Product To Be Returned On Our Mentioned Address.',0,1);

$pdf->Cell(177	,1,'',0,1,'R');
$pdf->Cell(150	,5,'3.Return Within Three Days Of Purchase.',0,1);

$pdf->Cell(177	,1,'',0,1,'R');
$pdf->Cell(150	,5,'4.No Return Without Customer Invoice.',0,1);

$pdf->Cell(177	,1,'',0,1,'R');
$pdf->Cell(150	,5,'5.Product Cannot be Return If Product is Damaged (Caused By You).',0,1);

//line
$pdf->Cell(180	,2,'',0,1,'R');
$pdf->Cell(177	,0,'',1,1,'R');
$pdf->Cell(177	,0,'',1,1,'R');
//Thankyou message
$pdf->SetFont('Arial','',12);
$pdf->Cell(177	,4,'',0,1,'R');
$pdf->Cell(35	,5,'                                         ThankYou For Purchase! Keep Visiting Kiryano ',0,1);
$pdf->Cell(35	,5,'                                                       For Queries: +923488311613 ',0,1);







//Numbers are right-aligned so we give 'R' after new line parameter























$pdf->Output();
?>
