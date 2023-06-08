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
      <div class="container1 container1-expand-lg "style="background-color:#808080;">
        <br>
        <div class="card text-center bg-whites" >
        <div class="container1 container1-expand-lg .bg-warning.bg-gradient" style="height: 700px;">
            <div class="input-group">
                <div class="form-outline" >
                  <img src="images\deped.png" style="width: 250px; height: 250px; margin-left: -700px; margin-right: 20px; margin-top: 100px;">
                    <p style="text-align: center; margin-left: 300px; margin-top: -350px; font-size: 50px;">Department of Education</p>
                    <div class="overflow-auto p-3 bg-light rounded" id="requirements_newstudent" style="float: right; width: 700px; height: auto; background-color: gray; margin-right: -95px; text-align:left;">
                    <h4>Requirements of New Students</h4>  
                    <h6>1. Proof of the child's age
                        Any one of the following constitutes acceptable documentation: birth certificate; notarized copy of birth certificate; baptismal certificate; copy of the record of baptism – notarized or duly certified and showing the date of birth; notarized statement from the parents or another relative indicating the date of birth; a valid passport; a prior school record indicating the date of birth.
                        <br>
                        2. Immunizations required by law
                        Acceptable documentation includes: either the child’s immunization record, a written statement from the former school district or from a medical office that the required immunizations have been administered, or that a required series is in progress, or verbal assurances from the former school district or a medical office that the required immunizations have been completed, with records to follow.
                        <br>
                        3. Proof of residency
                        Acceptable documentation includes: a deed, a lease, current utility bill, current credit card bill, property tax bill, vehicle registration, driver’s license, DOT identification card. A district may require that more than one form of residency confirmation be provided. However, school districts and charter schools should be flexible in verifying residency, and should consider what information is reasonable in light of the family’s situation. See the paragraph on Homeless Students for guidance in that situation.
                        <br>
                        4. Parent Registration Statement
                        A sworn statement (See Attachment A (PDF)) attesting to whether the student has been or is suspended or expelled for offenses involving drugs, alcohol, weapons, infliction of injury or violence on school property must be provided for a student to be admitted to any school entity (24 P.S. § 13-1304-A). A school district may not deny or delay a child’s school enrollment based on the information contained in a disciplinary record or sworn statement.
                        
                        However, if a student is currently expelled for a weapons offense, the school district can provide the student with alternative education services during the period of expulsion (24 P.S. § 13-1317.2(e.1)). If the disciplinary record or sworn statement indicates the student has been expelled from a school district in which he was previously enrolled, for reasons other than a weapons offense, it is recommended the school district review the student's prior performance and school record to determine the services and supports to be provided upon enrollment in the district.
                        <br>
                        5. Home Language Survey
                        All students seeking first time enrollment in a school shall be given a home language survey in according with requirements of the U.S. Department of Education’s Office for Civil Rights. Enrollment of the student may not be delayed in order to administer the Home Language Survey. A copy of the Home Language Survey is provided at this website.
                      </h6>
                  </div><br>
                  <div class="overflow-auto p-3 bg-light rounded" id="requirements_transfer" style="float: right; width: 700px; height: auto; background-color: gray; margin-right: -95px; display: none; text-align: justify;">
                  <h4>Process of Transferring</h4>  
                  <h6>&nbsp;To be a successful transfer student, the most important thing you need to do is be a successful college student. The criteria colleges look for from transfer students is much the same as it is for graduating high school students, just scaled up.

                        Good grades are one of the most important things admissions offices look for in transfer applications. If struggling in school is one of the reasons you want to transfer, be prepared to explain what steps you're taking to improve them in your college essay. The main focus of your essay should not be that you're struggling to keep up, but rather that you're addressing the reason for the struggle, such as a program that isn't a good fit. Even better, demonstrate that you're working to improve by continuing to work hard and improve your grades as you're going through the transfer process.
                        
                        Test scores are less important as a college transfer. Though schools may request them if you're transferring after just one or two semesters, the further you are into your college education, the less test scores matter. If it's been more than five years since you were in school and since you took a standardized test, you may consider taking the SAT or ACT again so that your transfer school has a good idea of where you're at academically, but if it hasn't been long and your college transcripts are solid, it shouldn't be necessary.
                        
                        If you're an international student, you may have some additional considerations. It's important to work with your designated school official and be sure all your paperwork, including work and student visas, is up to date and accurate. As an international student, you'll be contending with all the same obstacles as domestic students, with a few additional hurdles like language barriers, transferring papers properly, and visas. Plan as early as possible to avoid hiccups in the process.
                    </h6>
                </div>
                <div class="overflow-auto p-3 bg-light rounded" id="policy" style="float: right; width: 700px; height: auto; background-color: gray; margin-right: -95px; display: none;">
                    <h4>School Policy Definition</h4>
                     <h6>School policy is defined as the set of established expectations for specific behavior and norms within a school. School policies are put in place to guide the day-to-day functioning of the school as well as to make it safe and an effective place for learning to occur.
                      
                      Typically, schools and school districts have specific policies for different target audiences. For example, schools may have policies for families regarding sick children and drop off and pick-up. Schools may also have policies for students such as uniforms, cell phone policies or attendance policies. School policies are usually written out in the form of the student and parent handbook or online through the school's website.</h6> 
                      
                      <h4>Establishing School Policies</h4>
                      <h6>In order for school policies to be effective, they have to be more than just statements on paper. School policies have to be clearly articulated to faculty, staff, students and parents. All groups must be made aware of the policies and exactly how they are expected to follow them.
                      
                      Ensuring that everyone is clear about policies and procedures will help reduce confusion. Additionally, if policies and procedures are clear, the greater the likelihood that they will be followed appropriately.
                    </h6>
                      <h4>School Policy for Safety</h4>
                     <h6>Overall, school safety is a top priority for schools. Therefore, schools across the country have implemented specific school safety policies to ensure a safe learning environment. For example, schools now regularly practice lock-down drills and have set clear procedures for how to handle a stranger on campus.
                    </h6>
                </div>
                <div class="overflow-auto p-3 bg-light rounded" id="location" style="float: right; width: 700px; height: auto; background-color: gray; margin-right: -95px; display: none;">
                    <iframe></iframe>
                </div><br/>
                  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white" style="margin-top: 350px; margin-left: -100px; width: 280px;">
                    <div class="position-sticky">
                      <div class="list-group list-group-flush mx-3 mt-4">
                        <button class="list-group-item list-group-item-action py-2 ripple "aria-current="true" onclick="Show1()"><span>Requirements of New Students</span></button>
                        <button class="list-group-item list-group-item-action py-2 ripple " onclick="Show2()"><span>Process of Tranferring</span></button>
                        <button class="list-group-item list-group-item-action py-2 ripple " onclick="Show3()"><span>Policy</span></button>
                        <button class="list-group-item list-group-item-action py-2 ripple " onclick="Show4()"><span>Location</span></button>
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
    document.getElementById('requirements_newstudent').style.display = "block";
    document.getElementById('requirements_transfer').style.display = "none";
    document.getElementById('policy').style.display = "none";
    document.getElementById('location').style.display = "none";
  }
  function Show2(){
    document.getElementById('requirements_newstudent').style.display = "none";
    document.getElementById('requirements_transfer').style.display = "block";
    document.getElementById('policy').style.display = "none";
    document.getElementById('location').style.display = "none";
  }  
  function Show3(){
    document.getElementById('requirements_newstudent').style.display = "none";
    document.getElementById('requirements_transfer').style.display = "none";
    document.getElementById('policy').style.display = "block";
    document.getElementById('location').style.display = "none";
  }  
  function Show4(){
    document.getElementById('requirements_newstudent').style.display = "none";
    document.getElementById('requirements_transfer').style.display = "none";
    document.getElementById('policy').style.display = "none";
    document.getElementById('location').style.display = "block";
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