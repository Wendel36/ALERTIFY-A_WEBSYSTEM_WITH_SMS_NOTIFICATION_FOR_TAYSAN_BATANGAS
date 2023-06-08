<?php
if(!isset($_SESSION)){
    session_start();
}
include("includes/scripts.php");

include_once("connections/connection.php");

$con = connection();

include("connections/function.php");

$user_data = check_login($con);
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
<nav class="navbar navbar-expand-lg bg-light fixed-top sticky-top">
<?php include("includes/admin_navbar.php"); ?>

<div class="container container-expand-lg bg-white" style="width: 80%;">
    <div class="card">
        <div class="card-header bg-white">
            <h2 style="padding-left:500px;" class="fw-bold">Feedback Section
            <a href="feedback_reply.php" class="btn btn-primary float-end" type="button">Sent Messages</a>
            </h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover text-center" id="dataTable_1" cellspacing="0%">
                <thead>
                    <tr class="table-active">
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Feedbacks/Comments</th>
                        <th>Time Stamp</th>
                        <th>Action</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php
                $query = mysqli_query($con, "SELECT * FROM `feedback_info`ORDER BY id DESC") or die(mysqli_error($con));
                while($row = mysqli_fetch_array($query)){
                $datetime = $row['created_at'];
                $frmtd_datetime = date("d-M-Y h:i A", strtotime($datetime));
                ?>
                <tbody>
                    <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['barangay']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['feedback']; ?></td>
                    <td><?php echo $frmtd_datetime; ?></td>
                    <td>
                      <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#feedbackModal<?php echo $row['id']; ?>">Reply</button>
                    </td>
                    <td>
                      <form action="" method="POST">
                      <input type="hidden" class="delete_id_value"  value="<?php echo $row['id'];?>">
                        <a href="javascript:void(0)" class="feedback_delete_btn_ajax btn btn-danger btn-sm">Delete</a>
                      </form>
                    </td>
                    </tr>
                </tbody>
                <?php 
                include("includes/feedback_update.php");
                }
                
                ?>
            </table>
        </div>
    </div>
</div>
<!-- Bootstrap Core Javascript -->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- DataTables Javascripts -->
<script src="js/datatables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  $('.table').DataTable();
});
</script>
<script>
  // Data Confirmation on feedback_section page
$(document).ready(function (){
  $('.feedback_delete_btn_ajax').click(function (e){
    e.preventDefault();
  
    var deleteid = $(this).closest("tr").find('.delete_id_value').val();
    // console.log(deleteid);
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this Data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
  
          $.ajax({
            type: "POST",
            url: "alertify_backend.php",
            data: {
              "feedback_delete_btn_set": 1,
              "delete_id": deleteid,
            },
            
            success: function (response) {
              swal("Data Delete Successfully.!" , {
                  icon: "success",
              }).then((result) => {
                location.reload();
                

              });
            }
          });
        }
      });
  });
  });
</script>
</body>
</html>