<?php
require_once '../../controllers/AuthController.php';
require_once '../../models/vars.php';
$vars = new vars;
$auth = new AuthController();

if(!isset($_SESSION["user_id"]))
{
    session_start();
}

if(!$auth->isAuthenticated($vars->user)){
    header('Location: ../auth/page-login.php');
}

require_once '../../models/user.php';
require_once '../../controllers/PostController.php';

$user = new user;

$user->user_id = $_SESSION["user_id"];
$user->username = $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname'];
$user->user_email = $_SESSION['user_email'];
$user->user_profile = $_SESSION['user_profile'];
$user->user_status = $_SESSION['user_status'];

$postController = new PostController;
$posts = $postController->getAllPostsByUserId($user);


if(isset($_POST['delete']))
{
    if(!empty($_POST['post_id']))
    {
        if($postController->DeletePost($_POST['post_id']))
        {
            $dltMsg = true;
            $posts = $postController->getAllPostsByUserId($user);
        }
    }
}

require_once '../../controllers/UserController.php';
$userController = new UserController;

$errorMsg = "";

if(isset($_POST["status"])){
    if(!empty($_POST["status"])){
        $user->user_status = $_POST["status"];

        if($userController->updateStatus($user))
        {
            $_SESSION["user_status"] = $_POST["status"];
            header("location: profile.php");
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

if(isset($_FILES["image"])){
    //IMAGE
    $location = "../../assets/images/member/" . date("h-i-s") . $_FILES["image"]["name"]; //image path

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $location)) {
        $user->user_profile = $location;
        $_SESSION["user_profile"] = $location;

        if ($userController->updateProfilePicture($user)) {
            header("Location: profile.php");
        } else {
            $errorMsg = "Something went wrong.. Please try again";
        }
    } else {
        $errorMsg = "Error in upload";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Profile</title>
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

        <!-- row -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media align-items-center mb-4">
                                <button type="button" class="btn btn-transparent p-0 mr-3" data-toggle="modal" data-target="#updateProfile"><i class="fa fa-upload"></i></button>
                                <img class="mr-3" src="<?php
                                    if($_SESSION['user_profile'] == NULL){
                                        echo "../../assets/images/member/user.png";
                                    }else{
                                        echo $user->user_profile;
                                    }
                                    ?>"
                                     width="80" height="80" alt="" style="border-radius: 50%">
                                <div class="media-body">
                                    <h3 class="mb-0"><?php echo $user->username; ?></h3>
                                </div>

                            </div>

                            <div class="row mb-5">
                                <div class="col">
                                </div>
                                <div class="col">
                                </div>
<!--                                <div class="col-12 text-center">-->
<!--                                    <button type="button" class="btn mb-1 btn-outline-danger px-5" onclick="window.location.href='updateProfile.php'">Update Profile</button>-->
<!--                                </div>-->
                                <div class="bootstrap-modal">
                                    <!-- Button trigger modal -->
<!--                                    <div class="col-12 text-center">-->
<!--                                        <button type="button" class="btn mb-1 btn-outline-danger px-5" data-toggle="modal" data-target="#exampleModalCenter">Update Profile</button>-->
<!--                                    </div>-->
                                    <!-- Modal -->
                                    <div class="modal fade" id="updateProfile" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Change Profile Picture</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="profile.php" method="POST" enctype='multipart/form-data'>
                                                        <div class="media align-items-center mb-4">
                                                            <img class="mr-3" src="
                                                                 <?php
                                                                    if($_SESSION['user_profile'] == NULL){
                                                                        echo "../../assets/images/member/user.png";
                                                                    }else{
                                                                        echo $user->user_profile;
                                                                    }
                                                                 ?>"
                                                                 width="80" height="80" alt="" style="border-radius: 50%">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend"></div>
                                                                <div class="custom-file">
                                                                    <input class="form-control" type="file" id="formFile" name="image" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn btn-danger px-5" onclick="window.location.href='updateData.php'">Update Data</button>
                                </div>
                            </div>

                            <h4>Status <button type="button" class="btn btn-transparent p-0 mr-3" data-toggle="modal" data-target="#statusModal"><i class="fa fa-edit"></i></button></h4>
                            <div class="bootstrap-modal">
                                <!-- Modal -->
                                <div class="modal fade" id="statusModal" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Change Status</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="profile.php" method="POST">
                                                    <div class="media align-items-center mb-4">
                                                        <textarea class="text-muted form-control" name="status" id="textarea" cols="30" rows="2"><?php echo $user->user_status; ?></textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted"><?php echo $user->user_status; ?></p>
                            <ul class="card-profile__info">
                                <li><strong class="text-dark mr-4">Email</strong> <span><?php echo $user->user_email; ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>

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
                <?php
                if (count($posts) == 0)
                {
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show">No posts found.</div>
                    <?php
                }
                else
                {
                ?>
                    <div class="col-lg-8 col-xl-9">
                        <div class="card">
                            <div class="card-body">
                        <?php
                        foreach ($posts as $post) {
                        ?>
                                    <div class="media media-reply">
                                        <img class="mr-3" src="
                                        <?php
                                        if($_SESSION['user_profile'] == NULL){
                                            echo "../../assets/images/member/user.png";
                                        }else{
                                            echo $user->user_profile;
                                        }
                                        ?>"
                                             width="50" height="50" alt="" style="border-radius: 50%">
                                        <div class="media-body">
                                            <div class="d-sm-flex justify-content-between mb-2">
                                                <h5 class="mb-sm-0"><?php echo $post["username"] ?><small class="text-muted ml-3"><?php echo $post["topic_name"] ?></small></h5>
                                                <div class="media-reply__link">
                                                    <form method="POST" action="profile.php">
                                                            <span>
                                                                <input type="hidden" name="post_id" value="<?php echo $post["post_id"] ?>">
                                                                <button type="button" class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-up"></i></button>
                                                                <button class="btn btn-transparent p-0 mr-3" type="submit" name="delete"><i class="ti-trash"></i></button>
                                                                <button type="button" class="btn btn-transparent p-0 ml-3 font-weight-bold" onclick="window.location.href='add-comment.php?id=<?php echo $post["post_id"] ?>'">Comment</button>
                                                            </span>
                                                    </form>
                                                </div>
                                            </div>

                                            <p><?php echo $post["post_data"] ?></p>
                                        </div>
                                    </div>
                        <?php
                        }
                    }
                        ?>
                    </div>
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