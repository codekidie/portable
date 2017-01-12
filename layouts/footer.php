     </div>
    </div>
   <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->
   
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  	<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
  	<script type="text/javascript" src="libs/js/functions.js"></script>

    <!-- <script src="libs/assets/js/jquery-1.10.2.js" type="text/javascript"></script> -->
	<script src="libs/assets/js/bootstrap-checkbox-radio-switch.js"></script>
	<script src="libs/assets/js/chartist.min.js"></script>
    <script src="libs/assets/js/bootstrap-notify.js"></script>
	<script src="libs/assets/js/light-bootstrap-dashboard.js"></script>
  <script src="libs/assets/js/demo.js"></script>
  <script src="libs/js/notify.js"></script>
  <script src="libs/js/jquery.dataTables.min.js"></script>

  <script src="libs/js/dataTables.bootstrap.min.js"></script>


  <script type="text/javascript">
      $('.dropdown-toggle').click(function() {
            $.ajax({
              url: "submitnotificationajax.php",
            }).done(function(done) {
                $('.notification').html(0);
            });
      });

     
      $('#tb').DataTable();
      $('#tb2').DataTable();
      $('#tb3').DataTable();
      $('#tb4').DataTable();
      $('#tb5').DataTable();
      $('#tb6').DataTable();

      $('#tbd').dataTable({bFilter: false, bInfo: false});


     $(document).on('click', 'button.removebutton', function () {
         alert("Data Removed Success!");
         $(this).closest('tr').remove();
         return false;
     });

  </script>

    
  </body>
</html>

<?php if(isset($db)) { $db->db_disconnect(); } ?>
