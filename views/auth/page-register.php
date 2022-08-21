<?php
@require_once '../../models/user.php';
@require_once '../../controllers/AuthController.php';
@require_once '../../models/gender.php';
@require_once '../../models/vars.php';

$errorMsg = "";

$vars = new vars;

//GET GENDERS
$auth = new AuthController;
$genders = $auth->getGenders();

//if(!isset($_SESSION["user_id"]))
//{
//    session_start();
//}

if(isset($_POST['user_firstname']) && isset($_POST['user_lastname']) && isset($_POST['user_email']) && isset($_POST['username']) && isset($_POST['password'])){
    if(!empty($_POST['user_firstname']) && !empty($_POST['user_lastname']) && !empty($_POST['user_email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $errorMsg = $auth->checkEmail($_POST['user_email']);
        if($errorMsg == "") {
            $errorMsg = $auth->checkUsername($_POST['username']);
            if($errorMsg == "") {
                $errorMsg = $auth->checkPassword($_POST['password']);
            }
        }
//        $errorMsg = $auth->checkUsername($_POST['username']);
//        $errorMsg = $auth->checkPassword($_POST['password']);
        if ($errorMsg != "") {

        } else {
            $user = new user;

            $user->user_firstname = $_POST['user_firstname'];
            $user->user_lastname = $_POST['user_lastname'];
            $user->user_email = $_POST['user_email'];
            $user->username = $_POST['username'];
            $user->gender_id = $_POST['gender'];
            $user->password = $_POST['password'];

            if (!$auth->register($user)) {
                $errorMsg = $_SESSION['errorMsg'];
            } else {
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
    <title>Register</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/logo-color.png">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/logo-color.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
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
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <?php echo $errorMsg; ?>
                                    </div>
                                    <?php
                                }
                                ?>

                                <form id="formAuthentication" class="mt-5 mb-5 login-input" action="page-register.php" method="POST">
                                    <div class="form-group">
                                        <input type="text" id="user_firstname" name="user_firstname" class="form-control"  placeholder="First Name" >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="user_lastname" name="user_lastname" class="form-control"  placeholder="Last Name" >
                                    </div>
                                    <div class="form-group">
                                        <input type="email" id="user_email" name="user_email" class="form-control"  placeholder="Email" >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="username" name="username" class="form-control"  placeholder="username" >
                                    </div>
                                    <div class="form-group">
                                        <label>Gender: </label>
                                        <select class="form-control" id="sel1" name="gender">
                                            <?php
                                            foreach ($genders as $gender){
                                                ?>
                                                <option value="<?php echo $gender["gender_id"] ?>"><?php echo $gender["gender_name"] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" >
                                    </div>
                                    <button class="btn login-form__btn submit w-100">Register</button>
                                </form>
                                    <p class="mt-5 login-form__footer">Have account <a href="../../index.php" class="text-primary">Log in </a> now</p>
                                    </p>
                                </div>
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





