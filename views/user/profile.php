<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Profile</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../images/logo-color.png">
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
    <?php @include_once '../../components/navbar.php' ?>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <?php @include_once '../../components/user-sidebar.php';?>
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
                                <img class="mr-3" src="../../images/avatar/11.png" width="80" height="80" alt="">
                                <div class="media-body">
                                    <h3 class="mb-0">Pikamy Cha</h3>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col">
                                    <!-- <div class="card card-profile text-center">
                                        <span class="mb-1 text-primary"><i class="icon-people"></i></span>
                                        <h3 class="mb-0">263</h3>
                                        <p class="text-muted px-4">Following</p>
                                    </div> -->
                                </div>
                                <div class="col">
                                    <!-- <div class="card card-profile text-center">
                                        <span class="mb-1 text-warning"><i class="icon-user-follow"></i></span>
                                        <h3 class="mb-0">263</h3>
                                        <p class="text-muted">Followers</p>
                                    </div> -->
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn btn-danger px-5">Update Profile</button>
                                </div>
                            </div>

                            <h4>Status</h4>
                            <p class="text-muted">Hi, I'm Pikamy, has been the industry standard dummy text ever since the 1500s.</p>
                            <ul class="card-profile__info">
                                <li><strong class="text-dark mr-4">Email</strong> <span>name@domain.com</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-8 col-xl-9">
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
                    </div> -->
                
                <div class="col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="media media-reply">
                                <img class="mr-3 circle-rounded" src="../../images/avatar/2.jpg" width="50" height="50" alt="Generic placeholder image">
                                <div class="media-body">
                                    <div class="d-sm-flex justify-content-between mb-2">
                                        <h5 class="mb-sm-0">Milan Gbah <small class="text-muted ml-3">about 3 days ago</small></h5>
                                        <div class="media-reply__link">
                                            <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-up"></i></button>
                                            <button class="btn btn-transparent text-dark font-weight-bold p-0 ml-2">Comment</button>
                                        </div>
                                    </div>

                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                    <!-- <ul>
                                        <li class="d-inline-block"><img class="rounded" width="60" height="60" src="../../images/imgs/2.png" alt=""></li>
                                        <li class="d-inline-block"><img class="rounded" width="60" height="60" src="../../images/imgs/3.png" alt=""></li>
                                        <li class="d-inline-block"><img class="rounded" width="60" height="60" src="../../images/imgs/4.png" alt=""></li>
                                        <li class="d-inline-block"><img class="rounded" width="60" height="60" src="../../images/imgs/1.png" alt=""></li>
                                    </ul> -->

                                    <div class="media mt-3">
                                        <img class="mr-3 circle-rounded circle-rounded" src="../../images/avatar/4.jpg" width="50" height="50" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <div class="d-sm-flex justify-content-between mb-2">
                                                <h5 class="mb-sm-0">Milan Gbah <small class="text-muted ml-3">about 3 days ago</small></h5>
                                                <div class="media-reply__link">
                                                    <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-up"></i></button>
                                                    <button class="btn btn-transparent p-0 ml-3 font-weight-bold">Comment</button>
                                                </div>
                                            </div>
                                            <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="media media-reply">
                                <img class="mr-3 circle-rounded" src="../../images/avatar/2.jpg" width="50" height="50" alt="Generic placeholder image">
                                <div class="media-body">
                                    <div class="d-sm-flex justify-content-between mb-2">
                                        <h5 class="mb-sm-0">Milan Gbah <small class="text-muted ml-3">about 3 days ago</small></h5>
                                        <div class="media-reply__link">
                                            <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-up"></i></button>
                                            <button class="btn btn-transparent p-0 ml-3 font-weight-bold">Comment</button>
                                        </div>
                                    </div>

                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                </div>
                            </div>
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
    <?php @include_once '../../components/footer.php' ?>
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