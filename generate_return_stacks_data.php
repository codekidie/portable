<?php  
    
  require_once('includes/load.php');
  $admin_id =  $_SESSION['admin_id'] ;
  $year = date('Y');
  $month = date('m');
  $all_returned_products = find_by_sql("SELECT  ru.name as ru_name,
                                               ru.email as ru_email,
                                               ru.phone as ru_phone,
                                               ru.comment as ru_comment,
                                               ru.replace_product as ru_rp,
                                               ru.reason as ru_reason,
                                               ru.quantity as ru_quantity,
                                               p.name as p_name FROM return_product ru LEFT JOIN products p ON ru.product_id = p.id WHERE p.admin_id = '{$admin_id}' GROUP BY ru.product_id");
?>

  <h1>Returned Stocks Report</h1>    
      <table style="width:100%;">
        <thead>
          <tr>
              <th style="width: 50px;padding:15px;">Product Name</th>
              <th style="width: 50px;padding:15px;">Full Name</th>
              <th style="width: 50px;padding:15px;">email</th>
              <th style="width: 50px;padding:15px;">phone</th>
              <th style="width: 50px;padding:15px;">comment</th>
              <th style="width: 50px;padding:15px;">replace product</th>
              <th style="width: 50px;padding:15px;">reason</th>
              <th style="width: 50px;padding:15px;">quantity</th>
          </tr>
        </thead>
        <tbody>
           <?php foreach ($all_returned_products as $ar): ?>
          <tr>

            <td style="width: 50px;padding:15px;"><?php echo $ar['p_name']; ?></td>
            <td style="width: 50px;padding:15px;"><?php echo $ar['ru_name']; ?></td>
            <td style="width: 50px;padding:15px;"><?php echo $ar['ru_email']; ?></td>
            <td style="width: 50px;padding:15px;"><?php echo $ar['ru_phone']; ?></td>
            <td style="width: 50px;padding:15px;"><?php echo $ar['ru_comment']; ?></td>
            <td style="width: 50px;padding:15px;"><?php echo $ar['ru_rp']; ?></td>
            <td style="width: 50px;padding:15px;"><?php echo $ar['ru_reason']; ?></td>
            <td style="width: 50px;padding:15px;"><?php echo $ar['ru_quantity']; ?></td>
          </tr> 
            
           <?php endforeach ?>
        </tbody>
      </table>
