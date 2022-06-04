<?php
require_once '../../controllers/AuthController.php';
require_once '../../models/vars.php';
$vars = new vars;
$auth = new AuthController();

if(!isset($_SESSION['user_id'])){
    session_start();
}
if(!$auth->isAuthenticated($vars->user)){
    header('Location: ../../index.php');
}

require_once '../../controllers/PostController.php';
require_once '../../models/post.php';
$PostController=new PostController;

$errMsg = "";
if(!isset($_SESSION['user_id'])){
    session_start();
}
$posts = $PostController->getAllPosts();

if(isset($_POST['delete']))
{
    if(!empty($_POST['post_id']))
    {
        if($PostController->DeletePost($_POST['post_id']))
        {
            $dltMsg = true;
            $posts = $PostController->getAllPosts();
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
    <title>Feed</title>
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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
<!--            <div class="card">-->
<!--                <div class="card-body">-->
<!--                    <form action="#" class="form-profile">-->
<!--                        <div class="form-group">-->
<!--                            <textarea class="form-control" name="addPost" id="textarea" cols="30" rows="2" placeholder="Post a new message"></textarea>-->
<!--                        </div>-->
<!--                        <div class="d-flex align-items-center">-->
<!--                            <ul class="mb-0 form-profile__icons">-->
<!--                                <li class="d-inline-block">-->
<!--                                    <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-user"></i></button>-->
<!--                                </li>-->
<!--                                <li class="d-inline-block">-->
<!--                                    <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-paper-plane"></i></button>-->
<!--                                </li>-->
<!--                                <li class="d-inline-block">-->
<!--                                    <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-camera"></i></button>-->
<!--                                </li>-->
<!--                                <li class="d-inline-block">-->
<!--                                    <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-smile"></i></button>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                            <button class="btn btn-primary px-3 ml-4">Send</button>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
            <?php
            if (count($posts) == 0)
            {
                ?>
                <div class="alert alert-danger alert-dismissible fade show">There is no Posts yet</div>
                <?php
            }
            else
            {
            ?>
                <div class="card">
                    <div class="card-body">
                    <?php
                        foreach ($posts as $post) {
                        ?>

                            <div class="media media-reply">
                                <img class="mr-3 circle-rounded" src="../../assets/images/member/user.png" width="50" height="50" alt="Generic placeholder image">
                                <div class="media-body">
                                    <div class="d-sm-flex justify-content-between mb-2">
                                        <h5 class="mb-sm-0"><?php echo $post["username"] ?><small class="text-muted ml-3"><?php echo $post["topic_name"] ?></small><small class="text-muted ml-3"><?php echo $PostController->postRank($post["post_id"]); ?></small></h5>
<!--                                        <h5 class="mb-sm-0"><small class="text-muted ml-3">--><?php //echo $PostController->postRank($post["post_id"]); ?><!--</small></h5>-->
                                        <div class="media-reply-link">
                                            <form method="POST" action="index.php">
                                                <span>
                                                    <input type="hidden" name="post_id" value="<?php echo $post["post_id"]; ?>">
<!--                                                    <button type="button" class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-up"></i></button>-->
<!--                                                    <button class="btn btn-transparent p-0 mr-3" type="submit" name="delete"><i class="ti-trash"></i></button>-->
                                                    <button type="button" class="btn btn-transparent p-0 ml-3 font-weight-bold" onclick="window.location.href='add-comment.php?id=<?php echo $post["post_id"]; ?>'">Comment</button>
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