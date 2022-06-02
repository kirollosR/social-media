<?php
require_once '../../controllers/AuthController.php';
require_once '../../models/vars.php';
$vars = new vars;
$auth = new AuthController();

if(!isset($_SESSION["user_id"]))
{
    session_start();
}

    //if(!$auth->isAuthenticated($vars->user)){
    //    header('Location: ../auth/page-login.php');
    //}

require_once '../../models/user.php';
require_once '../../controllers/UserController.php';
@require_once '../../controllers/AuthController.php';

$auth = new AuthController;

$userController = new userController();

$errorMsg = "";
$user = new user;


$user->user_id = $_SESSION["user_id"];
$user->username = $_SESSION['username'];
$user->user_firstname = $_SESSION['user_firstname'];
$user->user_lastname = $_SESSION['user_lastname'];
$user->user_email = $_SESSION['user_email'];
//$user->user_status = $_SESSION['user_status'];

if(isset($_POST['user_firstname']) && isset($_POST['user_lastname']) && isset($_POST['user_email']) && isset($_POST['username']) && isset($_POST['password'])){
    if(!empty($_POST['user_firstname']) && !empty($_POST['user_lastname']) && !empty($_POST['user_email']) && !empty($_POST['username']) && !empty($_POST['password'])) {

        $errorMsg = $userController->checkEmail($_POST['user_email'],$_SESSION["user_id"]);
        if($errorMsg == "") {
            $errorMsg = $userController->checkUsername($_POST['username'],$_SESSION["user_id"]);
            if($errorMsg == "") {
                $errorMsg = $auth->checkPassword($_POST['password']);
            }
        }
        if ($errorMsg != "") {

        } else {
            $user->username = $_POST['username'];
            $user->user_firstname = $_POST['user_firstname'];
            $user->user_lastname = $_POST['user_lastname'];
            $user->user_email = $_POST['user_email'];
            $user->password = $_POST['password'];
//            $user->user_status = $_POST['user_status'];

            if ($userController->updateData($user)) {
                header("location: updateData.php");
            } else {
                $errMsg = "Something Went Wrong... Try Again";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Update profile data</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/logo-color.png">
    <!-- Custom Stylesheet -->
    <link href="../../assets/css/style.css" rel="stylesheet">

</head>

<body>

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


<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <?php @include_once '../components/navbar.php' ?>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <?php @include_once '../components/user-sidebar.php';?>
    <!--**********************************
        Sidebar end
    ***********************************-->

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Profile</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Update data</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update profile data</h4>
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
                        <div class="basic-form">
                            <form method="post" action="profile.php">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>First Name</label>
                                        <input type="text" id="user_firstname" name="user_firstname" class="form-control" value="<?php echo $_SESSION['user_firstname']; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Last Name</label>
                                        <input type="text" id="user_lastname" name="user_lastname" class="form-control" value="<?php echo $_SESSION['user_lastname']; ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Email</label>
                                        <input type="email" id="user_email" name="user_email" class="form-control" value="<?php echo $_SESSION['user_email']; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Password</label>
                                        <input type="password" id="password" name="password" class="form-control" value="<?php echo $_SESSION['password']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" id="username" name="username" class="form-control" value="<?php echo $_SESSION['username']; ?>">
                                </div>
<!--                                <div class="form-group">-->
<!--                                    <label>Status</label>-->
<!--                                    <input type="text" id="user_status" name="user_status" class="form-control" value="--><?php //echo $_SESSION['user_status']; ?><!--">-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>State</label>-->
<!--                                    <select id="inputState" class="form-control">-->
<!--                                        <option selected="selected">Choose...</option>-->
<!--                                        <option>Option 1</option>-->
<!--                                        <option>Option 2</option>-->
<!--                                        <option>Option 3</option>-->
<!--                                    </select>-->
<!--                                </div>-->
                                <button type="submit" class="btn mb-1 btn-primary">Update</button>
                                <button type="button" class="btn mb-1 btn-secondary" onclick="window.location.href='profile.php'">Back</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->
    </div>
    <!--**********************************
        Content body end
    ***********************************-->


    <!--**********************************
        Footer start
    ***********************************-->
    <?php @include_once '../components/footer.php' ?>
    <!--**********************************
        Footer end
    ***********************************-->
</div>
<!--**********************************
    Main wrapper end
***********************************-->

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