<?php
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}


    global $db;
    $admin_id = $_SESSION['admin_id'];
    $sql = "UPDATE products SET sms_sent='1' WHERE admin_id ='{$admin_id}'";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
?>

