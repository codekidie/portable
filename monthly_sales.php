<?php
  $page_title = 'Monthly Sales';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
?>
<?php
 $year = date('Y');
 $admin_id =  $_SESSION['admin_id'] ;
 $sales = monthlySales($year,$admin_id);
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="pe-7s-date"></span>
            <span>Monthly Sales</span>
          </strong>
        </div>
        <div class="panel-body">
            <input type="date" id="date_data" class="form-control">
            <table class="table table-bordered table-striped">
             <tbody id="table-body"></tbody>
            </table>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
