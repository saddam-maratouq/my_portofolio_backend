<?php

// show err
require '../../err_config/err_config.php';

// get sql connection
require_once '../../db_confgrations/db_connection.php';

//  get record msg fun update 
require_once '../../utilityes-functions/recored-msgMange.php';


$tableName = "feed_back";

$userImg   =  $_FILES['user_img']['name'] ?? '';




//  for edit record on same form 

$editId   =  isset($_GET['id'])        ? (int) $_GET['id'] : null;
$editData =  isset($_GET['edit_data']) ? $_GET['edit_data'] : null;  // true or false 


if ($editData === 'true') {
    $sql = " SELECT * from  $tableName  where id = $editId limit 1  ";
    $result = mysqli_query($connect, $sql);
    $current_data = mysqli_fetch_assoc($result);
}



if (isset($_POST['add'])) {


    $userName = trim($_POST['user_name']);
    $job = trim($_POST['job']);
    $feedbackDetails = trim($_POST['feedback_details']);
    $userImg  =  $_FILES['user_img']['name'] ?? null;



    if (! empty($userImg)) {

        $tmp_name  = $_FILES['user_img']['tmp_name'];

        // Get file extension
        $fileExtension  = pathinfo($userImg, PATHINFO_EXTENSION);

        // generate rare naming ...
        $fileName =  "feedback_" . uniqid() . '.' .  $fileExtension; // Ex: feedback_65f8a2b3c4d5e.png

        $targetPath = "../../upload-img/feedback/" . $fileName;

        $filePath = "../../upload-img/feedback/";


        // Move uploaded file
        if (! move_uploaded_file($tmp_name, $targetPath)) {
            header("Location: ?upload_error=1");
            exit();
        }
    }



    $finalUserImg = $fileName ?? null;


    $stmt = $connect->prepare("INSERT INTO $tableName (`user_img`, `user_name`, `job`, `feedback_details`) VALUES (?, ?, ?, ?)");

    // Bind parameters 
    $stmt->bind_param("ssss", $finalUserImg, $userName, $job, $feedbackDetails);

    // Execute the statement

    if ($stmt->execute()) {
        header('location: ?msg=add-record-successfully');
        exit();
    } else {
        echo '<div style="text-align:center; background:red; color:white;">Record inserted failed ❌</div>';
    }

    $stmt->close();
}



if (isset($_POST['update'])) {



    $userName = trim($_POST['user_name']);
    $job = trim($_POST['job']);
    $feedbackDetails = trim($_POST['feedback_details']);

    #img var  ...

    $userImg  =  $_FILES['user_img']['name'] ?? '';

    $userImg  = !empty($userImg) ? $userImg  : ($current_data['user_img'] ?? null);

    $existingImage = $current_data["user_img"] ?? null;



    if (!empty($userImg) && $existingImage !=  $userImg) {

        $tmp_name  = $_FILES['user_img']['tmp_name'];
        $fileName = basename($userImg);


        $targetPath = "../../upload-img/feedback/" . $fileName;

        $filePath = "../../upload-img/feedback/";

        // Delete old one 

        if ($existingImage && file_exists($filePath . $existingImage)) {

            unlink($filePath . $existingImage);
        }


        // Move uploaded file
        if (! move_uploaded_file($tmp_name, $targetPath)) {
            header("Location: ?upload_error=1");
            exit();
        }
    } else {
        $fileName = $existingImage;
    }


    $finalUserImg  = $fileName ?? null;


    // UPDATE statement
    $stmt = $connect->prepare("UPDATE $tableName SET `user_name` = ?, `job` = ?, `feedback_details` = ?, `user_img` = ? WHERE `id` = ?");

    $stmt->bind_param("ssssi", $userName, $job, $feedbackDetails, $finalUserImg, $editId);

    if ($stmt->execute()) {
        updateRecordMsg('view-feedback.php');
    } else {
        failedUpdateRecordMsg();
    }

    $stmt->close();
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
       Admin Site Portfolio
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <!--     Fonts and  material icon  icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />



    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Files -->
    <link href="../../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />

    <!-- custom css style  -->
    <link href="../../assets/css/custom.css" rel="stylesheet" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />

</head>

<body class="dark-edition">
    <div class="wrapper ">
        <div class="sidebar" data-color="orange" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                    Creative Team
                </a>
            </div>
            <div class="sidebar-wrapper">
        
            <!-- Side bar  -->
           <ul class="nav">

              <!-- dropdown tab    -->
            <li class="nav-item side dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-icons">person</i>
                <p class="text-white"> users </p>
              </a>
              <ul class="dropdown-menu" aria-labelledby="trainingDropdown">
                <li><a class="dropdown-item" href="../users/mange-user.php">Add </a></li>
                <li><a class="dropdown-item" href="../users/view-users.php">View All</a></li>
              </ul>
            </li>


            <!-- dropdown tab    -->
            <li class="nav-item side dropdown ">
              <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-icons">shopping_bag</i>
                <p class="text-white"> orders </p>
              </a>
              <ul class="dropdown-menu" aria-labelledby="trainingDropdown">
                <li><a class="dropdown-item" href="../orders/view-orders.php">View All</a></li>
              </ul>
            </li>

          <!-- dropdown tab  booking table   -->
            <li class="nav-item side dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-icons">event_available</i>
                <p class="text-white"> bookings tables </p>
            </a>
            <ul class="dropdown-menu" aria-labelledby="trainingDropdown">
                <li><a class="dropdown-item" href="../booking-tables/mange-booked.php">Add</a></li>
                <li><a class="dropdown-item" href="../booking-tables/view-booked.php">View All</a></li>
            </ul>
            </li>


             <!-- dropdown tab  -->
            <li class="nav-item side dropdown   ">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-icons">polymer</i>
                <p class=" text-white"> website Logo</p>
              </a>
              <ul class="dropdown-menu" aria-labelledby="userDropdown">
                <li> <a class="dropdown-item  " href="../web-logo/mange-web-logo.php">Mange  Logo</a> </li>
              </ul>
            </li>


            <!-- dropdown tab slider   -->
            <li class="nav-item side dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-icons">view_carousel</i>
                <p class="text-white">Sliders</p>
              </a>
              <ul class="dropdown-menu" aria-labelledby="trainingDropdown">
                <li><a class="dropdown-item" href="../hero/mange-hero.php">Add </a></li>
                <li><a class="dropdown-item" href="../hero/view-hero.php">View All</a></li>
              </ul>
            </li>

            <!-- dropdown tab special meal   -->
            <li class="nav-item side dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-icons">percent</i>
                <p class="text-white">offer Meal</p>
              </a>
              <ul class="dropdown-menu" aria-labelledby="trainingDropdown">
                <li><a class="dropdown-item" href="../offer-meals/mange-offer-meal.php">Add </a></li>
                <li><a class="dropdown-item" href="../offer-meals/view-offer-meal.php">View All</a></li>
              </ul>
            </li>



           <!-- dropdown tab our menu     -->
            <li class="nav-item side dropdown ">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-icons">local_dining</i>
                <p class="text-white">Our Menu</p>
              </a>
              <ul class="dropdown-menu" aria-labelledby="userDropdown">

                <!-- sub menu -->
                <li class="dropdown-submenu  position-relative ">
                  <a class="dropdown-item dropdown-toggle" role="button">Burgers</a>
                  <ul class="dropdown-menu right-submenu">
                    <li><a class="dropdown-item" href="../our-menu/burger/mange-burger.php">Add </a></li>
                    <li><a class="dropdown-item" href="../our-menu/burger/view-burgers.php">View All</a></li>
                  </ul>
                </li>

                <!-- sub menu -->
                <li class="dropdown-submenu  position-relative ">
                  <a class="dropdown-item dropdown-toggle" role="button">Pizza</a>
                  <ul class="dropdown-menu right-submenu">
                    <li><a class="dropdown-item" href="../our-menu/pizza/mange-pizza.php">Add </a></li>
                    <li><a class="dropdown-item" href="../our-menu/pizza/view-pizzas.php">View All</a></li>
                  </ul>
                </li>

                <!-- sub menu -->
                <li class="dropdown-submenu  position-relative ">
                  <a class="dropdown-item dropdown-toggle" role="button">Pasta</a>
                  <ul class="dropdown-menu right-submenu">
                    <li><a class="dropdown-item" href="../our-menu/pasta/mange-pasta.php">Add </a></li>
                    <li><a class="dropdown-item" href="../our-menu/pasta/view-pastas.php">View All</a></li>
                  </ul>
                </li>

                <li class="dropdown-submenu  position-relative ">
                  <a class="dropdown-item dropdown-toggle" role="button">Fries</a>
                  <ul class="dropdown-menu right-submenu">
                    <li><a class="dropdown-item" href="../our-menu/fries/mange-fries.php">Add </a></li>
                    <li><a class="dropdown-item" href="../our-menu/fries/view-fries.php">View All</a></li>
                  </ul>
                </li>

              </ul>
            </li>


            <!-- dropdown tab  about  -->

            <li class="nav-item side dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="newsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-icons">info</i>
                <p class="text-white">About</p>

              </a>
              <ul class="dropdown-menu" aria-labelledby="newsDropdown">
                <li><a class="dropdown-item" href="../about/mange-about.php">Add Img </a></li>
              </ul>
            </li>


            <!-- dropdownrestaurant tables   -->
            <li class="nav-item side dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-icons">table_restaurant</i>
                <p class="text-white">restaurant tables</p>
              </a>
              <ul class="dropdown-menu" aria-labelledby="trainingDropdown">
                <li><a class="dropdown-item" href="../book-tables/mange-table.php">Add </a></li>
                <li><a class="dropdown-item" href="../book-tables/view-tables.php">View All</a></li>
              </ul>
            </li>

            <!-- dropdown feedbacks   -->
            <li class="nav-item side dropdown alert-warning">
              <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-icons">rate_review</i>
                <p class="text-white"> feed backs  </p>
              </a>
              <ul class="dropdown-menu" aria-labelledby="trainingDropdown">
                <li><a class="dropdown-item" href="../Feedback/mange-feedback.php">Add </a></li>
                <li><a class="dropdown-item" href="../Feedback/view-feedback.php">View All</a></li>
              </ul>
            </li>




            <!-- dropdown tab contact us   -->
            <!-- <li class="nav-item side dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="orderDetailsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-icons">contacts</i>
                <p class="text-white">Contact Us </p>
              </a>
              <ul class="dropdown-menu" aria-labelledby="orderDetailsDropdown">
                <li><a class="dropdown-item" href="../contact-us/mange-contact.php">Mange</a></li>

              </ul>
            </li> -->


            <!-- dropdown  tab footer  -->
            <li class="nav-item side dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="orderDetailsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-icons">dashboard</i>
                <p class="text-white">footer</p>
              </a>
              <ul class="dropdown-menu" aria-labelledby="orderDetailsDropdown">
                <li><a class="dropdown-item" href="../footer/mange-footer.php">mange</a></li>
              </ul>
            </li>
           </ul>
           <!-- End Side bar  -->

            </div>
        </div>

        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
                <div class="container-fluid">
                    <div class="navbar-wrapper   ">
                        <a class="navbar-brand" href="javascript:void(0) text-white  "> <?= $editData ? 'Update' : 'Add'  ?> feedback </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">
                        <form class="navbar-form" onsubmit="searchPageRedirect(event)">
                            <div class="input-group no-border">
                                <input type="text" value="" id="searchInput" class="form-control" placeholder="Search...">
                                <button type="submit" id="searchSubmit" class="btn btn-default btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </div>
                        </form>
                        <ul class="navbar-nav">
                            <!-- lang drop down ...  -->
                            <li class="nav-item dropdown custom-dropdown">
                                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="flag-icon">🇺🇸</span> <!-- Default to English flag -->
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="languageDropdown" style="width: 100px;">
                                    <li><a class="dropdown-item" href="#" data-lang="en"> EN</a></li>
                                    <li><a class="dropdown-item" href="#" data-lang="ar"> AR</a></li>
                                </ul>
                            </li>






                            <li class="nav-item dropdown ">
                                <a class="nav-link" href="javscript:void(0)" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">notifications</i>
                                    <!-- edit depend on count notfication  from db ...  -->
                                    <span class="notification  count-notifcations "> 5 </span>
                                    <p class="d-lg-none d-md-block">
                                        Some Actions
                                    </p>
                                </a>

                                <div class="dropdown-menu  dropdown-menu-right" style="width: 500px;" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item " href="orders-details.php"> msg recived </a>

                                </div>
                            </li>


                            <!-- <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
              </li> -->

                            <li class="nav-item dropdown custom-dropdown">
                                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <!-- <i class="material-icons">person</i> -->
                                    <img src="../../assets/img/Website Logo.png" class="web-logo" srcset="">
                                    <p class="d-lg-none d-md-block">Account</p>
                                </a>
                                <ul class="dropdown-menu " aria-labelledby="accountDropdown">
                                    <li " ><a class=" dropdown-item" href="javascript:void(0)">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->

            <!-- content here -->

            <style>
                label {
                    color: #fff !important;
                }

                .web-logo {
                    width: 40px;
                }

                .dropdown-menu[data-bs-popper] {
                    top: 100%;
                    left: -100px;
                    margin-top: var(--bs-dropdown-spacer);
                }

                .input-group {
                    position: relative;
                    display: flex;
                    flex-wrap: wrap;
                    align-items: flex-end;
                    /* width: 99%; */
                    width: 1000px;

                }

                .count-notifcations {
                    background: #F99225 !important;
                }
            </style>

            <div class="content  ">
                <div class="container-fluid">
                    <div class="col-xl-12 col-lg-12">


                        <form action="" method="POST" class="mt-5" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label>User Name</label>
                                <input type="text" name="user_name" class="form-control" required
                                    value="<?= $editData ? htmlspecialchars($current_data['user_name'] ?? '', ENT_QUOTES, 'UTF-8') : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label>Job / Title</label>
                                <input type="text" name="job" class="form-control" required
                                    value="<?= $editData ? htmlspecialchars($current_data['job'] ?? '', ENT_QUOTES, 'UTF-8') : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label>Feedback Details</label>
                                <textarea name="feedback_details" class="form-control" rows="5" required><?= $editData ? htmlspecialchars($current_data['feedback_details'] ?? '', ENT_QUOTES, 'UTF-8') : '' ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="text-white mb-3">User Image</label>
                                <input type="file" name="user_img" class="form-control"
                                    accept="image/*"
                                    <?= $editData ? '' : 'required' ?>>
                                <small class="text-muted">Allowed: JPG, JPEG, PNG, GIF, WEBP, SVG (Max: 5MB)</small>
                            </div>

                            <button type="submit" name="<?= $editData ? 'update' : 'add' ?>" class="btn w-100 mt-4">
                                <?= $editData ? 'Update' : 'Add' ?>
                            </button>

                        </form>
                    </div>
                </div>
            </div>


            <!--  -->

            <footer class="footer">
                <div class="container-fluid">
                    <nav class="float-left">
                        <ul>
                            <li>
                                <a href="https://www.creative-tim.com">
                                    Creative Team
                                </a>
                            </li>
                            <li>
                                <a href="https://creative-tim.com/presentation">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="http://blog.creative-tim.com">
                                    Blog
                                </a>
                            </li>
                            <li>
                                <a href="https://www.creative-tim.com/license">
                                    Licenses
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright float-right" id="date">
                        , made with <i class="material-icons">favorite</i> by
                        <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
                    </div>
                </div>
            </footer>
            <script>
                const x = new Date().getFullYear();
                let date = document.getElementById('date');
                date.innerHTML = '&copy; ' + x + date.innerHTML;
            </script>
        </div>
    </div>
    <div class="fixed-plugin">
        <div class="dropdown show-dropdown">
            <!-- <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
      </a> -->
            <ul class="dropdown-menu">
                <li class="header-title"> Sidebar Filters</li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger active-color">
                        <div class="badge-colors ml-auto mr-auto">
                            <span class="badge filter badge-purple active" data-color="purple"></span>
                            <span class="badge filter badge-azure" data-color="azure"></span>
                            <span class="badge filter badge-green" data-color="green"></span>
                            <span class="badge filter badge-warning" data-color="orange"></span>
                            <span class="badge filter badge-danger" data-color="danger"></span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li class="header-title">Images</li>
                <li>
                    <a class="img-holder switch-trigger" href="javascript:void(0)">
                        <img src="../assets/img/sidebar-1.jpg" alt="">
                    </a>
                </li>
                <li class="active">
                    <a class="img-holder switch-trigger" href="javascript:void(0)">
                        <img src="../assets/img/sidebar-2.jpg" alt="">
                    </a>
                </li>
                <li>
                    <a class="img-holder switch-trigger" href="javascript:void(0)">
                        <img src="../assets/img/sidebar-3.jpg" alt="">
                    </a>
                </li>
                <li>
                    <a class="img-holder switch-trigger" href="javascript:void(0)">
                        <img src="../assets/img/sidebar-4.jpg" alt="">
                    </a>
                </li>
                <li class="button-container">
                    <a href="https://www.creative-tim.com/product/material-dashboard-dark" target="_blank" class="btn btn-primary btn-block">Free Download</a>
                </li>
                <!-- <li class="header-title">Want more components?</li>
            <li class="button-container">
                <a href="https://www.creative-tim.com/product/material-dashboard-pro" target="_blank" class="btn btn-warning btn-block">
                  Get the pro version
                </a>
            </li> -->
                <li class="button-container">
                    <a href="https://demos.creative-tim.com/material-dashboard-dark/docs/2.0/getting-started/introduction.html" target="_blank" class="btn btn-default btn-block">
                        View Documentation
                    </a>
                </li>
                <li class="button-container github-star">
                    <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard/tree/dark-edition" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star ntkme/github-buttons on GitHub">Star</a>
                </li>
                <li class="header-title">Thank you for 95 shares!</li>
                <li class="button-container text-center">
                    <button id="twitter" class="btn btn-round btn-twitter"><i class="fa fa-twitter"></i> &middot; 45</button>
                    <button id="facebook" class="btn btn-round btn-facebook"><i class="fa fa-facebook-f"></i> &middot; 50</button>
                    <br>
                    <br>
                </li>
            </ul>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle CDN  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="https://unpkg.com/default-passive-events"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chartist JS -->
    <script src="../assets/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.js?v=2.1.0"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="../assets/demo/demo.js"></script>
    <script>
        $(document).ready(function() {
            $().ready(function() {
                $sidebar = $('.sidebar');

                $sidebar_img_container = $sidebar.find('.sidebar-background');

                $full_page = $('.full-page');

                $sidebar_responsive = $('body > .navbar-collapse');

                window_width = $(window).width();

                $('.fixed-plugin a').click(function(event) {
                    // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                    if ($(this).hasClass('switch-trigger')) {
                        if (event.stopPropagation) {
                            event.stopPropagation();
                        } else if (window.event) {
                            window.event.cancelBubble = true;
                        }
                    }
                });

                $('.fixed-plugin .active-color span').click(function() {
                    $full_page_background = $('.full-page-background');

                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data-color', new_color);
                    }

                    if ($full_page.length != 0) {
                        $full_page.attr('filter-color', new_color);
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.attr('data-color', new_color);
                    }
                });

                $('.fixed-plugin .background-color .badge').click(function() {
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('background-color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data-background-color', new_color);
                    }
                });

                $('.fixed-plugin .img-holder').click(function() {
                    $full_page_background = $('.full-page-background');

                    $(this).parent('li').siblings().removeClass('active');
                    $(this).parent('li').addClass('active');


                    var new_image = $(this).find("img").attr('src');

                    if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                        $sidebar_img_container.fadeOut('fast', function() {
                            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                            $sidebar_img_container.fadeIn('fast');
                        });
                    }

                    if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                        $full_page_background.fadeOut('fast', function() {
                            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                            $full_page_background.fadeIn('fast');
                        });
                    }

                    if ($('.switch-sidebar-image input:checked').length == 0) {
                        var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                    }
                });

                $('.switch-sidebar-image input').change(function() {
                    $full_page_background = $('.full-page-background');

                    $input = $(this);

                    if ($input.is(':checked')) {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar_img_container.fadeIn('fast');
                            $sidebar.attr('data-image', '#');
                        }

                        if ($full_page_background.length != 0) {
                            $full_page_background.fadeIn('fast');
                            $full_page.attr('data-image', '#');
                        }

                        background_image = true;
                    } else {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar.removeAttr('data-image');
                            $sidebar_img_container.fadeOut('fast');
                        }

                        if ($full_page_background.length != 0) {
                            $full_page.removeAttr('data-image', '#');
                            $full_page_background.fadeOut('fast');
                        }

                        background_image = false;
                    }
                });

                $('.switch-sidebar-mini input').change(function() {
                    $body = $('body');

                    $input = $(this);

                    if (md.misc.sidebar_mini_active == true) {
                        $('body').removeClass('sidebar-mini');
                        md.misc.sidebar_mini_active = false;

                        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                    } else {

                        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                        setTimeout(function() {
                            $('body').addClass('sidebar-mini');

                            md.misc.sidebar_mini_active = true;
                        }, 300);
                    }

                    // we simulate the window Resize so the charts will get updated in realtime.
                    var simulateWindowResize = setInterval(function() {
                        window.dispatchEvent(new Event('resize'));
                    }, 180);

                    // we stop the simulation of Window Resize after the animations are completed
                    setTimeout(function() {
                        clearInterval(simulateWindowResize);
                    }, 1000);

                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            md.initDashboardPageCharts();

        });
    </script>
    <!-- search logic script  -->
    <script src="../../assets//js/main.js"> </script>

</body>

</html>