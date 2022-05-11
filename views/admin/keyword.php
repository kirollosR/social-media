<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Keywords</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/logo-color.png">
    <!-- Custom Stylesheet -->
    <link href="../../assets/css/style.css" rel="stylesheet">
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Keywords
                            <?php //TODO: onclick="window.location.href='addKeyword.php'">Add keyword ?>
                            <button type="button" class="btn mb-1 btn-primary" style="float: right;" onclick="window.location.href='addKeyword.php'">Add keyword<span class="btn-icon-right"><i class="fa fa-plus"></i></span>
                            </button>
                        </h4>
                        <div class="table-responsive"">
                            <table class="table table-bordered table-striped verticle-middle">
                                <thead>
                                <tr>
                                    <th scope="col">Word</th>
                                    <th scope="col">Weight</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Air Conditioner</td>
                                    <td>
                                        <div class="progress" style="height: 10px">
                                            <div class="progress-bar gradient-1" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Apr 20,2018</td>
                                    <td><span>
<!--                                            <a href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a>-->
<!--                                            <a type="submit" href="#" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i></a>-->
                                            <button type="button" class="btn mb-1 btn-rounded btn-outline-info" onclick="window.location.href='editKeyword.php'"><span class="fa fa-pencil color-muted m-r-5"></span></button>
                                            <button type="button" class="btn mb-1 btn-rounded btn-outline-danger"><span class="ti-trash"></span></button>
                                        </span>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
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

</body>

</html>