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
        <title>Municipality of Taysan</title>
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
<center>
    <div class="wrapper">
        <div class="logo">
            <img src="images\logo.png">
        </div>
            <div class="text-center mt-4 name"> 
               <h2>Taysan Municipality</h2>
               <h3>OTP Verification</h3>
            </div>
                <form action="alertify_backend.php" method="post">
                    <br>
                    <label class="label" style="font-weight: bolder;">OTP Code</label>
                    <div class="form-field d-flex align-items-center">
                        <input type="number" name="otp_code" placeholder="Enter your OTP Code" required>
                    </div>
                    <br>
                    <button class="login_btn" name="verify" style="font-weight: 100;">Next</button>
                    <br>
                </form><br>
        <div class="text-center fs-6">
            <a href="psw_recover.php"><button type="button" class="btn btn-danger" style="font-weight: 100;">Back</button></a>      
        </div>
    </div>
</center>

<!-- Bootstrap Core Javascript -->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>