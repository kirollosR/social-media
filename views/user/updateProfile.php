<?php
if(!isset($_SESSION["user_id"]))
{
    session_start();
}

require_once '../../models/user.php';
require_once '../../controllers/UserController.php';

$errMsg = "";
$user = new user;

$user->user_id = $_SESSION["user_id"];
$user->username = $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname'];
$user->user_email = $_SESSION['user_email'];
$user->user_profile = $_SESSION['user_profile'];
$user->user_status = $_SESSION['user_status'];


if(isset($_POST['status']))
{
    if(!empty($_POST['status']))
    { 
        $userController = new UserController;
        $user->user_status = $_POST['status'];

        if($userController->updateStatus($user))
        {
            header("location: updateProfile.php");
        }
        else
        {
            $errMsg="Something Went Wrong... Try Again";
        }
    }
    else 
    {
        $errMsg = "Please fill all fields";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Edit profile picture & status</title>
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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit profile picture & status</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
            <div class="col-lg-10 ">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit profile picture & status</h4>
                        <form action="updateProfile.php" method="POST">
                            
                                <?php
                                    if($errMsg != ""){
                                ?>
                                    <br>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <?php echo $errMsg; ?>
                                    </div>
                                <?php
                                    }
                                ?>
                        
                            <input type="hidden" name="productId" value="<?php //echo $product["id"]; ?>">
                            <div class="media align-items-center mb-4">
                                <img class="mr-3" src="../../assets/images/avatar/11.png" width="80" height="80" alt="">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend"></div>
                                        <div class="custom-file">
                                            <input class="form-control" type="file" id="formFile" name="image" />
                                        </div>
<!--                                        <button type="button" class="btn mb-1 btn-danger"><span class="ti-trash"></span></button>-->
                                    </div>
                            </div>
                            <div class="mb-6">
                                <h4>Status</h4>
                                <textarea class="text-muted form-control" name="status" id="textarea" cols="30" rows="2"><?php echo $user->user_status; ?></textarea>
                                <br>
                                <ul class="card-profile__info">
                                    <li><strong class="text-dark mr-4">Email</strong> <span><?php echo $user->user_email?></span></li>
                                </ul>
                            </div>
                                <button type="submit" class="btn mb-1 btn-primary">Update</button>
                                <button type="button" class="btn mb-1 btn-secondary" onclick="window.location.href='profile.php'">Back</button>
                            </form>

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