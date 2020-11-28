<?php 
if(isset($_GET['allow']) && isset($_GET['id'])){
$allow = $_GET['allow'];
$id    = $_GET['id'];
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
      <script src="{{URL::to('public/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{URL::to('public/assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
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
                        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                        </span>
                            <!--<img src="<?php //echo base_url() ; ?>assets/default/media/img/logo/logo.jpg" alt="">-->
                            <h2 class="">
                                
                            </h2>
                        <br/>
                    </div>
                </div>
            </div>
            <!--begin::Form-->
            
                <div class="m-portlet__body" style="background: aliceblue;">
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">CARD NUMBER</label>
                        <input type="type" class="form-control m-input m-input--square" name="card_number" value="<?php echo $id; ?>" required="">  
                    </div>
                   
                   
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit" style="background: aliceblue;">
                    <div class="m-form__actions">
                        <button type="submit"  class="btn btn-primary" id="send_button" style="margin-left: 19PX;
    MARGIN-BOTTOM: 16PX;">Enter Into Class</button>
                        
                    </div>
                </div>
            <!--end::Form-->            
        </div>
        </div>
      </div>
    
    <a href="{{URL::to('studentLogin')}}">Student Login </a>
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
<script>
    // $(document).ready(function(){
    //      setInterval(function(){ 
    //          var card_number = $('[name="card_number"]').val();
    //          if(card_number == ""){

    //          }else{
    //             $.ajaxSetup({
    //                 headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 }
    //             });
    //             $.ajax({
    //             'url':"{{url('/studentAttendent') }}",
    //             'type':'post',
    //             'dataType':'text',
    //             data:{  
    //             card_number:card_number
    //             },
    //             success:function(data)
    //             {
    //                 location.href='/';
    //                 console.log(data);
    //             }
    //             });                
    //          }
    //      }, 1000);
    // })
</script>