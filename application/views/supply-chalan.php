<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    .container {
      width: 800px;
      margin: 20px auto;
      border: 1px solid #ccc;
      padding: 20px;
    }
    .header {
        text-align: center;
        border-bottom: 2px solid #000;
        padding-bottom: 10px;
        display: flex;
        justify-content: space-between;
    }
    .logo{
        width: 100px;
    }
    .company-info {
        text-align: right;
        font-size: 13px;
    }

    .invoice-title {
        margin: 20px 0;
        font-size: 18px;
        font-weight: bold;
        width: fit-content;
        justify-self: center;
        box-shadow: 1px 1px 0px 2px black;
    }
    .details, .table-container {
      margin-bottom: 20px;
    }
    .details span {
      display: inline-block;
      font-weight: bold;
    }
    .table-container table {
      width: 100%;
      border-collapse: collapse;
    }
    .table-container th, .table-container td {
      border: 1px solid #000;
      text-align: center;
      padding: 8px;
    }
    .table-container th {
      background-color: #f4f4f4;
    }
    .footer {
      text-align: center;
      margin-top: 30px;
      font-size: 14px;
    }
    .signature-section {
      margin-top: 50px;
      display: flex;
      justify-content: space-between;
    }
    .signature-section div {
      text-align: center;
      width: 30%;
    }
    .signature-section hr {
      border: none;
      border-top: 1px solid #000;
    }
    .doted {
      border-bottom: 1px dotted #000;
      display: inline-block;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
    <?php
    $q1=$this->db->query("select * from db_company where id=1 and status=1");
    $res1=$q1->row();
    $company_name=$res1->company_name;
    $company_mobile=$res1->mobile;
    $company_phone=$res1->phone;
    $company_email=$res1->email;
    $company_country=$res1->country;
    $company_state=$res1->state;
    $company_city=$res1->city;
    $company_address=$res1->address;
    $company_gst_no=$res1->gst_no;
    $company_vat_no=$res1->vat_no;
    $company_pan_no=$res1->pan_no;
    $logo=$res1->company_logo;
        ?>
        <div>
            <img class="logo" src="http://salesman-jst.mysoftheaven.com/uploads/invenoty_with_POS1.png" alt="Company Logo">
        </div>

        <div class="company-info">
            <h1><?=$company_name?></h1>
            <p><?=$company_address?></p>
            <p>Email: <?=$company_email?> | Phone: +88 <?=$company_phone?></p>
        </div>
    </div>
    <div class="invoice-title">
      Challan
    </div>
    <?php
        $q1=$this->db->query("select * from db_sales where id=$sales_id");
        $res1=$q1->row();
        $customer_id = $res1->customer_id;
        $q2=$this->db->query("select * from db_customers where id=$customer_id");
        $res2=$q2->row();
        //dd($res2);
        if(!empty($customer_country)){
            $customer_country = $this->db->query("select country from db_country where id='$customer_country'")->row()->country;
          }
          if (!empty($customer_state) && $customer_state !== null) {
          $q = $this->db->query("select state from db_states where id='$customer_state'");
          if ($q->num_rows() > 0) {
            $row = $q->row();
            $customer_state = $row->state;
          }else{
            $customer_state = '';
          }
        }


        $supply=$this->db->select('db_sale_supply_item.*,db_items.item_name,db_items.item_code')
                                            ->from('db_sale_supply_item')
                                            ->join('db_items','db_items.id=db_sale_supply_item.item_id')
                                            ->where('supply_uniq_id',$supply_uniq_id)
                                            ->get()
                                            ->result();


    ?>
    <div class="details">
      <p style="width: 100%"><span width="10%">TO:</span> <span class="doted" style="width: 90%"><?=$res2->customer_name?></span></p>
      <p style="width: 100%"><span width="15%">ADDRESS:</span> <span class="doted" style="width: 85%">
        <?php if(isset($res2->address) && $res2->address != ''): ?>
          <?=$res2->address?>
        <?php endif; ?>
        <?php if(isset($customer_state) && $customer_state != ''): ?>
          <?=$customer_state?>
        <?php endif; ?>
        <?php if(isset($customer_country) && $customer_country != ''): ?>
          <?=$customer_country?>
        <?php endif; ?>
      </span></p>
      <p>
      <span>Bill No: </span> <?=$supply_uniq_id?> <span>
      <span>Date: </span> <?= $supply[0]->supply_date;  ?> <span>
        </p>
    </div>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>SL NO.</th>
            <th>DESCRIPTION</th>
            <th>QUANTITY</th>

          </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach($supply as $item): ?>
            <tr>
                <td><?=$i?></td>
                <td><?=$item->item_name?> (<?=$item->item_code?>)</td>
                <td><?=$item->supply_qty?></td>
            </tr>
            <?php $i++; endforeach; ?>
        </tbody>
      </table>
    </div>
    <p><span>Challan No.:</span> <?=$supply_uniq_id?> <span>Date:</span> <?=$supply[0]->supply_date?></p>
    <div class="footer">
    Once goods are sold it can't be returned or changed
    </div>
    <div class="signature-section">
      <div>
        <hr>
        <p>Signature of Receiver</p>
      </div>
      <div>
        <hr>
        <p>In Charge (Store)</p>
      </div>
      <div>
        <hr>
        <p>For JST TRADING CORPORATION</p>
      </div>
    </div>
  </div>
</body>
</html>
