<?php
$keyword_id = $_GET['id'];
$keyword_name = $_GET['name'];
if(!isset($_SESSION['user_id'])){
    session_start();
}

require_once '../../controllers/AuthController.php';
require_once '../../models/vars.php';
$vars = new vars;
$auth = new AuthController();

if(!$auth->isAuthenticated($vars->admin)){
    header('Location: ../../index.php');
}

require_once '../../controllers/keywordController.php';
require_once '../../models/keyword.php';

$keywordController=new keywordController;
// $keyword = new keyword;
//$keyword_value = $keywordController->getKeyword($keyword_id);
//$keywords = $keywordController->getAllKeywords();
$errorMsg="";

//if(isset($_POST['word'])) {
//    if(!empty($_POST['word'])){
//        $keywordController->updateKeyword($_POST['keyword_id'],$_POST["word"], $_POST['rate']);
//    }
//}


if(isset($_POST['word']) && isset($_POST['rate']))
{
    if(!empty($_POST['word']) && !empty($_POST['rate']))
    {
        $keyword1= new keyword();
        $keyword1->keyword_id = $_POST['keyword_id'];
        $keyword1->keyword_name = $_POST['word'];
        $keyword1->keyword_score = $_POST['rate'];

        if($keywordController->updateKeyword($keyword1->keyword_id,$keyword1->keyword_name,$keyword1->keyword_score))
        {
//            $keyword = $keywordController->getKeyword($_POST["keyword_id"]);
            header("location: keyword.php");
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
    <title>Edit keyword</title>
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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit keyword</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!--                        <h4 class="card-title">Search for keyword</h4>-->
                        <!--                        <div class="basic-form">-->
                        <!--                            <form method= "POST" action = "editKeyword.php">-->
                        <!--                                <div class="form-row">-->
                        <!--                                    <div class="form-group col-md-4">-->
                        <!--                                        <label>Word</label>-->
                        <!--                                        <select id="inputState" name= "rate" class="form-control">-->
                        <!--                                            --><?php
                        //                                            foreach ($keywords as $keyword){
                        //                                            ?>
                        <!--                                                <option value="--><?php //echo $keyword['keyword_id']?><!--">--><?php //echo $keyword['keyword_name'] ?><!--</option>-->
                        <!--                                            --><?php
                        //                                            }
                        //                                            ?>
                        <!--                                        </select>-->
                        <!--                                    <input id="word" name="word" type="text" class="form-control" value="">-->
                        <!--                                    </div>-->
                        <!---->
                        <!---->
                        <!--                                </div>-->
                        <!---->
                        <!--                                <button type="submit" class="btn mb-1 btn-primary">Search</button>-->
                        <!--                               <button type="button" class="btn mb-1 btn-secondary" onclick="window.location.href='keyword.php'">Back</button>-->
                        <!--                            </form>-->
                        <h4 class="card-title">Edit keyword</h4>
                        <div class="basic-form">
                            <form method= "POST" action = "" id="formAuthentication">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Word</label>
                                        <input type="hidden" name="keyword_id" value="<?php echo $keyword_id ?>">
                                        <input id="word" name="word" type="text" class="form-control" value="<?php echo $keyword_name; ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Rate</label>
                                        <select id="inputState" name= "rate" class="form-control">
                                            <option value="10" selected>Very Positive</option>
                                            <option value="8">Positive</option>
                                            <option value="6">Neutral</option>
                                            <option value="4">Negative</option>
                                            <option value="2">Very Negative</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" name="update" class="btn mb-1 btn-primary">Update</button>
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