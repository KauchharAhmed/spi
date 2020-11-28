<?php
$super_admin_id = Session::get('admin_id');
$type               = Session::get('type');
if($super_admin_id == null && $type != '1'){
return Redirect::to('/admin')->send();
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Report Print</title>
	<style type="text/css">
		table.nila {
			border-collapse: collapse;
		}

		table.nila, td.nila, th.nila {
			border: 1px solid black;
			padding:7px;
		}

    .logo{
      width: 120px;
      float: left;
    }

    .address{
      padding-left: 50px;
      width: 400px;
      float: left;
      line-height: 1px;
    }

    .bd_logo{
      width: 120px;
      float: right;
    }

	</style>
</head>
<body style="font-family:arial;">

      <div class="compnayInfo" style="margin-bottom: 20px;">
        <div class="logo">
          <img src="{{URL::to('images/bd_logo.png')}}" style="width: 100px;height: 100px;">
        </div>
        <div class="address">
          <h3><?php echo $setting->full_name;?></h3>
          <P><?php echo $setting->address;?></P>
          <p>Cell:<?php echo $setting->mobile;?></p>
        </div>
        <div class="bd_logo">
          <img src="{{URL::to('images/spi_logo.jpg')}}" style="width: 100px;height: 100px;">
        </div>
      </div>
      <br>
      <center><h4 style="margin-top: 89px;"><span style="font-family:arial;border:1px solid #000;padding-top:4px;padding-bottom:4px;padding-left:27px;padding-right:27px;">OVERALL SUMMARY REPORT</span></h4></center>      
      <div class="row">
        <table>
          <tr>
            <td>Date</td>
            <td>:</td>
            <td><b><?php echo date('d M Y',strtotime($from)) ;?></b></td>
          </tr>
          <tr>
            <td>Day</td>
            <td>:</td>
            <td><b><?php echo $day_no  = date("l",strtotime($from)); ?></b></td>
          </tr>
          <tr>
            <td>Printed on</td>
            <td>:</td>
            <td><b><?php echo date('d M Y, h:i:s A');  ?></b></td>
          </tr>
        </table>

      <table width="100%" class="nila" style="font-size:14px;">
                     <thead>
                    <tr>    
                    <td class="nila"><strong>TOTAL STAFFS</strong></th>
                    <td class="nila"><strong>ENTER INTO CAMPUS</strong></th>
                    <td class="nila"><strong>LEAVE & TRAINING</strong></th>
                    <td class="nila"><strong>ABSENTS</strong></th>
                    <td class="nila"><strong>ENTER INTO CAMPUS  % </strong></th>
                    <td class="nila"><strong>LEAVE %</strong></th>
                    <td class="nila"><strong>ABSENTS %</strong></th>
     
            </tr>
            </thead>
                              
                               <tbody>
                                 <tr>
                                    <td class="nila"><?php echo $total_staff_count;?></td>
                                    <td class="nila"><?php echo $total_staff_enter_into_campus;?></td>
                                    <td class="nila"><?php echo $total_staff_leave_count;?></td>
                                    <td class="nila"><?php 
                                     $absents_without_leave = $total_staff_count - $total_staff_leave_count ; 
                                     $final_absent = $absents_without_leave - $total_staff_enter_into_campus;  echo $final_absent;
                                    ?>
                                    </td>
                                    <td class="nila">
                                 <?php echo number_format(($total_staff_enter_into_campus*100)/$total_staff_count,2).' % ';
                                 ?>
                                    </td>
                                    <td class="nila">
                                  <?php echo number_format( ($total_staff_leave_count*100)/$total_staff_count).' % ';
                                  ?>
                                    </td>
                                    <td class="nila">
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
                    <td class="nila"><strong>TOTAL TEACHERS</strong></th>
                    <td class="nila"><strong>ENTER INTO CLASS</strong></th>
                    <td class="nila"><strong>LEAVE & TRAINING</strong></th>
                    <td class="nila"><strong>ABSENTS</strong></th>
                    <td class="nila"><strong>ENTER INTO CLASS  % </strong></th>
                    <td class="nila"><strong>LEAVE %</strong></th>
                    <td class="nila"><strong>ABSENTS %</strong></th>
            </tr>
            </thead>
                              
                               <tbody>
                                 <tr>
                                    <td class="nila"><?php echo $total_teacher_count;?></td>
                                    <td class="nila"><?php echo $total_teacher_attendent_in_class;?></td>
                                    <td class="nila"><?php echo $total_teacher_leave_count;?></td>
                                    <td class="nila"><?php 
                                     $absents_without_teacher_leave = $total_teacher_count - $total_teacher_leave_count ; 
                                     $final_teacher_absent = $absents_without_teacher_leave - $total_teacher_attendent_in_class;  echo $final_teacher_absent;
                                    ?>
                                    </td>
                                    <td class="nila">
                                      <?php echo number_format(($total_teacher_attendent_in_class*100)/$total_teacher_count).' % ';
                                      ?>
                                    </td>
                                    <td class="nila">
                                       <?php echo number_format(($total_teacher_leave_count*100)/$total_teacher_count).' % ';
                                      ?>
                                      
                                    </td>
                                    <td class="nila">
                                       <?php echo number_format(($final_teacher_absent*100)/$total_teacher_count).' % ';
                                      ?>
                                    </td>
                                </tr>  
                      </tbody>
                         <thead>
                    <tr>    
                    <td class="nila"><strong>TOTAL CLASSES</strong></th>
                    <td class="nila"><strong>TOTAL CLASS HELD</strong></th>
                    <td class="nila"><strong>TOTAL CLASS NOT HELD</strong></th>
                    <td class="nila"><strong>TOTAL CLASS HELD  % </strong></th>
                    <td class="nila"><strong>TOTAL CLASS NOT HELD %</strong></th>
     
            </tr>
            </thead>
                              
                               <tbody>
                                 <tr>
                                    <td class="nila"><?php echo $total_class_count;?></td>
                                    <td class="nila"><?php echo $teacher_taken_total_class_class;?></td>
                                    <td class="nila"><?php $total_class_not_held_is = $total_class_count - $teacher_taken_total_class_class;
                                    echo $total_class_not_held_is ;
                                    ?> </td>
                                    <td class="nila">
                                      <?php echo number_format(($teacher_taken_total_class_class*100)/$total_class_count).' % ';
                                      ?>
                                    </td>
                                    <td class="nila">
                                      <?php echo number_format(($total_class_not_held_is*100)/$total_class_count).' % ';
                                      ?>
                                    </td>
                                </tr>  
                      </tbody>
                      <thead>
                    <tr>    
                    <td class="nila"><strong>TOTAL CLASS HOURS</strong></th>
                    <td class="nila"><strong>TOTAL CLASS HOURS HELD</strong></th>
                    <td class="nila"><strong>TOTAL CLASS HOURS NOT HELD</strong></th>
                    <td class="nila"><strong>TOTAL CLASS HOURS HELD %</strong></th>
                    <td class="nila"><strong>TOTAL CLASS HOURS NOT HELD %</strong></th>
            </tr>
            </thead>
                              
                               <tbody>
                                 <tr>
                                    <td class="nila">
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
                                    <td class="nila">
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
                                    <td class="nila">
                                      <?php 
                                       $total_class_this_day_hours      = $total_hours_class_sum * 60;
                                      $total_class_this_day_held_hours = $total_class_hours_held_class_sum ;
                                      $total_class_hours_not_held      =  $total_class_this_day_hours - $total_class_this_day_held_hours ;

                                      
                    
                                       echo floor($total_class_hours_not_held / 3600) . gmdate(":i:s", $total_class_hours_not_held % 3600);
                                      ?>
                                    </td>
                                     <td class="nila">
                                       <?php echo number_format(($total_class_hours_held_class_sum*100)/$total_class_this_day_hours).' % ';
                                      ?>
                                     </td>

                                     <td class="nila">
                                        <?php echo number_format(($total_class_hours_not_held*100)/$total_class_this_day_hours).' % ';
                                      ?>
                                     </td>
                                </tr>
                                    
                      </tbody>
                      <?php }?>
                      <thead>
                    <tr>    
                    <td class="nila"><strong>TOTAL STUDENTS</strong></th>
                    <td class="nila"><strong>ENTER INTO CAMPUS</strong></th>
                    <td class="nila"><strong>ABSENTS</strong></th>
                    <td class="nila"><strong>ENTER INTO CAMPUS  % </strong></th>
                    <td class="nila"><strong>ABSENTS %</strong></th>
     
            </tr>
            </thead>
                              
                               <tbody>
                                 <tr>
                                    <td class="nila"><?php echo $total_student_count;?></td>
                                    <td class="nila"><?php echo $total_student_enter_into_campus;?></td>
                                    <td class="nila"><?php 
                                     $final_student_campus_absent = $total_student_count - $total_student_enter_into_campus;  echo $final_student_campus_absent;
                                    ?>
                                    </td>
                                    <td class="nila">
                                       <?php echo number_format(($total_student_enter_into_campus*100)/$total_student_count).' % ';
                                      ?>
                                      
                                    </td>
                                    <td class="nila">
                                         <?php echo number_format(($final_student_campus_absent*100)/$total_student_count).' % ';
                                      ?>
                                    </td>
                                </tr>  
                      </tbody>
                    <?php if($attendent_holiday_count == '0'){?>
                    <thead>
                    <tr>    
                    <td class="nila"><strong>TOTAL STUDENTS</strong></th>
                    <td class="nila"><strong>ENTER INTO CLASS</strong></th>
                    <td class="nila"><strong>ABSENTS</strong></th>
                    <td class="nila"><strong>ENTER INTO CLASS  % </strong></th>
                    <td class="nila"><strong>ABSENTS %</strong></th>
     
            </tr>
            </thead>
                              
                               <tbody>
                                 <tr>
                                    <td class="nila"><?php echo $total_student_count;?></td>
                                    <td class="nila"><?php echo $total_student_enter_into_class;?></td>
                                    <td class="nila"><?php 
                                     $final_student_class_absent = $total_student_count - $total_student_enter_into_class;  echo $final_student_class_absent;
                                    ?>
                                    </td>
                                    <td class="nila">
                                        <?php echo number_format(($total_student_enter_into_class*100)/$total_student_count).' % ';
                                    ?>
                                    </td>
                                    <td class="nila">
                                        <?php echo number_format(($final_student_class_absent*100)/$total_student_count).' % ';
                                      ?>
                                    </td>
                                </tr>  
       
                      </tbody>
                      <?php } ?>
                        </table>
                    

	<script type="text/javascript">
	window.print();
	</script>
    </body>
</html>

   