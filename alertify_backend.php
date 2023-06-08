<?php
// Connections of Database and other API
if(!isset($_SESSION)){
    session_start();
}
include_once("connections/connection.php");
$con = connection();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
?>
<?php
// Backend for the User Login Page
if(isset($_POST['login_btn'])){

    $contactnumber = mysqli_real_escape_string($con, $_POST ['contactnumber']);
    $password = mysqli_real_escape_string($con, $_POST ['password']);

    if(empty($contactnumber)){
        $_SESSION['alert'] = "Contact Number is Required";
        $_SESSION['alert_code'] = "warning";
        header("Location: login.php");
    }else{
        if(empty($password)){
            $_SESSION['alert'] = "Password is Required";
            $_SESSION['alert_code'] = "warning";
            header("Location: login.php"); 
            exit;
        }else{
            $sql = "SELECT * FROM tbl_residentsinfo WHERE contactnumber = '$contactnumber'";
            $user = $con->query($sql) or die ($con->error);
            $row = $user->fetch_assoc();
            $stored_password = $row['password'];

            if($row > 0){

                $select = mysqli_query($con,"SELECT * FROM tbl_residentsinfo WHERE contactnumber = '$contactnumber'");
                $row = mysqli_fetch_array($select);

                $status = $row['status'];
                $_SESSION['status'] = $row['status'];

                if(password_verify($password, $stored_password)){
                    if($status == "approved"){
                        $_SESSION['UserLogin'] = $row['contactnumber'];     
                        $_SESSION['Access'] = $row['contactnumber'];
                        $_SESSION['contactnumber'] = $contactnumber;
                        $_SESSION['alert'] = "Login Success!";
                        $_SESSION['alert_code'] = "success";
                        header("Location: index.php"); 
                    }elseif($status == "pending"){
                        $_SESSION['alert'] = "We are Verifying your Account Please Wait a Moment.";
                        $_SESSION['alert_code'] = "warning";
                        header("Location: login.php");
                    }else{
                        $_SESSION['alert'] = "Something Went Wrong";
                        $_SESSION['alert_code'] = "warning";
                        header("Location: login.php");
                        }
                }else{
                    $_SESSION['alert'] = "Incorrect Password";
                    $_SESSION['alert_code'] = "error";
                    header("Location: login.php");
                }
            }else{
                $_SESSION['alert'] = "Invalid Phone Number or Password";
                $_SESSION['alert_code'] = "error";
                header("Location: login.php");
            }
        }
    }
}
?>
<?php
// Backend for the Admin Login Page
if(isset($_POST['admin_login_btn'])){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $pass = mysqli_real_escape_string($con, $_POST['password']);

    if(empty($username)){
        $_SESSION['alert'] = "Username is Required";
        $_SESSION['alert_code'] = "warning";
        header("Location: login.php");
        exit; 
    }
    if(empty($pass)){
        $_SESSION['alert'] = "Password is Required";
        $_SESSION['alert_code'] = "warning";
        header("Location: login.php"); 
        exit;
    }
    $sql = "SELECT * FROM tbl_admin WHERE username='$username'"; 
    $user = $con->query($sql) or die($con->error);
    $row = $user->fetch_assoc();
    if($row['username'] == "admin"){
        if(password_verify($_POST['password'], $row['password'])){
            $_SESSION['UserLogin'] = $row['username'];     
            $_SESSION['Access'] = $row['username'];
            $_SESSION['alert'] = "Success Login!";
            $_SESSION['alert_code'] = "success";
            header ("Location: homepageadmin.php");
            exit;
        }else{
            $_SESSION['alert'] = "Invalid Password";
            $_SESSION['alert_code'] = "error";
            header("Location: admin_login.php");
            exit; 
        }   
    }else{
        $_SESSION['alert'] = "Invalid Credentials";
        $_SESSION['alert_code'] = "error";
        header("Location: admin_login.php");
        exit;
        }
}
?>
<?php
// Backend for the Create Account Page
if(isset($_POST['register_btn'])){
    $fullname = mysqli_real_escape_string($con, $_POST ['fullname']);
    $gender = mysqli_real_escape_string($con, $_POST ['gender']);
    $cnumber = mysqli_real_escape_string($con, $_POST ['contactnumber']);
    $email = mysqli_real_escape_string($con, $_POST ['email']);
    $bdate = mysqli_real_escape_string($con, $_POST ['birthdate']);
    $barangay = mysqli_real_escape_string($con, $_POST ['barangay']);
    $image_front = $_FILES["uploadfile_front"]["name"];
    $image_back = $_FILES["uploadfile_back"]["name"];
    $password = mysqli_real_escape_string($con, $_POST ['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST ['cpassword']);

    if(empty($_POST['fullname'])){
        $_SESSION['alert'] = "Full Name is Required";
        $_SESSION['alert_code'] = "warning";
        header("Location: create.php");  
    }else{
        if(empty($_POST['gender'])){
            $_SESSION['alert'] = "Gender is Required";
            $_SESSION['alert_code'] = "warning";
            header("Location: create.php");  
        }else{
            if(empty($_POST['contactnumber'])){
                $_SESSION['alert'] = "Contact Number is Required";
                $_SESSION['alert_code'] = "warning";
                header("Location: create.php");
            }else{
                // check if contact number is valid
                if (!preg_match("/^(09|639)\d{9}$/",($_POST['contactnumber']))) {
                    $_SESSION['alert'] ="Contact Number is not valid";
                    $_SESSION['alert_code'] = "error";
                    header("Location: create.php");
                }else{
                    if(empty($_POST['email'])){
                        $_SESSION['alert'] = "Email is Required";
                        $_SESSION['alert_code'] = "warning";
                        header("Location: create.php");  
                    }else{
                        $email = ($_POST["email"]);
                        // check if e-mail address is well-formed
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $_SESSION['alert'] = "Email is Invalid";
                            $_SESSION['alert_code'] = "error";
                            header("Location: create.php");  
                        }else{
                            if(empty($_POST['birthdate'])){
                                $_SESSION['alert'] = "Birthdate is Required";
                                $_SESSION['alert_code'] = "warning";
                                header("Location: create.php");  
                            }else{
                                if(empty($_POST['barangay'])){
                                    $_SESSION['alert'] = "Barangay is Required";
                                    $_SESSION['alert_code'] = "warning";
                                    header("Location: create.php");
                                }else{
                                    if(empty($_POST['password']) && empty($_POST['cpassword'])){
                                        $_SESSION['alert'] = "Password and Confirm Password is Required";
                                        $_SESSION['alert_code'] = "warning";
                                        header("Location: create.php");
                                    }else{
                                        if($_POST['password'] || $_POST['cpassword']){
                                            if( strlen($_POST['password']) > 20 ) {
                                                $_SESSION['alert'] = "The Password is too long";
                                                $_SESSION['alert_code'] = "warning";
                                                header("Location: create.php");
                                                }
                                                if( strlen($_POST['password'] ) < 8 ) {
                                                $_SESSION['alert'] = "The Password is too short, At least 8 characters and numbers.";
                                                $_SESSION['alert_code'] = "warning";
                                                header("Location: create.php");
                                                }
                                            }
                                        }
                                        if($_POST['password'] == $_POST['cpassword']){
                                            // Check if the contactnumber exists
                                            $sql = "SELECT * FROM tbl_residentsinfo WHERE contactnumber = '$cnumber'";
                                            $user = $con->query($sql) or die ($con->error);
                                            $row = $user->fetch_assoc();
                                            $result = $user->num_rows;
                                            if($result > 0){
                                                $_SESSION['alert'] = "Contact Number Already Exists";
                                                $_SESSION['alert_code'] = "warning";
                                                header("Location: create.php");
                                                exit(0);
                                            }else{
                                                // Check if the email exists
                                                $sql = "SELECT * FROM tbl_residentsinfo WHERE email = '$email'";
                                                $user = $con->query($sql) or die ($con->error);
                                                $row = $user->fetch_assoc();
                                                $result = $user->num_rows;
                                                if($result > 0){
                                                $_SESSION['alert'] = "Email Already Exists";
                                                $_SESSION['alert_code'] = "warning";
                                                header("Location: create.php");
                                                exit(0);
                                                }else{
                                                    // Checking if the extension is Image type
                                                    $allowed_exttension = array('jpg','png','jpeg');
                                                    $image_front = $_FILES["uploadfile_front"]["name"];
                                                    $image_back = $_FILES["uploadfile_back"]["name"];
                                                    $file_extension_front = pathinfo($image_front, PATHINFO_EXTENSION);
                                                    $file_extension_back = pathinfo($image_back, PATHINFO_EXTENSION);
                                                    if(!in_array($file_extension_front, $allowed_exttension)){
                                                        $_SESSION['alert'] = "Only Accepting Image extension file";
                                                        $_SESSION['alert_code'] = "warning";
                                                        header("Location: create.php");
                                                    }else if(!in_array($file_extension_back, $allowed_exttension)){
                                                        $_SESSION['alert'] = "Only Accepting Image extension file";
                                                        $_SESSION['alert_code'] = "warning";
                                                        header("Location: create.php");
                                                    }else{
                                                        //Checking if the image front is already exists
                                                        if(file_exists("./img_front/" . $_FILES["uploadfile_front"]["name"])){
                                                        $image_front = $_FILES["uploadfile_front"]["name"];
                                                        $_SESSION['alert'] = "The Image is Already Exists";
                                                        $_SESSION['alert_code'] = "warning";
                                                        header("Location: create.php");
                                                        }else{
                                                            //Checking if the image back is already exists
                                                            if(file_exists("./img_back/" . $_FILES["uploadfile_back"]["name"])){
                                                                $image_back = $_FILES["uploadfile_back"]["name"];
                                                                $_SESSION['alert'] = "The Image is Already Exists";
                                                                $_SESSION['alert_code'] = "warning";
                                                                header("Location: create.php");
                                                            }else{
                                                                if($password = password_hash($password, PASSWORD_DEFAULT)){
                                                                    $sql = "INSERT INTO `tbl_residentsinfo`(`fullname`, `gender`, `contactnumber`, `email`, `birthdate`, `barangay`, `valid_img_front`, `valid_img_back`,`password`,`status`) VALUES ('$fullname', '$gender', '$cnumber', '$email' , '$bdate', '$barangay', '$image_front', '$image_back', '$password','pending')";
                                                                    $insert_result = $con->query($sql) or die ($con->error);
                                                                    if($insert_result > 0){
                                                                        move_uploaded_file($_FILES["uploadfile_front"]["tmp_name"],"./img_front/" . $_FILES["uploadfile_front"]["name"]);
                                                                        move_uploaded_file($_FILES["uploadfile_back"]["tmp_name"],"./img_back/" . $_FILES["uploadfile_back"]["name"]);
                                                                        $_SESSION['alert'] = "Your Credentials are in Pending for Approval!";
                                                                        $_SESSION['alert_code'] = "info";
                                                                        header("Location: login.php");
                                                                        exit(0);
                                                                        } 
                                                                    }    
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                        }else{
                                          $_SESSION['alert'] = "Password and Confirm Password not matched";
                                          $_SESSION['alert_code'] = "error";
                                          header("Location: create.php");
                                          exit(0);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
?>
<?php
// validaion on create page input field
if(!isset($_SESSION)){
    session_start();
}
include_once("connections/connection.php");

$con = connection();

if(isset($_POST['check_email_submit_btn'])){

    $email = $_POST['email_id'];

        $sql = "SELECT * FROM tbl_residentsinfo WHERE email = '$email'";
        $user = $con->query($sql) or die ($con->error);
        $row = $user->fetch_assoc();
        $result = $user->num_rows;

        if($result> 0){
            echo"Email Already Exist";
        }
        else{
            echo"Available";
        }
}
if(isset($_POST['check_cnumber_submit_btn'])){

    $contactnumber = $_POST['contactnumber_id'];

        $sql = "SELECT * FROM tbl_residentsinfo WHERE contactnumber = '$contactnumber'";
        $user = $con->query($sql) or die ($con->error);
        $row = $user->fetch_assoc();
        $result = $user->num_rows;

        if($result> 0){
            echo"Number Already Exist";
        }
        else{
            echo"Available";
        }
}
?>
<?php
// Backend for Forgot Password Page
if(!isset($_SESSION)){
  session_start();
}

include_once("connections/connection.php");

$con = connection();

$mail = new PHPMailer;

if(isset($_POST["recover"])){
        
        $email = $_POST["email"];

        if(empty($email)){
            $_SESSION['alert'] = "Email is Required";
            $_SESSION['alert_code'] = "warning";
            header("Location: psw_recover.php");
            exit; 
        }

        $sql = "SELECT * FROM tbl_residentsinfo WHERE email = '$email'";
        $user = $con->query($sql) or die ($con->error);
        $row = $user->fetch_assoc();
        $result = $user->num_rows;

        if($result > 0){
            $otp = rand(100000,999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['mail'] = $email;

            //Server settings
            $mail->isSMTP();                                                   //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                              //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                          //Enable SMTP authentication
            $mail->Username   = 'taysanmunicipality@gmail.com';                     //SMTP username
            $mail->Password   = 'wunaovhedbdjxqev';                            //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                   //Enable implicit TLS encryption
            $mail->Port       = 465;                                           //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('taysanmunicipality@gmail.com', 'OTP Verification');
            $mail->addAddress($_POST["email"]);                                //Add a recipient

            //Content
            $mail->isHTML(true);
             // Add the local image as an embedded image
            $image_path = './images/logo2.png';
            $image_name = 'logo2.png';
            $mail->addEmbeddedImage($image_path, 'logo2', $image_name);

            $mail->Subject="Your Verify Code [$otp]";
            $mail->Body="<img src='cid:logo2' alt='Municipality of Taysan'>
                        <p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
                        <br><br>
                        <p>With regrads,</p>
                        <b>Municipality of Taysan</b>
                        <br/>
                        <center>
                            <p>Taysan, Batangas 4228 PH</p>
                            <p>Contact Us: taysanmunicipality@gmail.com</p>
                            <p>+ 63 946 372 5161</p>
                        </center>";

                    if(!$mail->send()){
                        $_SESSION['alert'] = "Invalid Email";
                        $_SESSION['alert_code'] = "error";
                        header("Location: psw_recover.php");
                        exit;
                    }else{
                        $_SESSION['alert'] = "Register Successfully, OTP sent to " . $email;
                        $_SESSION['alert_code'] = "success";
                        header("Location: psw_verify.php");
                        exit;
                    }
                }
                else{
                    $_SESSION['alert'] = "Unregistered Email Address";
                    $_SESSION['alert_code'] = "error";
                    header("Location: psw_recover.php");
                    exit;   
                }         
} 
// Backend for Password Verification via OTP Code 
if(!isset($_SESSION)){
    session_start();
}

include_once('connections/connection.php');

$con = connection();

if(isset($_POST["verify"])){
    $otp = $_SESSION['otp'];
    $email = $_SESSION['mail'];
    $otp_code = $_POST['otp_code'];

    if($otp != $otp_code){
        $_SESSION['alert'] = "Invalid OTP code";
        $_SESSION['alert_code'] = "error";
        header("Location: psw_verify.php");

    }else{

        mysqli_query($con ,"UPDATE tbl_residentsinfo SET email='$email' WHERE email = '$email'");


        $_SESSION['alert'] = "Verify Account done, you may now reset your password.";
        $_SESSION['alert_code'] = "success";
        header("Location: psw_reset.php");   
    }
}
// Backend for Password Reset Page
if(!isset($_SESSION)){
    session_start();
}

include_once('connections/connection.php');

$con = connection();

if(isset($_POST["update_psw"])){
    if ($_POST["password"] === $_POST["con_password"]) {
        $otp = $_SESSION['otp'];
        $email = $_SESSION['mail'];
        $password = $_POST['con_password'];

        mysqli_query($con ,"UPDATE tbl_residentsinfo SET email='$email' WHERE email = '$email'");
          
        if($email){
            $sql = mysqli_query($con, "SELECT * FROM tbl_residentsinfo WHERE email='$email' AND password = '$password'");
            $query = mysqli_num_rows($sql);
  	        $fetch = mysqli_fetch_assoc($sql);

              $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            mysqli_query($con, "UPDATE tbl_residentsinfo SET password='$hashed_password' WHERE email='$email'");
            
            $_SESSION['alert'] = "Your password has been successfully reset";
            $_SESSION['alert_code'] = "success";
            header("Location: login.php");
        }else{
            $_SESSION['alert'] = "Please try again";
            $_SESSION['alert_code'] = "error";
            header("Location: psw_reset.php");
        }

     }
     else {
            $_SESSION['alert'] = "New Password and Confirm Password not matched.";
            $_SESSION['alert_code'] = "error";
            header("Location: psw_reset.php");
     }
}
?>
<?php
//User Validation in ADMIN 
// IF User Approved
if(isset($_POST['approve'])){
    $user_id = $_POST['user_id'];

    $select = "UPDATE tbl_residentsinfo SET status ='approved' WHERE user_id = '$user_id'";
    $result = mysqli_query($con,$select);

    $send_email = mysqli_query($con,"SELECT email FROM tbl_residentsinfo WHERE user_id = '$user_id'");
    $row = mysqli_fetch_array($send_email);

    $email = $row['email'];
    
    $mail = new PHPMailer;

    $sql = "SELECT * FROM tbl_residentsinfo WHERE email = '$email'";
        $user = $con->query($sql) or die ($con->error);
        $row = $user->fetch_assoc();
        $result = $user->num_rows;

                if($result > 0){
                    $_SESSION['mail'] = $email;

                    //Server settings
                    $mail->isSMTP();                                                   //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                              //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                          //Enable SMTP authentication
                    $mail->Username   = 'taysanmunicipality@gmail.com';                     //SMTP username
                    $mail->Password   = 'wunaovhedbdjxqev';                            //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                   //Enable implicit TLS encryption
                    $mail->Port       = 465;                                           //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('taysanmunicipality@gmail.com', 'User Registration Verification');
                    $mail->addAddress($row['email']);                                //Add a recipient

                    //Content
                    $mail->isHTML(true);
                    $mail->Subject="Account Verification Status";
                    $mail->Body="<p>Dear user, $email </p> <h3> Your Account has been verified by the admin. You may now login here:<br></h3><br>
                                <p>https://taysanbatangas.com/login.php</p>
                                <br><br>
                                <p>With regrads,</p>
                                <b>Municipality of Taysan</b>";
    
                            if(!$mail->send()){
                                $_SESSION['alert'] = "Something Went Wrong!";
                                $_SESSION['alert_code'] = "warning";
                                header("Location: reg_validation.php");
                            }else{
                                $_SESSION['alert'] = "User Registration Approved!";
                                $_SESSION['alert_code'] = "success";
                                header("Location: reg_validation.php");
                            }
                }
}
//IF User Denied
if(isset($_POST['deny'])){
    $user_id = $_POST['user_id'];
    
    $img_front = mysqli_query($con,"SELECT valid_img_front FROM tbl_residentsinfo WHERE user_id = '$user_id'");
    $row = mysqli_fetch_array($img_front);

    $del_res_img_front = $row['valid_img_front'];

    $img_back = mysqli_query($con,"SELECT valid_img_back FROM tbl_residentsinfo WHERE user_id = '$user_id'");
    $row = mysqli_fetch_array($img_back);

    $del_res_img_back = $row['valid_img_back'];

    $send_email = mysqli_query($con,"SELECT email FROM tbl_residentsinfo WHERE user_id = '$user_id'");
    $row = mysqli_fetch_array($send_email);

    $email = $row['email'];
    
    $mail = new PHPMailer;

    $sql = "SELECT * FROM tbl_residentsinfo WHERE email = '$email'";
        $user = $con->query($sql) or die ($con->error);
        $row = $user->fetch_assoc();
        $result = $user->num_rows;

                if($result > 0){
                    $_SESSION['mail'] = $email;

                    //Server settings
                    $mail->isSMTP();                                                   //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                              //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                          //Enable SMTP authentication
                    $mail->Username   = 'taysanmunicipality@gmail.com';                     //SMTP username
                    $mail->Password   = 'wunaovhedbdjxqev';                            //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                   //Enable implicit TLS encryption
                    $mail->Port       = 465;                                           //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('taysanmunicipality@gmail.com', 'User Registration Verification');
                    $mail->addAddress($row['email']);                                //Add a recipient

                    //Content
                    $mail->isHTML(true);
                    $mail->Subject="Account Verification Status";
                    $mail->Body="<p>Dear user, $email </p> <h3> Unfortunately, Your Registration is Denied, You can submit another registration form here:<br></h3><br>
                                <p>https://taysanbatangas.com/create.php</p>
                                <br><br>
                                <p>With regrads,</p>
                                <b>Municipality of Taysan</b>";
    
                            if(!$mail->send()){
                                $_SESSION['alert'] = "Something Went Wrong!";
                                $_SESSION['alert_code'] = "warning";
                                header("Location: reg_validation.php");;
                            }else{
                                unlink("img_front/". $del_res_img_front);
                                unlink("img_back/". $del_res_img_back);
                                $select = "DELETE FROM tbl_residentsinfo WHERE user_id = '$user_id'";
                                $result = mysqli_query($con,$select);

                                $_SESSION['alert'] = "User Registration Denied";
                                $_SESSION['alert_code'] = "info";
                                header("Location: reg_validation.php");
                            }
                }
}
?>
<?php
// Backend for the Add btn of user_info modal Page
if(isset($_POST['add_btn'])){
    $fullname = mysqli_real_escape_string($con, $_POST ['fullname']);
    $gender = mysqli_real_escape_string($con, $_POST ['gender']);
    $cnumber = mysqli_real_escape_string($con, $_POST ['contactnumber']);
    $email = mysqli_real_escape_string($con, $_POST ['email']);
    $bdate = mysqli_real_escape_string($con, $_POST ['birthdate']);
    $barangay = mysqli_real_escape_string($con, $_POST ['barangay']);
    $image_front = $_FILES["uploadfile_front"]["name"];
    $image_back = $_FILES["uploadfile_back"]["name"];
    $password = mysqli_real_escape_string($con, $_POST ['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST ['cpassword']);

    if(empty($_POST['fullname'])){
        $_SESSION['alert'] = "Full Name is Required";
        $_SESSION['alert_code'] = "warning";
        header("Location: user_info.php");  
    }else{
        if(empty($_POST['gender'])){
            $_SESSION['alert'] = "Gender is Required";
            $_SESSION['alert_code'] = "warning";
            header("Location: user_info.php");  
        }else{
            if(empty($_POST['contactnumber'])){
                $_SESSION['alert'] = "Contact Number is Required";
                $_SESSION['alert_code'] = "warning";
                header("Location: user_info.php");
            }else{
                // check if contact number is valid
                if (!preg_match("/^(09|639)\d{9}$/",($_POST['contactnumber']))) {
                    $_SESSION['alert'] ="Contact Number is not valid";
                    $_SESSION['alert_code'] = "error";
                    header("Location: user_info.php");
                }else{
                    if(empty($_POST['email'])){
                        $_SESSION['alert'] = "Email is Required";
                        $_SESSION['alert_code'] = "warning";
                        header("Location: user_info.php");  
                    }else{
                        $email = ($_POST["email"]);
                        // check if e-mail address is well-formed
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $_SESSION['alert'] = "Email is Invalid";
                            $_SESSION['alert_code'] = "error";
                            header("Location: user_info.php");  
                        }else{
                            if(empty($_POST['birthdate'])){
                                $_SESSION['alert'] = "Birthdate is Required";
                                $_SESSION['alert_code'] = "warning";
                                header("Location: user_info.php");  
                            }else{
                                if(empty($_POST['barangay'])){
                                    $_SESSION['alert'] = "Barangay is Required";
                                    $_SESSION['alert_code'] = "warning";
                                    header("Location: user_info.php");
                                }else{
                                    if(empty($_POST['password']) && empty($_POST['cpassword'])){
                                        $_SESSION['alert'] = "Password and Confirm Password is Required";
                                        $_SESSION['alert_code'] = "warning";
                                        header("Location: user_info.php");
                                    }else{
                                        if($_POST['password'] || $_POST['cpassword']){
                                            if( strlen($_POST['password']) > 20 ) {
                                                $_SESSION['alert'] = "The Password is too long";
                                                $_SESSION['alert_code'] = "warning";
                                                header("Location: user_info.php");
                                                }
                                                if( strlen($_POST['password'] ) < 8 ) {
                                                $_SESSION['alert'] = "The Password is too short, At least 8 characters and numbers.";
                                                $_SESSION['alert_code'] = "warning";
                                                header("Location: user_info.php");
                                                }
                                            }
                                        }
                                        if($_POST['password'] == $_POST['cpassword']){
                                            // Check if the contactnumber exists
                                            $sql = "SELECT * FROM tbl_residentsinfo WHERE contactnumber = '$cnumber'";
                                            $user = $con->query($sql) or die ($con->error);
                                            $row = $user->fetch_assoc();
                                            $result = $user->num_rows;
                                            if($result > 0){
                                                $_SESSION['alert'] = "Contact Number Already Exists";
                                                $_SESSION['alert_code'] = "warning";
                                                header("Location: user_info.php");
                                                exit(0);
                                            }else{
                                                // Check if the email exists
                                                $sql = "SELECT * FROM tbl_residentsinfo WHERE email = '$email'";
                                                $user = $con->query($sql) or die ($con->error);
                                                $row = $user->fetch_assoc();
                                                $result = $user->num_rows;
                                                if($result > 0){
                                                $_SESSION['alert'] = "Email Already Exists";
                                                $_SESSION['alert_code'] = "warning";
                                                header("Location: user_info.php");
                                                exit(0);
                                                }else{
                                                    // Checking if the extension is Image type
                                                    $allowed_exttension = array('jpg','png','jpeg');
                                                    $image_front = $_FILES["uploadfile_front"]["name"];
                                                    $image_back = $_FILES["uploadfile_back"]["name"];
                                                    $file_extension_front = pathinfo($image_front, PATHINFO_EXTENSION);
                                                    $file_extension_back = pathinfo($image_back, PATHINFO_EXTENSION);
                                                    if(!in_array($file_extension_front, $allowed_exttension)){
                                                        $_SESSION['alert'] = "Only Accepting Image extension file (FRONT)";
                                                        $_SESSION['alert_code'] = "warning";
                                                        header("Location: user_info.php");
                                                    }else if(!in_array($file_extension_back, $allowed_exttension)){
                                                        $_SESSION['alert'] = "Only Accepting Image extension file (BACK)";
                                                        $_SESSION['alert_code'] = "warning";
                                                        header("Location: user_info.php");
                                                    }else{
                                                        //Checking if the image front is already exists
                                                        if(file_exists("./img_front/" . $_FILES["uploadfile_front"]["name"])){
                                                        $image_front = $_FILES["uploadfile_front"]["name"];
                                                        $_SESSION['alert'] = "The Image is Already Exists";
                                                        $_SESSION['alert_code'] = "warning";
                                                        header("Location: user_info.php");
                                                        }else{
                                                            //Checking if the image back is already exists
                                                            if(file_exists("./img_back/" . $_FILES["uploadfile_back"]["name"])){
                                                                $image_back = $_FILES["uploadfile_back"]["name"];
                                                                $_SESSION['alert'] = "The Image is Already Exists";
                                                                $_SESSION['alert_code'] = "warning";
                                                                header("Location: user_info.php");
                                                            }else{
                                                                if($password = password_hash($password, PASSWORD_DEFAULT)){
                                                                    $sql = "INSERT INTO `tbl_residentsinfo`(`fullname`, `gender`, `contactnumber`, `email`, `birthdate`, `barangay`, `valid_img_front`, `valid_img_back`,`password`,`status`) VALUES ('$fullname', '$gender', '$cnumber', '$email' , '$bdate', '$barangay', '$image_front', '$image_back', '$password','approved')";
                                                                    $insert_result = $con->query($sql) or die ($con->error);
                                                                    if($insert_result > 0){
                                                                        move_uploaded_file($_FILES["uploadfile_front"]["tmp_name"],"./img_front/" . $_FILES["uploadfile_front"]["name"]);
                                                                        move_uploaded_file($_FILES["uploadfile_back"]["tmp_name"],"./img_back/" . $_FILES["uploadfile_back"]["name"]);
                                                                        $_SESSION['alert'] = "Your Credentials are in Pending for Approval!";
                                                                        $_SESSION['alert_code'] = "info";
                                                                        header("Location: login.php");
                                                                        exit(0);
                                                                        } 
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                        }else{
                                          $_SESSION['alert'] = "Password and Confirm Password not matched";
                                          $_SESSION['alert_code'] = "error";
                                          header("Location: user_info.php");
                                          exit(0);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
// Backend for the Update btn in user_info page
if(isset($_POST['update_residents_info_btn'])){
    $user_id = $_POST ['user_id'];
    $fullname = $_POST ['fullname'];
    $gender = $_POST ['gender'];
    $cnumber = $_POST ['contactnumber'];
    $email = $_POST ['email'];
    $birthdate = $_POST ['birthdate'];
    $barangay = $_POST ['barangay'];
    $password = $_POST ['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE tbl_residentsinfo SET fullname = '$fullname', gender = '$gender', contactnumber = '$cnumber', email = '$email', birthdate = '$birthdate', barangay = '$barangay', password = '$hashed_password' WHERE user_id = '$user_id'";
    $con->query($sql) or die ($con->error);
    $_SESSION['alert'] = "Update Success!";
    $_SESSION['alert_code'] = "success";
    header ("Location: user_info.php");
}
// Backend for the Delete btn in user_info Page
if(isset($_POST['delete_btn_set'])){

    $user_id = $_POST['delete_id'];
    
    $res_img_front = $_POST['del_img_front'];
    $res_img_back = $_POST['del_img_back'];

    
    $sql = "DELETE FROM tbl_residentsinfo WHERE user_id = '$user_id'";
    $sql_run = $con->query($sql) or die ($con->error);
        unlink("img_front/". $res_img_front);
        unlink("img_back/". $res_img_back);
  }
?>
<?php
// Backend for the Delete btn in feedback_info Page
if(isset($_POST['feedback_delete_btn_set'])){

    $id = $_POST['delete_id'];

    $sql = "DELETE FROM feedback_info WHERE id = '$id'";
    $con->query($sql) or die ($con->error);
  }
// Backend for the Delete btn in feedback_reply Page
if(isset($_POST['feedback_reply_delete_btn_set'])){

    $id = $_POST['delete_id'];

    $sql = "DELETE FROM feedback_reply WHERE id = '$id'";
    $con->query($sql) or die ($con->error);
  }
?>
<?php
// Backend for homepageuser update_btn
if(isset($_POST['update_info_btn'])){

    $contactnumber = $_SESSION['contactnumber'];
    
    $sql = "SELECT * FROM tbl_residentsinfo WHERE contactnumber = '$contactnumber'";
    $user = $con->query($sql) or die ($con->error);
    $row = $user->fetch_assoc();
    $result = $user->num_rows;
  
    if($result > 0){
            $fullname = mysqli_real_escape_string($con, $_POST ['fullname']);
            $gender = mysqli_real_escape_string($con, $_POST ['gender']);
            $contactnumber = mysqli_real_escape_string($con, $_POST ['contactnumber']);
            $email = mysqli_real_escape_string($con, $_POST ['email']);
            $birthdate = mysqli_real_escape_string($con, $_POST ['birthdate']);
            $barangay = mysqli_real_escape_string($con, $_POST ['barangay']);
            $password = mysqli_real_escape_string($con, $_POST ['password']);
            
        $sql = "UPDATE tbl_residentsinfo SET fullname = '$fullname', gender = '$gender', contactnumber = '$contactnumber', email = '$email', birthdate = '$birthdate', barangay = '$barangay' WHERE contactnumber = '$contactnumber'";
        $con->query($sql) or die ($con->error);
        $_SESSION['alert'] = "Update Info Success!";
        $_SESSION['alert_code'] = "success";
        header("Location: index.php");
    }else{
        $_SESSION['alert'] = "Something Went Wrong!";
        $_SESSION['alert_code'] = "error";
        header("Location: index.php");
    }
  }
?>
<?php
// Backend for admn_chnge_psw page 
$mail = new PHPMailer;

  if(isset($_POST["verify_admin_otp"])){
          
          $email = $_POST["email"];
          
          $sql = "SELECT * FROM tbl_admin WHERE email = '$email'";
          $user = $con->query($sql) or die ($con->error);
          $row = $user->fetch_assoc();
          $result = $user->num_rows;
  
                  if($result > 0){
                      $otp = rand(100000,999999);
                      $_SESSION['otp'] = $otp;
                      $_SESSION['mail'] = $email;
  
                      //Server settings
                      $mail->isSMTP();                                                   //Send using SMTP
                      $mail->Host       = 'smtp.gmail.com';                              //Set the SMTP server to send through
                      $mail->SMTPAuth   = true;                                          //Enable SMTP authentication
                      $mail->Username   = 'taysanmunicipality@gmail.com';                     //SMTP username
                      $mail->Password   = 'wunaovhedbdjxqev';                            //SMTP password
                      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                   //Enable implicit TLS encryption
                      $mail->Port       = 465;                                           //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
                      //Recipients
                      $mail->setFrom('taysanmunicipality@gmail.com', 'OTP Verification');
                      $mail->addAddress($_POST["email"]);                                //Add a recipient
  
                      //Content
                      $mail->isHTML(true);
                      // Add the local image as an embedded image
                        $image_path = './images/logo2.png';
                        $image_name = 'logo2.png';
                        $mail->addEmbeddedImage($image_path, 'logo2', $image_name);

                      $mail->Subject="Your Verify Code [$otp]";
                      $mail->Body="
                                <img src='cid:logo2' alt='Municipality of Taysan'>
                                <p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
                                <br><br>
                                <p>With regrads,</p>
                                <b>Municipality of Taysan</b>
                                <br/>
                                <center>
                                    <p>Taysan, Batangas 4228 PH</p>
                                    <p>Contact Us: taysanmunicipality@gmail.com</p>
                                    <p>+ 63 946 372 5161</p>
                                </center>";
      
                              if(!$mail->send()){
                                  $_SESSION['alert'] = "Invalid Email";
                                  $_SESSION['alert_code'] = "error";
                                  header("Location: admn_chnge_psw.php");
                                  
                              }else{
                                  $_SESSION['alert'] = "Register Successfully, OTP sent to " . $email;
                                  $_SESSION['alert_code'] = "success";
                                  header("Location: admn_vrfy_psw.php");
                              }
                  }else{
                    $_SESSION['alert'] = "Unregistered Email Address";
                    $_SESSION['alert_code'] = "error";
                    header("Location: psw_recover.php");
                    exit;   
                    } 
}
?>
<?php
// backend for admn_vrfy_psw page
if(isset($_POST["admn_vrfy_code"])){
    $otp = $_SESSION['otp'];
    $email = $_SESSION['mail'];
    $otp_code = $_POST['otp_code'];

    if($otp != $otp_code){

        $_SESSION['alert'] = "Invalid OTP code";
        $_SESSION['alert_code'] = "error";
        header("Location: admn_vrfy_psw.php");

    }else{

        mysqli_query($con ,"UPDATE tbl_admin SET email = '$email' WHERE email = '$email'");

        $_SESSION['alert'] = "Verify Account done, you may now reset your password.";
        $_SESSION['alert_code'] = "success";
        header("Location: admn_rst_psw.php");       
    }
}
?>
<?php
// backend for admn_rst_psw page
if(isset($_POST["admn_rst_btn"])){
    if ($_POST["password"] == $_POST["con_password"]) {
        $otp = $_SESSION['otp'];
        $email = $_SESSION['mail'];
        $password = $_POST['con_password'];

        mysqli_query($con ,"UPDATE tbl_admin SET email = '$email' WHERE email = '$email'");
          
        if($email){
            $sql = mysqli_query($con, "SELECT * FROM tbl_admin WHERE email='$email' AND password = '$password'");
            $query = mysqli_num_rows($sql);
  	        $fetch = mysqli_fetch_assoc($sql);

              $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            mysqli_query($con, "UPDATE tbl_admin SET password='$hashed_password' WHERE email='$email'");
            
            $_SESSION['alert'] = "Your password has been successfully reset";
            $_SESSION['alert_code'] = "success";
            header("Location: homepageadmin.php");
        }else{
            $_SESSION['alert'] = "Please try again";
            $_SESSION['alert_code'] = "error";
            header("Location: admn_rst_psw.php");
        }

     }
     else {
            $_SESSION['alert'] = "New Password and Confirm Password not matched.";
            $_SESSION['alert_code'] = "error";
            header("Location: admn_rst_psw.php");
     }
}
?>
<?php
// Feedback Section on Footer
$mail = new PHPMailer;

if(isset($_POST['feedback_submit_btn'])){
    $name = $_POST['name'];
    $barangay = $_POST['barangay'];
    $mailTo = $_POST['email'];
    $feedback = $_POST['feedback'];
  
  
    $mail->isSMTP();                                                   //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                              //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                          //Enable SMTP authentication
    $mail->Username   = 'taysanmunicipality@gmail.com';                     //SMTP username
    $mail->Password   = 'wunaovhedbdjxqev';                            //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                   //Enable implicit TLS encryption
    $mail->Port       = 465;                                           //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS
  
    //Recipients
    $mail->setFrom('taysanmunicipality@gmail.com','Feedback');
    $mail->addAddress(($_POST['email']));  
  
    $mail->isHTML(true);

    // Add the local image as an embedded image
    $image_path = './images/logo2.png';
    $image_name = 'logo2.png';
    $mail->addEmbeddedImage($image_path, 'logo2', $image_name);

    $mail->Subject="Feedback Form";
    $mail->Body="<html>
                    <head>
                    </head>
                    <body>
                        <img src='cid:logo2' alt='Municipality of Taysan'>
                        <p>Dear <b>$name</b></p>
                        <p>Thank you for your feedback, We will get in touch with you immediately.</p>
                        <br/><br/>
                        <p>Best Regards,</p>
                        <p><b>Municipality of Taysan</b></p>
                        <br/>
                        <center>
                            <p>Taysan, Batangas 4228 PH</p>
                            <p>Contact Us: taysanmunicipality@gmail.com</p>
                            <p>+ 63 946 372 5161</p>
                        </center>
                    </body>
                </html>";
    if(!$mail->send()){
        $_SESSION['alert'] = "Invalid Email";
        $_SESSION['alert_code'] = "error";
        header("Location: index.php");
        
    }else{
        $sql = "INSERT INTO `feedback_info` (`name`, `barangay`, `email`, `feedback`) VALUES ('$name', '$barangay', '$mailTo', '$feedback')";
        $con->query($sql) or die ($con->error);
  
        $_SESSION['alert'] = "Sent Successfully";
        $_SESSION['alert_code'] = "success";
        header("Location: index.php");
    }
  }
  // Send Response on the Feedback_section page
  $mail = new PHPMailer;
  if(isset($_POST['send_response'])){
      $email = $_POST['email'];
      $response = $_POST['response'];
  
      $mail->isSMTP();                                                   //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                              //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                          //Enable SMTP authentication
      $mail->Username   = 'taysanmunicipality@gmail.com';                     //SMTP username
      $mail->Password   = 'wunaovhedbdjxqev';                            //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                   //Enable implicit TLS encryption
      $mail->Port       = 465;                                           //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS
   
      //Recipients
      $mail->setFrom('taysanmunicipality@gmail.com','Feedback');
      $mail->addAddress(($_POST['email']));  
    
      $mail->isHTML(true);

      // Add the local image as an embedded image
        $image_path = './images/logo2.png';
        $image_name = 'logo2.png';
        $mail->addEmbeddedImage($image_path, 'logo2', $image_name);

      $mail->Subject="Feedback Form(No Reply)";
      $mail->Body="<html>
                    <head>
                    </head>
                    <body>
                        <img src='cid:logo2' alt='Municipality of Taysan'>
                        <p>Dear <b>$email</b></p>
                        <p>We Recieved your feedback. Thank you for informing us.</p>
                        <p>Regarding to your inquiry,</p>
                        <p>$response</p>
                        <br />
                        <p>(no reply)</p>
                        <br/><br/>
                        <p>Best Regards,</p>
                        <p><b>Municipality of Taysan</b></p>
                        <br/>
                        <center>
                            <p>Taysan, Batangas 4228 PH</p>
                            <p>Contact Us: taysanmunicipality@gmail.com</p>
                            <p>+ 63 946 372 5161</p>
                        </center>
                    </body>
                    </html>";
      if(!$mail->send()){
          $_SESSION['alert'] = "Invalid Email";
          $_SESSION['alert_code'] = "error";
          header("Location: feedback_section.php");
      }else{
  
          $sql = "INSERT INTO `feedback_reply` (`email`, `response`) VALUES ('$email', '$response')";
          $con->query($sql) or die ($con->error);
  
          $_SESSION['alert'] = "Sent Successfully";
          $_SESSION['alert_code'] = "success";
          header("Location: feedback_section.php");
      }
    }
?>
<?php
// Backend for send_sms page
if(isset($_POST['send_announce'])){
    
    $num = $_POST['number'];
    $body = $_POST['textmsg'];

    // function for sending text message
    $curl = curl_init();
    $data = array(
      'api_key' => "2HLh42DxYWkeqsUXiO6FXEzQ0VH",
      'api_secret' => "9TZ1CZxoRK3HLPVDW79PaHmIgjw3AzpjIKtBJhQW",
      'text' => ($_POST['textmsg']),
      'to' => $num,
      'from' => "Taysan Municipal Hall"
    );
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.movider.co/v1/sms",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => http_build_query($data),
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/x-www-form-urlencoded",
        "cache-control: no-cache"
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    
    if ($err) {
        $_SESSION['alert'] = "Unfortunately, The Announcements are not sent.";
        $_SESSION['alert_code'] = "warning";
        header("Location: send_sms.php");
    } else {
        $sql = "INSERT INTO `tbl_history_announce` (`announcements`) VALUES ('$body')";
        $con->query($sql) or die ($con->error);
        $_SESSION['alert'] = "The Announcement is Successfully Sent";
        $_SESSION['alert_code'] = "success";
        header("Location: send_sms.php");
    }
}
?>