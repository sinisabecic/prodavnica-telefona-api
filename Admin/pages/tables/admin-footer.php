<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark" style="display: none;">
  <!-- Create the tabs -->
  <ul class="nav nav-tabs nav-justified control-sidebar-tabs">

  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <!-- Home tab content -->
    <div class="tab-pane" id="control-sidebar-home-tab">
    </div>
    <!-- /.tab-pane -->


  </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<style>
  .btn-file {
    position: relative;
    overflow: hidden;
  }

  .btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    cursor: inherit;
    display: block;
  }
</style>



<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../../bower_components/raphael/raphael.min.js"></script>
<script src="../../bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../bower_components/moment/min/moment.min.js"></script>
<script src="../../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>


<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>

<!-- Brisanje obicnog korisnika(ne admina) -->
<script>
  function delUser(item) {
    if (confirm('Da li ste sigurni?')) {
      var formData = {
        'user_id': item
      };
      $.ajax({
        type: 'POST',
        url: '../../../functions/delete-user.php',
        data: formData,
        success: function(response) {
          if (response.error) {
            console.log(response.error);
            alert(response.error);
          } else {
            console.log(response.success);
            window.location.reload(true);
          }
        },
        error: function(error) {
          console.log(error);
          alert("Greška, učitajte ponovo");
        },
        async: false
      });
    }
  }
</script>


<!-- Brisanje super korisnika(admina) -->
<script>
  function delSuperUser(item) {
    if (confirm('Da li ste sigurni?')) {
      var formData = {
        'admin_id': item
      };
      $.ajax({
        type: 'POST',
        url: '../../../functions/delete-admin.php',
        data: formData,
        success: function(response) {
          if (response.error) {
            console.log(response.error);
            alert(response.error);
          } else {
            console.log(response.success);
            window.location.reload(true);
          }
        },
        error: function(error) {
          console.log(error);
          alert("Greška, učitajte ponovo");
        },
        async: false
      });
    }
  }
</script>


<!-- Brisanje poruke -->
<script>
  function delMessage(item) {
    if (confirm('Da li ste sigurni?')) {
      var formData = {
        'W': item
      };
      $.ajax({
        type: 'POST',
        url: '../../../functions/delete-message.php',
        data: formData,
        success: function(response) {
          if (response.error) {
            console.log(response.error);
            alert(response.error);
          } else {
            console.log(response.success);
            window.location.reload(true);
          }
        },
        error: function(error) {
          console.log(error);
          alert("Greška, učitajte ponovo");
        },
        async: false
      });
    }
  }
</script>

<script>
  function setAsSeen(item) {

    var formData = {
      'message_id': item
    };
    $.ajax({
      type: 'POST',
      url: '../../../functions/update-message.php',
      data: formData,
      success: function(response) {
        if (response.error) {
          console.log(response.error);
          alert(response.error);
        } else {
          console.log(response.success);
          window.location.reload(true);
        }
      },
      error: function(error) {
        console.log(error);
        alert("Greška, učitajte ponovo");
      },
      async: false
    });

  }
</script>



</body>

</html>