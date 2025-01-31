<!DOCTYPE html>
<html>
<title><?= $page_title;?>- Format 2</title>
<head>
<link rel='shortcut icon' href='<?php echo $theme_link; ?>images/favicon.ico' />

<style>
table, th, td {
    /*border: 1px solid black;*/
    border-collapse: collapse;
    font-family: 'Open Sans', 'Martel Sans', sans-serif;
}
th, td {
    padding: 5px;
    text-align: left;   
    vertical-align:top 
}
.dashed_top{
  border-top-style: dashed;
  border-width: 0.1px;
}
.dashed_bottom{
  border-bottom-style: dashed;
  border-width: 0.1px;
}
.dashed_left{
  border-left-style: dashed;
  border-width: 0.1px;
}
.dashed_right{
  border-right-style: dashed;
  border-width: 0.1px;
}
</style>
</head>
<body onload="window.print();"><!--  -->
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
    $company_logo=$res1->company_logo;

    $q4=$this->db->query("select sales_invoice_footer_text from db_sitesettings where id=1");
    $res4=$q4->row();
    $sales_invoice_footer_text=$res4->sales_invoice_footer_text;
    

    $q3=$this->db->query("SELECT a.customer_name,a.mobile,a.phone,a.gstin,a.tax_number,a.email,
                           a.opening_balance,a.country_id,a.state_id,a.created_by,
                           a.postcode,a.address,b.sales_date,b.created_time,b.reference_no,
                           b.sales_code,b.sales_note,b.sales_status,
                           coalesce(b.grand_total,0) as grand_total,
                           coalesce(b.subtotal,0) as subtotal,
                           coalesce(b.paid_amount,0) as paid_amount,
                           coalesce(b.other_charges_input,0) as other_charges_input,
                           other_charges_tax_id,
                           coalesce(b.other_charges_amt,0) as other_charges_amt,
                           discount_to_all_input,
                           b.discount_to_all_type,
                           coalesce(b.tot_discount_to_all_amt,0) as tot_discount_to_all_amt,
                           coalesce(b.round_off,0) as round_off,
                           b.payment_status

                           FROM db_customers a,
                           db_sales b 
                           WHERE 
                           a.`id`=b.`customer_id` AND 
                           b.`id`='$sales_id' 
                           ");
                           /*GROUP BY 
                           b.`customer_code`*/
    
    $res3=$q3->row();
    $customer_name=$res3->customer_name;
    $customer_mobile=$res3->mobile;
    $customer_phone=$res3->phone;
    $customer_email=$res3->email;
    $customer_country=$res3->country_id;
    $customer_state=$res3->state_id;
    $customer_address=$res3->address;
    $customer_postcode=$res3->postcode;
    $customer_gst_no=$res3->gstin;
    $customer_tax_number=$res3->tax_number;
    $customer_opening_balance=$res3->opening_balance;
    $sales_date=$res3->sales_date;
    $created_time=$res3->created_time;
    $reference_no=$res3->reference_no;
    $sales_code=$res3->sales_code;
    $sales_note=$res3->sales_note;
    $sales_status=$res3->sales_status;
    $created_by=$res3->created_by;

    
    $subtotal=$res3->subtotal;
    $grand_total=$res3->grand_total;
    $other_charges_input=$res3->other_charges_input;
    $other_charges_tax_id=$res3->other_charges_tax_id;
    $other_charges_amt=$res3->other_charges_amt;
    $paid_amount=$res3->paid_amount;
    $discount_to_all_input=$res3->discount_to_all_input;
    $discount_to_all_type=$res3->discount_to_all_type;
    $discount_to_all_type = ($discount_to_all_type=='in_percentage') ? '%' : 'Fixed';
    $tot_discount_to_all_amt=$res3->tot_discount_to_all_amt;
    $round_off=$res3->round_off;
    $payment_status=$res3->payment_status;
    
    if(!empty($customer_country)){
      $customer_country = $this->db->query("select country from db_country where id='$customer_country'")->row()->country;  
    }
    if(!empty($customer_state)){
      $customer_state = $this->db->query("select state from db_states where id='$customer_state'")->row()->state;  
    }
    

    ?>

<table align="center" width="100%" height='100%' style="border:1px solid;">
    <thead>
      <tr>
        <th colspan="8">
          <table width="100%">
            <tr>
              <th colspan="12" style="text-transform: uppercase;text-align: center;">
              <?=  $this->lang->line('sales_invoice').' '.$sales_status;?>
              </th>
            </tr>
            <tr>
              <th colspan="6" style="">
                  <b><?php echo $company_name; ?></b><br/>
                  <?php echo $this->lang->line('address')." : ".$company_address; ?><br/>
                  <?php echo $company_country; ?><br/>
                  <?php echo $this->lang->line('mobile').":".$company_mobile; ?><br/>
                  <?php echo (!empty(trim($company_email))) ? $this->lang->line('email').": ".$company_email."<br>" : '';?>
                  <?php echo (!empty(trim($company_gst_no))) ? $this->lang->line('gst_number').": ".$company_gst_no."<br>" : '';?>
                  <?php echo (!empty(trim($company_vat_no))) ? $this->lang->line('vat_number').": ".$company_vat_no."<br>" : '';?>
                </th>
              <th colspan="6" style="text-align: right;">
                <img src="http://salesman-jst.mysoftheaven.com/uploads/invenoty_with_POS1.png" width='auto' height='150px'>
              </th>
              
            </tr>
            <tr class=" ">
              <td colspan="6" style="border: 1px solid;" >
              <center><?= $this->lang->line('customer_details'); ?></center>
              <?php echo $this->lang->line('name').": ".$customer_name; ?><br/>
                <?php echo $this->lang->line('mobile').": ".$customer_mobile; ?>
                <br>
                Address:
                <?php 
                        if(!empty($customer_address)){
                          echo $customer_address;
                        }
                        if(!empty($customer_state)){
                          echo ",".$customer_state;
                        }
                        if(!empty($customer_postcode)){
                          echo "-".$customer_postcode;
                        }
                        if(!empty($customer_country)){
                          echo ",".$customer_country;
                        }
                      ?>
                      <br>
                <?php echo (!empty(trim($customer_email))) ? $this->lang->line('email').": ".$customer_email."<br>" : '';?>
                <?php echo (!empty(trim($customer_gst_no))) ? $this->lang->line('gst_number').": ".$customer_gst_no."<br>" : '';?>
                <?php echo (!empty(trim($customer_tax_number))) ? $this->lang->line('tax_number').": ".$customer_tax_number."<br>" : '';?>
            </td>
              
              <td colspan="6" style="border: 1px solid;" >
                      <?= $this->lang->line('invoice_no'); ?> : <?php echo "$sales_code"; ?><br>
                      <?= $this->lang->line('reference_no'); ?> : <?php echo "$reference_no"; ?><br>
                      <?= $this->lang->line('date'); ?> : <?php echo show_date($sales_date)." ".$created_time; ?><br>
                      <?= $this->lang->line('sales_man'); ?> : <?php echo ucfirst($created_by); ?><br>
              </td>
            </tr>
          </table>
        </th>
    </tr>
     
  


      
  
    
  <tr style=''>
    <th style='border-right: 1px solid;border-top: 1px solid;' rowspan='2' style=''>#</th>
    <th style='border-right: 1px solid;border-top: 1px solid;' rowspan='2' colspan='4'><?= $this->lang->line('description'); ?></th>
    <!-- <th rowspan='2'><?= $this->lang->line('sales_price'); ?></th> -->
    <th style='border-right: 1px solid;border-top: 1px solid;' rowspan='2'><?= $this->lang->line('quantity'); ?></th>
    <!-- <th rowspan='2'><?= $this->lang->line('tax'); ?></th>
    <th rowspan='2'><?= $this->lang->line('tax_amount'); ?></th> -->
    <!-- <th style='border-right: 1px solid;border-top: 1px solid;' rowspan='2'><?= $this->lang->line('unit_price'); ?></th> -->
    <!-- <th rowspan='2'><?= $this->lang->line('discount'); ?></th> -->
    <!-- <th style='border-right: 1px solid;border-top: 1px solid;' rowspan='2'><?= $this->lang->line('discount_amount'); ?></th> -->
    <th style='border-right: 1px solid;border-top: 1px solid;' rowspan='2'><?= $this->lang->line('unit_cost'); ?></th>
    <th style='border-right: 1px solid;border-top: 1px solid;' rowspan='2'><?= $this->lang->line('total_amount'); ?></th>
  </tr>
  </thead>
<tbody style="border: 1px solid;">
  <tr style="border-bottom: 1px solid;">
 <?php
              $i=0;
              $tot_qty=0;
              $tot_sales_price=0;
              $tot_tax_amt=0;
              $tot_discount_amt=0;
              $tot_unit_total_cost=0;
              $tot_total_cost=0;
              $this->db->select('c.item_name, a.sales_qty, a.price_per_unit, b.tax, b.tax_name, a.tax_amt, a.unit_discount_per, a.discount_amt, a.unit_total_cost, a.total_cost,db_units.unit_name');
              $this->db->from('db_salesitems AS a');
              $this->db->join('db_tax AS b', 'b.id = a.tax_id');
              $this->db->join('db_items AS c', 'c.id = a.item_id');
              $this->db->join('db_units', 'c.unit_id = db_units.id');
              $this->db->where('a.sales_id', $sales_id);
              $q2 = $this->db->get();
              foreach ($q2->result() as $res2) {
                //dd($res2);
                  $discount = (empty($res2->unit_discount_per)||$res2->unit_discount_per==0)? '-':$res2->unit_discount_per."%";
                  $discount_amt = (empty($res2->discount_amt)||$res2->unit_discount_per==0)? '-':$res2->discount_amt."";

                  $unit_price_with_tax= number_format($res2->price_per_unit+$res2->tax_amt,2,'.','');
                  echo "<tr>";  
                  echo "<td style='border-right: 1px solid;border-top: 1px solid;'>".++$i."</td>";
                  echo "<td style='border-right: 1px solid;border-top: 1px solid;' colspan='4'>".$res2->item_name."</td>";
                  //echo "<td>".$res2->price_per_unit."</td>";
                  echo "<td style='border-right: 1px solid;border-top: 1px solid;'>".$res2->sales_qty."".$res2->unit_name."</td>";
                  /*echo "<td>".$res2->tax."%<br>".$res2->tax_name."</td>";
                  echo "<td style='text-align: right;'>".$res2->tax_amt."</td>";*/
                  // echo "<td style='text-align: right;border-right: 1px solid;border-top: 1px solid;'>".$unit_price_with_tax."</td>";
                  /*echo "<td style='text-align: right;'>".$discount."</td>";*/
                  // echo "<td style='text-align: right;border-right: 1px solid;border-top: 1px solid;'>".$discount_amt."</td>";
                  echo "<td style='text-align: right;border-right: 1px solid;border-top: 1px solid;'>".$res2->unit_total_cost."</td>";
                  echo "<td style='text-align: right;border-right: 1px solid;border-top: 1px solid;'>".$res2->total_cost."</td>";
                  echo "</tr>";  
                  $tot_qty +=$res2->sales_qty;
                  $tot_sales_price +=$res2->price_per_unit;
                  $tot_tax_amt +=$res2->tax_amt;
                  $tot_discount_amt +=$res2->discount_amt;
                  $tot_unit_total_cost +=$res2->unit_total_cost;
                  $tot_total_cost +=$res2->total_cost;
              }
              ?>
  </tr>
  </tbody>
<tfoot>
  <!-- <tr>
    <td colspan="3" style="text-align: center;font-weight: bold;"><?= $this->lang->line('total'); ?></td>
    <td colspan="1" style="font-weight: bold;"><?=$tot_qty; ?></td>
    <td colspan="1" style="">-</td>
    <td colspan="1" style="text-align: right;" ><b><?php echo number_format(($tot_tax_amt),2,'.',''); ?></b></td>
    <td colspan="1" style="">-</td>
    <td colspan="1" style="text-align: right;" ><b><?php echo number_format(($tot_discount_amt),2,'.',''); ?></b></td>
    <td colspan="1" style="text-align: right;" ><b><?php echo number_format(($tot_unit_total_cost),2,'.',''); ?></b></td>
    <td colspan="1" style="text-align: right;" ><b><?php echo number_format(($tot_total_cost),2,'.',''); ?></b></td>
  </tr> -->
  <tr>
    <td colspan="7" style="text-align: right;"><b><?= $this->lang->line('total'); ?></b></td>
    <td colspan="1" style="text-align: right;" ><b><?php echo number_format(($tot_total_cost),2,'.',''); ?></b></td>
  </tr>
  <!-- <tr>
    <td colspan="9" style="text-align: right;"><b><?= $this->lang->line('subtotal'); ?></b></td>
    <td colspan="1" style="text-align: right;" ><b><?php echo number_format(round($subtotal),2,'.',''); ?></b></td>
  </tr> -->
  
  <tr>
    <td colspan="7" style="text-align: right;"><b><?= $this->lang->line('other_charges'); ?></b></td>
    <td colspan="1" style="text-align: right;" ><b><?php echo number_format(round($other_charges_amt),2,'.',''); ?></b></td>
  </tr>
  <tr>
    <td colspan="7" style="text-align: right;"><b><?= $this->lang->line('discount_on_all'); ?>(<?= $discount_to_all_input." ".$discount_to_all_type; ?>)</b></td>
    <td colspan="1" style="text-align: right;" ><b><?php echo number_format(round($tot_discount_to_all_amt),2,'.',''); ?></b></td>
  </tr>
  <tr>
    <td colspan="7" style="text-align: right;"><b><?= $this->lang->line('round_off'); ?></b></td>
    <td colspan="1" style="text-align: right;" ><b><?php echo number_format(($round_off),2,'.',''); ?></b></td>
  </tr>
  <tr>
    <td colspan="6">
      <?php echo "<span class='amt-in-word'>Amount in words: <i style='font-weight:bold;'>".no_to_words(round($grand_total))." Only</i></span>"; ?>
    </td>
    <td colspan="1" style="text-align: right;"><b><?= $this->lang->line('grand_total'); ?></b></td>
    <td colspan="1" style="text-align: right;" ><b><?php echo number_format(round($grand_total),2,'.',''); ?></b></td>
  </tr>
  <tr>
    <td colspan="8">
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
  
</td>
  </tr>

  <tr>
    <td colspan="4" style="text-align: center;padding-top: 100px;border: 1px solid;">
      <b><?= $this->lang->line('customer_signature'); ?></b>
    </td>
    <td colspan="4" style="text-align: center;padding-top: 100px;border: 1px solid;">
      <b><?= $this->lang->line('authorised_signature'); ?>
    </td>
  </tr>

  <?php if(!empty($sales_invoice_footer_text)) {?>
  <tr style="border-top: 1px solid;">
    <td colspan="8" style="text-align: center;">
      <b><?= $sales_invoice_footer_text; ?></b>
    </td>
  </tr>
  <?php } ?>
</tfoot>
</table>



</body>
</html>
