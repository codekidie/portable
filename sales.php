<?php
  $page_title = 'All sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
?>
<?php
$admin_id =  $_SESSION['admin_id'] ;
$sales = find_by_sql("SELECT * FROM sales s LEFT JOIN products p  ON s.product_id = p.id WHERE p.admin_id = {$admin_id}");
// var_dump($sales);
// die();
?>
<?php include_once('layouts/header.php'); ?>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="libs/js/jquery.confirm.js"></script>

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
            <i class="pe-7s-cash"></i>
            <span>All Sales</span>
          </strong>
          <div class="pull-right">
            <a href="add_sale.php" class="btn btn-primary">Add sale</a>
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Product name </th>
                <th class="text-center" style="width: 15%;"> Quantity</th>
                <th class="text-center" style="width: 15%;"> Total </th>
                <th class="text-center" style="width: 15%;"> Date </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($sale['name']); ?></td>
               <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
               <td class="text-center"><?php echo remove_junk($sale['price']); ?></td>
               <td class="text-center"><?php echo $sale['date']; ?></td>
               <td class="text-center">
                  <div class="btn-group">
                     <a href="edit_sale.php?id=<?php echo (int)$sale[0];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <i class="pe-7s-edit"></i>
                     </a>
                     <a href="delete_sale.php?id=<?php echo (int)$sale[0];?>" class="btn btn-danger complexConfirm  btn-xs"  title="Delete" data-toggle="tooltip">
                       <i class="pe-7s-trash"></i>
                     </a>
                  </div>
               </td>
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <script type="text/javascript">
            $(".complexConfirm").confirm({
                title:"Delete confirmation",
                text:"This is very dangerous, you shouldn't do it! Are you really really sure?",
                confirm: function(button) {
                  var href = $(button).attr("href");
                  window.location.replace(href);
                },
                cancel: function(button) {
                      alert("You aborted the operation.");
                },
                confirmButton: "Yes I am",
                cancelButton: "No"
            });
    </script>
<?php include_once('layouts/footer.php'); ?>
