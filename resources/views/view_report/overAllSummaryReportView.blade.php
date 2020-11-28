<div class="m-portlet__body">
    <div class="m-portlet">
           
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                      <div class="row">       
                      <div class="row table-responsive">
                      <div class="col-md-8">
                      </div> 
                      <div class="col-md-2">
                        {!! Form::open(['url' =>'printOverAllSummaryReport','method' => 'post']) !!}
                            <input type="hidden" name="from" value="<?php echo $from; ?>">
                            <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                         {!! Form::close() !!}
                      </div>  
                    </div>
                        <div class="col-md-4"></div>
                            <div class="col-md-6"><strong style="font-size:20px;color: black;font-weight: bold">OVER ALL SUMMARY REPORT </strong></div>
                            <div class="col-md-2"></div> 

                    <table>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">DATE</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo date('d M Y',strtotime($from));?></td>
                      </tr>
                        <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">DAY</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo date('l',strtotime($from));?></td>
                      </tr> 
                    </table>

                      <!--begin: Search Form -->
                  <!--end: Search Form -->
                  <div class="container">
                    <table class="table table-bordered table-hover table-responsive" id="html_table" 
                    >
                    <thead>
                    <tr>    
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL STAFFS</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ENTER INTO CAMPUS</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>LEAVE & TRAINING</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENTS</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ENTER INTO CAMPUS  % </strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>LEAVE %</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENTS %</strong></th>
     
            </tr>
            </thead>
                              
                               <tbody>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $total_staff_count;?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $total_staff_enter_into_campus;?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $total_staff_leave_count;?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php 
                                     $absents_without_leave = $total_staff_count - $total_staff_leave_count ; 
                                     $final_absent = $absents_without_leave - $total_staff_enter_into_campus;  echo $final_absent;
                                    ?>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                 <?php echo number_format(($total_staff_enter_into_campus*100)/$total_staff_count,2).' % ';
                                 ?>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                  <?php echo number_format( ($total_staff_leave_count*100)/$total_staff_count).' % ';
                                  ?>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php echo number_format(($final_absent*100)/$total_staff_count).' % ';
                                  ?>
                                    </td>
                                </tr>  
                      </tbody>
                      <?php if($attendent_holiday_count > 0){ ?>
                         <span style="color:red;"> <?php echo date('d M Y',strtotime($from));?> CLASS HOLIDAY</span> 
                      <?php } ?>
                      <?php if($attendent_holiday_count == '0'){?>
                    <thead>
                    <tr>    
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL TEACHERS</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ENTER INTO CLASS</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>LEAVE & TRAINING</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENTS</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ENTER INTO CLASS  % </strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>LEAVE %</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENTS %</strong></th>
            </tr>
            </thead>
                              
                               <tbody>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $total_teacher_count;?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $total_teacher_attendent_in_class;?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $total_teacher_leave_count;?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php 
                                     $absents_without_teacher_leave = $total_teacher_count - $total_teacher_leave_count ; 
                                     $final_teacher_absent = $absents_without_teacher_leave - $total_teacher_attendent_in_class;  echo $final_teacher_absent;
                                    ?>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php echo number_format(($total_teacher_attendent_in_class*100)/$total_teacher_count).' % ';
                                      ?>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                       <?php echo number_format(($total_teacher_leave_count*100)/$total_teacher_count).' % ';
                                      ?>
                                      
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                       <?php echo number_format(($final_teacher_absent*100)/$total_teacher_count).' % ';
                                      ?>
                                    </td>
                                </tr>  
                      </tbody>
                         <thead>
                    <tr>    
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL CLASSES</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL CLASS HELD</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL CLASS NOT HELD</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL CLASS HELD  % </strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL CLASS NOT HELD %</strong></th>
     
            </tr>
            </thead>
                              
                               <tbody>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $total_class_count;?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $teacher_taken_total_class_class;?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php $total_class_not_held_is = $total_class_count - $teacher_taken_total_class_class;
                                    echo $total_class_not_held_is ;
                                    ?> </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php echo number_format(($teacher_taken_total_class_class*100)/$total_class_count).' % ';
                                      ?>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php echo number_format(($total_class_not_held_is*100)/$total_class_count).' % ';
                                      ?>
                                    </td>
                                </tr>  
                      </tbody>
                      <thead>
                    <tr>    
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL CLASS HOURS</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL CLASS HOURS HELD</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL CLASS HOURS NOT HELD</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL CLASS HOURS HELD %</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL CLASS HOURS NOT HELD %</strong></th>
            </tr>
            </thead>
                              
                               <tbody>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php
                                      $total_hours_class_sum     = 0 ; 
                                      //$total_minitutes_class_sum = 0 ;

                                      foreach ($total_class_hour_in_routine as $routine_time_value) {
                                        $end_routine_to        = $routine_time_value->to ;
                                        $start_routine_form    = $routine_time_value->from ;

        
                                        
                                        // $checkTime             = strtotime($start_routine_form);
                                        // $loginTime             = strtotime($end_routine_to);

                                  $checkTime_hours               = date('H:i', strtotime($start_routine_form));
                                  $loginTime_hours               = date('H:i', strtotime($end_routine_to));

                                  // $checkTime_minituets           = date('i', strtotime($start_routine_form));
                                  // $loginTime_minituets           = date('i', strtotime($end_routine_to));

                                      $rotuine_end_time  = explode(':', $loginTime_hours);
                                      $total_end_time    = ($rotuine_end_time[0]*60) + ($rotuine_end_time[1]);

                                      $rotuine_start_time  = explode(':', $checkTime_hours);
                                      $total_start_time    = ($rotuine_start_time[0]*60) + ($rotuine_start_time[1]);

                                      $diff_time_is = $total_end_time -  $total_start_time ;

                                      $dividers_hours = ($diff_time_is / 60) ;

                                     $dividate_explode = explode('.',$dividers_hours);
                                     $total_hours_dividate = $dividate_explode[0];

                                     $total_hours_miniute  = $total_hours_dividate * 60 ;

                                     $different_hours_modulas = ($diff_time_is % 60) ;

                                     $summ_total_min = $total_hours_miniute + $different_hours_modulas ;

                                    $total_hours_class_sum     = $total_hours_class_sum + $summ_total_min  ;

                                      }
                                      $final_total_class_hours = floor($total_hours_class_sum * 60 / 3600) . gmdate(":i:s", $total_hours_class_sum * 60 % 3600);
                                      echo $final_total_class_hours ;

                                      ?>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                    <?php
                                     $total_class_hours_held_class_sum = 0 ;
                                       foreach ($total_hours_class_held_query as $total_class_held_value) {
                                           $start_teacher_class_form    = $total_class_held_value->enter_time ;
                                          $teacher_out_from_class_count = DB::table('teacher_attendent')->where('created_at',$from)->where('status',2)->where('type',3)->where('class_no',$total_class_held_value->class_no)->count();
                                           if($teacher_out_from_class_count != '0'){

                                        $teacher_out_from_class = DB::table('teacher_attendent')->where('created_at',$from)->where('status',2)->where('type',3)->where('class_no',$total_class_held_value->class_no)->first();
                                        $end_teacher_class_to        = $teacher_out_from_class->out_time ;
                                        $teache_out_time_is          = strtotime($end_teacher_class_to);
                                      }else{
                                         $teache_out_time_is          = strtotime($start_teacher_class_form);
                                      }
                                
                                        $teacher_in_time_is          = strtotime($start_teacher_class_form);

                                        $diff_class_held_time       =  $teache_out_time_is - $teacher_in_time_is;
                                        $total_class_hours_held_class_sum = $total_class_hours_held_class_sum + $diff_class_held_time;
                                       }

                                       echo gmdate("H:i:s", $total_class_hours_held_class_sum);
                                    ?>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php 
                                       $total_class_this_day_hours      = $total_hours_class_sum * 60;
                                      $total_class_this_day_held_hours = $total_class_hours_held_class_sum ;
                                      $total_class_hours_not_held      =  $total_class_this_day_hours - $total_class_this_day_held_hours ;

                                      
                    
                                       echo floor($total_class_hours_not_held / 3600) . gmdate(":i:s", $total_class_hours_not_held % 3600);
                                      ?>
                                    </td>
                                     <td style="font-size: 20px;color: black;text-align: center;">
                                       <?php echo number_format(($total_class_hours_held_class_sum*100)/$total_class_this_day_hours).' % ';
                                      ?>
                                     </td>

                                     <td style="font-size: 20px;color: black;text-align: center;">
                                        <?php echo number_format(($total_class_hours_not_held*100)/$total_class_this_day_hours).' % ';
                                      ?>
                                     </td>
                                </tr>  
                      </tbody>
                      <?php }?>
                      <thead>
                    <tr>    
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL STUDENTS</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ENTER INTO CAMPUS</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENTS</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ENTER INTO CAMPUS  % </strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENTS %</strong></th>
     
            </tr>
            </thead>
                              
                               <tbody>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $total_student_count;?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $total_student_enter_into_campus;?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php 
                                     $final_student_campus_absent = $total_student_count - $total_student_enter_into_campus;  echo $final_student_campus_absent;
                                    ?>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                       <?php echo number_format(($total_student_enter_into_campus*100)/$total_student_count).' % ';
                                      ?>
                                      
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                         <?php echo number_format(($final_student_campus_absent*100)/$total_student_count).' % ';
                                      ?>
                                    </td>
                                </tr>  
                      </tbody>
                    <?php if($attendent_holiday_count == '0'){?>
                    <thead>
                    <tr>    
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL STUDENTS</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ENTER INTO CLASS</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENTS</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ENTER INTO CLASS  % </strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENTS %</strong></th>
     
            </tr>
            </thead>
                              
                               <tbody>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $total_student_count;?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $total_student_enter_into_class;?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php 
                                     $final_student_class_absent = $total_student_count - $total_student_enter_into_class;  echo $final_student_class_absent;
                                    ?>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                        <?php echo number_format(($total_student_enter_into_class*100)/$total_student_count).' % ';
                                    ?>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                        <?php echo number_format(($final_student_class_absent*100)/$total_student_count).' % ';
                                      ?>
                                    </td>
                                </tr>  
       
                      </tbody>
                      <?php } ?>
                      </table>
                    </div>
                    </div>
                </div>
                <!--end::Section-->
            </div>
            <!--end::Form-->
        </div>
    </div>