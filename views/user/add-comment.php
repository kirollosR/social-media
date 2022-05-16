<?php
//extends Com_Controller & Comment files
require_once '../../controllers/commentController.php';

$Comment_Controller=new commentController();

if(!isset($_SESSION['user_id'])){
    session_start();
}

$errorMsg = "";

 if( isset($_POST['comment_data']) ){
    if(!empty($_POST['comment_data']) ){
        $comment=new comment;
        $comment->user_id=$_SESSION['user_id'];
        $comment->topic_id=2;
        $comment->post_id=1;
        $comment->comment_score=6;
        $comment->comment_data=$_POST['comment_data'];

        if($Comment_Controller->addComment($comment)){
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
 
 $comments = $Comment_Controller->getComments();

 if( isset($_POST['deleteComment'])){
    if(!empty($_POST['comment_id'])){
        if($Comment_Controller->deleteComment($_POST['comment_id'])){
            $comments = $Comment_Controller->getComments();
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
                                <img class="mr-3 circle-rounded" src="../../assets/images/avatar/2.jpg" width="50" height="50" alt="Generic placeholder image">
                                <div class="media-body">
                                    <div class="d-sm-flex justify-content-between mb-2">
                                        <h5 class="mb-sm-0">Milan Gbah <small class="text-muted ml-3">about 3 days ago</small></h5>
                                        <div class="media-reply__link">
                                            
                                                <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-up"></i></button>
                                            <button class="btn btn-transparent text-dark font-weight-bold p-0 ml-2">Comment</button>
                                        </div>
                                    </div>

                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    <?php 
                                            foreach($comments as $comment){
                                                ?>
                                            <div class="media mt-3">
                                                <img class="mr-3 circle-rounded circle-rounded" src="../../assets/images/avatar/4.jpg" width="50" height="50" alt="Generic placeholder image">
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
                                        <form action="#" class="form-profile" method="POST">
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