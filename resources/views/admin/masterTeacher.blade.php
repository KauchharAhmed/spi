<?php
$teacher_id    = Session::get('teacher_id');
$type          = Session::get('type');
$teacher_image = Session::get('image');
if($teacher_id == null && $type != '3'){
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
<div class="m-stack__item m-brand  m-brand--skin-dark" style="background: ##2a5631">
    <div class="m-stack m-stack--ver m-stack--general">
        <div class="m-stack__item m-stack__item--middle m-brand__logo">
            <a href="index9bfb.html?page=index&amp;demo=default" class="m-brand__logo-wrapper">
            <!--<img alt="" src="assets/demo/default/media/img/logo/logo_default_dark.png"/>-->
            <h6 style="color:white;font-weight: bold;font-family: monospace;font-size: 22px;">TEACHER</h6>
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
<div class="m-stack__item m-stack__item--fluid m-header-head" style="background: #406f23" id="m_header_nav">
<!-- BEGIN: Horizontal Menu -->
<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
<!-- END: Horizontal Menu --> 
<!-- BEGIN: Topbar -->
<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general" style="background: #406f23">
    <div class="m-stack__item m-topbar__nav-wrapper">
    <ul class="m-topbar__nav m-nav m-nav--inline"> 
<li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center  m-dropdown--mobile-full-width" data-dropdown-toggle="click" data-dropdown-persistent="true" style="padding-top:20px;"> 
</li>
      <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center  m-dropdown--mobile-full-width" data-dropdown-toggle="click" data-dropdown-persistent="true" style="padding-top:20px;color:white;font-weight: bold;font-family: monospace;">
         <?php if(!empty(Session::get('teacher_name')))
      {
           echo 'Welcome To Mr '. Session::get('teacher_name'); 
      }
      ?>
</li>
    <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
    <a href="#" class="m-nav__link m-dropdown__toggle">
    <span class="m-topbar__userpic">
    <?php if(!empty($teacher_image)):?>
    <img class="md-user-image" style="border-radius: 50%;" src="{{URL::to($teacher_image)}}" alt=""/>
    <?php else:?>
    <?php endif;?>
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
                        <!--<li class="m-nav__item">
                            <a href="admin/change_password/" class="m-nav__link">
                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                <span class="m-nav__link-text">Change Password</span>
                            </a>
                        </li>-->
                        <li class="m-nav__separator m-nav__separator--fit">
                        </li>
                        <li class="m-nav__item">
                            <a href="{{URL::to('teacherLogout')}}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
                            
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
<div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark" style="background: #fff;">    
    <!-- BEGIN: Aside Menu -->
    <div 
        id="m_ver_menu" 
        class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " 
        data-menu-vertical="true"
         data-menu-scrollable="false" data-menu-dropdown-timeout="500"  
        > 
         <span><img width="50" height="40" src="{{URL::to('images/spi_logo.jpg') }}"> </span>  <span style="font-size: 10px;font-weight: bold;">SIRAJGANJ POLYTECHNNIC INSTITUTE</span> 
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow " style="background: #fff;">
            <li class="m-menu__item " aria-haspopup="true" >
                <a  href="{{URL::to('superadminDashboard')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-line-graph">
                    
                </i><span class="m-menu__link-title">  
                    <span class="m-menu__link-wrap">    
                      <span class="m-menu__link-text" style="font-family: monospace; font-weight: bold;">DASHBOARD</span>    
                        <span class="m-menu__link-badge">
                            </span>  </span></span></a></li>

                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-layers"></i>
                    <span class="m-menu__link-text" style="font-family: monospace; font-weight: bold;">TODAY CLASS</span><i class="m-menu__ver-arrow la la-angle-right"></i>
                </a><div class="m-menu__submenu "><span class="m-menu__arrow">
                </span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" ><span class="m-menu__link">
                        <span class="m-menu__link-text"></span>
                    </span>
                </li>
             <?php  
              $result = DB::table('shift')->get();
              ?>
               <?php foreach ($result as $value) { ?>
                    <li class="m-menu__item " aria-haspopup="true" >
                    <a  href="{{URL::to('teacherTodayClass/'.$value->id)}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;"><?php echo $value->shiftName ; ?></span></a>
                </li>
            <?php } ?>
               
                    
            </ul>
        </li>


                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-layers"></i>
                    <span class="m-menu__link-text" style="font-family: monospace; font-weight: bold;">LEAVE</span><i class="m-menu__ver-arrow la la-angle-right"></i>
                </a><div class="m-menu__submenu "><span class="m-menu__arrow">
                </span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" ><span class="m-menu__link">
                        <span class="m-menu__link-text"></span>
                    </span>
                </li>
                 <li class="m-menu__item " aria-haspopup="true" >
                    <a  href="{{URL::to('requestLeave')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Leave Request</span></a>
                </li>
                  <li class="m-menu__item " aria-haspopup="true" >
                    <a  href="{{URL::to('leaveRequestList')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">All Leave Request</span></a>
                </li>
                    
            </ul>
        </li>
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-layers"></i>
                    <span class="m-menu__link-text" style="font-family: monospace; font-weight: bold;">RESULT</span><i class="m-menu__ver-arrow la la-angle-right"></i>
                </a><div class="m-menu__submenu "><span class="m-menu__arrow">
                </span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" ><span class="m-menu__link">
                        <span class="m-menu__link-text"></span>
                    </span>
                </li>
                 <li class="m-menu__item " aria-haspopup="true" >
                    <a  href="{{URL::to('teacherSearchToAddResult')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text" style="font-family: monospace;">Add Result Marks</span></a>
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
    <!---- quick sidebar area --------->

    <!---- end quick sidebar area --------->

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