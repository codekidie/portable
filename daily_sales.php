<?php
  $page_title = 'Daily Sales';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
?>

<?php
 $year  = date('Y');
 $month = date('m');
 $admin_id =  $_SESSION['admin_id'] ;

 $sales = dailySales($year,$month,$admin_id);
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
            <span class="pe-7s-cash"></span>
            <span>Daily Sales</span>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped" id="tb">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Product name </th>
                <th> Flavor</th>
                <th class="text-center" style="width: 15%;"> Quantity sold</th>
                <th class="text-center" style="width: 15%;"> Total </th>
                <th class="text-center" style="width: 15%;"> Date </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
              <?php if (!empty(remove_junk($sale['name']))): ?>
                    <tr>
                       <td class="text-center"><?php echo count_id();?></td>
                       <td><?php echo remove_junk($sale['name']); ?></td>
                       <td><?php echo remove_junk($sale['flavor']); ?></td>
                       <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
                       <td class="text-center"><?php echo remove_junk($sale['total_saleing_price']); ?></td>
                       <td class="text-center"><?php echo $sale['date']; ?></td>
                     </tr>
              <?php endif ?>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
