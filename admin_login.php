<?php
if(!isset($_SESSION)){
    session_start();
}
include("includes/scripts.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.scss">
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
<center>
    <div class="wrapper">
        <div class="logo">
            <img src="images\logo.png">
        </div>
            <div class="text-center mt-4 name"> 
            <h2>Taysan Municipality</h2>
            <h4>Administrator Login</h4>
            </div>
                <form action="alertify_backend.php" method="post">
                    <br>
                    <label class="label" style="font-weight: bolder;">Username</label>
                    <div class="form-field d-flex align-items-center">
                        
                        <input type="text" name="username" placeholder="Username">
                    </div>
                    <br>
                    <label class="label" style="font-weight: bolder;">Password</label>
                    <div class="form-field d-flex align-items-center">
                        <input type="password" name="password"  placeholder="Password" class="input">
                    </div>
                    <br>
                    <button class="login_btn" name="admin_login_btn" style="font-weight: 150px;">Login</button>
                </form><br>
        <div class="text-center fs-6">
        <a href="admn_chnge_psw.php">Forget password?</a>
        </div>
    </div>
</center>

<!-- Bootstrap Core Javascript -->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>