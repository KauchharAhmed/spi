<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class IdcardController extends Controller
{
    /**
     * IdcardController Class Constructor
     *
     * @return \Illuminate\Http\Response
     */
    private $rcdate ;
    private $dept_id ;
    public function __construct(){
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate       = date('Y/m/d');
        $this->current_year = date('Y');
        $this->dept_id  	= Session::get('dept_id');
    }
     /**
     * crate id card
     */
    public function createIdCard()
    {
    	// get shift
       $shift               = DB::table('shift')->get();
        // get current semister
       $semister            = DB::table('semister')->where('status','1')->get();
        // get section
       $section             = DB::table('section')->where('dept_id', $this->dept_id)->get();
       return view('educationInfo.createIdCard')->with('shift',$shift)->with('semsiter',$semister)->with('section',$section);
    }
      /**
     * get student id card
     */
    public function getStudentIdCard(Request $request)
    {
       $dep_id    = $this->dept_id;
       $shift     = $request->shift ;
       $semister  = $request->semister ;
       $year      = $request->year;
       $section   = $request->section;
       $roll      = $request->roll; 
    	if($roll != ''){
         $data = DB::table('student')
        ->join('students', 'student.studentID', '=', 'students.id')
        ->join('shift', 'student.shift_id', '=', 'shift.id')
        ->join('department', 'student.dept_id', '=', 'department.id')
        ->join('semister', 'student.semister_id', '=', 'semister.id')
        ->join('session', 'student.session', '=', 'session.id')
        ->join('section', 'student.section_id', '=', 'section.id')
        ->select('students.*','student.session','student.year','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','section.section_name')
        ->orderBy('student.roll','asc')
        ->where('student.year', $year)
        ->where('student.shift_id', $shift)
        ->where('student.dept_id', $dep_id)
        ->where('student.semister_id', $semister)
        ->where('student.section_id', $section)
         ->where('student.roll', $roll)
        ->where('student.status', 0)
        ->get();
    }else{
    	 $data = DB::table('student')
        ->join('students', 'student.studentID', '=', 'students.id')
        ->join('shift', 'student.shift_id', '=', 'shift.id')
        ->join('department', 'student.dept_id', '=', 'department.id')
        ->join('semister', 'student.semister_id', '=', 'semister.id')
        ->join('session', 'student.session', '=', 'session.id')
        ->join('section', 'student.section_id', '=', 'section.id')
        ->select('students.*','student.session','student.year','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','section.section_name')
        ->orderBy('student.roll','asc')
        ->where('student.year', $year)
        ->where('student.shift_id', $shift)
        ->where('student.dept_id', $dep_id)
        ->where('student.semister_id', $semister)
        ->where('student.section_id', $section)
        ->where('student.status', 0)
        ->get();
    }
    // get department head signature
    $dep_signature = DB::table('department_head')->where('dep_id',$this->dept_id)->first();
    return view('educationInfo.studentIdCardList')->with('data',$data)->with('shift',$shift)->with('semister',$semister)->with('dep_signature',$dep_signature);
    }
    // generate the id card
    public function generateIdCard($id , $shift , $semister)
    {
        $print_status_query = DB::table('students')->where('id',$id)->first();
        $print_status       = $print_status_query->print_id_status ;
       // get student infomation
         $data = DB::table('student')
        ->join('students', 'student.studentID', '=', 'students.id')
        ->join('shift', 'student.shift_id', '=', 'shift.id')
        ->join('department', 'student.dept_id', '=', 'department.id')
        ->join('semister', 'student.semister_id', '=', 'semister.id')
        ->join('session', 'student.session', '=', 'session.id')
        ->join('section','student.section_id','=','section.id')
        ->select('students.*','student.session','student.year','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','section.section_name')
        ->where('students.id', $id)
        ->where('student.year', $this->current_year)
        ->where('student.shift_id', $shift)
        ->where('student.dept_id', $this->dept_id)
        ->where('student.semister_id', $semister)
        ->where('student.status', 0)
        ->first();
        return view('student.idCardInformation')->with('data',$data)->with('shiftID',$shift)->with('semisterID',$semister)->with('print_status',$print_status);
    }
    // staff id card
    public function staffIdCard($id)
    {
        // get prit id status
    $print_status_query = DB::table('users')->where('id',$id)->first();
    $print_status       = $print_status_query->print_id_status ;
    $data = DB::table('users')
    ->where('id', $id)->first();
    //get type
    $type = $data->type ;
    if($type == '5'){
     $dept = '0' ;
    }else{
    // get department name by id
    $dept_id = $data->dept ;
    $dept = DB::table('department')
    ->where('id', $dept_id)->first(); 
  }
    return view('admin.staffIdCard')->with('data',$data)->with('dept',$dept)->with('print_status',$print_status);
    }




}
