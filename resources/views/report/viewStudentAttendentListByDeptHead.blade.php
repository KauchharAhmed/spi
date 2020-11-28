@extends('admin.masterDepartmentHead')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">

<div class="m-portlet__body">
    <div class="m-portlet">
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                      <div class="row">
                    
                          <!--<div class="row table-responsive">
                      <div class="col-md-8">
                      </div> 
                      <div class="col-md-2">
                           <a href="{{URL::to('printTeacherTodayAttendentReport')}}">
                            <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                          </a>
                      </div>  
                    </div>-->
                    <table>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">YEAR</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo $year;?></td>
                      </tr>
                       <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">DEPARTMENT</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo $dept_info->departmentName;?></td>
                      </tr>
                       <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">SHIFT</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo $shift_info->shiftName;?></td>
                      </tr>
                        <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">SEMESTER</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo $semister_info->semisterName;?></td>
                      </tr>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">SECTION</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo $section_info->section_name;?></td>
                      </tr>
                        <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">TOTAL STUDENTS</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo count($result) + count($absent_result);?></td>
                      </tr>
                          <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">PRESENTS</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: green;padding: 5px 5px 0px; "><?php echo count($result);?></td>
                      </tr>  
                         <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">ABSENTS</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: red;padding: 5px 5px 0px; "><?php echo count($absent_result);?></td>
                      </tr> 
                    </table>
                  
                    <table style="margin-left:250px;">
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">TEACHER PHOTO</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; ">
                          <?php if(!empty($teacher_info->image)):?>
                          <img height="80" width="80" style="border-radius: 50%;" src="{{ URL::to($teacher_info->image) }}">
                        <?php else:?>
                          <span style="color:red">Photo Not Uploaded</span>
                        <?php endif;?>
                        </td>
                      </tr>
                       <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">TEACHER NAME</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo $teacher_info->name; ?></td>
                      </tr>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">SUBJECT</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo $subject_info->subject_name; ?></td>
                      </tr>
                        <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">CLASS DATE / DAY</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo date('d M Y',strtotime($rcdate)).' / '.date('l',strtotime($rcdate)) ?></td>
                      </tr>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">CLASS TIME</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo date('h:i:s a',strtotime($routine_query->from)).' - '.date('h:i:s a',strtotime($routine_query->to)) ?></td>
                      </tr>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">STATUS</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; ">
                         <?php if($teacher_leave_count > '0'):?>
                          <span style="color:orange">TEACHER IN LEAVE</span>
                      <?php elseif($teacher_traning_count > '0'):?>
                        <span style="color:blue">TEACHER IN TRAINING</span>
                      <?php else:?>
                          <?php
                          // get teacher present or absent
                          $teacher_status_count = DB::table('teacher_attendent')->where('teacherId',$teacher_info->id)->where('year',$year)->where('class_no',$routine_id)->where('created_at',$rcdate)->where('status',1)->count();
                          if($teacher_status_count == '0'):?>
                          <span style="color:red;">TEACHER ABSENT IN CLASS</span>
                          <?php else:?>
                            <span style="color:green;">TEACHER PRESENT IN CLASS</span>
                            <br/>
                            <?php 
                                 $teacher_status_enter = DB::table('teacher_attendent')->where('teacherId',$teacher_info->id)->where('year',$year)->where('class_no',$routine_id)->where('created_at',$rcdate)->where('status',1)->first();
                                   $teacher_status_OUT_count = DB::table('teacher_attendent')->where('teacherId',$teacher_info->id)->where('year',$year)->where('class_no',$routine_id)->where('created_at',$rcdate)->where('status',2)->count();
                                    $teacher_status_OUT = DB::table('teacher_attendent')->where('teacherId',$teacher_info->id)->where('year',$year)->where('class_no',$routine_id)->where('created_at',$rcdate)->where('status',2)->first();

                              ?>
                              <span style="color:green"> IN <?php  echo date('h:i:s a',strtotime($teacher_status_enter->enter_time)) ;?> 

                                <?php if($teacher_status_OUT_count == '1'){?>

                                -
                                   <span style="color:green"> OUT <?php  echo date('h:i:s a',strtotime($teacher_status_OUT->out_time)) ;?>
                                    <?php } ?>
                          <?php endif;?>
                          <?php endif;?>
                        </td>
                      </tr>
                    </table>
                      <!--begin: Search Form -->
                   <!--end: Search Form -->
                   <div class="container">
                    <table class="table table-bordered table-hover table-responsive" id="html_table">

                  <thead>
                    <tr>
                      <th colspan="8" style="font-size: 17px;background-color: #156d48;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>PRESENT STUDENTS LIST (TOTAL <?php echo count($result);?>)</strong></th>
                    </tr>
                    <tr>    
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SL NO</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>PHOTO</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>NAME</strong></th>
                    <th style="font-size: 17px; background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ROLL</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>REG</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ENTER TIME</strong></th>
                     <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>STATUS</strong></th>  
                       <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>MOBILE</strong></th>      
            </tr>
            </thead>
                               <tbody>
                                <?php 
                                $i = 1 ;
                                foreach ($result as $value) { ?>
                                 <tr>
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $i++ ;?></td>
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php if(!empty($value->studentImage)){?>
                                      <img width="80" height="80" style="border-radius:50%" src="{{URL::to($value->studentImage)}}">
                                      <?php } ?>
                                    </td>   
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->studentName;?></td>    
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->roll;?></td> 
                                     <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->registration;?></td>
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php echo $value->enter_time;?>
                                    </td>
                                        <td style="font-size: 15px;color: green;text-align: center;">
                                      <strong>P</strong>
                                    </td>
                                      <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->studentMobile;?></td>
                                </tr>
                                <?php } ?>
                              </tbody>
                        </table>
                   </div>
                   <div class="container">
                    <table class="table table-bordered table-hover table-responsive" id="html_table">
                  <thead>
                    <tr>
                      <th colspan="8" style="font-size: 17px;background-color: #7d0b0b;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENTS STUDENTS LIST(TOTAL <?php echo count($absent_result);?>)</strong></th>
                    </tr
                    <tr>    
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SL NO</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>PHOTO</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>NAME</strong></th>
                    <th style="font-size: 17px; background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ROLL</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>REG</strong></th>
                     <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>STATUS</strong></th>  
                       <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>MOBILE</strong></th>      
            </tr>
            </thead>
                               <tbody>
                                <?php 
                                $i = 1 ;
                                foreach ($absent_result as $value) { ?>
                                 <tr>
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $i++ ;?></td>
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php if(!empty($value->studentImage)){?>
                                      <img width="80" height="80" style="border-radius:50%" src="{{URL::to($value->studentImage)}}">
                                      <?php } ?>
                                    </td>   
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->studentName;?></td>    
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->roll;?></td> 
                                     <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->registration;?></td>

                                        <td style="font-size: 15px;color: red;text-align: center;">
                                      <strong>A</strong>
                                    </td>
                                      <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->studentMobile;?></td>
                                </tr>
                                <?php } ?>
                              </tbody>
                        </table>
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
