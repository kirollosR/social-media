<?php

// ADD TOPIC

require_once '../../models/topic.php';
require_once '../../controllers/TopicController.php';

$errMsg = "";
$topicController = new TopicController;

if(!isset($_SESSION['user_id'])){
    session_start();
}

$addMsg = false;

if(isset($_POST['topic']))
{
    if(!empty($_POST['topic']))
    { 
        $topic = new topic;

        $topic->topic_name = $_POST['topic'];
        $topic->user_id = $_SESSION['user_id'];

        if($topicController->addTopic($topic))
        {
            header("location: topic.php");
            $addMsg = true;
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

// LIST TOPICS FROM DB
$topics = $topicController->getAllTopics();

// DELETE TOPIC
$dltMsg = false;

if(isset($_POST['delete']))
{
    if(!empty($_POST['topic_id']))
    {
        if($topicController->deleteTopic($_POST['topic_id']))
        {
            $dltMsg = true;
            $topics = $topicController->getAllTopics();
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
    <title>Topics</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/logo-color.png">
    <!-- Custom Stylesheet -->
    <link href="../../assets/css/style.css" rel="stylesheet">
    <link href="../../plugins/toastr/css/toastr.min.css" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

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

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <!--                    <li class="breadcrumb-item"><a href="javascript:void(0)">Keyword</a></li>-->
                    <!--                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>-->
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
            <!--            <div class="col-lg-6">-->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add topic</h4>

                            <!-- TOASTER -->
<!--                            <button type="button" class="btn btn-success m-b-10 m-l-5" id="toastr-success-top-right">Success</button>-->

                            <div class="basic-form">
                                <form action="topic.php" method="POST">
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

                                    <?php
                                    if($addMsg){
                                        ?>
                                        <br>
                                        <div class="alert alert-success alert-dismissible fade show">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <?php echo "Topic added successfully."; ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                        <input type="topic" id="topic" class="form-control" name="topic" placeholder="Topic">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn mb-1 btn-primary">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Topics</h4>

                        <?php
                        if($dltMsg){
                            ?>
                            <br>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <?php echo "Topic deleted successfully."; ?>
                            </div>
                            <?php
                        }
                        ?>

                        <?php
                            if (count($topics) == 0)
                            {
                                ?>
                                <div class="alert alert-danger alert-dismissible fade show">There is no Topics yet</div>
                                <?php
                            }
                            else
                            {
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped verticle-middle">
                                    <thead>
                                    <tr>
                                        <th scope="col">Topic</th>
                                        <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                <?php
                                foreach ($topics as $topic)
                                {
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $topic["topic_name"] ?></td>
                                        <td>
                                            <form action="topic.php" method="post">
                                                <span>
                                                    <input type="hidden" name="topic_id" value="<?php echo $topic["topic_id"]?>">
                                                    <button type="submit" name="delete" class="btn mb-1 btn-rounded btn-outline-danger"><span class="ti-trash"></span></button>
                                                </span>
                                            </form>
                                        </td>
                                    </tr>

                                    <?php
                                }
                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php
                            }
                            ?>
                            
                </div>
            </div>
            </div>

            <?php
                if($dltMsg==true)
                {  ?>
                    <!-- toaster -->
            <?php  }
            ?>

        </div>
        <!--            </div>-->
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

<script src="../../plugins/toastr/js/toastr.min.js"></script>
<script src="../../plugins/toastr/js/toastr.init.js"></script>


</body>

</html>