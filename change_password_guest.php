<?php
  $page_title = 'Change Password';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
?>
<?php $user = current_user(); ?>
<?php
  if(isset($_GET['email'])){

    if(empty($errors)){
        $email = $_GET['email'];
        $user= find_by_sql("SELECT email FROM users WHERE email='{$email}'");
        if (!empty($user)) {
          $new_pass = $_GET['password'];
          echo 1;
          $sql = "UPDATE users SET password='".sha1($new_pass)."' WHERE email ='{$email}' LIMIT 1";
          $result = $db->query($sql);
        }
        

      $session->msg("s", 'Success Send Mail');
      redirect('change_password_guest.php',false);
      
    } else {
      $session->msg("d", $errors);
      redirect('change_password_guest.php',false);
    }
  }
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page col-sm-12 col-md-6 col-md-offset-3 form-box" style="margin-top:20px;margin-bottom:20px;">
  <center><img src="uploads/logo.jpg" alt="" class="col-sm-12"></center>

    <div class="text-center">
       <h3 style="margin-top: 20px;">Recover your password</h3>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="" class="clearfix">
         <div class="form-group">
              <label class="control-label">Email</label>
              <input type="hidden" name="password" class="passval" value="<?php echo uniqid();?>">
              <input type="email" class="form-control emailval" name="email" placeholder="email" required="">
        </div>
        <div class="form-group clearfix">
                <button type="submit" name="update" class="btn btn-info submit-email">Submit</button>
        </div>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.emailjs.com/dist/email.min.js"></script>
<script type="text/javascript">
   (function(){
      emailjs.init("user_U6MqmzisMcx22HmaFc5ol");
   })();
</script>
<script type="text/javascript">
$('.submit-email').click(function(event) {
    event.preventDefault()
    var emailval = $('.emailval').val();
    var passval = $('.passval').val();
   
    emailjs.send("gmail", "inventory_reset_password", {"to_mail":"codekidie@gmail.com","reply_to":emailval,"message_html":"Your new password is "+passval})
    console.log(emailjs);

    $.ajax({
    url: "http://localhost/portable_inventory/change_password_guest.php?email="+emailval+"&password="+passval,
    }).done(function() {
        alert('Email Recover Sent!');
    });

});

</script>
<?php include_once('layouts/footer.php'); ?>
