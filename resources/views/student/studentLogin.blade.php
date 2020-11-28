<!DOCTYPE html>
<html lang="en" >
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8" />
    <title>SPI</title>
    <meta name="description" content="Datatable HTML table"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
    <!--begin::Web font -->
    <script src="../../../ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
      WebFont.load({
        google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
      });
    </script>
   
    <link rel="stylesheet" href="{{URL::to('public/assets/vendors/base/vendors.bundle.css')}}"/>
    <link rel="stylesheet" href="{{URL::to('public/assets/demo/default/base/style.bundle.css')}}"/>
    <link rel="stylesheet" href="{{URL::to('public/assets/demo/default/media/img/logo/favicon.ico')}}"/>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-37564768-1', 'auto');
        ga('send', 'pageview');
    </script>
</head>
    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  > 
        <!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
<!-- begin::Body -->
<!-- END: Left Aside -->                            
<div class="m-grid__item m-grid__item--fluid m-wrapper">
                                
<div class="m-content">
                    <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <div class="m-portlet m-portlet--tab" style="margin-top: 50px;">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                        </span>
                            <!--<img src="<?php //echo base_url() ; ?>assets/default/media/img/logo/logo.jpg" alt="">-->
                            <h6 class="" style="padding-top:10px;">
                                <strong>WELCOME TO SIRAJGANJ POLYTECHNIC INSTITUTE</strong>
                              
                            </h6>
                              <center>Log In To Enter Into System</center>
                        <br/>
                    </div>
                </div>
            </div>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (!empty(Session::get('login_faild')))
<div class="alert alert-danger">
<?php
$message= Session::get('login_faild');
if($message){
    echo $message;
    Session::put('login_faild',null);
    }
?>
</div>
@endif
         
            <!--begin::Form-->
            {!! Form::open(['url' => 'studentLoginProcess','method' => 'post']) !!}
                <div class="m-portlet__body" style="background: aliceblue;">

                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Mobile Number</label>
                        <input type="text" class="form-control m-input m-input--square" name="login_id" aria-describedby="emailHelp" placeholder="Enter Mobile Number" required="">  
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control m-input m-input--square" name="password" placeholder="Password" required="">
                        <span class="m-form__help">We'll never share your password with anyone else.</span>
                    </div>
                   
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit" style="background: aliceblue;">
                    <div class="m-form__actions">
                        <button type="submit" class="btn btn-primary" style="margin-left: 28PX;margin-bottom: 16PX;margin-top: 16px;">LOG IN</button>
                        <span style="margin-left: 60px;"><a href="" class="uk-float-right">Forgotten Password?</a></span>
                    </div>
                </div>
          {!! Form::close() !!}
            <!--end::Form-->            
        </div>
        </div>
      </div>
    
    </div>
</div>      
 </div>
</div>
</div>
<!-- end:: Body -->      

</div>
<!-- end:: Page -->
       
    <!-- begin::Scroll Top -->
    <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
        <i class="la la-arrow-up"></i>
    </div>
    <!-- end::Scroll Top -->            

         
    </body>
</html>