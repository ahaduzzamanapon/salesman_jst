<!DOCTYPE html>
<html>

<head>
    <!-- TABLES CSS CODE -->
    <?php include"comman/code_css_form.php"; ?>
    <!-- </copy> -->
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include"sidebar.php"; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <small>Sub Category</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?php echo $base_url; ?>category/sub_category">Sub Category</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="col-md-12">
                    <div class="box box-info ">
                        <div class="box-header with-border">
                            <h3 class="box-title">Please Enter Valid Data</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="sub_category-form">
                            <input type="hidden" name="sub_category_id" id="sub_category_id" value="">
                            <input type="hidden" id="<?php echo $this->security->get_csrf_token_name();?>"
                                value="<?php echo $this->security->get_csrf_hash();?>">
                            <input type="hidden" id="base_url" value="<?php echo $base_url; ?>">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="category_id" class="col-sm-2 control-label">Category Name</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="category_id" name="category_id">
                                            <option value="">Select Category</option>
                                            <?php
                                              foreach ($category as $row) {
                                                echo '<option value="' . $row->id . '">' . $row->category_name . '</option>';
                                              }
                                            ?>
                                        </select>
                                    </div>
                                    <label for="sub_category_name" class="col-sm-2 control-label">Sub Category
                                        Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control input-sm" id="sub_category_name"
                                            name="sub_category_name" placeholder="" autofocus>
                                        <span id="sub_category_msg" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control input-sm" id="description" name="description"
                                            placeholder=""></textarea>
                                        <span id="description_msg" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="button" class="btn btn-info pull-right" id="submit"
                                    onclick="submit_sub_form(event)">Submit</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12" style="padding: 28px;">
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title">Sub Category List</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="sub_category-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Sub Category Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($sub_category as $row) {
                                              echo '<tr>';
                                              echo '<td>'.$row->category_name.'</td>';
                                              echo '<td>'.$row->sub_category_name.'</td>';
                                              echo '<td>'.$row->description.'</td>';
                                              echo '<td><a class="btn btn-info" onclick="update_sub_cat('.$row->id.')""><i class="fa fa-edit"></i>Update</a></td>';
                                              echo '</tr>';
                                            }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
    <?php include"comman/code_js_form.php"; ?>

    <script src="<?php echo $theme_link; ?>js/category.js"></script>
    <!-- Make sidebar menu hughlighter/selector -->
    <script>
    $(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");
    </script>

    <script>
    function submit_sub_form(e) {      
      e.preventDefault();
      var category_id = $('#category_id').val()
      var sub_category_name= $('#sub_category_name').val()
      var description= $('#description').val()
      var sub_category_id= $('#sub_category_id').val()
      $.post('sub_category_save', {category_id:category_id,sub_category_name:sub_category_name,description:description,sub_category_id:sub_category_id}, function(result) {
        alert(result)
        location.reload()
      });
    }
    </script>
    <script>
    function update_sub_cat(id) {
      $.post('sub_category_update', {id:id}, function(result) {
        var data = JSON.parse(result)
        $('#sub_category_id').val(data.id)
        $('#category_id').val(data.category_id)
        $('#sub_category_name').val(data.sub_category_name)
        $('#description').val(data.description)
      });
    }
    </script>
</body>

</html>