<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class ResultReportController extends Controller
{
     /**
     * Result Report controller Class Constructor
     *
     * @return \Illuminate\Http\Response
     */
    private $rcdate ;
    private $current_time ;
    private $department_head_id ;
    private $dept_id ;
    public function __construct(){
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate             = date('Y/m/d');
        $this->current_time       = date('H:i:s');
        $this->dept_id            = Session::get('dept_id');
        $this->department_head_id = Session::get('department_head_id');
    }
    // depart ment head result list
    public function deptHeadResultList()
    {
    	$year                = DB::table('student')->distinct()->get(array('year'));
    	// get shift
      $shift               = DB::table('shift')->get();
        // get current semister
      $semister            = DB::table('semister')->get();
        // get section
      $section             = DB::table('section')->where('dept_id', $this->dept_id)->get();
    	return view('result_report.deptHeadResultList')->with('year',$year)->with('shift',$shift)->with('semister',$semister)->with('section',$section);
    }
   // dept head result view
   public function deptHeadResultListView(Request $request)
   {
   	   $year        = trim($request->year);
   	   $shift       = trim($request->shift);
   	   $semister    = trim($request->semister);
   	   $section 	  = trim($request->section);
   	   // count
   	   $count = DB::table('tbl_result')->where('year',$year)->where('shift_id',$shift)->where('dept_id',$this->dept_id)->where('semister_id',$semister)->where('section_id',$section)->count();
   	   if($count == '0'){
   	   	echo "f1";
   	   	exit();
   	   }
       // probidhan query
        $probidhan_query = DB::table('tbl_result')->where('year',$year)->where('shift_id',$shift)->where('dept_id',$this->dept_id)->where('semister_id',$semister)->where('section_id',$section)->first();
        $probidhan_id = $probidhan_query->probidhan_id ;
   	     // get pass student list first
        $pass_result = DB::table('tbl_result')
        ->where('year',$year)
        ->where('shift_id',$shift)
        ->where('dept_id',$this->dept_id)
        ->where('semister_id',$semister)
        ->where('section_id',$section)
        ->where('pass_fail_status',1)
        ->orderBy('total_marks', 'DESC')
        ->orderBy('roll','ASC')
        ->get();
      // get fail result
      $failed_result = DB::table('tbl_result_marks')
      ->join('tbl_result','tbl_result_marks.student_id','=','tbl_result.student_id')
      ->select('tbl_result.*', DB::raw("COUNT(tbl_result_marks.id) AS count"))
      ->where('tbl_result_marks.year',$year)
      ->where('tbl_result_marks.shift_id',$shift)
      ->where('tbl_result_marks.dept_id',$this->dept_id)
      ->where('tbl_result_marks.semister_id',$semister)
      ->where('tbl_result_marks.section_id',$section)
      ->where('tbl_result.pass_fail_status',2)
      ->where(function ($query) {
      $query->orWhere('tbl_result_marks.theory_pass_fail_status',2)
      ->orWhere('tbl_result_marks.practical_pass_fail_status',2);
        })
      ->groupBy('tbl_result_marks.roll')
      ->orderBy('count','ASC')
      ->orderBy('tbl_result.total_marks','DESC')
      ->orderBy('tbl_result.roll','ASC')
      ->get();

      $shift_name         = DB::table('shift')->where('id',$shift)->first();
      $dept_name          = DB::table('department')->where('id',$this->dept_id)->first();
      $semister_name      = DB::table('semister')->where('id',$semister)->first();
      $section_name       = DB::table('section')->where('id',$section)->first();
      $porbidhan_details  = DB::table('tbl_probidhan')->where('id',$probidhan_id)->first();
     
    return view('result_view_report.deptHeadResultListView')->with('pass_result',$pass_result)->with('failed_result',$failed_result)->with('year',$year)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('porbidhan_details',$porbidhan_details)->with('year',$year)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('dept',$this->dept_id)->with('year',$year)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('probidhan_id',$probidhan_id);
   }
}
