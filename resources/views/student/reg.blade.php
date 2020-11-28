
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
    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page" style="margin: 50px;">
<!-- BEGIN: Header -->

<!-- END: Header -->  
<!-- Start sidebar -->   

<div class="m-grid__item m-grid__item--fluid m-wrapper">                     
 <div class="m-content">

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
<!-- end sesssion message-->
    <div class="12">
    <center><h2 style="color:green;"><strong>SIRAJGANJ POLYTECHNIC INSTITUTE</strong></h2></center>
        <center><b><h3>Student Registration Form For Digital ID Card</h3></b></center>
        <div class="row">
       <div class="col-md-12" style="color:red;text-align: center;"><p>For Any Problem. Please Call To : 01729661197</p><p>শুধুমাত্র যাদের তথ্য পাওয়া যায় নি তাদের রেজিস্ট্রেশন করতে হবে</p><a href="{{URL::to('checkReg')}}"><p>আপনাকে রেজিস্ট্রেশন করতে হবে কি না জানতে ক্লিক করুন</p></a></div>
   </div>
   
        <div class="row" style="display: none;">
       <div class="col-md-12" style="color:red;text-align: center;font-size:30px"><p> ৪ ঠা আগষ্ট হতে ডিজিটাল আইডি কার্ডের রেজিস্ট্রেশন শুরু হবে ।  </p></div>
   </div>
   <?//php //exit();?>
   
   
   
   
    <div style="background-color: #e7f3fe;
    border-left: 6px solid #2196F3; margin-bottom: 15px;
    padding: 4px 12px;">
    <strong> Must Be Filled Input Box Which Symbol Is <span style="color:red ; padding-left:5px;" >*</span>
    </strong>                                  
    </div>
    </div>
                {!! Form::open(['url' =>'regInfo','method' => 'post','files' => true]) !!}
                <div class="row" style="background: #6cbfc3">
                <div class="col-md-6">
                    <h3><strong>ACADEMIC INFORMATION</strong></h3>
                <div class="form-group m-form__group">
                        <label for="full_name">Department Name <span style="color:red ; padding-left:30px;" >*</span></label>
                        <select class="form-control m-input m-input--square" name="department" id="dept" required="">
                         <option value="">Select Department</option>
                            <?php foreach ($row as $row_value) { ?>
                                <option value="<?php echo $row_value->id ; ?>"><?php echo $row_value->departmentName;?></option>
                            <?php } ?>
                            
                        </select> 
                    </div>
                        <div class="form-group m-form__group" style="display: none;">
                        <label for="full_name">Year </label>
                        <input type="text" class="form-control m-input m-input--square" value="<?php echo '2019';?>" disabled> 
                         <input type="hidden" class="form-control m-input m-input--square" name="year" value="<?php echo '2019';?>">  
                    </div>
                    <div class="form-group m-form__group" style="display: none;">
                        <label for="full_name">Enter RfId Number</label> 
                        <input type="text" class="form-control m-input m-input--square" name="rfid">
                    </div> 
                       <div class="form-group m-form__group">
                        <label for="full_name">Session </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" id="session" name="session" required="">
                            <option value="">Select Session</option>
                            <?php foreach ($session as $sesssions) { ?>
                                <option value="<?php echo $sesssions->id ; ?>"><?php echo $sesssions->sessionName;?></option>
                            <?php } ?>
                            
                        </select> 
                    </div>

                        <div class="form-group m-form__group">
                        <label for="full_name">Shift Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" id="shift_id" name="shift" required="">
                            <option value="">Select Shift</option>
                            <?php foreach ($shift as  $shifts) { ?>
                                <option value="<?php echo $shifts->id ; ?>"><?php echo $shifts->shiftName;?></option>
                            <?php } ?>
                            
                        </select> 
                    </div>

                    <div class="form-group m-form__group">
                        <label for="full_name">Semister Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" id="semister_id" name="semister" required="">
                            <option value="">Select Semister</option>
                            <?php foreach ($result as  $value) { ?>
                                <option value="<?php echo $value->id ; ?>"><?php echo $value->semisterName;?></option>
                            <?php } ?>
                        </select> 
                    </div>
                      <div class="form-group m-form__group">
                        <label for="full_name">Group Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" id="section_id" name="section" required="">
                        </select>
                            
                    </div>
                        <div class="form-group m-form__group">
                        <label for="full_name">Board Roll</label><span style="color:red ; padding-left:30px;" >*</span> 
                        <input type="number" class="form-control m-input m-input--square" name="roll" required="" >
                    </div> 
                       <div class="form-group m-form__group">
                        <label for="full_name">Confirm Board Roll</label><span style="color:red ; padding-left:30px;" >*</span> 
                        <input type="number" class="form-control m-input m-input--square" name="confirm_roll" required="">
                    </div> 
                        <div class="form-group m-form__group">
                        <label for="full_name">Registration Number</label><span style="color:red ; padding-left:30px;" >*</span> 
                        <input type="number" class="form-control m-input m-input--square" name="registration" re>
                    </div>


          
                </div>

                <div class="col-md-6">
                 <h3><strong>BASIC INFORMATION</strong></h3>
                      <div class="form-group m-form__group">
                        <label for="full_name">Student Name </label><span style="color:red ; padding-left:30px;" >*</span> 
                        <input type="text" class="form-control m-input m-input--square" name="student_name" required="" >
                    </div>

                        <div class="form-group m-form__group">
                        <label for="full_name">Father Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="text" class="form-control m-input m-input--square" name="father_name" required="">
                    </div>
                     <div class="form-group m-form__group">
                        <label for="full_name">Mother Name </label>
                        <input type="text" class="form-control m-input m-input--square" name="mother_name">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="full_name">Student Email (If It) </label>
                        <input type="email" class="form-control m-input m-input--square" name="email">
                    </div>
                      <div class="form-group m-form__group">
                        <label for="full_name">Student Mobile (Must Be 11 Digits)<span style="color:red ; padding-left:30px;" >*</span> </label> 
                        <input type="number" class="form-control m-input m-input--square" name="student_mobile" required="">
                    </div>
                        <div class="form-group m-form__group">
                        <label for="full_name">Guardian Mobile (Must Be 11 Digits)<span style="color:red ; padding-left:30px;" >*</span> </label>
                        <input type="number" class="form-control m-input m-input--square" name="parents_mobile" required="">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="full_name">Surecash Mobile No (Must Be 12 Digits)<span style="color:red ; padding-left:30px;" >*</span> </label> 
                        <input type="number" class="form-control m-input m-input--square" name="surecash_mobile" required="">
                    </div>
                        <div class="form-group m-form__group">
                        <label for="full_name">Date Of Birth </label>
                        <input type="number" class="form-control m-input m-input--square" name="date_of_birth" >
                    </div>

                      <div class="row">
                        <!-- first col 6 -->
                        <div class="col-md-6">
                        <div class="form-group m-form__group">
                        <label for="full_name">Sex </label>
                        <select class="form-control m-input m-input--square" name="sex">
                            <option value="">Select Sex</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                </div>
                <!-- end first col-6----->
                  <!-- second col 6 -->
                  <div class="col-md-6">
                      <div class="form-group m-form__group">
                        <label for="full_name">Blood Group </label>
                         <select class="form-control m-input m-input--square" name="blood_group">
                        <option value="">Select Blood Group</option>
                        <option value="A+">A+</option>
                        <option value="A−">A−</option>
                        <option value="B+">B+</option>
                        <option value="B−">B−</option>
                        <option value="O+">O+</option>
                        <option value="O−">O−</option>
                        <option value="AB+">AB+</option>
                        <option value="AB−">AB−</option>
                        </select>
                    </div>
                </div>
               
                   </div>

                    <div class="form-group m-form__group">
                        <label for="phone_number">Present Address</label>
                        <textarea type="text" class="form-control m-input m-input--square" name="present_address"></textarea>
                    </div>
                      <div class="form-group m-form__group">
                        <label for="phone_number">Permanent Address</label>
                        <textarea type="text" class="form-control m-input m-input--square" name="permanent_address"></textarea>
                    </div>
                   
                    <div class="form-group m-form__group" style="display: none;">
                        <label for="phone_number">Remarks</label>
                        <textarea type="text" class="form-control m-input m-input--square" name="remarks"></textarea>
                    </div>

                    <div class="form-group m-form__group">
                        <label for="phone_number">Picture<span style="color:red ; padding-left:30px;" >*</span> &nbsp;&nbsp;&nbsp;<span style="color: green">Must Be 100 KB And Format jpg,jpeg,png</span> </label>
                        <input type="file" class="form-control m-input m-input--square" name="image" required>
                    </div>

                    <div class="form-group m-form__group">
                       <input type="submit" class="btn btn-primary" style="margin-top: 25px;" value="REGISTRATION"/>
                    </div>

                </div>
                    
            </div>
                    
                </div>
                {!! Form::close() !!}
         
        <!--end: Search Form -->
        <!--begin: Datatable -->
 </div>
</div>              
</div>
</div>
</div>
</div>


 <!-- END DYNAMIC DONTENT -->
</div>
<!-- END: side bar -->                            
<!-- end:: Body -->            
<!-- begin::Footer -->
<div class="row">
    <div class="col-md-12"><a href="http://asianitinc.com/"><p style="font-size: 18px;text-align: center;">Developed By Asian It Inc.</p></a></div>
</div>
<!-- end::Footer -->      
</div>
<!-- end:: Page -->
    <!-- quick sidebar area -->

    <!-- end quick sidebar area -->

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
    </body>
</html>
<script>
    $('#dept').change(function(e){
    e.preventDefault();
    var dept = $(this).val();
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    $.ajax({
        'url':"{{ url('/getSectionByDepartment') }}",
        'type':'post',
        'dataType':'text',
        data:{  
        dept:dept,
        },
         success:function(data)
         {
          $('#section_id').html(data);
        }
        });
       });
</script>
