<?php 
require_once '../../controllers/SystemController.php';
require_once '../../controllers/DBController.php';
$systemController=new SystemController;
$_usersNum=$systemController->getNumberOfUsers();
$_postsNum=$systemController->getNumberOfPosts();
$_number_of_good_posts=$systemController->getNumberOfGoodPosts();
$_number_of_bad_posts=$systemController->getNumberOfBadPosts();

require_once '../../controllers/AuthController.php';
require_once '../../models/vars.php';
$vars = new vars;
$auth = new AuthController();

if(!isset($_SESSION['user_id'])){
    session_start();
}

if(!$auth->isAuthenticated($vars->admin)){
    header('Location: ../auth/page-login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard</title>
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
    <?php @include_once '../components/admin-sidebar.php';?>
    <!--**********************************
        Sidebar end
    ***********************************-->

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">

        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="card gradient-1">
                        <div class="card-body">
                            <h3 class="card-title text-white">Number of Users</h3>
                            <div class="d-inline-block">
                             <!--********   php code ***************-->
                             <h2 class="text-white" > 
                                  <?php    echo    $_usersNum[0]["count"];    ?>  
                                   </h2>

                                <p class="text-white mb-0">Users</p> 
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card gradient-2">
                        <div class="card-body">
                            <h3 class="card-title text-white">Number of Posts</h3>
                            <div class="d-inline-block">
                               

                               <h2 class="text-white" >     <?php  
                                echo  $_postsNum[0]["NumberOfPosts"];?>  </h2>
                                   


                                <p class="text-white mb-0">Posts</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-newspaper-o"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card gradient-3">
                        <div class="card-body">
                            <h3 class="card-title text-white">Number of Good Posts</h3>
                            <div class="d-inline-block">
                            <h2 class="text-white" >     <?php  
                                echo  $_number_of_good_posts[0]["NumberOfGoodPosts"];?>  </h2>

                                <p class="text-white mb-0">Posts</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-thumbs-up"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card gradient-4">
                        <div class="card-body">
                            <h3 class="card-title text-white">Number of Bad Posts</h3>
                            <div class="d-inline-block">
                            <h2 class="text-white" >     <?php  
                                echo  $_number_of_bad_posts[0]["NumberOfBadPosts"];?>  </h2>
                                <p class="text-white mb-0">Posts</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-thumbs-down"></i></span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
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