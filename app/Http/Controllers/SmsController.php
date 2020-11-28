<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class SmsController extends Controller
{
    private $rcdate ;
    private $dept_id ;
    private $department_head_id ;
    private $type ;
    private $current_time ;
    private $superadmin_id ;
    public function __construct(){
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate       = date('Y/m/d');
        $this->current_year = date('Y');
        $this->dept_id  	  = Session::get('dept_id');
        $this->department_head_id = Session::get('department_head_id');
        $this->type               = Session::get('type');
        $this->current_time       = date("H:i:s");
        $this->superadmin_id      = Session::get('superadmin_id');
    }
    // send sms
    public function sendSms()
    {
    	// get shift
        $shift               = DB::table('shift')->get();
        // get current semister
        $semister            = DB::table('semister')->where('status','1')->get();
        // get section
         $section            = DB::table('section')->where('dept_id', $this->dept_id)->get();
        return view('sms.sendSms')->with('shift',$shift)->with('semsiter',$semister)->with('section',$section);
    }
    // sending sms
    public function sendingSms(Request $request)
    {
       $dep_id    = $this->dept_id;
       $shift     = $request->shift ;
       $semister  = $request->semister ;
       $year      = $request->year;
       $section   = $request->section;
       $send_message   = $request->sms_message;
       
         $data = DB::table('student')
        ->join('students', 'student.studentID', '=', 'students.id')
        ->join('shift', 'student.shift_id', '=', 'shift.id')
        ->join('department', 'student.dept_id', '=', 'department.id')
        ->join('semister', 'student.semister_id', '=', 'semister.id')
        ->join('session', 'student.session', '=', 'session.id')
        ->join('section', 'student.section_id', '=', 'section.id')
        ->select('students.*','student.studentID','student.session','student.semister_status','student.year','student.shift_id','student.dept_id','student.semister_id','student.section_id','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','section.section_name')
        ->orderBy('student.roll','asc')
        ->where('student.year', $year)
        ->where('student.shift_id', $shift)
        ->where('student.dept_id', $dep_id)
        ->where('student.semister_id', $semister)
        ->where('student.section_id', $section)
        ->where('student.status', 0)
        ->get();
         $count = DB::table('student')
        ->join('students', 'student.studentID', '=', 'students.id')
        ->join('shift', 'student.shift_id', '=', 'shift.id')
        ->join('department', 'student.dept_id', '=', 'department.id')
        ->join('semister', 'student.semister_id', '=', 'semister.id')
        ->join('session', 'student.session', '=', 'session.id')
        ->join('section', 'student.section_id', '=', 'section.id')
        ->select('students.*','student.studentID','student.session','student.semister_status','student.year','student.shift_id','student.dept_id','student.semister_id','student.section_id','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','section.section_name')
        ->where('student.year', $year)
        ->where('student.shift_id', $shift)
        ->where('student.dept_id', $dep_id)
        ->where('student.semister_id', $semister)
        ->where('student.section_id', $section)
        ->where('student.status', 0)
        ->count();
      // count message character
       $count_msg   = strlen($send_message) ;
       $now_msg     = $count_msg / 159 ;
       $explode     = explode('.',$now_msg) ;
       $int_number  = $explode[0];
       $after_float = $explode[1];
       if($after_float > 0){
        $cal_msg  = $int_number + 1 ;
       }else{
        $cal_msg  = $int_number ;
       }
       $total_sms =  $count * $cal_msg ;

       $avilable_sms_query = DB::table('sms_count')->first();
      $avialable_sms      = $avilable_sms_query->available_sms;
      $sending_sms        = $avilable_sms_query->sending_sms;

      if($avialable_sms < $total_sms) {
      Session::put('failed','Sorry ! Insufficent SMS Balance. SMS Not Sent Successfully');
      return Redirect::to('sendSms');
      exit();
        }

       $data_sms_count   = array();
       $data_sms_count['available_sms'] = $avialable_sms - $total_sms ;
       $data_sms_count['sending_sms']   = $sending_sms + $total_sms;
       DB::table('sms_count')->update($data_sms_count);

       $message = urlencode($send_message);
       $data_sms = array();
       $data_sms['sms'] 			     = $send_message;
       $data_sms['sms_count']      = $total_sms;
       $data_sms['created_at'] 		 = $this->rcdate;
       DB::table('sending_sms')->insert($data_sms);
       // get last sending sms id
       $last_sms_id_query = DB::table('sending_sms')->orderBy('id','desc')->limit(1)->first();
       $last_sms_id       = $last_sms_id_query->id ;
       foreach ($data as $value){
        $sms_studentID         = $value->studentID ;
        $sms_send_year         = $value->year ;
        $sms_send_shift_id     = $value->shift_id ;
        $sms_send_dept_id      = $value->dept_id ; 
        $sms_send_semister_id  = $value->semister_id ;
        $sms_send_section_id   = $value->section_id ;
        $sms_send_roll         = $value->roll;
        // insert sending sms table
        $data_sms_insert = array();
        $data_sms_insert['added_id']        = $this->department_head_id ;
        $data_sms_insert['added_user_type'] = $this->type ;
        $data_sms_insert['sms_id']          = $last_sms_id ;
        $data_sms_insert['type']            = 2 ;
        $data_sms_insert['student_id']      = $sms_studentID ;
        $data_sms_insert['year']            = $sms_send_year ;
        $data_sms_insert['dep_id']          = $sms_send_dept_id ;
        $data_sms_insert['shift_id']        = $sms_send_shift_id ;
        $data_sms_insert['semister_id']     = $sms_send_semister_id ;
        $data_sms_insert['section_id']      = $sms_send_section_id ;
        $data_sms_insert['roll']            = $sms_send_roll ;
        $data_sms_insert['mobile_number']   = $value->studentMobile ;
        $data_sms_insert['sms_count']       = $cal_msg ;
        $data_sms_insert['sms_type']        = "Normal Notify";
        $data_sms_insert['sms_time']        = $this->current_time ;
        $data_sms_insert['created_at']      = $this->rcdate ;
        DB::table('sending_sms_history')->insert($data_sms_insert);
       file_get_contents("http://touchsitbd.com/systemsms/api.php?username=asianitinc@gmail.com&password=121lsr21LaraSoft&recipient=$value->studentMobile&message=$message");
         }
        Session::put('succes','SMS Send Successfully');
        return Redirect::to('sendSms');

    }

    // send sms to staff
    public function staffSmsSent()
    {
      return view('sms.staffSmsSent');
    }
    // sending sms to the staff
    public function sendingStaffSms(Request $request)
    {
      $send_message   = $request->sms_message;
      $data = DB::table('users')->where('trasfer_status',0)->get();
      $count = DB::table('users')->where('trasfer_status',0)->count();
      
      // count message character
       $count_msg   = strlen($send_message) ;
       $now_msg     = $count_msg / 159 ;
       $explode     = explode('.',$now_msg) ;
       $int_number  = $explode[0];
       $after_float = $explode[1];
       if($after_float > 0){
        $cal_msg  = $int_number + 1 ;
       }else{
        $cal_msg  = $int_number ;
       }
       $total_sms =  $count * $cal_msg ;

      $avilable_sms_query = DB::table('sms_count')->first();
      $avialable_sms      = $avilable_sms_query->available_sms;
      $sending_sms        = $avilable_sms_query->sending_sms;

      if($avialable_sms < $total_sms) {
        Session::put('failed','Sorry ! Insufficent SMS Balance. SMS Not Sent Successfully');
        return Redirect::to('staffSmsSent');
        exit();
      }

       $data_sms_count   = array();
       $data_sms_count['available_sms'] = $avialable_sms - $total_sms ;
       $data_sms_count['sending_sms']   = $sending_sms + $total_sms;
       DB::table('sms_count')->update($data_sms_count);

       $message = urlencode($send_message);
       $data_sms = array();
       $data_sms['sms']             = $send_message ;
       $data_sms['sms_count']       = $total_sms;
       $data_sms['created_at']      = $this->rcdate;
       DB::table('sending_sms')->insert($data_sms);
        $last_sms_id_query = DB::table('sending_sms')->orderBy('id','desc')->limit(1)->first();
        $last_sms_id       = $last_sms_id_query->id ;
       foreach ($data as $value){
        $data_sms_insert = array();
        $data_sms_insert['added_id']        = $this->superadmin_id ;
        $data_sms_insert['added_user_type'] = $this->type ;
        $data_sms_insert['sms_id']          = $last_sms_id ;
        $data_sms_insert['type']            = 1 ;
        $data_sms_insert['user_type']       = $value->type ;
        $data_sms_insert['user_id']         = $value->id ;
        $data_sms_insert['mobile_number']   = $value->mobile ;
        $data_sms_insert['sms_count']       = $cal_msg ;
        $data_sms_insert['sms_type']        = "Normal Notify";
        $data_sms_insert['sms_time']        = $this->current_time ;
        $data_sms_insert['created_at']      = $this->rcdate ;
        DB::table('sending_sms_history')->insert($data_sms_insert);

        file_get_contents("http://touchsitbd.com/systemsms/api.php?username=asianitinc@gmail.com&password=121lsr21LaraSoft&recipient=$value->mobile&message=$message");
          }
        Session::put('succes','SMS Send Successfully');
        return Redirect::to('staffSmsSent');
    }
}
