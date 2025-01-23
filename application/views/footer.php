<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b> <a target="_blank" href="https://mysoftheaven.com/">Salesman</a> -v2.3</b>
    </div>
    <strong>Copyright Mysoftheaven (BD) Ltd &copy; <?=date('Y')?> All Rights Reserved.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li>
      </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane" id="control-sidebar-home-tab">

      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- <script>
    function convert_excel(who,type, fn, dl) {
    var elt = document.getElementById(who);
    var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
    return dl ?
        XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
        XLSX.writeFile(wb, fn || ('Sales-Report.' + (type || 'xlsx')));
}
  </script> -->

  <?php
$q1=$this->db->query("select * from db_company where id=1 and status=1");
    $res1=$q1->row();
    $company_name=$res1->company_name;
    $company_mobile=$res1->mobile;
    $company_phone=$res1->phone;
?>
  


  <script>
    function printData() {
        // Get the content to print
        var divToPrint = document.getElementById("report-data");
        
        // Open a new window
        var newWin = window.open("", "_blank");

        // Add the content and styles
        newWin.document.open();
        newWin.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>Print Table</title>
                <style>
                    table {
                        border-collapse: collapse;
                        width: 100%;
                    }
                    th, td {
                        border: 1px solid black;
                        padding: 8px;
                        text-align: left;
                    }
                    th {
                        background-color: #f2f2f2;
                    }
                </style>
            </head>
            <body>
                 <div style="justify-items: center;">
                     <h1><?=$company_name?></h1>
                     <h2><?$company_mobile?></h2>
                     <h1>Sales Report</h1>
                 </div>
                ${divToPrint.outerHTML}
            </body>
            </html>
        `);

        newWin.document.close();
        
        newWin.print();

        // Print and close the new window
        setTimeout(() => {
          
          newWin.close();
        }, 2000);
    }

  </script>
