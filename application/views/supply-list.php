<!DOCTYPE html>
<html>

<head>
    <!-- TABLES CSS CODE -->
    <?php include"comman/code_css_datatable.php"; ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <!-- Left side column. contains the logo and sidebar -->

        <?php include"sidebar.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <!-- ********** ALERT MESSAGE START******* -->
                    <?php include"comman/code_flashdata.php"; ?>
                    <!-- ********** ALERT MESSAGE END******* -->
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <?php
                              $q1=$this->db->query("select * from db_sales where id=$sales_id");
                              $res1=$q1->row();
                              $customer_id = $res1->customer_id;
                              $q2=$this->db->query("select * from db_customers where id=$customer_id");
                              $res2=$q2->row();
                          
                              $customer_name=$res2->customer_name;
                                $customer_mobile=$res2->mobile;
                                $customer_phone=$res2->phone;
                                $customer_email=$res2->email;
                                $customer_country=$res2->country_id;
                                $customer_state=$res2->state_id;
                                $customer_address=$res2->address;
                                $customer_postcode=$res2->postcode;
                                $customer_gst_no=$res2->gstin;
                                $customer_tax_number=$res2->tax_number;
                                $customer_opening_balance=$res2->opening_balance;
                          
                                $sales_date=$res1->sales_date;
                                $reference_no=$res1->reference_no;
                                $sales_code=$res1->sales_code;
                                $sales_note=$res1->sales_note;
                                $grand_total=$res1->grand_total;
                                $paid_amount=$res1->paid_amount;
                                $due_amount =$grand_total - $paid_amount;
                          
                                if(!empty($customer_country)){
                                  $customer_country = $this->db->query("select country from db_country where id='$customer_country'")->row()->country;
                                }
                                if (!empty($customer_state) && $customer_state !== null) {
                                $q = $this->db->query("select state from db_states where id='$customer_state'");
                                if ($q->num_rows() > 0) {
                                  $row = $q->row();
                                  $customer_state = $row->state;
                                }
                              }
                          
                              ?>
                                <div class="col-md-12">
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            <strong>Customer Information</strong>
                                            <address>
                                                <strong><?= $customer_name; ?></strong><br>
                                                <?= !empty(trim($customer_mobile)) ? $this->lang->line('mobile') . ": " . $customer_mobile . "<br>" : ''; ?>
                                                <?= !empty(trim($customer_phone)) ? $this->lang->line('phone') . ": " . $customer_phone . "<br>" : ''; ?>
                                                <?= !empty(trim($customer_email)) ? $this->lang->line('email') . ": " . $customer_email . "<br>" : ''; ?>
                                                <?= !empty(trim($customer_gst_no)) ? $this->lang->line('gst_number') . ": " . $customer_gst_no . "<br>" : ''; ?>
                                                <?= !empty(trim($customer_tax_number)) ? $this->lang->line('tax_number') . ": " . $customer_tax_number . "<br>" : ''; ?>
                                            </address>
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            <strong>Sales Information</strong>
                                            <address>
                                                <b>Invoice #<?= $sales_code; ?></b><br>
                                                <b>Date: <?= show_date($sales_date); ?></b><br>
                                                <b>Grand Total: <?= $grand_total; ?></b><br>
                                            </address>
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            <b>Paid Amount:
                                                <span><?= number_format($paid_amount, 2, '.', ''); ?></span></b><br>
                                            <b>Due Amount: <span
                                                    id='due_amount_temp'><?= number_format($due_amount, 2, '.', ''); ?></span></b><br>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $supply_ref_id=$this->db->select('supply_uniq_id,supply_date')
                                              ->from('db_sale_supply_item')
                                              ->where('db_sales_id',$sales_id)
                                              ->group_by('supply_uniq_id')
                                              ->get()
                                              ->result();
                                ?>
                                <table class="table table-bordered table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Supply Date</th>
                                            <th>Supply Reference No.</th>
                                            <th>Actions</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                        if(!empty($supply_ref_id)){
                                        foreach ($supply_ref_id as $key => $value) {?>
                                            <tr>
                                                <td><?= $key+1; ?></td>
                                                <td><?= show_date($value->supply_date); ?></td>
                                                <td><?= $value->supply_uniq_id; ?></td>
                                                <td>
                                                    <a href="<?= $base_url; ?>sales/supply_view/<?= $value->supply_uniq_id; ?>/<?= $sales_id; ?>"
                                                        class="btn btn-primary btn-xs">View</a>
                                                    <a href="<?= $base_url; ?>sales/supply_chalan/<?= $value->supply_uniq_id; ?>/<?= $sales_id; ?>"
                                                        class="btn btn-primary btn-xs" target="_blank">Print Chalan</a>
                                                </td>
                                            </tr>
                                        <?php } } ?>
                                      </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include"footer.php"; ?>
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <!-- SOUND CODE -->
    <?php include"comman/code_js_sound.php"; ?>
    <!-- TABLES CODE -->
    <?php include"comman/code_js_datatable.php"; ?>

    <script src="<?php echo $theme_link; ?>js/country.js"></script>

    <script type="text/javascript">
    var table;
    $(document).ready(function() {
        //datatables
        table = $('#example2').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "responsive": true,

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('country/ajax_list')?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [2], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],
        });
        new $.fn.dataTable.FixedHeader(table);
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert-dismissable").fadeOut(1000, function() {});
        }, 3000);
    });
    </script>
    <!-- Make sidebar menu hughlighter/selector -->
    <script>
    $(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");
    </script>

</body>

</html>