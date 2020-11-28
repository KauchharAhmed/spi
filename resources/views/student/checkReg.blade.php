
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
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    আপনাকে রেজিস্ট্রেশন করতে হবে কি না তা জানতে আপনার বোর্ড রোল নম্বর দিয়ে সার্চ করুন
                </h3>
            </div>
        </div>
    </div>
    <!--<div class="m-portlet__body">-->
       <!--begin::Form--> 
    <div class="m-portlet__body">
        <!-- START SESSION MESSAGE -->
    <?php if(Session::get('succes') != null) { ?>
   <div class="alert alert-info alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    </button>
  <strong><?php echo Session::get('succes') ;  ?></strong>
  <?php Session::put('succes',null) ;  ?>
</div>
<?php } ?>
<?php
if(Session::get('failed') != null) { ?>
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    </button>
 <strong><?php echo Session::get('failed') ; ?></strong>
 <?php echo Session::put('failed',null) ; ?>
</div>
<?php } ?>

  @if (count($errors) > 0)
    @foreach ($errors->all() as $error)      
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    </button>
  <strong>{{ $error }}</strong>
</div>
@endforeach
@endif

           <div class="row">
             <center><h6><a href="{{URL::to('reg')}}">রেজিস্ট্রেশন করতে ক্লিক করুন</a></h6></center>
           </div>
             <div class="row">
                  <div class="col-md-6">
                  <label for="phone_number">Given Your Board Roll</label>
                  <input style="border-color:GREENYELLOW" type="number" name="roll" class="form-control m-input" id="roll">
                      </div>
                      
                <br/><br/><br/>
                <div class="col-md-2">
                       <label for="phone_number"></label>
                       <button type="submit" id="send_button" class="form-control  btn btn-primary" style="margin-top:6px">SEARCH</button>             
                </div>
                </div>

            </div>
         
        <!--end: Search Form -->
        <!--begin: Datatable -->
   <!-- </div>-->
</div> 
<span id="wrong" style="color: red; font-weight: bold; font-size: 20px;"></span>   
<span id="right" style="color: green; font-weight: bold; font-size: 20px;" ></span>             
</div>
</div>
</div>
</div>
    <script src="{{URL::to('public/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{URL::to('public/assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
<script src="{{URL::to('public/assets/demo/default/custom/components/datatables/base/html-table.js')}}" type="text/javascript"></script>
<script src="{{URL::to('public/assets/demo/default/custom/components/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{URL::to('public/assets/demo/default/custom/components/forms/widgets/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
<script src="{{URL::to('public/assets/demo/default/custom/components/forms/widgets/select2.js')}}" type="text/javascript"></script>
    </body>
</html>
<script>
    $('#send_button').click(function(e){
    e.preventDefault();
    var roll        = $('#roll').val();
    if(roll == ''){
      alert('Please Given Roll');
      return false;
    }
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    $.ajax({
        'url':"{{ url('/studentVerifyCheckByStudent') }}",
        'type':'post',
        'dataType':'text',
        data:{  
        roll:roll 
        },
         success:function(data)
         {
          if(data =='f1'){
          $('#wrong').text('আপনাকে রেজিস্ট্রেশন করতে হবে না। ধন্যবাদ');
          $('#right').text('');
          }else{
          $('#wrong').text('');
          $('#right').html("রোল নং "+roll+" , আপনাকে রেজিস্ট্রেশন করতে হবে। <a href='{{URL::to('reg')}}'>রেজিস্ট্রেশন করতে ক্লিক করুন</a>");
        }
        }
        });
       });

</script>
