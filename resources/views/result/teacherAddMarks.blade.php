@extends('admin.masterTeacher')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
  
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
                      
                        <div class="col-md-4"></div>
                            <div class="col-md-4"><strong style="font-size:20px;color: black;font-weight: bold">ADD RESULT MARKS</strong></div>
                             <div class="col-md-4"></div>
                           
                    <table>
                    <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">PROBIDHAN </td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo $porbidhan_details->probidhan_name ;  ?></td>
                      </tr>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">YEAR </td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo $year ;  ?></td>
                      </tr>
                       <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">SHIFT</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo $shift_name->shiftName ;  ?></td>
                      </tr>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">DEPARTMENT</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo $dept_name->departmentName ; ?></td>
                      </tr>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">SEMESTER</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo $semister_name->semisterName ;  ?></td>
                      </tr>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">SECTION</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo $section_name->section_name ; ?></td>
                      </tr>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">SUBJECT</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo $subject_info->subject_name ; ?> (<?php echo $subject_info->subject_code ; ?>)</td>
                      </tr>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">MARKS TYPE / MARKS</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> 
                          <?php if($marks_type == '0'){
                              echo "Mid Term Exam Marks";
                          }elseif($marks_type == '1'){
                              echo "Continious Theory Marks ";
                          }elseif($marks_type == '2'){
                              echo "Final Theory Marks";
                          }elseif($marks_type == '3'){
                              echo "Continious Practical Marks";
                          }elseif($marks_type == '4'){
                              echo " Final Practical Marks";
                          }
                          ?> / <?php echo $total_marks;?>
                        </td>
                      </tr>
                    </table>

            
            </div>
          </div>
         
        <!--end: Search Form -->
        <!--begin: Datatable -->
   <!-- </div>-->
</div> 
<div class="m-portlet__body">
    <div class="m-portlet">
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                    <!--begin: Search Form -->
                   <!--end: Search Form -->
                   <div class="container">
                     {!! Form::open(['url' =>'addTeacherMarkInfoInsert','method' => 'post','files' => true]) !!}
                    <table class="table table-bordered table-hover table-responsive" id="html_table" style="background: aliceblue;">
                  <thead>
                    <tr>    
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SL</strong></th>
                     <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>NAME</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ROLL</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;width:300px"><strong>INPUT MARKS</strong></th>
    
            </tr>
            </thead>
                               <tbody>
                                <?php $i = 1 ;
                                foreach ($result as $value) { ?>
                                 <tr>
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->studentName ; ?></td>   
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->roll ; ?></td>    
                                     <td style="font-size: 15px;color: black;text-align: center;"> 
                                       <input type="number" class="form-control m-input m-input--square" name="roll[]" value="<?php echo $value->roll ; ?>"   required="" > 
                                       <input type="number" class="form-control m-input m-input--square" name="studentId[]" value="<?php echo $value->studentID ; ?>"   required="" >
                                     <input type="number" class="form-control m-input m-input--square" name="gain_marks[]" step="any"  required="" style="width:300px" min=0.00 max=<?php echo $total_marks;?> oninput="validity.valid||(value='')">   
                                     </td>
                                </tr>
                              <?php } ?>
                              <input type="hidden" name="probidhan_id" value="<?php echo $probidhan_id ; ?>" required="">
                              <input type="hidden" name="year" value="<?php echo $year ; ?>" required="">
                              <input type="hidden" name="shift" value="<?php echo $shift ; ?>" required="">
                              <input type="hidden" name="dept" value="<?php echo $dept ; ?>" required="">
                              <input type="hidden" name="semister" value="<?php echo $semister ; ?>" required="">
                              <input type="hidden" name="section" value="<?php echo $section ; ?>" required="">
                              <input type="hidden" name="subject_id" value="<?php echo $subject_id ; ?>" required="">
                              <input type="hidden" name="marks_type" value="<?php echo $marks_type ; ?>" required="">
                              <input type="hidden" name="total_marks" value="<?php echo $total_marks ; ?>" required="">
                              </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">ADD MARKS</button>
                         {!! Form::close() !!}
                   </div>
                   </div>
                </div>
                <!--end::Section-->
            </div>
            <!--end::Form-->
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
