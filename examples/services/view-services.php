
<?php

# main variable 
$tableName = "services";
$urlName =  basename($_SERVER['SCRIPT_NAME']) ;
$editPageName = "manage-services.php" ; 
# 


// show err
require '../../err_config/err_config.php';

// get sql connection
require_once '../../db_confgrations/db_connection.php';

// get utility function to  delete record 
include '../../db_confgrations/delete_utilty.php' ;

// show no record added yet alert msg  
require_once '../../utilityes-functions/no-data-alert.php';


$path = '../../upload-img/services' ;

# we  get file img to delete it from folder target when record deleted  .. 

$deleteID =  isset( $_GET['id'])  ?  $_GET['id'] : null ;
 
if ( is_numeric($deleteID) &&  $deleteID > 0 ) {

  // need current img here to check if exist on folder to delete it ...

  $sql = " SELECT `image_name` from  $tableName  where id = $deleteID limit 1  ";
  $result = mysqli_query($connect, $sql);
  $current_data = mysqli_fetch_assoc($result);

  $existingImg = $current_data['image_name'] ?? null ; 

  $filePath = "../../upload-img/services/";
 
    // Delete old one 

    if ($existingImg && file_exists($filePath . $existingImg )) {

      unlink($filePath . $existingImg );
    }


  deleteRecord($tableName ,$deleteID,$connect);

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
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

   <!-- Bootstrap 5 CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- CSS Files -->
  <link href="../../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <!-- custom css -->
  <link href="../../assets/css/custom.css" rel="stylesheet" />

  <!-- CSS Just for d purpose, don't include it in your project -->
  <!-- <link href="../assets/demo/demo.css" rel="stylesheet" /> -->

</head>

<body class="dark-edition">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
          Creative Team
        </a></div>
      <div class="sidebar-wrapper">
         <ul class="nav">

          <!-- dropdown tab    -->
          <li class="nav-item side dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="material-icons">person</i>
              <p class="text-white"> users </p>
            </a>
            <ul class="dropdown-menu" aria-labelledby="trainingDropdown">
              <li><a class="dropdown-item" href="../../users/mange-user.php">Add</a></li>
              <li><a class="dropdown-item" href="../../users/view-users.php">View All</a></li>
            </ul>
          </li>

          <!-- dropdown tab    -->
          <li class="nav-item side dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="material-icons">shopping_bag</i>
              <p class="text-white"> orders </p>
            </a>
            <ul class="dropdown-menu" aria-labelledby="trainingDropdown">
              <li><a class="dropdown-item" href="../../orders/view-orders.php">View All</a></li>
            </ul>
          </li>

           <!-- dropdown tab  booking table   -->
            <li class="nav-item side dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-icons">event_available</i>
                <p class="text-white"> bookings tables </p>
              </a>
              <ul class="dropdown-menu" aria-labelledby="trainingDropdown">
                <li><a class="dropdown-item" href="../../booking-tables/mange-booked.php">Add</a></li>
                <li><a class="dropdown-item" href="../../booking-tables/view-booked.php">View All</a></li>
              </ul>
            </li>


          <!-- dropdown tab  -->
          <li class="nav-item side dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="material-icons">polymer</i>
              <p class="text-white"> website Logo</p>
            </a>
            <ul class="dropdown-menu" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="../../web-logo/mange-web-logo.php">Mange Logo</a></li>
            </ul>
          </li>

          <!-- dropdown tab slider   -->
          <li class="nav-item side dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="material-icons">view_carousel</i>
              <p class="text-white">Sliders</p>
            </a>
            <ul class="dropdown-menu" aria-labelledby="trainingDropdown">
              <li><a class="dropdown-item" href="../../hero/mange-hero.php">Add</a></li>
              <li><a class="dropdown-item" href="../../hero/view-hero.php">View All</a></li>
            </ul>
          </li>

          <!-- dropdown tab special meal   -->
          <li class="nav-item side dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="material-icons">percent</i>
              <p class="text-white">offer Meal</p>
            </a>
            <ul class="dropdown-menu" aria-labelledby="trainingDropdown">
              <li><a class="dropdown-item" href="../../offer-meals/mange-offer-meal.php">Add</a></li>
              <li><a class="dropdown-item" href="../../offer-meals/view-offer-meal.php">View All</a></li>
            </ul>
          </li>

          <!-- dropdown tab our menu     -->
          <li class="nav-item side dropdown alert-warning">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="material-icons">local_dining</i>
              <p class="text-white">Our Menu</p>
            </a>
            <ul class="dropdown-menu" aria-labelledby="userDropdown">

              <!-- sub menu - Burger -->
              <li class="dropdown-submenu position-relative">
                <a class="dropdown-item dropdown-toggle" role="button">Burgers</a>
                <ul class="dropdown-menu right-submenu">
                  <li><a class="dropdown-item" href="mange-burger.php">Add</a></li>
                  <li><a class="dropdown-item" href="view-burgers.php">View All</a></li>
                </ul>
              </li>

              <!-- sub menu - Pizza -->
              <li class="dropdown-submenu position-relative">
                <a class="dropdown-item dropdown-toggle" role="button">Pizza</a>
                <ul class="dropdown-menu right-submenu">
                  <li><a class="dropdown-item" href="../pizza/mange-pizza.php">Add</a></li>
                  <li><a class="dropdown-item" href="../pizza/view-pizzas.php">View All</a></li>
                </ul>
              </li>

              <!-- sub menu - Pasta -->
              <li class="dropdown-submenu position-relative">
                <a class="dropdown-item dropdown-toggle" role="button">Pasta</a>
                <ul class="dropdown-menu right-submenu">
                  <li><a class="dropdown-item" href="../pasta/mange-pasta.php">Add</a></li>
                  <li><a class="dropdown-item" href="../pasta/view-pastas.php">View All</a></li>
                </ul>
              </li>

              <!-- sub menu - Fries -->
              <li class="dropdown-submenu position-relative">
                <a class="dropdown-item dropdown-toggle" role="button">Fries</a>
                <ul class="dropdown-menu right-submenu">
                  <li><a class="dropdown-item" href="../fries/mange-fries.php">Add</a></li>
                  <li><a class="dropdown-item" href="../fries/view-fries.php">View All</a></li>
                </ul>
              </li>

            </ul>
          </li>

          <!-- dropdown tab about -->
          <li class="nav-item side dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="newsDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="material-icons">info</i>
              <p class="text-white">About</p>
            </a>
            <ul class="dropdown-menu" aria-labelledby="newsDropdown">
              <li><a class="dropdown-item" href="../../about/mange-about.php">Add Img</a></li>
            </ul>
          </li>

          <!-- dropdownrestaurant tables-->
          <li class="nav-item side dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="material-icons">table_restaurant</i>
              <p class="text-white">booked table</p>
            </a>
            <ul class="dropdown-menu" aria-labelledby="trainingDropdown">
              <li><a class="dropdown-item" href="../../book-tables/mange-table.php">Add</a></li>
              <li><a class="dropdown-item" href="../../book-tables/view-tables.php">View All</a></li>
            </ul>
          </li>

          <!-- dropdown feedback -->
          <li class="nav-item side dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="material-icons">rate_review</i>
              <p class="text-white">feed backs</p>
            </a>
            <ul class="dropdown-menu" aria-labelledby="trainingDropdown">
              <li><a class="dropdown-item" href="../../Feedback/mange-feedback.php">Add</a></li>
              <li><a class="dropdown-item" href="../../Feedback/view-feedback.php">View All</a></li>
            </ul>
          </li>

          <!-- dropdown footer -->
          <li class="nav-item side dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="orderDetailsDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              <i class="material-icons">dashboard</i>
              <p class="text-white">footer</p>
            </a>
            <ul class="dropdown-menu" aria-labelledby="orderDetailsDropdown">
              <li><a class="dropdown-item" href="../../footer/mange-footer.php">mange</a></li>
            </ul>
          </li>

        </ul>

      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
        <div class="container-fluid">
          <div class="navbar-wrapper   ">
            <a class="navbar-brand" href="javascript:void(0) text-white  "> All Services</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form"  onsubmit="searchPageRedirect(event)" >
              <div class="input-group no-border">
                <input type="text" value="" id="searchInput"  class="form-control" placeholder="Search...">
                <button type="submit"   id="searchSubmit" class="btn btn-default btn-round btn-just-icon">
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
                <li><a class="dropdown-item" href="#" data-lang="en">  EN</a></li>
                <li><a class="dropdown-item" href="#" data-lang="ar">  AR</a></li>
              </ul>
            </li>

            <?php 

            // $sql = "SELECT id from `Orders`";

            // $result = mysqli_query($connect,$sql);

            //  $count_notifications = mysqli_num_rows($result) ;

            ?>



              

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
           
            <a class="dropdown-item " href="../orders-history/orders-details.php">  order   received  </a>
           

          </div>
              </li>


            

            <li class="nav-item dropdown custom-dropdown">
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <!-- <i class="material-icons">person</i> -->
                   <img src="../../assets/img/Website Logo.png"  class="web-logo"  srcset="">
                  <p class="d-lg-none d-md-block">Account</p>
                </a>
                <ul class="dropdown-menu " aria-labelledby="accountDropdown">
              <li " ><a class="dropdown-item" href="javascript:void(0)">Logout</a></li>
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
  background: #F99225  !important ;
}


</style>

<div class="content  ">
  <div class="container-fluid">
    <div class="col-xl-12 col-lg-12">
      <!-- Add  Button -->
        <div class="d-flex justify-content-start ">
        <a href= <?= $editPageName ?>  class="btn ">
            <i class="material-icons" style="vertical-align: middle;">add</i>
            Add Service
        </a>
        </div>

       <!-- Services Table -->
<div class="table-responsive mt-4 mb-4" style="width: 100%;">
  <table class="table table-dark table-striped table-bordered align-middle text-center w-100">
    <thead>
      <tr>
        <th>ID</th>
        <th>Service Title</th>
        <th>Description</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tbody>
      <?php 
      $sql = "SELECT * FROM $tableName ORDER BY id asc";
      $result = mysqli_query($connect, $sql);
      $rowsCount = mysqli_num_rows($result);
      ?>

      <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?= htmlspecialchars($row['id']) ?></td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td style="max-width: 300px;"><?= htmlspecialchars($row['description']) ?></td>
        <td>
          <?php if (!empty($row['image_name'])): ?>
            <img class="table-img" src="../../upload-img/services/<?= htmlspecialchars($row['image_name']) ?>" 
                 alt="service image" 
                 style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;">
          <?php else: ?>
            <span class="text-muted">No image</span>
          <?php endif; ?>
        </td>
        <td>
          <a href="<?= $editPageName ?>?id=<?= $row['id'] ?>&edit_data=true" class="text-white me-3" title="Edit">
            <i class="material-icons">edit</i>
          </a>

          <a href="<?= $urlName ?>?id=<?= $row['id'] ?>" 
             class="text-white" 
             title="Delete (cannot undo)"
             onclick="return confirm('Are you sure you want to delete this service?')">
            <i class="material-icons">delete</i>
          </a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  
  <!-- Check if no records -->
  <?php if ($rowsCount == 0) echo showNoRecordsMessage(); ?>
</div>
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
   <script src="../../assets//js/main.js" >  </script>

</body>

</html>