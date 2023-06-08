<?php
if(!isset($_SESSION)){
  session_start();
}

include_once("connections/connection.php");

$con = connection();

include("connections/function.php");

$user_data = check_login($con);

include("includes/scripts.php");

$sql = "SELECT * FROM tbl_residentsinfo WHERE status = 'approved' ORDER BY user_id ASC";
$residents = $con->query($sql) or die($con->error);
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
<!-- Modal -->
<div class="modal fade" id="residentsupdatemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" style="max-width: 850px;">
            <div class="modal-content" >
            <div class="modal-header bg-light">
                <img src="images/logo.png" alt="Municipality of Taysan" style="height: 90px; width: 90px;">
                <h3 class="modal-title" style="margin-left: 10px;">Taysan, Batangas</h3>
                <h3 class="modal-title" style="position: relative; right: -240px;">Add Residents</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="alertify_backend.php" method="POST" enctype="multipart/form-data">
                <div class="form-group form1">
                    <label>Full Name</label>
                    <input type="text" name="fullname" class="form-control" placeholder="Enter First Name." required="">
                </div>
                <div class="form-group form1">
                    <label>Gender</label>
                    <input type="text" name="gender" class="form-control" list="gender" placeholder="Gender" required="">
                        <datalist id="gender">
                            <option value="Female"></option>
                            <option value="Male"></option>
                        </datalist>
                </div>
                <div class="form-group form1">
                    <label>Contact Number</label>
                    <input type="text" name="contactnumber" class="form-control" placeholder="Enter Contact Number." required="">
                </div>
                <div class="form-group form1">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter Email." required="">
                </div><div class="form-group form1">
                    <label>Birth Date</label>
                    <input type="date" name="birthdate" class="form-control" placeholder="" required="">
                </div><div class="form-group form1">
                    <label>Barangay</label>
                    <input type="dropdown"  class = "form-control" name="barangay" list="barangay" placeholder="Barangay">
                    <datalist id="barangay">
                        <option value="Bacao"></option>
                        <option value="Bilogo"></option>
                        <option value="Bukal"></option>
                        <option value="Dagatan"></option>
                        <option value="Guinhawa"></option>
                        <option value="Laurel"></option>
                        <option value="Mabayabas"></option>
                        <option value="Mapulo"></option>
                        <option value="Pagasa"></option>
                        <option value="Panghayaan"></option>
                        <option value="Pina"></option>
                        <option value="Pinagbayanan"></option>
                        <option value="Poblacion East"></option>
                        <option value="Poblacion West"></option>
                        <option value="San Isidro"></option>
                        <option value="San Marcelino"></option>
                        <option value="Santo Nino"></option>
                        <option value="Tilambo"></option>
                    </datalist>
                </div><div class="form-group form1">
                    <label>Enter Valid ID(Front)</label>
                    <input type="file" name="uploadfile_front" class = "form-control" accept="image/*" value="" required/>
                </div><div class="form-group form1">
                    <label>Enter Valid ID(Back)</label>
                    <input type="file" name="uploadfile_back" class = "form-control" accept="image/*" value="" required/>
                </div><div class="form-group form1">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Password." required="">
                </div><div class="form-group form1">
                    <label>Confirm Password</label>
                    <input type="password" name="cpassword" class="form-control" placeholder="Enter Confirm Password." required="">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" name="add_btn">Add New</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        </div>
    <div class="container container-expand-lg bg-white" style="width:80%;"><br>
                <div class="card">
                    <div class="card-header bg-white text-center ">
                        <h2 style="padding-left:110px;" class="fw-bold">Residents Information
                            <a href="homepageadmin.php" class="btn btn-primary float-end" type="button" data-bs-toggle="modal" data-bs-target="#residentsupdatemodal">Add New</a>
                        </h2>
                    </div>
                    <div class="card-body">
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
                                if(mysqli_num_rows($residents) > 0){
                                foreach($residents as $row){
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
                                        <img src="<?php echo "img_back/" . $row['valid_img_back'];?>" width = "50px"  height = "10px" alt="Image Back" data-bs-toggle="modal" data-bs-target="#img_popup_back<?php echo $row['user_id']; ?>">
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
                                      <input type="hidden" name="details_id" value="<?php echo $row['user_id']; ?>">
                                      <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#add_residents<?php echo $row['user_id']; ?>">View</button>
                                    </td>
                                    <td>
                                      <form action="" method="POST">
                                      <input type="hidden" class="delete_id_value" value="<?php echo $row['user_id'];?>">
                                      <input type="hidden" class="del_res_front" value="<?php echo $row['valid_img_front'];?>">
                                      <input type="hidden" class="del_res_back" value="<?php echo $row['valid_img_back'];?>">
                                      <a href="javascript:void(0)" class="delete_btn_ajax btn btn-danger btn-sm">Delete</a>
                                      </form>
                                    </td>
                                </tr>
                                <?php 
                                include("includes/update_residents.php");
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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