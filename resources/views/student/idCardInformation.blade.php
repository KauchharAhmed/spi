@extends('admin.masterDepartmentHead')
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
                                    <a class="btn btn-primary" href="{{URL::to('printIdCard/'.$data->id. '/' .$shiftID. '/' .$semisterID)}}">PRINT</a>
                                    <br/>
                                    <?php else:?>
                                      <div class="row">
                                        <span style="color: red;">This Student ID Card Already Printed</span>
                                      </div>
                                      <div class="row">
                                      Again Print
                                      <input type="checkbox" name="" id="pChk" class="form-control">
                                    </div>
                                      <span id="checkButton">
                                        <a class="btn btn-primary" href="{{URL::to('printIdCard/'.$data->id. '/' .$shiftID. '/' .$semisterID)}}">PRINT</a>
                                     </span>
                                     <br/>
                                    <?php endif;?>
                           <h6 class="scholl_name" style="padding-top: 10px;padding-bottom:10px;background-color: #2d3caf !important"><center><span style="color:white !important;font-weight: bold;">SIRAJGANJ POLYTECHNIC INSTITUTE</span></center></h6>
                              <center>                                
                                <img width="50" src="{{URL::to('images/bd_logo.png') }}">

                            Fakirtola , Sirajganj ,

                           Est-2004
                           <img width="50" height="50" src="{{URL::to('images/spi_logo.jpg') }}">
                           </center>

                      <center>
                           <img style="display:none;" width="70px;" style="height:80px" src="images/<?php //echo $setting->showSetting()->image;?>">
                           <img width="80px;" style="height:80px" src="{{URL::to($data->studentImage) }}" width="100" height="50">
                           <img style="display: none;" width="70px;" style="height:80px" src="images/<?php //echo $value1->studentImage;?>">
                           </center>

                              <center>
                           <img style="display:none;" width="70px;" style="height:80px" src="images/<?php //echo $setting->showSetting()->image;?>">
                
                           <img style="width: 85px;height: 15px; padding-bottom: 3px;" src="data:image/png;base64,{{DNS1D::getBarcodePNG($data->roll, 'C39')}}" alt="barcode" />

                           <img style="display: none;" width="70px;" style="height:80px" src="images/<?php //echo $value1->studentImage;?>">
                           </center>


                            <h6 class="student_color" style="padding-top: 10px;padding-bottom:10px;">
                              <center><span style="color:black !important;font-weight: bolder;text-transform:uppercase;"><?php echo $data->studentName;?></span></center></h6>
                            <table>
                              <tr>
                                <td style="font-size:10px;">Id No.</td>
                                <td style="font-size:10px;"><?php echo "S-".$data->id ; ?></td>
                                <td style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Session</td>
                                <td style="font-size:10px;"><?php echo $data->sessionName;  ?>
                                    </td>
                              </tr>
                                <tr>
                                <td style="font-size:10px;">Shift</td>
                                <td style="font-size:10px;"><?php
                                echo $data->shiftName;  ?> 
                                  </td>

                                <td style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dept</td>
                                <td style="font-size:10px;"><?php
                                echo $data->departmentName;  ?> </td>
                              </tr>
                                <tr>
                                <td style="font-size:10px;">Roll</td>
                                <td style="font-size:10px;"><?php
                                echo $data->roll;  ?> 
                                  </td>

                                <td style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reg</td>
                                <td style="font-size:10px;"><?php
                                echo $data->registration;  ?> </td>
                              </tr>
                                 <tr>
                                <td style="font-size:10px;">Section</td>
                                <td style="font-size:10px;"><?php
                                echo $data->section_name;  ?> 
                                  </td>

                                <td style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B.Group</td>
                                <td style="font-size:10px;"><?php
                                echo $data->studentReligion;  ?> </td>
                              </tr>
                                <tr>
                                <td style="font-size:10px;">F.Name</td>
                                <td style="font-size:10px;" colspan="3"><?php echo $data->fatherName ; ?></td>
                              </tr>
                               <tr>
                                <td style="font-size:10px;">Mobile</td>
                                <td style="font-size:10px;"><?php echo $data->studentMobile ; ?></td>
                                </tr>

                                  <tr>
                                <td style="font-size:10px;">

                                </td>
                                  <tr>
                                <td style="font-size:10px;"><span style="color:red;">Last Validity Date</span></td>
                                <td style="font-size:10px;" colspan="3"> <span style="color:red;"><?php
                                $explode = explode('-', $data->sessionName);
                                $last_year = $explode['1'];
                                $last_validate = $last_year + 3 ;
                                $last_validate_is = "31 DECEMBER 20".$last_validate;
                                echo $last_validate_is;

                                ?></span></td>
                              </tr>
                                </tr>
                               
                            </table>
                            <center>                                
                              <table>
                                <tr>
                                  <td><img width="50" height="25" style="margin-right: 109px;" src="{{URL::to('images/bd_logo.png') }}"></td>
                                  <td><img width="50" height="25" src="{{URL::to('images/spi_logo.jpg') }}"></td>
                                </tr>
                                <tr>
                                  <td><span style="border-top:1px solid #000;">Principal</span></td>
                                  <td><span style="border-top:1px solid #000;">Dept. Head</span></td>
                                </tr>
                              </table>
                            </center>

                            <div class="row" style="margin-top:5px;
    font-size: 9px;
    padding-left: 15px;
}">
                           Software Developed By : Asian IT Inc (asianitinc.com)
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