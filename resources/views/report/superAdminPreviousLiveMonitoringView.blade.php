<?php
$year = $from_year;
$current_time        = date("H:i").':00';
$rcdate              = $previous_date;
// get day
$day_no  = date('D', strtotime($rcdate));

if($day_no == 'Sat'){
 $day = '1';
}elseif($day_no == 'Sun'){
  $day = '2';
}elseif($day_no == 'Mon'){
     $day = '3';
}elseif($day_no == 'Tue'){
     $day = '4';
}elseif($day_no == 'Wed'){
     $day = '5';
}elseif($day_no == 'Thu'){
     $day = '6';
}elseif($day_no == 'Fri'){
     $day = '7';
}
?>
 <span style="background-color: #943924f7;text-align: center;color: white;font-weight: bold;font-family: monospace; padding: 15px; margin-left: 29px;">ATTENDENT DATE : <?php echo date('d M Y',strtotime($rcdate)) ; ?> / DAY : <?php echo date('l',strtotime($rcdate))  ?></span>
<div class="m-grid__item m-grid__item--fluid m-wrapper">                        <!-- BEGIN: Subheader -->
<div class="m-content">
<div class="m-portlet ">
    <div class="m-portlet__body  m-portlet__body--no-padding">
        <div class="row m-row--no-padding m-row--col-separator-xl">
            <?php foreach ($result as  $value) { ?>
            <div class="col-md-12">
                <!--begin::New Feedbacks-->
                <div class="m-widget24">
                     <div class="m-widget24__item">
                       <center>
                        <h4 class="m-widget24__title" style="font-family: tahoma;font-weight: bold;font-size:30px; text-transform: uppercase;">
                           <?php echo $value->departmentName.' Department' ;?>
                        </h4>
                      </center>
                        <br>
                          <?php
                          // get department section
                          $section = DB::table('section')->where('dept_id',$value->id)->get();
                         // divided by section
                        foreach ($section as $sectionn) { ?>   
                       <table style="font-family: tahoma;" class="table table-bordered table-hover table-responsive">
                        <span style="background-color: #156d48;text-align: center;color: white;font-weight: bold;font-family: monospace; padding: 15px;">
                          <?php 
                             echo "SECTION ".$sectionn->section_name ;
                           ?> 
                       </span>
                       <hr/ style="background: red;">
                       <?php
                        // get the current semeister that status is 1
                       $semister = DB::table('semister')->where('status',1)->get();
                       ?>
                       <?php foreach ($semister as $semisterr) { ?>
                        <tr>
                        <td style="background-color: beige; color: black;font-weight: bold;width: 150px;border: 2px solid green;">
                        <?php 
                        echo $semisterr->semisterName.'<br/>' ;
          $student_count = DB::table('student')
        ->where('year', $year)
        ->where('shift_id', $shift_id)
        ->where('dept_id', $value->id)
        ->where('semister_id', $semisterr->id)
        ->where('section_id',$sectionn->id)
        ->where('status', 0)
        ->count();
        echo "Total Stu"."<br/>";
        echo $student_count ;
                        ?> 
                        </td> 

                         <?php
                         // get today routine

        $routine = DB::table('routine')
        ->join('shift', 'routine.shift_id', '=', 'shift.id')
        ->join('semister', 'routine.semister_id', '=', 'semister.id')
        ->join('section', 'routine.section_id', '=', 'section.id')
        ->join('subject', 'routine.subject_id', '=', 'subject.id')
        ->join('users', 'routine.teacher_id', '=', 'users.id')
        ->select('routine.*','users.name','shift.shiftName','semister.semisterName','subject.subject_name','users.name','users.image')
        ->where('routine.year', $year)
        ->where('routine.dept_id', $value->id)
        ->where('routine.shift_id', $shift_id)
        ->where('routine.semister_id', $semisterr->id)
         ->where('routine.section_id', $sectionn->id)
        ->where('routine.day', $day)
        ->orderBy('routine.from','asc')
        ->get();
      $get_count = DB::table('routine')
    ->where('dept_id',$value->id)
    ->where('year',$year)
    ->where('shift_id',$shift_id)
    ->where('semister_id',$semisterr->id)
    ->where('section_id',$sectionn->id)
    ->where('day',$day)
    ->where('from', '<=', $current_time)
    ->where('to', '>=', $current_time)
    ->limit(1)
    ->count();
    $get_class = DB::table('routine')
    ->where('dept_id',$value->id)
    ->where('year',$year)
    ->where('shift_id',$shift_id)
    ->where('semister_id',$semisterr->id)
    ->where('section_id',$sectionn->id)
    ->where('day',$day)
    ->where('from', '<=', $current_time)
    ->where('to', '>=', $current_time)
    ->limit(1)
    ->get();
    //echo $get_class->id ;
    foreach ($get_class as $get_classs) {
     
    }
    if($get_count == '0'){

    }else{
      $class_id = $get_classs->id ;
    }
    ?>
       <?php foreach ($routine as $routinee) { ?>
         <td style="border: 2px solid green;background-color: <?php 
         if($get_count !=0){if($class_id == $routinee->id){}else{}} ?>
         ">
         
            <?php echo date('h:i A', strtotime($routinee->from)).' - '.date('h:i A', strtotime($routinee->to)) ;
              ?>
               <br/>
            <?php 
            echo "Room: ".$routinee->room_no ;
           ?>
            <br/>
            <?php 
            echo $routinee->subject_name ;
           ?>
            <br/>
            <strong>
            Enter Stu:
            <?php 
             $student_count = DB::table('student_attendent')
             ->where('class_no', $routinee->id)
             ->where('created_at',$rcdate)
             ->count();
             echo $student_count ;
           ?>
           </strong>
            <a target="_blank" href="{{URL::to('viewStudentAttendentList/'.$routinee->id.'/'.$rcdate)}}">View</a>
            <br/>
            <?php 
             echo $routinee->name ;
            ?>
            <br/>
            <?php if(!empty($routinee->image)){?>
            <img width="50" height="50" style="border-radius:50%;" src="{{URL::to($routinee->image)}}">
            <?php } ?>
             <br/>
           <?php
              $teacher_count = DB::table('teacher_attendent')
             ->where('class_no', $routinee->id)
             ->where('created_at',$rcdate)
             ->where('type',3)
             ->count();

             $teacher_attendent = DB::table('teacher_attendent')
             ->where('class_no', $routinee->id)
             ->where('created_at',$rcdate)
             ->where('type',3)
             ->get();
             // foreach ($teacher_attendent as $teacher_attendentt) {
             //  //echo $teacher_attendentt->enter_time ;
             // }
             ?>
             <strong>
              <?php
            // get leave
            $teacher_leave_count = DB::table('tbl_leave')->where('user_id',$routinee->teacher_id)->where('final_request_from',$rcdate)->where('type_status','0')->count() ;
            $teacher_traning_count = DB::table('tbl_leave')->where('user_id',$routinee->teacher_id)->where('final_request_from',$rcdate)->where('type_status','1')->count() ;
            ?>
             <?php if($teacher_leave_count > '0'): ?>
          <span style="color:orange;">LEAVE</span> 

        <?php elseif($teacher_traning_count > '0'): ?>
          <span style="color:blue;">TRAINING</span> 
        <?php else:?>

          <?php if($teacher_count == 0):?>
            <span style="color:red;">ABSENT</span> 
              <?php 
                if($get_count !=0 AND $class_id == $routinee->id)
                  { ?>
              <!--<a href="">Send SMS To Teacher</a>-->

            <?php } ?>
          <?php else:?>
            <?php foreach ($teacher_attendent as $teacher_attendentt) { ?>
          <span style="color:green">
            <?php if($teacher_attendentt->enter_time == '00:00:00'){
          }else{
             echo "IN: ".date('h:i A', strtotime($teacher_attendentt->enter_time));}?>  <?php
             if($teacher_attendentt->out_time == '00:00:00'){

             }else{ 
             echo "OUT: ".date('h:i A', strtotime($teacher_attendentt->out_time));
           }
             ?>
              </span>
          
             <?php }?>
           <?php endif;?>
           <?php endif;?>
          </strong>



             </td>
          <?php } ?>

                       </tr>
                       <?php } ?>
                       </table>
                       <?php } ?>
                    </div>      
                </div>
                <!--end::New Feedbacks--> 
            </div>
        <?php } ?>
        </div>
    </div>
</div>

</div>

</div>
</div>
</div>

