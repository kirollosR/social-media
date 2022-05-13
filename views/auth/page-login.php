<?php
require_once '../../models/user.php';
require_once '../../controllers/AuthController.php';
require_once '../../models/vars.php';

$errorMsg = "";

$vars = new vars;

//logout end session
if(isset($_GET['logout'])){
    session_start();
    session_destroy();
}

//if(!isset($_SESSION)){
//    session_start();
//}

if(isset($_POST['email']) && isset($_POST['password'])){
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $user = new user;
        $auth = new AuthController;

        $user->user_email = $_POST['email'];
        $user->password = $_POST['password'];

        if(!$auth->login($user)){

            $errorMsg = $_SESSION['errorMsg'];
        }else{
            if(!isset($_SESSION["user_id"])){
                session_start();
            }
            if($_SESSION["role_id"] == $vars->admin){
                header("Location: ../admin/index.php");
            }else{
                header('Location: ../user/index.php');
            }
        }
    }else{
        $errorMsg = "Please fill all fields";
    }
}
?>
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Log in</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/logo-color.png">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/logo-color.png">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="../../assets/css/style.css" rel="stylesheet">
    
</head>

<body class="h-100">
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    



    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <!--LOGO-->
                                <center><b class="logo-abbr"><img src="../../assets/images/logo-color.png" alt=""> </b></center>

                                <!--ERROR MESSAGE-->
                                <?php
                                    if($errorMsg != ""){
                                ?>
                                    <br>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <?php echo $errorMsg; ?>
                                    </div>
                                <?php
                                    }
                                ?>

                                <form id="formAuthentication" class="mt-5 mb-5 login-input" action="page-login.php" method="POST">
                                    <div class="form-group">
                                        <input type="email" id="email" class="form-control" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                    <button class="btn login-form__btn submit w-100" type="submit">Sign In</button>
                                </form>
                                <p class="mt-5 login-form__footer">Dont have account? <a href="page-register.php" class="text-primary">Register</a> now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../../plugins/common/common.min.js"></script>
    <script src="../../assets/js/custom.min.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/gleek.js"></script>
    <script src="../../assets/js/styleSwitcher.js"></script>
</body>
</html>





