<?php 
$valset=true;
if (isset($_GET['device_id'])) {
    $device_id= $_GET['device_id'];
}
else{
    $valset=false;
}
if (isset($_GET['card_no'])) {
    $card_no= $_GET['card_no'];
    
}else{
    $valset=false;
}
if (isset($_GET['date_time'])) {
    $date_time= $_GET['date_time'];
     $date_time= $date_time-21600;
}else{
    $valset=false;
}
  $event_log  = DB::table('event_log')->where('device_id',$device_id)->where('card_no',$card_no)->where('date_time',$date_time)->count();
  if($event_log > 0){
      echo "Reapet";
      exit();
  }

  $data_event = array();
  $data_event['device_id'] = $device_id ;
  $data_event['card_no']   = $card_no ;
  $data_event['date_time'] = $date_time ;
  $insert_event = DB::table('event_log')->insert($data_event);
  // only for security door
  #------------------------------ SECURITY DOR-------------------------#
    date_default_timezone_set('Asia/Dhaka');
    $crated_date_is           = date('Y-m-d');
    $door_rcdate              = date('Y-m-d',$date_time);
    $door_time                = date('H:i',$date_time);
    $door_current_time        = $door_time.':00';
    $door_get_current_day     = date("l",$date_time);

    $doorone = '1';
   if($doorone == '1'){
    $door_studentIdCount = DB::table('students')->where('rfIdNumber',$card_no)->count();
    if($door_studentIdCount > 0){
      // student activites
     $door_studentIdQuery = DB::table('students')->where('rfIdNumber',$card_no)->first();
     $door_student_id     = $door_studentIdQuery->id;
     // get current semister and student info
     $door_student_info = DB::table('student')->where('studentID',$door_student_id)->where('semister_status',1)->first();
     $door_student_year         = $door_student_info->year;
     $door_student_shift_id     = $door_student_info->shift_id;
     $door_student_dept_id      = $door_student_info->dept_id;
     $door_student_semister_id  = $door_student_info->semister_id;
     $door_student_section_id   = $door_student_info->section_id;
     $door_student_roll_is      = $door_student_info->roll;
     // get office start value by shift id
     $office_start_time_query = DB::table('shift')->where('id',$door_student_shift_id)->first();
     $office_start_time_is    =  $office_start_time_query->office_start ;

     $door_data_student = array();
     $door_data_student['device_number']  = $doorone;
     $door_data_student['card_no']        = $card_no;
     $door_data_student['type']           = 2;
     $door_data_student['student_id']     = $door_student_id ;
     $door_data_student['year']           = $door_student_year ;
     $door_data_student['dep_id']         = $door_student_dept_id ;
     $door_data_student['shift_id']       = $door_student_shift_id ;
     $door_data_student['semister_id']    = $door_student_semister_id ;
     $door_data_student['section_id']     = $door_student_section_id  ; 
     $door_data_student['roll']           = $door_student_roll_is ; 
     $door_data_student['enter_day']      = $door_get_current_day ;
     $door_data_student['enter_time']     = $door_current_time;
     $door_data_student['office_start']   = $office_start_time_is;
     $door_data_student['enter_date']     = $door_rcdate ; 
     $door_data_student['created_at']     = $crated_date_is;
     DB::table('tbl_door_log')->insert($door_data_student); 
    }else{
      // othet  stafff
        // match card number 
      $door_card_count     = DB::table('users')->where('rfidCardNo',$card_no)->count();
    // card number does not exits in table
     if($door_card_count == 0){
      return Redirect::to('/');
      exit();
     }
      $door_staff_Info = DB::table('users')->where('rfidCardNo',$card_no)->first();
      $door_staff_id   = $door_staff_Info->id;
      $door_staff_type = $door_staff_Info->type;
      $door_staff_dept = $door_staff_Info->dept;
      $office_start_time_query = DB::table('shift')->orderBy('office_start','asc')->first();
      $office_start_time_is    =  $office_start_time_query->office_start ;
      $door_data_student = array();
     $door_data_student['device_number']  = $doorone;
     $door_data_student['card_no']        = $card_no;
     $door_data_student['type']           = 1;
     $door_data_student['user_type']      = $door_staff_type;
     $door_data_student['user_id']        = $door_staff_id ;
     $door_data_student['dep_id']         = $door_staff_dept ;
     $door_data_student['enter_day']      = $door_get_current_day ;
     $door_data_student['enter_time']     = $door_current_time;
     $door_data_student['office_start']   = $office_start_time_is;
     $door_data_student['enter_date']     = $door_rcdate ; 
     $door_data_student['created_at']     = $crated_date_is;
     DB::table('tbl_door_log')->insert($door_data_student);
    }
    exit();
   }
  #------------------------------ END SECURITY DOR---------------------#
  #----------------------------- ATTENDENCE----------------------------#
    // get student id by card number from student tables
    $studentIdCount = DB::table('students')->where('rfIdNumber',$card_no)->count();
      if($studentIdCount > 0){
    $studentId      = DB::table('students')->where('rfIdNumber',$card_no)->first();
    $student_id     = $studentId->id ; 
    // now get  year current semister and roll of this student 
    // semister status 1 means active semister
    $studentInfo    = DB::table('student')->where('studentID',$student_id)->where('semister_status',1)->first();
    $session        = $studentInfo->session ;
    $year           = $studentInfo->year ;
    $shift          = $studentInfo->shift_id ;
    $department     = $studentInfo->dept_id ;
    $semister       = $studentInfo->semister_id ;
    $section        = $studentInfo->section_id ;
    $roll           = $studentInfo->roll ;
    // get the current time and day
    date_default_timezone_set('Asia/Dhaka');
    $rcdate              = date('Y-m-d',$date_time);
    $time = date('H:i',$date_time);
    $current_time = $time.':00';
    $get_current_day     = date("l",$date_time);
    if($get_current_day =='Saturday'){
      $current_day = 1 ;
    }
    if($get_current_day =='Sunday'){
      $current_day = 2 ;
    }
    if($get_current_day =='Monday'){
      $current_day = 3 ;
    }
    if($get_current_day =='Tuesday'){
      $current_day = 4 ;
    }
    if($get_current_day =='Wednesday'){
      $current_day = 5 ;
    }
    if($get_current_day =='Thursday'){
      $current_day = 6 ;
    }
    if($get_current_day =='Friday'){
      $current_day = 7 ;
    }
  // count the class
      $class_count = DB::table('routine')
    ->where('dept_id',$department)
    ->where('year',$year)
    ->where('shift_id',$shift)
    ->where('semister_id',$semister)
    ->where('section_id',$section)
    ->where('day',$current_day)
    ->where('from', '<=', $current_time)
    ->where('to', '>=', $current_time)
    ->count();

    $get_class = DB::table('routine')
    ->where('dept_id',$department)
    ->where('year',$year)
    ->where('shift_id',$shift)
    ->where('semister_id',$semister)
    ->where('section_id',$section)
    ->where('day',$current_day)
    ->where('from', '<=', $current_time)
    ->where('to', '>=', $current_time)
    ->first();
   if($class_count > 0){
     $class_id  = $get_class->id;
   }else{
    return Redirect::to('/');
    exit();
   }
    // check that the attendence already given
     $check_count = DB::table('student_attendent')
    ->where('dept_id',$department)
    ->where('year',$year)
    ->where('shift_id',$shift)
    ->where('semister_id',$semister)
    ->where('section_id',$section)
    ->where('day',$current_day)
    ->where('class_no',$class_id)
    ->where('created_at',$rcdate)
    ->where('roll',$roll)
    ->count();
    if($check_count > 0){
      // already attendent given
      return Redirect::to('/');
      exit();
    }
 // collect attendece of this class
 $data=array();
$data['studentId']    = $student_id ;
$data['session_id']   = $session ;
$data['year']         = $year ;
$data['shift_id']     = $shift ; 
$data['dept_id']      = $department ;
$data['semister_id']  = $semister ; 
$data['section_id']   = $section ;
$data['day']          = $current_day ;
$data['class_no']     = $class_id ;
$data['roll']         = $roll ;
$data['enter_time']   = $current_time ;
$data['created_at']   = $rcdate ;
$take_attendent       = DB::table('student_attendent')->insert($data);

if($take_attendent){
return Redirect::to('/');
 exit();
}else{
return Redirect::to('/');
 exit();
}

}else{
// teacher attendent
    date_default_timezone_set('Asia/Dhaka');
    $rcdate              = date('Y-m-d',$date_time);
    $time = date('H:i',$date_time);
    $current_time = $time.':00';
    $get_current_day     = date("l",$date_time);
    $year      = date('Y');
    if($get_current_day =='Saturday'){
      $current_day = 1 ;
    }
    if($get_current_day =='Sunday'){
      $current_day = 2 ;
    }
    if($get_current_day =='Monday'){
      $current_day = 3 ;
    }
    if($get_current_day =='Tuesday'){
      $current_day = 4 ;
    }
    if($get_current_day =='Wednesday'){
      $current_day = 5 ;
    }
    if($get_current_day =='Thursday'){
      $current_day = 6 ;
    }
    if($get_current_day =='Friday'){
      $current_day = 7 ;
    }
   // match card number 
  $count     = DB::table('users')->where('rfidCardNo',$card_no)->count();
  // card number does not exits in table
  if($count == 0){
    return Redirect::to('/');
    exit();
  }

   $teacherInfo = DB::table('users')->where('rfidCardNo',$card_no)->first();
   $teacher_type  = $teacherInfo->type;
   $teacher_id    = $teacherInfo->id;
   if($teacher_type == 3 OR $teacher_type == 4 ){
   // get current semister id
   $current_semister = DB::table('semister')->where('status',1)->get();

   // query only for teacher
   if($teacher_type == 3){
   foreach ($current_semister as $current_semisterr) {
    $current_semister_id  = $current_semisterr->id;
    $class_count = DB::table('routine')
    ->where('year',$year)
    ->where('semister_id',$current_semister_id)
    ->where('day',$current_day)
    ->where('from', '<=', $current_time)
    ->where('to', '>=', $current_time)
    ->where('teacher_id',$teacher_id)
    ->limit(1)
    ->get();
    // filtering completed
    // then get class id
     foreach ($class_count as $class_no) {
    
    }
    }
  }// tearch type end bracked
  if($teacher_type == 4){
   foreach ($current_semister as $current_semisterr) {
    $current_semister_id  = $current_semisterr->id;
    $class_count = DB::table('routine')
    ->where('year',$year)
    ->where('semister_id',$current_semister_id)
    ->where('day',$current_day)
    ->where('from', '<=', $current_time)
    ->where('to', '>=', $current_time)
    ->where('craft',$teacher_id)
    ->limit(1)
    ->get();
    // filtering completed
    // then get class id
     foreach ($class_count as $class_no) {
    
    }
    }
  }// craft type end
  if(isset($class_no->id)){
     $year          = $class_no->year ;
     $shift         = $class_no->shift_id ;
     $dept_id       = $class_no->dept_id ;
     $semister      = $class_no->semister_id ;
     $section       = $class_no->section_id ;
     $day           = $class_no->day ;
     $class_id      = $class_no->id ;
    // insert query
    $check_count = DB::table('teacher_attendent')
    ->where('year',$year)
    ->where('class_no',$class_no->id)
    ->where('teacherId',$teacher_id)
    ->where('day',$current_day)
    ->where('created_at',$rcdate)
    ->count();

       $check_count_out_time = DB::table('teacher_attendent')
    ->where('year',$year)
    ->where('class_no',$class_no->id)
    ->where('teacherId',$teacher_id)
    ->where('day',$current_day)
    ->where('created_at',$rcdate)
    ->where('status', 0)
    ->count();
    
    
    
    if($check_count === 0){
      // type 1 enter in class
      // type 1 == teacher
$data=array();
$data['teacherId']    = $teacher_id ;
$data['type']         = $teacher_type ;
$data['year']         = $year ;
$data['shift_id']     = $shift ; 
$data['dept_id']      = $dept_id ;
$data['semister_id']  = $semister ;
$data['section_id']   = $section; 
$data['day']          = $day ;
$data['class_no']     = $class_id ;
$data['status']       = 1 ;
$data['enter_time']   = $current_time ;
$data['created_at']   = $rcdate ;
$take_attendent       = DB::table('teacher_attendent')->insert($data);
exit();
}
elseif($check_count == 1){
$data['teacherId']    = $teacher_id ;
$data['type']         = $teacher_type ;
$data['year']         = $year ;
$data['shift_id']     = $shift ; 
$data['dept_id']      = $dept_id ;
$data['semister_id']  = $semister ;
$data['section_id']   = $section;  
$data['day']          = $day ;
$data['class_no']     = $class_id ;
$data['status']       = 2 ;
$data['out_time']     = $current_time ;
$data['created_at']   = $rcdate ;
$take_attendent       = DB::table('teacher_attendent')->insert($data);
exit();
 }
else{
        echo "Reapet";
//   return Redirect::to('/');
//   exit();
}
   }else{
    return Redirect::to('/');
    exit();

   }
   }
   // teacher type end bracked
  else{
    // not card holder as a teacher
    return Redirect::to('/');
    exit();
   }
  
}

?>