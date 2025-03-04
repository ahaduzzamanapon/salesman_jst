<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 650px;
            margin: 20px auto;
            background: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            position: relative;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header .logo img {
            height: 60px;
        }

        .header .details {
            text-align: right;
            font-size: 14px;
        }

        .header .details h2 {
            margin: 0;
            color: #f89c1c;
        }

        .title {
            text-align: center;
            margin: 20px 0;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .content {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .content .row {
            display: flex;
            margin-bottom: 10px;
        }

        .content .row .label {
            width: 30%;
            font-weight: bold;
        }

        .content .row .value {
            width: 70%;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            align-items: center;
        }

        .footer .signature {
            text-align: center;
            margin-top: 30px;
        }

        .footer .signature span {
            display: block;
            margin-top: 5px;
        }
        .btn{
            background-color: #f89c1c;
            border-color: #f89c1c;
            color: #fff;
            padding: 5px 10px;
        }
        @media print {
            .btn{
                display: none;
            }
        }
    </style>
</head>
<?php

$data=$this->db->query("select * from db_salespayments where id=$payment_id")->row();
$sales_id=$data->sales_id;
$sale_data=$this->db->query("select * from db_sales where id=$sales_id")->row();
$customer_id=$sale_data->customer_id;
$customer_data=$this->db->query("select * from db_customers where id=$customer_id")->row();
//dd($customer_data);


//dd($data);
$payment= $data->payment;

// Convert image to Base64
function imageToBase64($imagePath) {
    $imageData = file_get_contents($imagePath);
    $base64 = base64_encode($imageData);

    // Use getimagesize() to get MIME type
    $imageInfo = getimagesize($imagePath);
    $mimeType = $imageInfo['mime'];

    return 'data:' . $mimeType . ';base64,' . $base64;
}

    $logoBase64 = imageToBase64('http://salesman-jst.mysoftheaven.com/uploads/invenoty_with_POS1.png');



?>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="<?=$logoBase64?>" alt="Logo">
            </div>
            <div class="details">
                <h2>JST Trading Corporation</h2>
                <p>14 Purana Paltan (7th floor), Darus Salam Arcade</p>
                <p>Room No. 10/A, Dhaka-1000, Bangladesh</p>
                <p>+88 01733 606 723 | jsttradingbd@gmail.com</p>
            </div>
        </div>

        <div class="title">Money Receipt</div>

        <div class="content">
            <div class="row">
                <div class="label">Received with thanks from</div>
                <div class="value"><?=$customer_data->customer_name?></div>
            </div>
            <div class="row">
                <div class="label">Purpose</div>
                <div class="value"></div>
            </div>
            <?php

            $data=$this->db->query("select * from db_salespayments where id=$payment_id")->row();
            $sales_id=$data->sales_id;
            $sale_data=$this->db->query("select * from db_sales where id=$sales_id")->row();
            $customer_id=$sale_data->customer_id;
            $customer_data=$this->db->query("select * from db_customers where id=$customer_id")->row();
            //dd($customer_data);
            
            
            //dd($data);
            $payment= $data->payment;


            
            ?>

<?php
      function no_to_words($no)
      {   
       $words = array('0'=> '' ,'1'=> 'One' ,'2'=> 'Two' ,'3' => 'Three','4' => 'Four','5' => 'Five','6' => 'Six','7' => 'Seven','8' => 'Eight','9' => 'Nine','10' => 'Ten','11' => 'Eleven','12' => 'Twelve','13' => 'Thirteen','14' => 'Fouteen','15' => 'Fifteen','16' => 'Sixteen','17' => 'Seventeen','18' => 'Eighteen','19' => 'Nineteen','20' => 'Twenty','30' => 'Thirty','40' => 'Fourty','50' => 'Fifty','60' => 'Sixty','70' => 'Seventy','80' => 'Eighty','90' => 'Ninty','100' => 'Hundred &','1000' => 'Thousand','100000' => 'Lakh','10000000' => 'Crore');
        if($no == 0)
          return ' ';
        else {
        $novalue='';
        $highno=$no;
        $remainno=0;
        $value=100;
        $value1=1000;       
            while($no>=100)    {
              if(($value <= $no) &&($no  < $value1))    {
              $novalue=$words["$value"];
              $highno = (int)($no/$value);
              $remainno = $no % $value;
              break;
              }
              $value= $value1;
              $value1 = $value * 100;
            }       
            if(array_key_exists("$highno",$words))
              return $words["$highno"]." ".$novalue." ".no_to_words($remainno);
            else {
             $unit=$highno%10;
             $ten =(int)($highno/10)*10;            
             return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".no_to_words($remainno);
             }
        }
      }
?>


            <div class="row">
                <div class="" style="white-space:nowrap">In Cash / Cheque / D.D. No________________ Bank __________ Branch __________Date____________</div>
            </div>
            <div class="row">
                <div class="label">Taka</div>
                <div class=""><?= $payment; ?> In Word : <?= no_to_words($payment); ?></div>
            </div>
        </div>

        <div class="footer">
            <div class="signature">
                <p>Paid By</p>
                <span>_______________________</span>
            </div>
            <div class="signature">
                <p>For JST Trading Corporation</p>
                <span>_______________________</span>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script>
function generatePDF() {
    // Get the entire body content
    const element = document.body;

    html2pdf()
        .from(element)
        .set({
            margin: 10,
            filename: 'mypage.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true, allowTaint: true },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        })
        .outputPdf('bloburl') // Get a Blob URL
        .then((pdfUrl) => {
            // Open the generated PDF in a new tab
            window.open(pdfUrl, '_blank');
        });
}
  document.addEventListener('DOMContentLoaded', function() {
    generatePDF()
  });
</script>
</body>
</html>
