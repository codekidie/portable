<?php  
    
  require_once('includes/load.php');
  $admin_id =  $_SESSION['admin_id'] ;
  $year = date('Y');
  $month = date('m');
   $all_qty = find_by_sql("SELECT *,p.flavor FROM items as i LEFT JOIN products as p ON p.id = i.product_id WHERE p.admin_id = '{$admin_id}'");
?>

  <h1>Daily Sales Report</h1>    
  <table  style="width:100%;">
      <thead>
        <tr>
          <th style="width: 50px;padding:15px;">#</th>
          <th style="width: 50px;padding:15px;"> Product name </th>
          <th style="width: 50px;padding:15px;"> Flavor </th>
          <th style="width: 50px;padding:15px;"> Batch </th>
          <th style="width: 50px;padding:15px;"> Quantity Instocks </th>
       </tr>
      </thead>
     <tbody>
       <?php foreach ($all_qty as $sale):?>
            <?php if (!empty($sale['item_name'])): ?>
                   <tr>
                     <td style="width: 50px;padding:15px;"><?php echo count_id();?></td>
                     <td style="width: 50px;padding:15px;"><?php echo remove_junk($sale['item_name']); ?></td>
                     <td style="width: 50px;padding:15px;"><?php echo remove_junk($sale['flavor']); ?></td>
                     <td style="width: 50px;padding:15px;"><?php echo remove_junk($sale['batch']); ?></td>
                     <td style="width: 50px;padding:15px;"><?php echo (int)$sale['quantity']; ?></td>
                   </tr>
            <?php endif ?>
       <?php endforeach;?>
     </tbody>
   </table>
