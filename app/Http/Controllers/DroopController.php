<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class DroopController extends Controller
{
     /**
     * DroopController Class Constructor
     *
     * @return \Illuminate\Http\Response
     */
    private $rcdate ;
    private $current_year ;
    public function __construct(){
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate             = date('Y/m/d');
        $this->current_year       = date('Y');
        $this->dept_id            = Session::get('dept_id');
        $this->current_time       = date("H:i:s");
    }
    // student droop out by principal
    public function studentDroopOut($id)
    {
    	$current_semister_query = DB::table('student')
        ->join('students', 'student.studentID', '=', 'students.id')
        ->join('shift', 'student.shift_id', '=', 'shift.id')
        ->join('department', 'student.dept_id', '=', 'department.id')
        ->join('semister', 'student.semister_id', '=', 'semister.id')
        ->join('session', 'student.session', '=', 'session.id')
        ->join('section', 'student.section_id', '=', 'section.id')
        ->select('students.*','student.semister_id','student.session','student.semister_status','student.year','student.studentID','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','section.section_name','student.id as new_semister_student_id')
        ->where('student.studentID', $id)
        ->where('student.semister_status',1)
        ->first();
        $current_semester_is = $current_semister_query->semister_id ;
        // current semister  order
        $current_semister_order_query = DB::table('semister')->where('id',$current_semester_is)->first();
        $current_semister_order = $current_semister_order_query->order ;
        $result    = DB::table('semister')->where('order','<',$current_semister_order)->where('status','1')->get();
    	 $data = DB::table('student')
        ->join('students', 'student.studentID', '=', 'students.id')
        ->join('shift', 'student.shift_id', '=', 'shift.id')
        ->join('department', 'student.dept_id', '=', 'department.id')
        ->join('semister', 'student.semister_id', '=', 'semister.id')
        ->join('session', 'student.session', '=', 'session.id')
        ->join('section', 'student.section_id', '=', 'section.id')
        ->select('students.*','student.semister_id','student.session','student.semister_status','student.year','student.studentID','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','section.section_name','student.id as new_semister_student_id')
        ->where('student.studentID', $id)
        ->where('student.semister_status',1)
        ->first();
       return view('student.studentDroopOut')->with('data',$data)->with('result',$result);
    }
    // insert student droop out info
    public function studentDroopOutInfo(Request $request)
    {
    $this->validate($request, [   
    'right_semister'        		=> 'required',
    'confirm_right_semister'        => 'required',
    'student_id'           			=> 'required',
    'wrong_semister_id'           	=> 'required'
     ]);
    $right_semister 		    = trim($request->right_semister);
    $confirm_right_semister = trim($request->confirm_right_semister);
    $student_id 			      = trim($request->student_id);
    $wrong_semister_id 		  = trim($request->wrong_semister_id);
    // check two semister
    if($right_semister != $confirm_right_semister){
    	Session::put('failed','Sorry ! Right Semester And Confirm Right Semester Did Not Match');
        return Redirect::to('studentDroopOut/'.$student_id);
    	exit();
    }
    // detail student information 
    $studentInfo = DB::table('student')->where('studentID',$student_id)->where('semister_status',1)->first();

    $session        = $studentInfo->session ;
  	$year           = $studentInfo->year ;
  	$shift          = $studentInfo->shift_id ;
  	$department     = $studentInfo->dept_id ;
  	$semister       = $studentInfo->semister_id ;
    $section        = $studentInfo->section_id ;
  	$roll           = $studentInfo->roll ;
  	$studentID      = $studentInfo->studentID ;
  	$registration   = $studentInfo->registration ;
    $semister_status = 1 ;
  	$activity_status = 2 ;
  	$student_type 	 = 1 ;
  	// check duplicate entry
  	$count = DB::table('student')->where('studentID',$student_id)->where('semister_id',$right_semister)->count();
  	if($count > 0)
  	{
  		   Session::put('failed','Sorry ! Already Exits Of This Student');
        return Redirect::to('studentDroopOut/'.$student_id);
    	exit();
  	}
  	// insert query
  	$data = array();
  	$data['studentID'] 		= $studentID ;
  	$data['session'] 		  = $session ;
  	$data['year'] 			  = $year ;
  	$data['shift_id'] 		= $shift ;
  	$data['dept_id'] 		  = $department ;
  	$data['semister_id'] 	= $right_semister ;
  	$data['section_id'] 	= $section ;
  	$data['roll'] 			  = $roll ;
  	$data['registration'] 	   = $registration ;
  	$data['semister_status'] 	 = $semister_status ;
  	$data['activity_status'] 	 = $activity_status ;
  	$data['student_type'] 		 = $student_type ;
  	$data['created_at'] 		   = $this->rcdate ;
  	DB::table('student')->insert($data);
   // insert droop out table
    $data_droopout                      = array();
    $data_droopout['year']              = $year ;
    $data_droopout['student_id']        = $student_id ;
    $data_droopout['session_id']        = $session ;
    $data_droopout['wrong_semister_id'] = $wrong_semister_id ;
    $data_droopout['right_semister_id'] = $right_semister ;
    $data_droopout['create_time']       = $this->current_time ;
    $data_droopout['created_at']        = $this->rcdate ;
    DB::table('tbl_droopout')->insert($data_droopout);
    //delete wrong semester
    DB::table('student')->where('studentID',$student_id)->where('semister_id','>',$right_semister)->delete();
    Session::put('succes','Drop Out Complete Succssfully');
    return Redirect::to('studentVerify/');
    }
}
