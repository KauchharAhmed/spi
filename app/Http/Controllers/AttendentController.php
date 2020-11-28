<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DateTime;
use DB;
use Session;

class AttendentController extends Controller
{
     /**
     * AttendentController Class Constructor
     *
     * @return \Illuminate\Http\Response
     */
    private $rcdate ;
    private $year ;
    private $department_head_id ;
    private $type ;
    private $current_time ;
    private $superadmin_id ;
    private $teacher_id ;
    public function __construct(){
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate = date('Y/m/d');
        $this->year   = date('Y');
        $this->rcdate1 = date('Y-m-d');
        $this->department_head_id = Session::get('department_head_id');
        $this->type               = Session::get('type');
        $this->current_time       = date("H:i:s");
        $this->superadmin_id      = Session::get('superadmin_id');
        $this->teacher_id            = Session::get('teacher_id'); 
    }
    // add manualy attendent
    public function manualStaffAttendent($user_id , $attendent_date)
    {
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*','department.departmentName')
        ->where('users.id',$user_id)
        ->first();
        return view('attendent.manualStaffAttendent')->with('result',$result)->with('attendent_date',$attendent_date);
    }
    // add staff manual attedent info
    public function addStaffManualAttendentInfo(Request $request)
    {
    $this->validate($request, [
    'staff_type_is'        		   => 'required',
    'staff_id_is'  		   		   => 'required',
    'staff_attendent_date_is'      => 'required',
    'enter_time'      			   => 'required',
    ]);
      $staff_type_is 		    = trim($request->staff_type_is);
      $staff_id_is 				= trim($request->staff_id_is);
      $dept_id 				    = trim($request->dept_id);
      $staff_attendent_date_is  = trim($request->staff_attendent_date_is);
      $enter_time  				= trim($request->enter_time);
      // convert 12 hout to 24 hours
      $twent_fours_enter_time = date("H:i", strtotime($enter_time));
      $staff_enter_time_is = $twent_fours_enter_time.':00'; 
      $enter_day_is    = date("l",strtotime($staff_attendent_date_is));
     // check valid date
     if($staff_attendent_date_is > $this->rcdate1)
      {
        Session::put('failed','Sorry ! Enter Wrong Attendent Date.');
        return Redirect::to('manualStaffAttendent/'.$staff_id_is.'/'.$staff_attendent_date_is);
      	exit();
      }
       $door_holiday_count = DB::table('holiday')->where('door_holiday',0)->where('holiday_date',$staff_attendent_date_is)->count();
        if($door_holiday_count > 0){
        Session::put('failed','Sorry ! This Day Was Holiday.');
        return Redirect::to('manualStaffAttendent/'.$staff_id_is.'/'.$staff_attendent_date_is);
        exit();
        }
     // already attendent taken
      $count = DB::table('tbl_door_log')->where('user_id',$staff_id_is)->where('enter_date',$staff_attendent_date_is)->count();
      if($count > 0){
      	Session::put('failed','Sorry ! Already Attendent Given Of This Day .');
        return Redirect::to('manualStaffAttendent/'.$staff_id_is.'/'.$staff_attendent_date_is);
      	exit();
      }
      $office_start_time_query = DB::table('shift')->orderBy('office_start','asc')->first();
      $office_start_time_is    =  $office_start_time_query->office_start ;
      //insert the attendence
      $data 	= array();
      $data['type'] 		= 1;  
      $data['user_type'] 	= $staff_type_is  ;
      $data['user_id'] 		= $staff_id_is  ;
      $data['dep_id'] 		= $dept_id ;
      $data['enter_day']    = $enter_day_is ;
      $data['enter_time'] 	= $staff_enter_time_is ;
      $data['office_start'] = $office_start_time_is ;
      $data['enter_date'] 		= $staff_attendent_date_is  ;
      $data['created_at'] 		= $this->rcdate  ;
      $data['m_status'] 		= 1  ;
      DB::table('tbl_door_log')->insert($data);
      Session::put('succes','Manualy Attendent Added Sucessfully');
      return Redirect::to('manualStaffAttendent/'.$staff_id_is.'/'.$staff_attendent_date_is);
    }
    // manual edited staff attendent report
    public function manualEditStaffAttendentTime($user_id , $attendent_date)
    {
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*','department.departmentName')
        ->where('users.id',$user_id)
        ->first();
        // get enter first enter time
        $first_enter_time = DB::table('tbl_door_log')->where('user_id',$user_id)->where('enter_date',$attendent_date)->orderBy('enter_time','asc')->first();
        return view('attendent.manualEditStaffAttendentTime')->with('result',$result)->with('attendent_date',$attendent_date)->with('first_enter_time',$first_enter_time);
    }
    // edit manual staff attendet report
    public function editStaffManualEditAttendentTimeInfo(Request $request)
    {
     $this->validate($request, [
    'staff_type_is'               => 'required',
    'staff_id_is'                 => 'required',
    'staff_attendent_date_is'     => 'required',
    'card_enter_time'             => 'required',
    'enter_time'                  => 'required',
    'door_log_id'                 => 'required'
    ]);
      $staff_type_is            = trim($request->staff_type_is);
      $staff_id_is              = trim($request->staff_id_is);
      $staff_attendent_date_is  = trim($request->staff_attendent_date_is);
      $card_enter_time          = trim($request->card_enter_time);
      $enter_time               = trim($request->enter_time);
      $door_log_id              = trim($request->door_log_id);
      $twent_fours_card_enter_time = date("H:i", strtotime($card_enter_time));
      $staff_card_enter_time_is = $twent_fours_card_enter_time.':00'; 
  
      // convert 12 hout to 24 hours
      $twent_fours_enter_time = date("H:i", strtotime($enter_time));
      $staff_enter_time_is = $twent_fours_enter_time.':00'; 
    
     // check valid date
     if($staff_attendent_date_is > $this->rcdate1)
      {
        Session::put('failed','Sorry ! Enter Wrong Attendent Date.');
        return Redirect::to('manualEditStaffAttendentTime/'.$staff_id_is.'/'.$staff_attendent_date_is);
        exit();
      }
       $door_holiday_count = DB::table('holiday')->where('door_holiday',0)->where('holiday_date',$staff_attendent_date_is)->count();
        if($door_holiday_count > 0){
        Session::put('failed','Sorry ! This Day Was Holiday.');
        return Redirect::to('manualEditStaffAttendentTime/'.$staff_id_is.'/'.$staff_attendent_date_is);
        exit();
        }
      //insert the attendence
      $data   = array();
      $data['tbl_door_log_id']    = $door_log_id  ;
      $data['user_id']            = $staff_id_is  ;
      $data['user_type']          = $staff_type_is  ;
      $data['attendent_date']     = $staff_attendent_date_is ;
      $data['card_enter_time']    = $staff_card_enter_time_is ;
      $data['manual_enter_time']  = $staff_enter_time_is ;
      $data['created_at']         = $this->rcdate  ;
      DB::table('manual_edit_time')->insert($data);
      // update tbl door log 
      $data_update      = array();
      $data_update['enter_time']   = $staff_enter_time_is ;
      $data_update['modified_at']  = $this->rcdate;
      DB::table('tbl_door_log')->where('id',$door_log_id)->update($data_update);
      Session::put('succes','Manualy Attendent Time Edited Sucessfully');
      return Redirect::to('manualEditStaffAttendentTime/'.$staff_id_is.'/'.$staff_attendent_date_is);
    }
    // manaualy teacher attendent by department head
    public function manualTeacherAttendentByDeptHead()
    {
      $teacher = DB::table('users')->where('type',3)->where('trasfer_status',0)->get();
      return view('attendent.manualTeacherAttendentByDeptHead')->with('teacher',$teacher);
    } 
    #---------------------------- add manualy teacher attendent class-----------------------------#
    public function addManualTeacherAttendentClass(Request $request)
    {
     $this->validate($request, [
    'teacher_routine_id'       => 'required',
    'teacher_routine_date'     => 'required',
    'routine_form_time_is'     => 'required',
    'routine_to_time_is'       => 'required',
    ]);

     $teacher_routine_id     = trim($request->teacher_routine_id) ;
     $teacher_routine_date   = trim($request->teacher_routine_date) ;
     $routine_form_time_is   = trim($request->routine_form_time_is) ;
     $routine_to_time_is     = trim($request->routine_to_time_is) ;

     #------ convert 12 hours to 24 hours -----------# 
     $from                  = date("H:i:00", strtotime($routine_form_time_is));
     $to                    = date("H:i:00", strtotime($routine_to_time_is));
     #-----end convert 12 hours to 24 hours ---------#
     $explode_year = explode('-',$teacher_routine_date) ;
     $year         = $explode_year[0];
     $get_routin_info = DB::table('routine')->where('year',$year)->where('id',$teacher_routine_id)->limit(1)->first();
     $teacher_id   = $get_routin_info->teacher_id;
     $teacher_type = 3 ;
     $shift        = $get_routin_info->shift_id;
     $semister    = $get_routin_info->semister_id;
     $dept_id     = $get_routin_info->dept_id ;
     $section     = $get_routin_info->section_id ;
     $class_id    = $get_routin_info->id;
     $day         = $get_routin_info->day;
     $routine_from = $get_routin_info->from;
     $routine_to   = $get_routin_info->to;
     #------------------- time validation ------------------#
     // enter time validation
     if($routine_from > $from){
      Session::put('failed','Sorry ! Enter Wrong In Time');
      return Redirect::to('viewStudentAttendentList/'.$teacher_routine_id.'/'.$teacher_routine_date);
      exit();

     }
     if($routine_to < $to){
        Session::put('failed','Sorry ! Enter Wrong Out Time');
      return Redirect::to('viewStudentAttendentList/'.$teacher_routine_id.'/'.$teacher_routine_date);
      exit();
     }
     #------------------- end time validation ---------------#
     // already taken
     $count_already_taken = DB::table('teacher_attendent')
                           ->where('teacherId',$teacher_id)
                           ->where('type',$teacher_type)
                           ->where('year',$year)
                           ->where('shift_id',$shift)
                           ->where('dept_id',$dept_id)
                           ->where('semister_id',$semister)
                           ->where('section_id',$section)
                           ->where('day',$day)
                           ->where('class_no',$class_id)
                           ->where('created_at',$teacher_routine_date)
                           ->count();
    if($count_already_taken > 0){
      Session::put('failed','Sorry ! Already Attendent Taken');
      return Redirect::to('viewStudentAttendentList/'.$teacher_routine_id.'/'.$teacher_routine_date);
      exit();
    }

// enter attendent
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
$data['enter_time']   = $from ;
$data['created_at']   = $teacher_routine_date ;
$data['on_created_at'] = $this->rcdate; 
DB::table('teacher_attendent')->insert($data);
// get last id 
$last_enter_id_query = DB::table('teacher_attendent')->orderBy('id','desc')->limit(1)->first();
$last_enter_id       = $last_enter_id_query->id ; 

$data_enter =array();

$data_enter['added_id']           = $this->superadmin_id  ;
$data_enter['added_user_type']     = $this->type ;
$data_enter['main_attendent_id']    = $last_enter_id ;
$data_enter['teacherId']    = $teacher_id ;
$data_enter['type']         = $teacher_type ;
$data_enter['year']         = $year ;
$data_enter['shift_id']     = $shift ; 
$data_enter['dept_id']      = $dept_id ;
$data_enter['semister_id']  = $semister ;
$data_enter['section_id']   = $section; 
$data_enter['day']          = $day ;
$data_enter['class_no']     = $class_id ;
$data_enter['status']       = 1 ;
$data_enter['enter_time']   = $from ;
$data_enter['created_at']   = $teacher_routine_date ;
$data_enter['on_created_at'] = $this->rcdate; 
DB::table('manual_teacher_attendent')->insert($data_enter);

// out attendent
$data1=array();
$data1['teacherId']    = $teacher_id ;
$data1['type']         = $teacher_type ;
$data1['year']         = $year ;
$data1['shift_id']     = $shift ; 
$data1['dept_id']      = $dept_id ;
$data1['semister_id']  = $semister ;
$data1['section_id']   = $section; 
$data1['day']          = $day ;
$data1['class_no']     = $class_id ;
$data1['status']       = 2 ;
$data1['out_time']     = $to ;
$data1['created_at']   = $teacher_routine_date ;
$data1['on_created_at'] = $this->rcdate; 
DB::table('teacher_attendent')->insert($data1);

$last_out_id_query    = DB::table('teacher_attendent')->orderBy('id','desc')->limit(1)->first();
$last_out_id          = $last_out_id_query->id ;

$data_out =array();
$data_out['added_id']             = $this->superadmin_id  ;
$data_out['added_user_type']      = $this->type ;
$data_out['main_attendent_id']    = $last_out_id ;
$data_out['teacherId']    = $teacher_id ;
$data_out['type']         = $teacher_type ;
$data_out['year']         = $year ;
$data_out['shift_id']     = $shift ; 
$data_out['dept_id']      = $dept_id ;
$data_out['semister_id']  = $semister ;
$data_out['section_id']   = $section; 
$data_out['day']          = $day ;
$data_out['class_no']     = $class_id ;
$data_out['status']       = 2 ;
$data_out['out_time']     = $to ;
$data_out['created_at']   = $teacher_routine_date ;
$data_out['on_created_at'] = $this->rcdate; 
DB::table('manual_teacher_attendent')->insert($data_out); 

Session::put('succes','Manualy Teacher Class Attendent Taken Sucessfully');
return Redirect::to('viewStudentAttendentList/'.$teacher_routine_id.'/'.$teacher_routine_date);
}
// taken manual attendent
public function teacherAddManualyStudentClassAttendent(Request $request)
{
    $this->validate($request, [
    'absent_routine_id'       => 'required',
    'absent_rc_date'          => 'required',
    ]);

    $absentAttendent     = $request->absentAttendent ;
    $absent_routine_id   = trim($request->absent_routine_id) ;
    $absent_rc_date      = trim($request->absent_rc_date) ;
   if(count($absentAttendent) == '0'){
     Session::put('failed','Sorry Please Atleast One Student Select');
     return Redirect::to('viewStudentAttendentListByTeacher/'.$absent_routine_id.'/'.$absent_rc_date);
     exit();
   }
   $year_explode = explode('-', $absent_rc_date) ;
   $year_is = $year_explode[0];

   // get information from routine
   $routine_info = DB::table('routine')->where('year',$year_is)->where('id',$absent_routine_id)->first();



   $dept_id     = $routine_info->dept_id ;
   $year        = $routine_info->year ;
   $shift_id    = $routine_info->shift_id ;
   $semister_id = $routine_info->semister_id ;
   $section_id  = $routine_info->section_id ;
   $day         = $routine_info->day ;
   foreach ($absentAttendent as $value) {

    // get student info 
    $studetn_info = DB::table('student')
    ->where('year',$year)
    ->where('studentID',$value)
    ->where('shift_id',$shift_id)
    ->where('dept_id',$dept_id)
    ->where('semister_id',$semister_id)
    ->where('section_id',$section_id)
    ->limit(1)
    ->first();

    $session_id = $studetn_info->session;
    $roll       = $studetn_info->roll;

    // duplicaty check
    $count_duplicate_entry = DB::table('student_attendent')->where('studentId',$value)->where('day',$day)->where('class_no', $absent_routine_id)->where('created_at',$absent_rc_date)->count();
    if($count_duplicate_entry > 0){

    }else{

    $data                   = array();
    $data['studentId']      = $value;
    $data['session_id']     = $session_id;
    $data['year']           =  $year;
    $data['shift_id']       = $shift_id ;
    $data['dept_id']        = $dept_id;
    $data['semister_id']    = $semister_id;
    $data['section_id']     = $section_id  ;
    $data['day']            = $day ;
    $data['class_no']       = $absent_routine_id ;
    $data['roll']           = $roll ;
    $data['created_at']     = $absent_rc_date ;
    $data['on_created_at']  = $this->rcdate ;
    DB::table('student_attendent')->insert($data);
    // get last id
    $last_main_attendet_query = DB::table('student_attendent')->orderBy('id','desc')->limit(1)->first();
    $last_main_id = $last_main_attendet_query->id ;

    $data1                   = array();
    $data1['added_id']       =  $this->teacher_id ;
    $data1['added_id_type']  = $this->type;
    $data1['main_attendent_id']  = $last_main_id;
    $data1['studentId']      = $value;
    $data1['session_id']     = $session_id;
    $data1['year']           = $year;
    $data1['shift_id']       = $shift_id ;
    $data1['dept_id']        = $dept_id;
    $data1['semister_id']    = $semister_id;
    $data1['section_id']     = $section_id  ;
    $data1['day']            = $day ;
    $data1['class_no']       = $absent_routine_id ;
    $data1['roll']           = $roll ;
    $data1['created_at']     = $absent_rc_date ;
    $data1['on_created_at']  = $this->rcdate ;
    DB::table('manual_student_attendent')->insert($data1);
    }
 }
Session::put('succes','Manualy Student Class Attendent Taken Sucessfully');
return Redirect::to('viewStudentAttendentListByTeacher/'.$absent_routine_id.'/'.$absent_rc_date);
}
#---------------------------- end manual teacher attendent class------------------------------#
}
