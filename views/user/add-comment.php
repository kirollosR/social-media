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
//extends Com_Controller & Comment files
require_once '../../controllers/CommentController.php';
$Comment_Controller=new commentController();

require_once '../../controllers/UserController.php';
$userController = new UserController;

require_once '../../models/comment.php';
$Comment = new Comment;

require_once '../../controllers/PostController.php';
$postController = new PostController;


if(isset($_GET['id'])){
    if(!empty($_GET['id'])){
        $posts = $postController->getPost($_GET['id']);
    }else
    {
        header("location: index.php");
    }
}else
{
    header("location: index.php");
}


$errorMsg = "";

 if(isset($_POST['comment_data']) ){
    if(!empty($_POST['comment_data']) ){
        $topic_id = $postController->getTopicId($_GET['id']);
        $comment=new comment;
        $comment->user_id=$_SESSION['user_id'];
        $comment->topic_id=$topic_id[0]['topic_id'];
        $comment->post_id=$_GET['id'];
        $comment->comment_score= $Comment_Controller->commentsRank($_POST['comment_data']);

        $comment->comment_data=$_POST['comment_data'];

        if($Comment_Controller->addComment($comment)){
            $postController->postScore($_GET['id']);
            header("location: add-comment.php");
        }
        else{
            $errorMsg = "Something went wrong.. Please try again";
        }  
    }
    else{
        $errorMsg = "Something went wrong.. Please try again";
        return false;
    }
 }
 
 $comments = $Comment_Controller->getComments($_GET['id']);

 if( isset($_POST['deleteComment'])){
    if(!empty($_POST['comment_id'])){
        if($Comment_Controller->deleteComment($_POST['comment_id'])){
            $postController->postScore($_GET['id']);
            $comments = $Comment_Controller->getComments($_GET['id']);
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
    <title>Comments</title>
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
                
                <div class="col-lg-8 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="media media-reply">
                                <?php
                                foreach ($posts as $post) {
                                ?>
                                <img class="mr-3 circle-rounded" src="../../assets/images/member/user.png"" width="50" height="50" alt="Generic placeholder image">
                                <div class="media-body">
                                    <div class="d-sm-flex justify-content-between mb-2">
                                        <h5 class="mb-sm-0"><?php echo $post['username']; ?><small class="text-muted ml-3"><?php echo $post['topic_name']; ?></small></h5>
                                        <div class="media-reply__link">
                                            <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-up"></i></button>
                                            <button class="btn btn-transparent text-dark font-weight-bold p-0 ml-2">Comment</button>
                                        </div>
                                    </div>
                                    <p style="font-size: medium;"><?php echo $post['post_data']; ?></p>
                                    <?php
                                    }
                                    ?>
                                    <?php 
                                            foreach($comments as $comment){
                                                ?>
                                            <div class="media mt-3">
                                                <img class="mr-3 circle-rounded circle-rounded" src="../../assets/images/member/user.png" width="50" height="50" alt="Generic placeholder image">
                                                <div class="media-body">
                                                        <div class="d-sm-flex justify-content-between mb-2">
                                                            <h5 class="mb-sm-0">
                                                            <?php
                                                                $username = $Comment_Controller->getUsername($comment['user_id']);
                                                                echo $username;
                                                            ?>
                                                            <small class="text-muted ml-3"><?php echo $comment['comment_date']?></small></h5>
                                                        </div>
                                                        <p><?php echo $comment['comment_data']?></p>
                                                </div>
                                                <div class="media-reply__link">
                                                    <form method="post" action="add-comment.php">
                                                        <input type="hidden" name="comment_id" value="<?php echo $comment["comment_id"]; ?>">
                                                        <button class="btn btn-transparent p-0 mr-3" type="submit" name="deleteComment"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                                <?php
                                            }
                                            
                                            ?>
                                    <div class="card">
                                    <div class="card-body">
                                        <form action="" class="form-profile" method="POST">
                                            <div class="form-group">
                                                <textarea class="form-control" name="comment_data" id="comment_data" cols="30" rows="2" placeholder="Write a comment..."></textarea>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <ul class="mb-0 form-profile__icons">
                                                    <li class="d-inline-block">
                                                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-user"></i></button>
                                                    </li>
                                                    <li class="d-inline-block">
                                                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-paper-plane"></i></button>
                                                    </li>
                                                    <li class="d-inline-block">
                                                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-camera"></i></button>
                                                    </li>
                                                    <li class="d-inline-block">
                                                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-smile"></i></button>
                                                    </li>
                                                </ul>
                                                <button class="btn btn-primary px-3 ml-4" type="submit">Send</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>

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