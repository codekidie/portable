<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
?>
<?php
  $d_sale = find_by_id('return_product',(int)$_GET['id']);
  if(!$d_sale){
    $session->msg("d","Missing return id.");
    redirect('add_return_product.php');
  }
?>
<?php
  $delete_id = delete_by_id('return_product',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","return product deleted.");
      redirect('add_return_product.php');
  } else {
      $session->msg("d","return product deletion failed.");
      redirect('add_return_product.php');
  }
?>
