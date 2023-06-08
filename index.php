<?php
if(!isset($_SESSION)){
  session_start();
}
include("connections/connection.php");

include("includes/scripts.php");

$con = connection();

if(isset($_SESSION['UserLogin'])){
  $contactnumber = $_SESSION['contactnumber'];
  $sql = "SELECT * FROM tbl_residentsinfo WHERE contactnumber = '$contactnumber'";
  $residents = $con->query($sql) or die($con->error);
  $row = $residents->fetch_assoc();
}
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
    <title>Taysan, Batangas</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
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
    <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo.png" alt="Municipality of Taysan" width="100" height="80">
                <h2 style="float: right; margin-top: 20px; margin-left: 20px;">Taysan, Batangas</h2>
              </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active rounded" aria-current="page" href="index.php" style="width: 120px;"><i class="fa-solid fa-house icon" style="font-size: 25px;"></i>Home</a>
              </li>
            <li class="nav-item">
                <a class="nav-link active rounded" aria-current="page" href="#contact_us" style="width: 160px;"><i class="fa-solid fa-phone icon" style="font-size: 25px;"></i>Contact Us</a>
              </li>
              <?php if(isset($_SESSION['UserLogin'])){?>
                <li class="nav-item">
                <a class="nav-link active rounded" aria-current="page" type="button" data-bs-toggle="modal" data-bs-target="#residentsupdatemodal" style="width: 120px;"><i class="fa-sharp fa-solid fa-newspaper icon" style="font-size: 30px;"></i></i>Profile</a>
              </li> 
              <?php } else{?>
                <li class="nav-item">
                  <a href="create.php" class="nav-link active rounded" aria-current="page" style="width: 160px;"><i class="fa-solid fa-address-card icon" style="font-size: 25px;"></i>Register</a>
                </li>
              <?php }?>
              <?php if(isset($_SESSION['UserLogin'])){?>
              <li class="nav-item">
                <a class="nav-link active rounded" aria-current="page" href="logout.php" style="width: 120px;"><i class="fa-solid fa-right-to-bracket icon" style="font-size: 25px;"></i>Logout</a>
              </li>
              <?php } else{?>
              <li class="nav-item">
                <a class="nav-link active rounded" aria-current="page" href="login.php" style="width: 120px;"><i class="fa-solid fa-right-to-bracket icon" style="font-size: 25px;"></i>Login</a>
              </li>
              <?php }?>
            </ul>
          </div>
        </div>
      </nav>
      
      <div class="container1 container1-expand-lg bg-secondary">
        <br>
        <div class="card bg-white" >
        <div class="text-center">
            <div class="d-flex justify-content-center">
                <div class="form-outline">
                  <br>
                    <h1>Services of Taysan, Batangas</h1>
                  </button>
                </div>
            </div>
            <div class="d-flex justify-content-center">
            
            <div><br>
              <button class="btn btn-outline border p-3" style="margin-right: 80px;"><a href="deped.php"><img src="images\deped.png" style="width: 100px; height: 100px;"></a><br>DepEd</button>
              <button class="btn btn-outline border p-3" style="margin-right: 30px;margin-left: 50x;"><a href="student_assistance.php"><img src="images\scholarship.png" style="width: 100px; height: 100px; "></a><br>Student Assist.</button>
              <button class="btn  btn-outline border p-3" style="margin-right: 40px;margin-left: 50px;"><a href="police_station.php"><img src="images\police.png" style="width: 100px; height: 100px;"></a><br>Police Station</button>
              <button class="btn btn-outline border p-3" style="margin-left: 40px;"><a href="comelec.php"><img src="images\comelec.png" style="width: 100px; height: 100px;"></a><br>COMELEC</button>
            <div><br>
                <button class="btn btn-outline border p-3" style="margin-right: 80px;"><a href="psa.php"><img src="images\psa.png" style="width: 100px; height: 100px;"></a><br>PSA</button>
                <button class="btn btn-outline border p-3" style="margin-right: 80px;margin-left: 50x;"><a href="senior_citizen.php"><img src="images\senior.png" style="width: 100px; height: 100px;"></a><br>Senior Citizens</button>
                <button class="btn btn-outline border p-3" style="margin-right: 80px;margin-left: 50x;"><a href="pwd.php"><img src="images\pwd.png" style="width: 100px; height: 100px;"></a><br>PWD</button>
                <button class="btn btn-outline border p-3" style="margin-left: 80x;"><a href="work_permit.php"><img src="images\businesspermit.png" style="width: 100px; height: 100px;"></a><br>Permit</button>
            </div><br>
            <div>
                <button class="btn btn-outline border p-3" style="margin-right: 80px;"><a href="gsis.php"><img src="images\gsis.png" style="width: 100px; height: 100px;"></a><br>GSIS</button>
                <button class="btn btn-outline border p-3" style="margin-right: 80px;margin-left: 50x;"><a href="dswd.php"><img src="images\DSWD.png" style="width: 100px; height: 100px;"></a><br>DSWD</button>
                <button class="btn btn-outline border p-3" style="margin-right: 80px;margin-left: 50x;"><a href="dole.php"><img src="images\dole.png" style="width: 100px; height: 100px;"></a><br>DOLE</button>
                <button class="btn btn-outline border p-3" style="margin-left: 80x;"><a href="peso.php"><img src="images\peso.png" style="width: 100px; height: 100px;"></a><br>PESO</button>
            </div><br>
            <div>
              <button class="btn btn-outline border p-3" style="margin-right: 80px;"><a href="pleb.php"><img src="images\pleb.png" style="width: 100px; height: 100px;"></a><br>PLEB</button>
              <button class="btn btn-outline border p-3" style="margin-right: 80px;margin-left: 50x;"><a href="dilg.php"><img src="images\dilg.png" style="width: 100px; height: 100px;"></a><br>DILG</button>
              <button class="btn btn-outline border p-3" style="margin-right: 80px;margin-left: 50x;"><a href="batelec.php"><img src="images\batelec.png" style="width: 100px; height: 100px;"></a><br>BATELEC II</button>
              <button class="btn btn-outline border p-3" style="margin-left: 80x;"><a href="spes.php"><img src="images\spes.png" style="width: 100px; height: 100px;"></a><br>SPES</button>
            </div><br><br>
              </div>
              
          </div>
        </div>
      </div>
      
<!-- Remove the container if you want to extend the Footer to full width. -->
<div id="contact_us" class="container my-5">
  <!-- Footer -->
  <footer
          class="text-center text-lg-start text-white"
          style="background-color: rgba(210,0,8,1);"
          >
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Links -->
      <section class="">
        <!--Grid row-->
        <div class="row">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold">Taysan Batangas</h6>
                <div class="div10">
                  <img src="images/batangas_seal.png" class="img-fluid" alt="Responsive image">
                  <img src="images/Taysan_Batangas.png" class="img-fluid" alt="Responsive image">
                </div>      
          </div>
          <!-- Grid column -->
          <hr class="w-100 clearfix d-md-none" />
          <!-- Grid column -->
          <hr class="w-100 clearfix d-md-none" />
          <!-- Grid column -->
          <hr class="w-100 clearfix d-md-none" />
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold">Contact Us!</h6>
            <p><i class="fas fa-home mr-3"></i> Taysan Batangas 4228, PH</p>
            <p><i class="fas fa-envelope mr-3"></i> taysanmunicipality@gmail.com</p>
            <p><i class="fas fa-phone mr-3"></i> + 63 946 372 5161</p>
            <!--<p><i class="fas fa-print mr-3"></i> + 63 946 372 5161</p>-->
            <table class="table" style="font-size: 14px; color: white; font-weight: bold;">
                      </tr>
                      <tr>
                        <td>MSWD</td>
                        <td>09173140941</td>
                      </tr>
                        <tr>
                        <td>MDRRMO</td>
                        <td>09175931013</td>
                      </tr>
                      <tr>
                        <td>TAYSAN PNP</td>
                        <td>09062421620</td>
                      </tr>
                        <tr>
                        <td>DIVISION DRRM COORDINATOR</td>
                        <td>09192575752</td>
                      </tr>
                        <tr>
                        <td>MAYOR'S OFFICE</td>
                        <td>09175247540</td>
                      </tr>  
                      <tr>
                        <td>MUNICIPAL HEALTH OFFICE</td>
                        <td>09175248645</td>
                      </tr>
                      <tr>
                        <td>MUNICIPAL HEALTH OFFICE</td>
                        <td>09175248645</td>
                      </tr>
                      <tr>
                        <td>TAYSAN LGU</td>
                        <td>(043)774-2216</td>
                      </tr>
                    </table>
          </div>
          <!-- Grid column -->
          <!-- Grid column -->
          <div class="col-md-2 col-lg-3 col-xl-2 mx-auto mb-3">
            <h6 class="text-uppercase mb-4 fw-bold">Follow us</h6>
            <!-- Facebook -->
            <a
               class="btn btn-primary btn-floating m-1"
               style="background-color: #3b5998"
               href="https://www.facebook.com/TaysanMIO"
               role="button"
               ><i class="fab fa-facebook-f"></i
              ></a>

            <!-- Google -->
            <a
               class="btn btn-primary btn-floating m-1"
               style="background-color: #dd4b39"
               href="mailto: taysanmunicipality@gmail.com"
               role="button"
               ><i class="fab fa-google"></i
              ></a>
              <br><br><br><br>
              <table class="table" style="font-size: 14px; color: white; font-weight: bold;">
                      <tr >
                        <td>PALMA-MALALUAN HOSPITAL </td>
                        <td>(043)321-1410</td>
                      </tr> 
                      <tr>
                        <td>STO. ROSARIO HOSPITAL</td>
                        <td>09328436537</td>
                      </tr> 
                      <tr>
                        <td>UNTALAN HOSPITAL</td>
                        <td>(043)321-1563</td>
                      </tr> 
                      <tr>
                        <td>NURSE I</td>
                        <td>09177073147</td>
                      </tr> 
                      <tr>
                        <td>FIRE STATION</td>
                        <td>09165415314</td>
                      </tr> 
                      <tr>
                        <td>PESO</td>
                        <td>(043)703-2053</td>
                      </tr>
                    </table>
      <form action="alertify_backend.php" method="POST">
          </div>
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
              <h6 class="text-uppercase font-weight-bold">Connect To Us!</h6>
            <div class="form-outline form-white mb-4">
              <label class="form-label" for="form5Example2">Name</label>
              <input type="text" name="name" id="form5Example2" class="form-control" required/>
              <label class="form-label" for="form5Example2">Barangay</label>
              <select class="form-select" name="barangay" id="barangay" required>
                    <option disabled selected value="">Select Barangay</option>
                    <option value="Bacao">Bacao</option>
                    <option value="Bilogo">Bilogo</option>
                    <option value="Bukal">Bukal</option>
                    <option value="Dagatan">Dagatan</option>
                    <option value="Guinhawa">Guinhawa</option>
                    <option value="Laurel">Laurel</option>
                    <option value="Mabayabas">Mabayabas</option>
                    <option value="Mapulo">Mapulo</option>
                    <option value="Pagasa">Pagasa</option>
                    <option value="Panghayaan">Panghayaan</option>
                    <option value="Pina">Pina</option>
                    <option value="Pinagbayanan">Pinagbayanan</option>
                    <option value="Poblacion East">Poblacion East</option>
                    <option value="Poblacion West">Poblacion West</option>
                    <option value="San Isidro">San Isidro</option>
                    <option value="San Marcelino">San Marcelino</option>
                    <option value="Santo Nino">Santo Nino</option>
                    <option value="Tilambo">Tilambo</option>
                </select>
              <label class="form-label" for="form5Example2">Email address</label>
              <input type="email" name="email" id="form5Example2" class="form-control" required/>
              
              <label class="form-label" for="form5Example2">Comments/Suggestions/Feedbacks</label>
              <textarea class="form-control" name="feedback" id="exampleFormControlTextarea1" rows="3" required></textarea>
              <br>
            <button type="submit" class="btn btn-outline-light mb-4" name="feedback_submit_btn" style="float:right;">Send</button>
        </div>
      </form>  
        </div>
        <!--Grid column-->
        </div>
        <!--Grid row-->
      </section>
      <!-- Section: Links -->
    </div>
    <!-- Grid container -->
    <!-- Copyright -->
    <div
         class="text-center p-3"
         style="background-color: rgba(0, 0, 0, 0.2)"
         >
      © 2022 Copyright
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
</div>
<!-- End of .container -->      
<!-- Modal -->
    <div class="modal fade" id="residentsupdatemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 850px;">
            <div class="modal-content" >
            <div class="modal-header">
              <img src="images/logo3.png">
                <h5 class="modal-title" id="exampleModalLabel">Update Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <?php do{?>
              <form action="alertify_backend.php" method="POST">
                <div class="form-group form1">
                    <label>Full Name</label>
                    <input type="text" name="fullname" class="form-control" placeholder="Enter First Name." value="<?php echo $row['fullname']; ?>"required>
                </div>
                <div class="form-group form1">
                    <label>Gender</label>
                    <input type="text" name="gender" class="form-control" list="gender" placeholder="Gender" value="<?php echo $row['gender']; ?>" required>
                        <datalist id="gender">
                            <option value="Female"></option>
                            <option value="Male"></option>
                        </datalist>
                </div>
                <div class="form-group form1">
                    <label>Contact Number</label>
                    <input type="text" name="contactnumber" class="form-control" placeholder="Enter Contact Number." value="<?php echo $row['contactnumber']; ?>" required>
                </div>
                <div class="form-group form1">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter Email." value="<?php echo $row['email']; ?>" required>
                </div>
                <div class="form-group form1">
                    <label>Birth Date</label>
                    <input type="text" name="birthdate" class="form-control" placeholder="Enter Birth Date." value="<?php echo $row['birthdate']; ?>" required>
                </div>
                <div class="form-group form1">
                    <label>Barangay</label>
                    <input type="text" name="barangay" class="form-control" placeholder="Enter Barangay." value="<?php echo $row['barangay']; ?>" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="update_info_btn" class="btn btn-success">Save changes</button>
            </div>
            </div>
            <?php }while($row = $residents->fetch_assoc()); ?>
          </form>
        </div>
        </div>
        </div>
      </div>
    </div>
</div>
<!-- Bootstrap Core Javascript -->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>