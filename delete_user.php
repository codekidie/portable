<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
?>
<?php
  $delete_id = delete_by_id('users',(int)$_GET['id']);
  $delete_prev_id = delete_by_user_id('privilege',(int)$_GET['id']);

  if($delete_id || $delete_prev_id ){
      $session->msg("s","User deleted.");
      redirect('users.php');
  } else {
      $session->msg("d","Holly Guakamoly User deletion failed something went wrong! ");
      redirect('users.php');
  }
?>
