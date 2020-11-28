<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
class StudentattendentController extends Controller
{
  public function studentAttendent(Request $request)
  {
  	$card_no   		  = $request->card_number;
  	// get student id by card number from student tables
  	$studentIdCount = DB::table('students')->where('rfIdNumber',$card_no)->count();
      if($studentIdCount == 0){
      // now will go to new function
      // for teacher attendetn
      return Redirect::to('teacherAttendent/'.$card_no);
      exit();
    }
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
  	$rcdate              = date('Y/m/d');
  	$current_time        = date("H:i").':00';
  	$get_current_day     = date("l");
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
  	if($check_count>0){
  		// already attendent given
  		return Redirect::to('/');
  		exit();
  	}
 // collect attendece of this class
 $data=array();
$data['studentId']		= $student_id ;
$data['session_id']		= $session ;
$data['year']			    = $year ;
$data['shift_id']		  = $shift ; 
$data['dept_id']		  = $department ;
$data['semister_id']	= $semister ; 
$data['section_id']   = $section ;
$data['day']			    = $current_day ;
$data['class_no']		  = $class_id ;
$data['roll']			    = $roll ;
$data['enter_time']		= $current_time ;
$data['created_at']		= $rcdate ;
$take_attendent       = DB::table('student_attendent')->insert($data);
if($take_attendent){
return Redirect::to('/');
 exit();
}else{
return Redirect::to('/');
 exit();
}
}
// teacher attendent
public function teacherAttendent($card_no)
{
  date_default_timezone_set('Asia/Dhaka');
    $rcdate              = date('Y/m/d');
    $current_time        = date("H:i").':00';
    $get_current_day     = date("l");
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
    if($check_count == 0){
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
}elseif($check_count == 1){
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
}else{
  return Redirect::to('/');
  exit();
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
}
