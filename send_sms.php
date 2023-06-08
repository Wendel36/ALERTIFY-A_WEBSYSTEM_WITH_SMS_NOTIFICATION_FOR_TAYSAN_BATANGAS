<?php
if(!isset($_SESSION)){
  session_start();
}
include("connections/connection.php");
$con = connection();
include("connections/function.php");
$user_data = check_login($con);
include("includes/scripts.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/design.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
    <title>Taysan, Batangas</title>
</head>
<body>
        <?php
          if(isset($_SESSION['alert'])){
        ?>
        <script>
          swal({
            title: "<?php echo $_SESSION['alert'];?>",
            //text: "You clicked the button!",
            icon: "<?php echo $_SESSION['alert_code'];?>",
            button: "OK",
            });
          </script>
          <?php
            unset($_SESSION['alert']);
            }
          ?>
    <!-- Nav -->
    <nav class="navbar navbar-expand-lg bg-light fixed-top sticky-top">
    <?php include("includes/admin_navbar.php"); ?>
<!-- Nav -->
<div class="container2 container2-expand-lg bg-white">
  <div class="card">
    <div class="card-header">
    <h2 class="text-center fw-bold">SMS ANNOUNCEMENT</h2>
    </div>
    <div class="card-body">
      <span style="color: red;">Note: All of the Announcements will be sent to all registered users.</span>
      <?php
        $sql = "SELECT CONCAT('63', SUBSTR(contactnumber, 2)) AS contactnumber_replaced FROM tbl_residentsinfo WHERE status = 'approved'";
        $user = $con->query($sql) or die($con->error);
      ?>
      <form action="alertify_backend.php" method="POST">
        <div class="input-group">
          <input type = "hidden" class="text form-control opacity-75" name = "number" value=
          <?php 
            while($row = $user->fetch_assoc()){
              echo $row['contactnumber_replaced'].',';
            }
            ?>
            >
        </div>
        <div class="input-group">
          <textarea class="text form-control opacity-75" name="textmsg" aria-label="With textarea" style="height: 230px;" placeholder="Type announcement here" required></textarea>
        </div>
        <br>
        <button type="submit" name="send_announce" class="btn btn-success btn float-end">Send</button>
      </form>
    </div>
  </div><br />
  <div class="card">
    <div class="card-header">
      <h2 class="text-center fw-bold">ANNOUNCEMENT HISTORY</h2>
    </div>
    <div class="card-body">
    <table class="table table-bordered table-hover table-striped rounded" id="dataTable" cellspacing="0%">
      <thead>
        <?php
          $sql = "SELECT * FROM tbl_history_announce ORDER BY id asc";
          $user = $con->query($sql) or die ($con->error);
          $row = $user->fetch_assoc();
        ?>
      <tr class="table-active">
        <th>Date and time</th>
        <th>Announcements</th>
      </tr>
      </thead>
      <tbody>
        <?php
          while($row = $user->fetch_assoc()){
          $datetime = $row['date'];
          $frmtd_datetime = date("d-M-Y h:i A", strtotime($datetime));?>
        <tr>
          <td><?php echo $frmtd_datetime;?></td>
          <td><?php echo $row['announcements'];?></td>
        </tr>
        <?php }?>
      </tbody>
    </table>
    </div>
  </div>
</div>
<!-- Bootstrap Core Javascript -->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- DataTables Javascripts -->
<script src="js/datatables.min.js"></script>
<!-- Datatable Configuration -->
<script type="text/javascript">
  $(document).ready(function(){
  $('.table').DataTable();
});
</script>
</body>
</html> 