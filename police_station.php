<?php
if(!isset($_SESSION)){
  session_start();
}
include("connections/connection.php");

$con = connection();

if(isset($_SESSION['UserLogin'])){
  $contactnumber = $_SESSION['UserLogin'];
  $contactnumber = $_SESSION['contactnumber'];
  $sql = "SELECT * FROM tbl_residentsinfo WHERE contactnumber = '$contactnumber'";
$residents = $con->query($sql) or die($con->error);
$row = $residents->fetch_assoc();
}
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
    <title>Taysan, Batangas</title>
</head>
<body>
  
    <nav class="navbar navbar-expand-lg fixed-top sticky-top bg-light" >
    <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/logo.png" alt="Municipality of Taysan" width="100" height="80">
                <h2 style="float: right; margin-top: 20px; margin-left: 20px;">Taysan, Batangas</h2>
              </a>
        </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
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
        <div class="card text-center bg-whites" >
        <div class="container1 container1-expand-lg .bg-warning.bg-gradient" style="height: 700px;">
            <div class="input-group">
                <div class="form-outline" >
                  <img src="images\police.png" style="width: 250px; height: 250px; margin-left: -500px; margin-right: 20px; margin-top: 100px;">
                    <p style="text-align: center; margin-left: 380px; margin-top: -350px; font-size: 50px;">Police Station</p>
                    <div class="overflow-auto p-3 bg-light rounded" id="police_clearance" style="float: right; width: 700px; height: auto; background-color: gray; margin-right: -300px; text-align: left; font-style:inherit; font-size: 15px;">
                      <h4>To apply for a police clearance, you need to present two valid IDs. These can be any of the following:</h4>

                        <li>Birth Certificate</li>
                        <li>Driver’s License</li>
                        <li>Passport</li>
                        <li>SSS ID/UMID</li>
                        <li>TIN ID</li>
                        <li>Voter’s ID</li>
                        <li>School ID (with registration form)</li>
                        <li>PRC ID</li>
                        <li>Postal ID</li>
                        <li>Senior Citizen ID</li>
                        <li>OFW ID</li>
                        <li>GSIS ID</li>
                        <li>PhilHealth ID</li>
                        <li>Alien Certificate of Registration</li>
                        <h4>The two IDs presented should:</h4>
                        
                        <li>Original (not photocopied)</li>
                        <li>Not be expired</li>
                        <li>Bears the applicant’s complete name, clear photo, and signature</li>
                        <h6>Note: If you only have one valid ID, you can present this along with a certified true copy of your birth certificate (with original official receipt). 
                      </h6>
                  </div>
                  <div class="overflow-auto p-3 bg-light rounded" id="procedures" style="float: right; width: 700px; height: auto; background-color: gray; margin-right: -300px; display: none; text-align: justify;">
                    <h2>How to Apply for a Police Clearance Online</h2>
                        In August of 2018, the PNP launched the National Police Clearance System (NPCS) – an online service that allows Filipinos nationwide to secure a police clearance in just 10 minutes.
                        
                        However, applicants will still have to make a personal at a police station to register their biometrics.
                        
                        Here’s how to go about applying online: 
                        
                        <h4 style="font-weight: bolder;">Step 1: Register for an online account</h4>
                        <h6>Visit PNPClearance.ph. If you’re a first-time applicant, click the “Register” button and agree to the Terms and Conditions. Click on the “Next” button until you reach the last page where the “Agree” button is. </h6>
                        <h6>Input all the required information in the “New Applicant Registration” box. Once you check the “Terms and Conditions” box, click the “Register” button. </h6>
                       <h6>You’ll then receive a confirmation email from the NPCS. If you can’t find the email in your inbox, check your spam folder.

                        The email will contain a link to verify your account. When you click the verification link, you’ll be taken to the log-in page of the NPCS website. </h6> 
                        <h4 style="font-weight: bolder;">Step 2: Set an appointment</h4>  
                        <h6>Sign in to your account using your registered email address. It’s important to note that before you can set an appointment, you need to edit your profile first.</h6>
                        <h6>To do this, you’ll need to click the “Edit Profile” button and accomplish the online form. When you’re done, click the “Save Profile” button. 
                            Then, click the “Clearance Application” button and select the police station closest to you. Then, choose from the list of available schedules and click “Next.”</h6>
                        <h6>Click the “Land Bank of the Philippines” button, then “Save Appointment.”</h6>
                        <h6>This will show you the payment details. Take note of the reference number provided as this will be used for the police clearance fee payment. </h6>
                        <h4 style="font-weight: bolder;">Step 3: Pay for the Police Clearance</h4>
                        <h6>Click the “Pay to LANDBANK” button. This will take you to the LBP ePayment Portal.

                            You can pay the fee using your Landbank, GCash, or BancNet account. </h6>
                        <h4 style="font-weight: bolder;">Step 4: Go to your selected police station</h4>
                        <h6>On your scheduled appointment, you’ll need to bring your two valid IDs, reference number, and official receipt of your police clearance payment.</h6>
                        <h6>Once there, you'll have your biometrics captured, along with your photo, fingerprints, and digital signature. Then, you’ll need to wait a few minutes as the police officer verifies your records on the PNP database. </h6>
                        <h6>Should your name get a hit, you’ll need to undergo another verification process. Once you get through that, you can claim your police clearance. </h6>
                    </div>
                <div class="overflow-auto p-3 bg-light rounded" id="report_missing" style="float: right; width: 700px; height: auto; background-color: gray; margin-right: -300px; display: none; text-align: justify;">
                    <li>If you have concerns for someone’s safety and welfare, and their whereabouts is unknown, you can file a missing person’s report at your local police station.
<br></li>
                        <li>The first 24 hours following a person’s disappearance are the most crucial. This is because the sooner police are able to follow-up leads, such as the availability of CCTV footage, the more likely the person will be found safe and well.
                        It is important to give the police all the facts and circumstances related to the disappearance, including search efforts already made by you and others. Relevant information may include intimate or private details regarding the missing person or their lifestyle.
                    </li>
                </div>
                
                
                  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white" style="margin-top: 350px; margin-left: -100px; width: 280px;">
                    <div class="position-sticky">
                      <div class="list-group list-group-flush mx-3 mt-4">
                        <button class="list-group-item list-group-item-action py-2 ripple "aria-current="true" onclick="Show1()"><span>Police Clearance Requirements</span></button>
                        <button class="list-group-item list-group-item-action py-2 ripple " onclick="Show2()"><span>Procedures</span></button>
                        <button class="list-group-item list-group-item-action py-2 ripple " onclick="Show3()"><span>How to report missing person</span></button>
                      </div>
                    </div>
                  </nav>
                </div>
                <br>
              </div>
            </div>
          </div>
<script type="text/javascript">
  function Show1(){
    document.getElementById('police_clearance').style.display = "block";
    document.getElementById('procedures').style.display = "none";
    document.getElementById('report_missing').style.display = "none";
  }
  function Show2(){
    document.getElementById('police_clearance').style.display = "none";
    document.getElementById('procedures').style.display = "block";
    document.getElementById('report_missing').style.display = "none";
  }  
  function Show3(){
    document.getElementById('police_clearance').style.display = "none";
    document.getElementById('procedures').style.display = "none";
    document.getElementById('report_missing').style.display = "block";
  }  
</script>        
<!-- Remove the container if you want to extend the Footer to full width. -->
<div id="contact_us" class="container my-5">
  <!-- Footer -->
  <footer
          class="text-center text-lg-start text-white"
          style="background-color: rgba(210,0,8,1);;"
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
               href="#!"
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
              <input type="text" name="barangay" id="form5Example2" class="form-control" required/>

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
<!-- End of .container --> 
        </div>
      </div>
    </div>
  </div>

<!-- Bootstrap Core Javascript -->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>