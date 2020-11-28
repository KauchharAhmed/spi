<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sirajganj Polytechnic Institute</title>
    <!-- boostrap 4 css -->
    <link rel="stylesheet" href="{{URL::to('public/web_assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('public/web_assets/css/animate.css')}}">
    <!-- Custom Css  -->
    <link rel="stylesheet" href="{{URL::to('public/web_assets/css/custom.css')}}">
    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="{{URL::to('//use.fontawesome.com/releases/v5.8.1/css/all.css')}}" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- fancybox css  -->
    <link rel="stylesheet" href="{{URL::to('//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css')}}" />

    <!-- Main Jquery file -->
    <script src="{{URL::to('//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js')}}"></script>
    <!-- bootsrap jquey file -->
    <script src="{{URL::to('//maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js')}}"></script>
    <!-- Fancybox main js -->
    <script src="{{URL::to('//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js')}}"></script>

    <!-- Favicon Section -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{URL::to('public/web_assets/icons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{URL::to('public/web_assets/icons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::to('public/web_assets/icons/favicon-16x16.png')}}">
    <link rel="shortcut icon" href="{{URL::to('public/web_assets/icons/favicon.ico')}}" sizes="16x16">
    <!-- end favicon -->
</head>
<body>
    <!-- Main Contaier Section  -->
    <div class="container" style="border: 2px solid aliceblue;background-color: white;">
        <!-- Start Main Header Row -->
        <div class="row">
            <div class="col-md-12">
                <!-- Start Main Header Section  -->
                <div class="main_header">
                    <div class="carousel slide" data-ride="carousel">
                      <!-- The slideshow -->
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img src="{{URL::to('web_images/header_sliders/1.jpg')}}" alt="Los Angeles">
                        </div>
                        <div class="carousel-item">
                          <img src="{{URL::to('web_images/header_sliders/2.jpg')}}" alt="Chicago">
                        </div>
                        <div class="carousel-item">
                          <img src="{{URL::to('web_images/header_sliders/3.jpg')}}" alt="New York">
                        </div>
                      </div>
                    </div>

                    <div class="centered">
                        <div class="row">
                            <div class="col-md-12" style="padding-left: 0px;margin-left: 0px;">
                                <h3><a href="{{URL::to('')}}" class="site_name">Sirajganj Polytechnic Institute</a></h3>
                                <p class="slogan">Government of the People's Republic of Bangladesh</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Main Header Section -->

         <nav class="navbar navbar-expand-lg navbar-dark bg-customization" id="navbar">
                  
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                      <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('')}}"><i class="fas fa-home"></i></a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          About Us
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item" tabindex="-1" href="{{URL::to('missionVision/')}}">
                                   Mission & Vision
                                </a>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item" tabindex="-1" href="{{URL::to('history/')}}">
                                   History Of SPI
                                </a>
                            </li>
                        </ul>
                      </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Notice
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item" tabindex="-1" href="{{URL::to('notice')}}">Internal Notice
                                </a>
                            </li>
                                <li class="dropdown-submenu">
                                <a class="dropdown-item" target="_blank" tabindex="-1" href="http://bteb.gov.bd/page.php?action=notice_block&item=Notice_Diploma">Board Notice
                                </a>
                            </li>
                        </ul>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Departments
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                           <?php
$dept = DB::table('department')->get();
foreach ($dept as $dept_value) {?>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item" tabindex="-1" href="{{URL::to('spiDeptInfo/'.$dept_value->id)}}">
                                  <?php echo $dept_value->departmentName; ?>
                                </a>
                            </li>
                            <?php }?>
                        </ul>
                      </li>

                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Academic
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item" tabindex="-1" href="{{URL::to('spiClassRoutine')}}">
                                    Class Routine
                                </a>
                            </li>
                        </ul>
                      </li>

                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Digital ID Card
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item" tabindex="-1" href="{{URL::to('reg')}}">
                                 Registration For Digital ID Card
                                </a>
                            </li>
                        </ul>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('spiStaffList')}}">Staff</a>
                      </li>

                       <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Gallery
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{URL::to('photoGallery')}}">Photo Gallery</a>
                          <a class="dropdown-item" href="{{URL::to('videoGallery')}}">Video Gallery</a>
                        </div>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="contactUs">Contract Us</a>
                      </li>

                    </ul>
                  </div>
                </nav>
                    <marquee style="color:red;">Latest News :
                  <?php
// last notice show
$last_notice = DB::table('w_notice')->orderBy('id', 'desc')->limit(1)->first();
echo $last_notice->notice_title;
?></marquee>
                <!-- End Main Menu -->

            </div>
        </div>
        <!-- End Main Header Row  -->

        <!-- Body Content  -->
        <div class="row">
            @yield ('content')
            <!-- END DYNAMIC DONTENT -->
        </div>
        <!-- End Row -->
        <div class="row">
            <div class="col-md-12 footer_content mg-15">
                <footer>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Last Updated : 12 Jan 2019</p>
                        </div>
                        <div class="col-md-6">
                            <p style="float: right;">Technical Support <a href="" title="">Asian It Inc.</a></p>
                        </div>
                    </div>

                </footer>
            </div>
        </div>

    </div>
    <!-- End Container  -->
    <script>
        $(".btn-group, .dropdown").hover(
        function () {
            $('>.dropdown-menu', this).stop(true, true).fadeIn("fast");
            $(this).addClass('open');
        },
        function () {
            $('>.dropdown-menu', this).stop(true, true).fadeOut("fast");
            $(this).removeClass('open');
        });
    </script>

    <!-- On Scroll Navbar Fixed in Top -->
    <script>
        window.onscroll = function() {myFunction()};

        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;

        function myFunction() {
          if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
          }else{
            navbar.classList.remove("sticky");
          }
        }

    </script>
</body>
</html>