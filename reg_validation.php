<?php
if(!isset($_SESSION)){
  session_start();
}
include_once("connections/connection.php");
include("connections/function.php");

$con = connection();
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
<?php
  include("includes/admin_navbar.php");
?>
<!-- Body -->
<div class="container container-expand-lg bg-white" style="width: 80%;"><br>
    <div class="card">
        <div class="card-header">
            <h3 class="text-center fw-bold">User Registration Validation</h3>
        </div>
        <div class="card-body">
            <?php
              $sql = "SELECT * FROM tbl_residentsinfo WHERE status = 'pending' ORDER BY user_id ASC";
              $result = mysqli_query($con,$sql);
            ?>
        <table class="table table-bordered table-hover table-striped w-100 text-center" id="dataTable" cellspacing="0%">
            <thead>
                <tr class="table-active">
                    <th scope="col">Full Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Birth Date</th>
                    <th scope="col">Barangay</th>
                    <th scope="col">Valid ID (Front)</th>
                    <th scope="col">Valid ID (Back)</th>
                    <th scope="col">Action</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
              <?php
              if(mysqli_num_rows($result) > 0){
                foreach($result as $row){
                  ?>
                <tr>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['contactnumber']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['birthdate']; ?></td>
                    <td><?php echo $row['barangay']; ?></td>
                    <td>
                      <img src="<?php echo "img_front/" . $row['valid_img_front'];?>" width = "50px" height = "10px"alt="Image Front" data-bs-toggle="modal" data-bs-target="#img_popup_front<?php echo $row['user_id']; ?>">
                      <!-- Modal -->
                      <div class="modal fade" id="img_popup_front<?php echo $row['user_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
                        <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <img  style="  height: 400px; width: 550px;" src="<?php echo "img_front/" . $row['valid_img_front'];?>" alt="">
                        </div>
                        </div>
                      </div>
                      </div>
                    </td>
                    <td>
                       <img src="<?php echo "img_back/" . $row['valid_img_back'];?>" width = "5  0px"  height = "10px" alt="Image Back" data-bs-toggle="modal" data-bs-target="#img_popup_back<?php echo $row['user_id']; ?>">
                      <!-- Modal -->
                      <!-- Modal -->
                      <div class="modal fade" id="img_popup_back<?php echo $row['user_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
                        <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <img  style=" height: 400px; width: 550px;" src="<?php echo "img_back/" . $row['valid_img_back'];?>" alt="">
                        </div>
                        </div>
                      </div>
                      </div>
                    </td>
                    <td>
                        <form action="alertify_backend.php" method="POST">
                            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                            <input class="btn btn-primary" type="submit" name="approve" value="Approve">
                        </form>
                    </td>
                    <td>
                        <form action="alertify_backend.php" method="POST">
                            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                            <input class="btn btn-danger"type="submit" name="deny" value="Deny">
                        </form>
                    </td>
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
<!-- Bootstrap Core Javascript -->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- DataTables Javascripts -->
<script src="js/datatables.min.js"></script>
<!-- Datatable Configuration -->
<script type="text/javascript">
  $(document).ready(function(){
  $('#dataTable').DataTable();
});
</script>
</body>
</html>