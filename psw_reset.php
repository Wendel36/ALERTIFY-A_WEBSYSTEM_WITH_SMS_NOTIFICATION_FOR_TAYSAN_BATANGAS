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
            </div>
                <form action="alertify_backend.php" method="post">
                    <br>
                    <label class="label" style="font-weight: bolder;">New Password</label>
                    <div class="form-field d-flex align-items-center">
                        <input type="password" name="password" placeholder="Enter your New Password" required="">
                    </div>
                    <br>
                    <label class="label" style="font-weight: bolder;">Confirm Password</label>
                    <div class="form-field d-flex align-items-center">
                        <input type="password" name="con_password"  placeholder="Confirm your New Password" requred="">
                    </div>
                    <br>
                    <button class="login_btn" name="update_psw" style="font-weight: 150px;">Update</button>
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