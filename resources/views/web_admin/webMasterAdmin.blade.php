<?php
$superadmin_id = Session::get('superadmin_id');
$type          = Session::get('type');
       if($superadmin_id == null && $type != '1'){
       return Redirect::to('/admin')->send();
        }
        ?>
<!DOCTYPE html>
<html lang="en" >
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8" />
    <title>SPI</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Datatable HTML table"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <link rel="stylesheet" href="{{URL::to('public/assets/css/solaimanlipi.css')}}"/>
    <link href="{{URL::to('public/assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::to('public/assets/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="{{URL::to('public/assets/default/media/img/logo/favicon.ico')}}"/> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.3/sweetalert2.min.css">
    <link rel="stylesheet" href="{{URL::to('public/assets/css/custom_style.css')}}"/>
    <!--begin::Web font -->
        <script src="assets/js/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>

</head>
    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
<!-- BEGIN: Header -->
<header class="m-grid__item    m-header "  data-minimize-offset="200" data-minimize-mobile-offset="200" >
    <div class="m-container m-container--fluid m-container--full-height">
        <div class="m-stack m-stack--ver m-stack--desktop">     
            <!-- BEGIN: Brand -->
<div class="m-stack__item m-brand  m-brand--skin-dark" style="background: #ff8d18;">
    <div class="m-stack m-stack--ver m-stack--general">
        <div class="m-stack__item m-stack__item--middle m-brand__logo">
            <a href="index9bfb.html?page=index&amp;demo=default" class="m-brand__logo-wrapper">
            <!--<img alt="" src="assets/demo/default/media/img/logo/logo_default_dark.png"/>-->
            <h6 style="color:white;font-weight: bold;font-family: monospace;font-size: 19px;">WEB ADMIN</h6>
            </a>  
        </div>
        <div class="m-stack__item m-stack__item--middle m-brand__tools">
                            
                <!-- BEGIN: Left Aside Minimize Toggle -->
                <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block 
                     ">
                    <span></span>
                </a>
                <!-- END -->
            
                <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                    <span></span>
                </a>
                <!-- END -->
            
                <!-- BEGIN: Responsive Header Menu Toggler -->
                <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                    <span></span>
                </a>
                <!-- END -->
                        

            <!-- BEGIN: Topbar Toggler -->
            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                <i class="flaticon-more"></i>
            </a>
            <!-- BEGIN: Topbar Toggler -->
        </div>
    </div>
</div>
<!-- END: Brand -->         
<div class="m-stack__item m-stack__item--fluid m-header-head" style="background: #ff8d18" id="m_header_nav">
<!-- BEGIN: Horizontal Menu -->
<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
<!-- END: Horizontal Menu --> 
<!-- BEGIN: Topbar -->
<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general" style="background: #ff8d18">
    <div class="m-stack__item m-topbar__nav-wrapper" >
    <ul class="m-topbar__nav m-nav m-nav--inline" > 
<li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center  m-dropdown--mobile-full-width" data-dropdown-toggle="click" data-dropdown-persistent="true" style="padding-top:20px;">
</li>
      <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center  m-dropdown--mobile-full-width" data-dropdown-toggle="click" data-dropdown-persistent="true" style="padding-top:20px;color:white;font-weight: bold;font-family: monospace;">
      <?php if(!empty(Session::get('superadmin_name')))
      {
           echo 'Welcome To Mr '. Session::get('superadmin_name'); 
      }
      ?>
</li>
    <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
    <a href="#" class="m-nav__link m-dropdown__toggle">
    <span class="m-topbar__userpic">
    <img class="md-user-image" style="border-radius: 50%;" src="{{URL::to('public/assets/img/avatars/principal.jpg')}}" alt=""/>
    <span class="m-topbar__username m--hide">Nick</span>                    
    </a>
    <div class="m-dropdown__wrapper">
        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
        <div class="m-dropdown__inner">
            <div class="m-dropdown__header m--align-center" background-size: cover;">

                <div class="m-card-user m-card-user--skin-dark">
                    <div class="m-card-user__pic">
                        <img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt=""/>
                    </div>
                    <div class="m-card-user__details">
                        <span class="m-card-user__name m--font-weight-500"></span>
                        <a href="#" class="m-card-user__email m--font-weight-300 m-link"></a>
                    </div>
                </div>
            </div>
            <div class="m-dropdown__body">
                <div class="m-dropdown__content">
                    <ul class="m-nav m-nav--skin-light">
                        <li class="m-nav__separator m-nav__separator--fit">
                        </li>
                        <li class="m-nav__item">
                            <a href="{{URL::to('superAdminLogout')}}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
                            
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</li>           
</ul>
    </div>
</div>
<!-- END: Topbar -->            
</div>
</div>
    </div>
</header>
<!-- END: Header -->  
<!-- Start sidebar -->   

<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
    <!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark" style="background: #ffbe7b;">    
    <!-- BEGIN: Aside Menu -->
    <div 
        id="m_ver_menu" 
        class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " 
        data-menu-vertical="true"
         data-menu-scrollable="false" data-menu-dropdown-timeout="500"  
        > 
         <span><img width="50" height="40" src="{{URL::to('images/spi_logo.jpg') }}"> </span>  <span style="font-size: 10px;font-weight: bold;">SIRAJGANJ POLYTECHNNIC INSTITUTE</span> 
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow " style="background: #ffbe7b;">
           
            <li class="m-menu__item " aria-haspopup="true" style="background: blue;">
                <a  href="{{URL::to('superAdminFromWebAdmin/'.$superadmin_id.'/'.$type)}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph" style="color:white;"></i>
                    <span class="m-menu__link-title">  
                    <span class="m-menu__link-wrap">    
                    <span class="m-menu__link-text" style="color:white;font-family: monospace; font-weight: bold;font-size: 16px;">
                    SOFTWARE
                    </span>    
                    <span class="m-menu__link-badge">
                    </span>  
                    </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true">
                <a  href="{{URL::to('webMasterDashboard')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">  
                    <span class="m-menu__link-wrap">    
                    <span class="m-menu__link-text" style="font-family: monospace; font-weight: bold;">DASHBOARD</span>    
                    <span class="m-menu__link-badge">
                    </span>  
                    </span>
                    </span>
                </a>
            </li>
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-layers"></i>
                    <span class="m-menu__link-text" style="font-family: monospace; font-weight: bold;">BANNER</span><i class="m-menu__ver-arrow la la-angle-right"></i>
                </a><div class="m-menu__submenu "><span class="m-menu__arrow">
                </span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" ><span class="m-menu__link">
                        <span class="m-menu__link-text"></span>
                        </span>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="{{URL::to('webBannerAdd')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Add Banner</span></a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="{{URL::to('webManageBanner')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Manage Banner</span></a>
                    </li>
                </ul>
            </li>
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-layers"></i>
                    <span class="m-menu__link-text" style="font-family: monospace; font-weight: bold;">MESSAGE</span><i class="m-menu__ver-arrow la la-angle-right"></i>
                </a><div class="m-menu__submenu "><span class="m-menu__arrow">
                </span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" ><span class="m-menu__link">
                        <span class="m-menu__link-text"></span>
                        </span>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="{{URL::to('principalMessageList')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Principal Message</span></a>
                    </li>
                    <!--<li class="m-menu__item " aria-haspopup="true" >
                        <a  href="{{URL::to('departmetnHeadList')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Acamedic Incharge Message</span></a>
                    </li>-->
                </ul>
            </li>
                   <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-layers"></i>
                    <span class="m-menu__link-text" style="font-family: monospace; font-weight: bold;">NOTICE</span><i class="m-menu__ver-arrow la la-angle-right"></i>
                </a><div class="m-menu__submenu "><span class="m-menu__arrow">
                </span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" ><span class="m-menu__link">
                        <span class="m-menu__link-text"></span>
                        </span>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="{{URL::to('webAddNotice')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Add Notice</span></a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="{{URL::to('webManageNotice')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Manage Notice</span></a>
                    </li>

                </ul>
            </li>
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-layers"></i>
                    <span class="m-menu__link-text" style="font-family: monospace; font-weight: bold;">LATEST NEWS & EVENT</span><i class="m-menu__ver-arrow la la-angle-right"></i>
                </a><div class="m-menu__submenu "><span class="m-menu__arrow">
                </span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" ><span class="m-menu__link">
                        <span class="m-menu__link-text"></span>
                        </span>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="{{URL::to('webLatestNewsAndEventAdd')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Add News & Event</span></a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="{{URL::to('webManageLatestNewsAndEvent')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Manage News & Event</span></a>
                    </li>
                </ul>
            </li>

            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-layers"></i>
                    <span class="m-menu__link-text" style="font-family: monospace; font-weight: bold;">PHOTO GALLARY</span><i class="m-menu__ver-arrow la la-angle-right"></i>
                </a><div class="m-menu__submenu "><span class="m-menu__arrow">
                </span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" ><span class="m-menu__link">
                        <span class="m-menu__link-text"></span>
                        </span>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="{{URL::to('webAddPhotoGallary')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Add Photo Gallary</span></a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="{{URL::to('webManagePhotoGallary')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Manage Photo Gallary</span></a>
                    </li>
                </ul>
            </li>

            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-layers"></i>
                    <span class="m-menu__link-text" style="font-family: monospace; font-weight: bold;">SECTION</span><i class="m-menu__ver-arrow la la-angle-right"></i>
                </a><div class="m-menu__submenu "><span class="m-menu__arrow">
                </span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" ><span class="m-menu__link">
                        <span class="m-menu__link-text"></span>
                        </span>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="{{URL::to('addWebSection')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Add Section</span></a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="{{URL::to('manageWebSection')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Manage Section</span></a>
                    </li>
                </ul>
            </li>

            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-layers"></i>
                    <span class="m-menu__link-text" style="font-family: monospace; font-weight: bold;">SECTION SUBMENU</span><i class="m-menu__ver-arrow la la-angle-right"></i>
                </a><div class="m-menu__submenu "><span class="m-menu__arrow">
                </span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" ><span class="m-menu__link">
                        <span class="m-menu__link-text"></span>
                        </span>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="{{URL::to('addWebSectionSubMenu')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Add Section Submenu</span></a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="{{URL::to('manageWebSection')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Manage Section</span></a>
                    </li>
                </ul>
            </li>

            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-layers"></i>
                    <span class="m-menu__link-text" style="font-family: monospace; font-weight: bold;">SECTION INFO</span><i class="m-menu__ver-arrow la la-angle-right"></i>
                </a><div class="m-menu__submenu "><span class="m-menu__arrow">
                </span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" ><span class="m-menu__link">
                        <span class="m-menu__link-text"></span>
                        </span>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="{{URL::to('addWebSectionPageInfo')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Add Info</span></a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="{{URL::to('manageWebSectionPageInfo')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Manage Info</span></a>
                    </li>
                </ul>
            </li>

        </ul>          
    </div>
    <!-- END: Aside Menu -->
</div>
<div class="m-grid__item m-grid__item--fluid m-wrapper">                     
 <div class="m-content">
 @yield ('content')
 <!-- END DYNAMIC DONTENT -->
</div>
<!-- END: side bar -->                            
<!-- end:: Body -->            
<!-- begin::Footer -->
<footer class="m-grid__item m-footer ">
    <div class="m-container m-container--fluid m-container--full-height m-page__container">
        <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
            <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                <span class="m-footer__copyright">
                    <?php echo date("Y") ;?> &copy; <a href="#" class="m-link">SPI</a>
                </span>
            </div>
            <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                    <li class="m-nav__item">
                        <a href="http://asianitinc.com/" class="m-nav__link">
                            <span class="m-nav__link-text"><strong>Developed By : ASIAN IT INC</strong></span>
                        </a>
                    </li>
                </ul>
            </div>  
        </div>
    </div>
</footer>
<!-- end::Footer -->      
</div>
<!-- end:: Page -->
    <!--- quick sidebar area -->

    <!--- end quick sidebar area -->

    <!-- begin::Scroll Top -->
    <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
        <i class="la la-arrow-up"></i>
    </div>
    <!-- end::Scroll Top -->            
    <script src="{{URL::to('public/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{URL::to('public/assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
<script src="{{URL::to('public/assets/demo/default/custom/components/datatables/base/html-table.js')}}" type="text/javascript"></script>
<script src="{{URL::to('public/assets/demo/default/custom/components/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{URL::to('public/assets/demo/default/custom/components/forms/widgets/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
<script src="{{URL::to('public/assets/demo/default/custom/components/forms/widgets/select2.js')}}" type="text/javascript"></script>
<script src="{{URL::to('public/assets/demo/default/custom/components/forms/widgets/bootstrap-timepicker.js')}}" type="text/javascript"></script>
    </body>
</html>
 @yield ('js')