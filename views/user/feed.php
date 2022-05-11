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
    <link href="../../css/style.css" rel="stylesheet">

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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="#" class="form-profile">
                        <div class="form-group">
                            <textarea class="form-control" name="textarea" id="textarea" cols="30" rows="2" placeholder="Post a new message"></textarea>
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
                            <button class="btn btn-primary px-3 ml-4">Send</button>
                        </div>
                    </form>
                </div>
            </div>

                <div class="card">
                    <div class="card-body">
                        <div class="media media-reply">
                            <img class="mr-3 circle-rounded" src="../../assets/images/avatar/2.jpg" width="50" height="50" alt="Generic placeholder image">
                            <div class="media-body">
                                <div class="d-sm-flex justify-content-between mb-2">
                                    <h5 class="mb-sm-0">Milan Gbah <small class="text-muted ml-3">Topic name</small></h5>
                                    <div class="media-reply__link">
                                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-up"></i></button>
                                        <button class="btn btn-transparent p-0 ml-3 font-weight-bold" onclick="window.location.href='add-comment.php'">Comment</button>
                                    </div>
                                </div>

                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
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
<script src="../../js/custom.min.js"></script>
<script src="../../js/settings.js"></script>
<script src="../../js/gleek.js"></script>
<script src="../../js/styleSwitcher.js"></script>

</body>

</html>