<?php
if(!isset($_SESSION)){
  session_start();
}
include_once("connections/connection.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=0.1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/design.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
<div class="container container-expand-lg bg-white" style="width:80%;"><br><br>
  <div class="card">
    <div class="card-header">
        <h3 class="text-center fw-bold">Visualizations</h>
    </div>
    <div class="card-body">
      <div class="d-flex justify-content-end">
          <p class="fw-bold h5">Time: </p><div id="realtime-clock" class="mx-2 h5"></div>
          <p class="fw-bold h5">Date: </p><div id="realtime-date" class="mx-2 h5"></div>  
      </div>
    <div class="d-flex justify-content-between">
    <div class="col-xl-3 col-md-3 p-2">
      <div class="card border-left-primary shadow py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <i class="fa-solid fa-users fa-xl" style="color: #05BFDB;"></i>
            </div>
            <div class="col mr-2">
              <div class="d-flex justify-content-between">
              <div class="fw-bold text-uppercase mb-1" style="font-size:smaller;">
                Registered Users</div>
              <div class="h5 mb-0 fw-bold">
              <?php 
                $sql = "SELECT user_id, COUNT(*) as registered_users FROM tbl_residentsinfo WHERE status = 'approved'";
                $result = $con->query($sql) or die($con->error);
                while($row = mysqli_fetch_array($result)){
                  echo $row["registered_users"];
                }
              ?>
            </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
<div class="col-xl-3 col-md-3 p-2">
  <div class="card border-left-primary shadow py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
          <div class="col-auto">
            <i class="fas fa-message fa-xl text-warning"></i>
          </div>
            <div class="col mr-2">
            <div class="d-flex justify-content-between">
              <div class="fw-bold text-uppercase mb-1" style="font-size:smaller;">
                  Total Sent Messages</div>
                <div class="h5 mb-0 fw-bold">
                <?php 
                  $sql = "SELECT announcements, COUNT(*) as sent_messages FROM tbl_history_announce";
                  $result = $con->query($sql) or die($con->error);
                  while($row = mysqli_fetch_array($result)){
                    echo $row["sent_messages"];
                  }
                ?>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
  <div class="col-xl-3 col-md-3 p-2">
  <div class="card border-left-primary shadow py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
          <div class="col-auto">
            <i class="fas fa-comments fa-xl text-success"></i>
          </div>
            <div class="col mr-2">
            <div class="d-flex justify-content-between">
              <div class="text-xs font-weight-bold text-uppercase mb-1" style="font-size:smaller;">
                  Inquires</div>
                <div class="h5 mb-0 fw-bold">
                <?php 
                  $sql = "SELECT feedback, COUNT(*) as inquiry FROM feedback_info";
                  $result = $con->query($sql) or die($con->error);
                  while($row = mysqli_fetch_array($result)){
                    echo $row["inquiry"];
                  }
                ?>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
  </div>
  <div class="col-xl-3 col-md-3 p-2">
  <div class="card border-left-primary shadow py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
          <div class="col-auto">
            <i class="fas fa-reply fa-xl text-dark"></i>
          </div>
            <div class="col mr-2">
              <div class="d-flex justify-content-between">
                <div class="text-xs font-weight-bold text-uppercase mb-1" style="font-size:smaller;">
                  Replies</div>
                <div class="h5 mb-0 fw-bold">
                <?php 
                  $sql = "SELECT response, COUNT(*) as reply FROM feedback_reply";
                  $result = $con->query($sql) or die($con->error);
                  while($row = mysqli_fetch_array($result)){
                    echo $row["reply"];
                  }
                ?>
                </div>
              </div>
          </div>
      </div>
    </div>
  </div>
  </div>
</div>
<div>
<div>
  <canvas id="chart"></canvas>
</div>
      <?php
      $sql = "SELECT barangay, COUNT(*) as number FROM tbl_residentsinfo WHERE status = 'approved' GROUP BY barangay ";
      $result = $con->query($sql) or die ($con->error);
      
      // Format data for Chart.js
      $barangay = array();
      $number = array();
      
      while ($row = mysqli_fetch_assoc($result)) {
          $barangay[] = $row['barangay'];
          $number[] = $row['number'];
          }
      ?>
      <script>
        var ctx = document.getElementById('chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($barangay); ?>,
                datasets:[{
                    label: 'Total Registered Users Per Barangay',
                    data: <?php echo json_encode($number); ?>,
                    backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(255, 159, 64, 0.2)',
                      'rgba(255, 205, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                      'rgb(255, 99, 132)',
                      'rgb(255, 159, 64)',
                      'rgb(255, 205, 86)',
                      'rgb(75, 192, 192)',
                      'rgb(54, 162, 235)',
                      'rgb(153, 102, 255)',
                      'rgb(201, 203, 207)'
                    ],
                      borderWidth: 1
                    }]
            },
            options: {
              indexAxis: 'y',
                scales: {
                  x: {
                    ticks:{
                      stepSize: 1,
                      }
                    }
                  }
                }
              }
            );
      </script>
    </div>
  </div>
</div><br />
    <div class="card">
      <div class="card-header">
      <h2 class="text-center fw-bold">Residents Information</h2>
      </div>
          <div class="card-body">
            <?php
              $sql = "SELECT * FROM tbl_residentsinfo WHERE status = 'approved' ORDER BY user_id ASC";
              $residents = $con->query($sql) or die($con->error);
            ?>
              <table class="table table-bordered table-hover" id="dataTable_1" cellspacing="0%">
                <thead>
                  <tr class="table-active">
                    <th scope="col">Full Name</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Barangay</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if(mysqli_num_rows($residents) > 0){
                  foreach($residents as $row){
                  ?>
                      <tr>
                        <td><?php echo $row['fullname']; ?></td>
                        <td><?php echo $row['contactnumber']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['barangay']; ?></td>
                      </tr>
                      <?php
                }
              }
              ?>
                </tbody>
              </table>
        </div>
    </div>
    </div>
    <div class="container container-expand-lg bg-white" style="width:80%;"><br><br>
    <div class="card">
      <div class="card-header">
        <h2 class="text-center fw-bold">Announcements History</h2>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover" id="dataTable_2" cellspacing="0%">
            <thead>
            <?php
              $sql = "SELECT * FROM tbl_history_announce ORDER BY id DESC";
              $user = $con->query($sql) or die ($con->error);
              $row = $user->fetch_assoc();
            ?>
              <tr class="table-active">
                  <th>Date and Time</th>
                  <th>Announcements</th>
              </tr>
            </thead>
            <tbody>
              <?php do{
                $datetime = $row['date'];
                $frmtd_datetime = date("d-M-Y h:i A", strtotime($datetime));
                ?>
              <tr>
                <td><?php echo $frmtd_datetime; ?></td>
                <td><?php echo $row['announcements']; ?></td>
              </tr>
              <?php }while($row = $user->fetch_assoc());?>
            </tbody>
        </table>
      </div>
    </div><br><br>
<!-- Bootstrap Core Javascript -->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- DataTables Javascripts -->
<script src="js/datatables.min.js"></script>
<!-- Datatable Configuration -->
<script type="text/javascript">
  $(document).ready(function(){
  $('#dataTable_1').DataTable();
});
</script>
<!-- Datatable Configuration -->
<script type="text/javascript">
  $(document).ready(function(){
  $('#dataTable_2').DataTable();
});
</script>
<script type="text/javascript">
  // Get the clock and date elements
  const clock = document.getElementById('realtime-clock');
  const date = document.getElementById('realtime-date');

  // Update the clock and date every second
      setInterval(() => {
        const now = new Date();
        const time = now.toLocaleTimeString();
        const day = now.toLocaleDateString();
        clock.textContent = time;
        date.textContent = day;
      }, 1000);
</script>
</body>
</html>