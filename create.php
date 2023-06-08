<?php
if(!isset($_SESSION)){
    session_start();
}
include("includes/scripts.php");
?>

<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.scss">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Taysan, Batangas</title>
</head> 
<body class="body">
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
<center>
<div class="wrapper">
    <div class="logo">
        <img src="images\logo.png">
    </div><br>
        <div class="text-center mt-4 name"> 
           <h2>User's Information</h2>
        </div>
        <br>
        <form action="alertify_backend.php" method="post" enctype="multipart/form-data">
            <label class="label" style="font-weight: bolder;">Fullname</label>
            <div class="form-field d-flex align-items-center">
                <input type="text" name="fullname" placeholder="Fullname">
            </div> 
            <label class="label" style="font-weight: bolder;">Gender</label>
            <div class="form-field d-flex align-items-center">
                <select class="form-select form-select-lg" name="gender" id="gender" style="width: 620px; height: 50px;">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>  
            <label class="label" style="font-weight: bolder;">Contact Number</label>
            <div class="form-field d-flex align-items-center">
                <input class="checking_contactnumber" type="text" name="contactnumber"  placeholder="Contact Number">
                <span class="error_cnumber" style="color: red;"></span>
            </div>  
            <label class="label" style="font-weight: bolder;">Email Address</label>
            <div class="form-field d-flex align-items-center">
                <input class="checking_email" type="text" name="email"placeholder="Email">
                <span class="error_email" style="color: red;"></span>
            </div>  
            <label class="label" style="font-weight: bolder;">Birth Date</label>
            <div class="form-field d-flex align-items-center">
                <input type="date" name="birthdate" placeholder="Birth Date">
            </div>  
            <label class="label" style="font-weight: bolder;">Barangay</label>
            <div class="form-field d-flex align-items-center">
                <select class="form-select form-select-lg" name="barangay" id="barangay" style="width: 620px; height: 50px;">
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
            </div>
            <label class="label" style="font-weight: bolder;">Enter your Valid ID(Front)</label>
            <div class="form-field d-flex align-items-center">
                <input type="file" style="height: 60px;" name="uploadfile_front" accept="image/*" value="" required/>
            </div>
            <label class="label" style="font-weight: bolder;">Enter your Valid ID(Back)</label>
            <div class="form-field d-flex align-items-center">
                <input type="file" style="height: 60px;" name="uploadfile_back" accept="image/*" value="" required/>
            </div>
            <label class="label" style="font-weight: bolder;">Password</label>
            <div class="form-field d-flex align-items-center">
                <input type="password" name="password" placeholder="Password">
            </div>  
            <label class="label" style="font-weight: bolder;">Confirm Password</label>
            <div class="form-field d-flex align-items-center">
                <input type="password" name="cpassword" placeholder="Password">
            </div>  

            <button class="login_btn" name="register_btn">Sign Up</button>
        </form><br>
        <div class="text-center fs-6">
            <a href="index.php"><button class="btn btn-danger">Cancel</button></a>
        </div>
    </div>
</center>

<!-- Bootstrap Core Javascript -->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>