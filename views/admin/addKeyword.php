<?php

if(!isset($_SESSION['user_id'])){
    session_start();
}

require_once '../../controllers/keywordController.php';
require_once '../../models/keyword.php';
$keywordController=new keywordController;
//$rates=$keywordController->getRates();
$errorMsg="";

require_once '../../controllers/AuthController.php';
require_once '../../models/vars.php';
$vars = new vars;
$auth = new AuthController();

if(!$auth->isAuthenticated($vars->admin)){
    header('Location: ../../index.php');
}


if(isset($_POST['word'])){
    if(!empty($_POST['word']))
    {
        $keyword=new Keyword;
        $keyword->keyword_name=$_POST['word'];
        $keyword->keyword_score=$_POST['rate'];
        $keyword->user_id=$_SESSION['user_id'];
        
        if($keywordController->addKeyword($keyword))
        {
            header("location: addKeyword.php?added");
        }
        else {
            $errorMsg="Something Went Wrong... Try Again";
        }
    }else {
        $errorMsg = "Please fill all fields";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add keyword</title>
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

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Keyword</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Add keyword</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add keyword</h4>

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
//                        if(isset($_GET['added'])){
//                            ?>
<!--                            <br>-->
<!--                            <div class="alert alert-success alert-dismissible fade show">-->
<!--                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>-->
<!--                                Keyword added successfully.-->
<!--                            </div>-->
<!--                            --><?php
//                        }
                        ?>
                        <div class="basic-form">
                            <form id="formAuthentication" action="addKeyword.php" method="POST">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Word</label>
                                        <input id="word" name="word" type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Rate</label>
                                        <select id="largeSelect" class="form-control" name="rate">
                                            <option value="10">Very Positive</option>
                                            <option value="8">Positive</option>
                                            <option value="6">Neutral</option>
                                            <option value="4">Negative</option>
                                            <option value="2">Very Negative</option>


                                        </select>
                                    </div>

                                </div>

                                <button type="submit" class="btn mb-1 btn-primary">Add</button>
                                <button type="button" class="btn mb-1 btn-secondary" onclick="window.location.href='keyword.php'">Back</button>
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