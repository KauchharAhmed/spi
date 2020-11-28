<div class="m-portlet__body">
    <div class="m-portlet">
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                      <div class="row" >
                            {!! Form::open(['url' =>'printDailyStudentDoorReport','method' => 'post']) !!}
                            <input type="hidden" name="year" value="<?php echo $year; ?>">
                            <input type="hidden" name="shift" value="<?php echo $shift; ?>">
                             <input type="hidden" name="semister" value="<?php echo $semister; ?>">
                             <input type="hidden" name="section" value="<?php echo $section; ?>">
                             <input type="hidden" name="dept" value="<?php echo $dept; ?>">
                             <input type="hidden" name="from" value="<?php echo $from; ?>">
                        <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                         {!! Form::close() !!}
                         &nbsp;  &nbsp;  &nbsp;

                            {!! Form::open(['url' =>'csvDailyStudentDoorReport','method' => 'post']) !!}
                            <input type="hidden" name="year" value="<?php echo $year; ?>">
                            <input type="hidden" name="shift" value="<?php echo $shift; ?>">
                             <input type="hidden" name="semister" value="<?php echo $semister; ?>">
                             <input type="hidden" name="section" value="<?php echo $section; ?>">
                             <input type="hidden" name="dept" value="<?php echo $dept; ?>">
                             <input type="hidden" name="from" value="<?php echo $from; ?>">
                        <button class="btn btn-success m-r-5 m-b-5" > <i class="fa fa-file-excel-o" style="padding-right:10px"></i>EXCEL (CSV)</button>
                         {!! Form::close() !!}
                      <div class="row table-responsive">
                      <div class="col-md-8">
                      </div> 
                      <div class="col-md-2">
                      </div>  
                    </div>
                        <div class="col-md-3"></div>
                          <div class="col-md-8"><strong style="font-size:20px;color: black;font-weight: bold">DAILY STUDENT DOOR ATTENDENT REPORT</strong></div>
                      <div class="col-md-1"></div> 
                    <table>
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
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">DATE</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo date('d M Y',strtotime($from)); ?></td>
                      </tr>

                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">TOTAL STUDENTS</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo $count_student; ?></td>
                      </tr>

                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;color:green;">PRESENTS</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="color:green;font-family: tahoma;font-weight:bold;font-size: 16px;padding: 5px 5px 0px; "> <?php echo $total_present_student; ?></td>
                      </tr>
                        <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;color:red">ABSENTS</td>
                        <td style="color:red ;font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color:red;padding: 5px 5px 0px; "> <?php echo $count_student - $total_present_student; ?></td>
                      </tr>
                    </table>
                  <div class="container">
                  <table class="table table-bordered table-hover table-responsive" id="html_table">
                  <thead>
                    <tr>    
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SL</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>NAME</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ROLL</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>REG</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>MOBILE</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>STATUS</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>FIRST ENTER  </strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ENTER NUMBER</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ENTER TIMES</strong></th>
                   </tr>
                  </thead>
                               <?php $i = 1 ; foreach ($result as $value) { ?>
                               <tbody>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php
                                      $student_info = DB::table('students')->where('id',$value->studentID)->first();
                                      echo  $student_info->studentName ;
                                      ?>
                                    </td> 
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $value->roll ; ?></td>   
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $value->registration ; ?></td>  
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo  $student_info->studentMobile ;?></td>  
                                    <td>
                                      <?php
                                      // get studen status present or absent
                                      $present        = DB::table('tbl_door_log')
                                      ->where('student_id',$value->studentID)
                                      ->where('enter_date',$from)
                                      ->orderBy('enter_time','asc')
                                      ->get();
                                      $prsent_status =  count($present) ;
                                      if($prsent_status > 0):?>
                                         <span style="color:green"> <?php echo "PRESENT";?>
                                         <?php else:?>
                                          <span style="color:red"> <?php echo "ABSENT";?>
                                     <?php endif;?>
                                    </td> 
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                       <?php if($prsent_status > 0){ ?>
                                       <span style="color:green">   <?php $present_time = DB::table('tbl_door_log')
                                      ->where('student_id',$value->studentID)
                                      ->where('enter_date',$from)
                                      ->orderBy('enter_time','asc')
                                      ->first();
                                      echo date('h:i:s a',strtotime($present_time->enter_time));
                                      ?>
                                      <?php } ?>
                                    </td>   
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                        <span style="color:green"><?php  if($prsent_status > 0){echo $prsent_status;}?></span>
                                    </td>  
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php if($prsent_status > 0){ ?>
                                      <?php foreach ($present as $present_time_value) { ?>
                                      <span style="color:green">
                                        <?php echo date('h:i:s a',strtotime($present_time_value->enter_time)).' , '; ?>
                                      </span> 
                                      <?php } ?>
                                      <?php } ?>
                                    </td>   
                                </tr>
                              </tbody>
                            <?php } ?>
                        </table>
                      </div>
                         </div>
                    </div>
                </div>
                <!--end::Section-->
            </div>
            <!--end::Form-->
        </div>
    </div>