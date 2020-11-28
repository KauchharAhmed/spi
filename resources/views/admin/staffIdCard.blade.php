@extends('admin.masterAdmin')
@section('content')
<style type="text/css">

.scholl_name {
        background: black !important;
        color: white !important;
        
    }

 @media print and (color){
  -webkit-print-color-adjust: exact;
  print-color-adjust: exact;
}

 @media print{
  .scholl_name {
    -webkit-print-color-adjust: exact;
    background: black !important;
        
    }

  .student_color{
    -webkit-print-color-adjust: exact;
    background: black !important;
    padding-top: 10px;
    padding-bottom:10px
  }
  }

  html {zoom: 80%;}
 }

  

/*    @page:first {
  size: portrait;  
  margin-bottom: -500px;
  
  
}*/
/*  @page {
  size: portrait;  
  margin-top: 100px;
}*/

</style>
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                     PRINT ID CARD
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
               <div class="col-xs-4">
        
                 <?php if($print_status == '0'):?>
                                    <a class="btn btn-primary" href="{{URL::to('printTeacherIdCard/'.$data->id)}}">PRINT</a>
                                    <br/>
                                    <?php else:?>
                                      <div class="row">
                                        <span style="color: red;">Staff ID Card Already Printed</span>
                                      </div>
                                      <div class="row">
                                      Again Print
                                      <input type="checkbox" name="" id="pChk" class="form-control">
                                    </div>
                                      <span id="checkButton">
                                        <a class="btn btn-primary" href="{{URL::to('printTeacherIdCard/'.$data->id)}}">PRINT</a>
                                     </span>
                                     <br/>
                                    <?php endif;?>


                           <h6 class="scholl_name" style="padding-top: 10px;padding-bottom:10px"><center><span style="color:white !important;font-weight: bold;">SIRAJGANJ POLYTECHNIC INSTITUTE</span></center></h6>
                           <span><center>Fakirtola , Sirajganj</center></span>
                           <span><center>Est-2004</center></span>
                           <center>
                           <img style="display:none;" width="70px;" style="height:80px" src="images/<?php //echo $setting->showSetting()->image;?>">
                           <img width="80px;" style="height:80px" src="{{URL::to($data->image) }}" width="100" height="50">
                           <img style="display: none;" width="70px;" style="height:80px" src="images/<?php //echo $value1->studentImage;?>">
                           </center>
                           <br/>
                            <h6 class="student_color" style="background: black;  padding-top: 10px;padding-bottom:10px">
                              <center><span style="color:white !important;"><?php echo $data->name;?></span></center></h6>
                            <table>
                              <tr>
                                <td style="font-size:10px;">ID No.</td>
                                <td style="font-size:10px;"><?php echo $data->rfidCardNo ; ?></td>
                                <td style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dept</td>
                                <td style="font-size:10px;">
                                  <?php if($dept != '0'){
                                   echo $dept->departmentName; 
                                 }
                                   ?>
                                    </td>
                              </tr>
                                <tr>
                                <td style="font-size:10px;">Degi</td>
                                <td style="font-size:10px;"><?php
                                echo $data->degi;  ?> 
                                  </td>

                                <td style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile</td>
                                <td style="font-size:10px;"><?php
                                echo $data->mobile;  ?> </td>
                              </tr>
                                <tr>
                                <td style="font-size:10px;">Email</td>
                                <td style="font-size:10px;"><?php
                                echo $data->email;  ?> 
                                  </td>

                                <td style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="font-size:10px;"> </td>
                              </tr>
    
     
                              </tr>
                            </table>
                            <div class="row" style="margin-top: 35px;
    font-size: 9px;
    padding-left: 8px;
">
                            Powered By : Asian IT Inc
                           </div>
                           </div>


</div>




  </div>
         
        <!--end: Search Form -->
        <!--begin: Datatable -->
   <!-- </div>-->
</div> 
<span id="get_content"></span>             
</div>
</div>
</div>
</div>
@endsection
@section('js')
<script>
   $('#checkButton').hide();
    $('#pChk').click(function() {
        $('#checkButton').toggle();
      
    });

</script>
  @endsection