<?php
  $page_title = 'Add Sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   $admin_id =  $_SESSION['admin_id'] ;

?>
<?php

  if(isset($_POST['add_sale'])){

          foreach ($_POST['price'] as $key => $value) {
                $p_id      = $db->escape((int)$_POST['s_id'][$key]);
                $s_qty     = $db->escape((int)$_POST['quantity'][$key]);
                $s_total   = $db->escape($_POST['total'][$key]);
                $date      = $db->escape($_POST['date'][$key]);
                $s_date    = make_date();

                $sql  = "INSERT INTO sales (";
                $sql .= " product_id,qty,price,date,admin_id";
                $sql .= ") VALUES (";
                $sql .= "'{$p_id}','{$s_qty}','{$s_total}','{$s_date}','{$admin_id}'";
                $sql .= ")";

                if($db->query($sql)){
                  update_product_qty($s_qty,$p_id);
                  $session->msg('s',"Sale added. ");
                  redirect('add_sale.php', false);
                } else {
                  $session->msg('d',' Sorry failed to add!');
                  redirect('add_sale.php', false);
                }
          }

       
  }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">Find It</button>
            </span>
            <input type="text" id="sug_input" class="form-control" name="title"  placeholder="Search for product name">
         </div>
         <div id="result" class="list-group"></div>
        </div>
    </form>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="pe-7s-tools"></span>
          <span>Sale Edit</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_sale.php" >
         <table class="table table-bordered">
           <thead>
            <th> Item </th>
            <th> Price </th>
            <th> Qty </th>
            <th> Date</th>
            <th> Total </th>
            <!-- <th> Action</th> -->
           </thead>
             <tbody  id="product_info"> </tbody>
         </table>
         <div class="product_sale">
             <center><input type="submit" class="btn btn-success btn-md" name="add_sale" value="Submit"></center>
          </div>
       </form>
      </div>
    </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>
