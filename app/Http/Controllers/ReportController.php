<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;
use DateTime;
class ReportController extends Controller
{
     /**
     * ReportController Class Constructor
     *
     * @return \Illuminate\Http\Response
     */
    private $rcdate ;
    private $rcdate1 ;
    private $year ;
    private $dept_id ;
    private $teacher_id ;
    public function __construct(){
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate             = date('Y/m/d');
        $this->rcdate1            = date('Y-m-d');
        $this->year               = date('Y');
        $this->dept_id            = Session::get('dept_id'); 
        $this->teacher_id            = Session::get('teacher_id'); 
    }
    /**
     * get all depatmetn by shift id
     *
     */
    public function showTodayAttendent($shift_id)
    {
       
       $count = DB::table('holiday')->where('holiday_date',$this->rcdate1)->count();
       if($count > 0){
        Session::put('failed','Sorry ! Today Is Class Holiday');
        return Redirect::to('superadminDashboard');
        exit();

       }
       $result = DB::table('department')->where('status',1)->get();
       $shift  = DB::table('shift')->where('id',$shift_id)->get();
       return view('report.daytodayViewAttendent')
       ->with('result',$result)
       ->with('shift',$shift)
       ->with('shift_id',$shift_id);
    }
    // department head live monitoring
    public function deptHeadLiveMonitoring($shift_id)
    {
       $result = DB::table('department')->where('status',1)->get();
       $shift  = DB::table('shift')->where('id',$shift_id)->get();
       $current_dept = $this->dept_id ;
        $count = DB::table('holiday')->where('holiday_date',$this->rcdate1)->count();
       if($count > 0){
        Session::put('failed','Sorry ! Today Is Class Holiday');
        return Redirect::to('departmentHeadDashboard');
        exit();

       }
       return view('report.deptHeadLiveMonitoring')
       ->with('result',$result)
       ->with('shift',$shift)
       ->with('shift_id',$shift_id)
       ->with('current_dept',$current_dept);
    }
    // super admin previoud monitoring
    public function superAdminPreviousLiveMonitoring($shift_id)
    {
       $result = DB::table('department')->where('status',1)->get();
       $shift  = DB::table('shift')->where('id',$shift_id)->first();
       return view('report.superAdminPreviousLiveMonitoring')
       ->with('result',$result)
       ->with('shift',$shift)
       ->with('shift_id',$shift_id);
    }
    // super admin previous monitoring
    public function superAdminPreviousLiveMonitoringView(Request $request)
    {
        $result   = DB::table('department')->where('status',1)->get();
       $shift_id = trim($request->shift);
       $from_date= trim($request->from_date); 
       $explode       = explode('-',$from_date);
       $from_day      = $explode[0]; 
       $from_month    = $explode[1];
       $from_year     = $explode[2]; 
       $previous_date = $from_year.'-'.$from_month.'-'.$from_day;
       if($previous_date >  $this->rcdate1){
        echo 'f1';
        exit();
       }

       $shift  = DB::table('shift')->where('id',$shift_id)->get();
       return view('report.superAdminPreviousLiveMonitoringView')
       ->with('result',$result)
       ->with('shift',$shift)
       ->with('shift_id',$shift_id)
       ->with('previous_date',$previous_date)
       ->with('from_year',$from_year);
    }
    // department head previous monitoring
    public function deptHeadPreviousLiveMonitoring($shift_id)
    {
       $result = DB::table('department')->where('status',1)->get();
       $shift  = DB::table('shift')->where('id',$shift_id)->first();
       $current_dept = $this->dept_id ;
       return view('report.deptHeadPreviousLiveMonitoring')
       ->with('result',$result)
       ->with('shift',$shift)
       ->with('shift_id',$shift_id)
       ->with('current_dept',$current_dept);
    }
    // department head live monitoring view
    public function deptHeadPreviousLiveMonitoringView(Request $request)
    {
       $result   = DB::table('department')->where('status',1)->get();
       $shift_id = trim($request->shift);
       $from_date= trim($request->from_date); 
       $explode       = explode('-',$from_date);
       $from_day      = $explode[0]; 
       $from_month    = $explode[1];
       $from_year     = $explode[2]; 
       $previous_date = $from_year.'-'.$from_month.'-'.$from_day; 
        if($previous_date >  $this->rcdate1){
        echo 'f1';
        exit();
       }

       $shift  = DB::table('shift')->where('id',$shift_id)->get();
       $current_dept = $this->dept_id ;
       return view('report.deptHeadPreviousLiveMonitoringView')
       ->with('result',$result)
       ->with('shift',$shift)
       ->with('shift_id',$shift_id)
       ->with('current_dept',$current_dept)
       ->with('previous_date',$previous_date)
       ->with('from_year',$from_year);
    }
 
    /**
     * today attendent report search page (entrace into campus)
     *
     */
    public function reportTodayAttendent()
    {
      $shift = DB::table('shift')->get();
      $dept  = DB::table('department')->where('status',1)->get();
      return view('report.reportTodayAttendent')->with('shift',$shift)->with('dept',$dept);
    }
    #------------------ enatece into campus attednece report -------------------------#
    /**
     * today attendent report search page (entrace into campus)
     *
     */
    public function reportTodayAttendentView(Request $request)
    {
         $shift = trim($request->shift) ;
         $dept  = trim($request->dept) ;
         // get semister of 
         $result        = DB::table('semister')->where('status',1)->get();
         // get section of this department
         $section_name  = DB::table('section')->where('dept_id',$dept)->get();
         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         return view('report.showsTodayAttendent')->with('result',$result)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('section_name',$section_name)->with('shift_id',$shift)->with('dept_id',$dept);
      }
     /**
     * monthly attedent Report (entrace into campus)
     *
     */
    public function reportMonthlyAttendentForm()
    {
      $year           = DB::table('student')->distinct()->get(array('year'));
      $shift          = DB::table('shift')->get();
      $dept           = DB::table('department')->where('status',1)->get();
      $semister       = DB::table('semister')->where('status',1)->get();
      return view('report.reportMonthlyAttendentForm')
      ->with('year',$year)
      ->with('shift',$shift)
      ->with('dept',$dept)
      ->with('semister',$semister);
    }
    /*
    ** today attendent view by department head
    */
    public function todayStudentAttedntReportByDeptHead()
    {
      $shift = DB::table('shift')->get();
      return view('report.todayStudentAttedntReportByDeptHead')->with('shift',$shift);
    }
    /*
    ** monthly student attendent report
    */
    public function reportMonthlyAttendentView(Request $request)
    {
        $year     = trim($request->year) ;
        $shift    = trim($request->shift);
        $dept     = trim($request->dept);
        $semister = trim($request->semister);
        $section  = trim($request->section);
        $month    = trim($request->month);
        // get student
        $result = DB::table('student')->where('year',$year)->where('shift_id',$shift)->where('dept_id', $dept )->where('semister_id',$semister)->where('section_id',$section)->orderBy('roll','asc')->get();
        // get holiday
        $from = $year.'-'.$month.'-01';
        $to   = $year.'-'.$month.'-31';
        $count_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereBetween('holiday_date', [$from, $to])->count();
        $month_total_day =cal_days_in_month(CAL_GREGORIAN,$month,$year);
  
         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();

        return view('report.reportMonthlyAttendentView')->with('result',$result)->with('count_holiday',$count_holiday)->with('month_total_day',$month_total_day)->with('from',$from)->with('to',$to)->with('month',$month)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('section',$section)->with('semister',$semister)->with('dept',$dept)->with('shift',$shift); 
    }
    /*
    ** datewise student attendent report (campus entrace)
    */
    public function reportDatewiseAttendentForm()
    {
      $year           = DB::table('student')->distinct()->get(array('year'));
      $shift          = DB::table('shift')->get();
      $dept           = DB::table('department')->where('status',1)->get();
      $semister       = DB::table('semister')->where('status',1)->get();
      return view('report.reportDatewiseAttendentForm')
      ->with('year',$year)
      ->with('shift',$shift)
      ->with('dept',$dept)
      ->with('semister',$semister);
    }
    /*
    ** datewise student attendent report view (campus entrace)
    */
    public function reportDatewiseAttendentView(Request $request)
    {
        $year        = trim($request->year) ;
        $shift       = trim($request->shift);
        $dept        = trim($request->dept);
        $semister    = trim($request->semister);
        $section     = trim($request->section);
        $date_form   = trim($request->from); 
        $from        = date ("Y-m-d", strtotime($date_form));
        $date_to     = trim($request->to); 
        $to          = date ("Y-m-d", strtotime($date_to));
        $result = DB::table('student')->where('year',$year)->where('shift_id',$shift)->where('dept_id', $dept )->where('semister_id',$semister)->where('section_id',$section)->orderBy('roll','asc')->get();
        // count holiday
        $count_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereBetween('holiday_date', [$from, $to])->count();
        // total day caluclation
        $date1 = date_create($from);
        $date2 = date_create($to);
        //difference between two dates
        $diff       = date_diff($date1,$date2);
        $total_day  = $diff->format("%a")+1;
         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();
         return view('report.reportDatewiseAttendentView')->with('result',$result)->with('count_holiday',$count_holiday)->with('total_day',$total_day)->with('from',$from)->with('to',$to)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('shift',$shift)->with('dept',$dept)->with('semister',$semister)->with('section',$section)->with('date_form',$date_form)->with('date_to',$date_to); 

    }
    #------------------------------ end campus entrece student report-------------------------#
    #----------------------- start class wise attendent system--------------------------#
    /*
    ** monthly student attendent report search form (class wise)
    */
    public function reportMonthlyClassWiseAttendentForm()
    {
      $year           = DB::table('student')->distinct()->get(array('year'));
      $shift          = DB::table('shift')->get();
      $dept           = DB::table('department')->where('status',1)->get();
      $semister       = DB::table('semister')->where('status',1)->get();
      return view('report.reportMonthlyClassWiseAttendentForm')
      ->with('year',$year)
      ->with('shift',$shift)
      ->with('dept',$dept)
      ->with('semister',$semister);
    }
    /*
    ** monthly student attendent report view (class wise)
    */
    public function reportMonthlyClassWiseAttendentView(Request $request)
    {
        $year     = trim($request->year) ;
        $shift    = trim($request->shift);
        $dept     = trim($request->dept);
        $semister = trim($request->semister);
        $section  = trim($request->section);
        $month    = trim($request->month);
        // get student
        $result = DB::table('student')->where('year',$year)->where('shift_id',$shift)->where('dept_id', $dept )->where('semister_id',$semister)->where('section_id',$section)->orderBy('roll','asc')->get();
 
        #---------------- total holiday class calculation-------------------#
        $from = $year.'-'.$month.'-01';
        $to   = $year.'-'.$month.'-31';
        $get_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereNotIn('type',[1])
                         ->whereBetween('holiday_date', [$from, $to])->get();

  
  $total_holiday_class = 0 ;
  foreach ($get_holiday as $holidays) {
  $day_no =  date('D', strtotime($holidays->holiday_date));
  //echo $day_no;
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
// count total holiday class
$holiday_total_class = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day)->count();
$total_holiday_class = $total_holiday_class+$holiday_total_class;
 }
#-----------------end total holiday class calulation---------------------#
 // month total holiday 
 $get_all_holiday =  DB::table('holiday')
                    ->where('year',$year)
                    ->whereBetween('holiday_date', [$from, $to])->get(['holiday_date']);
                   $data = array();
                   foreach ($get_all_holiday as $data1) {
                     $data[] = $data1->holiday_date;
                   }
$start_date = $year.'-'.$month.'-01';;
$start_time = strtotime($start_date);
$end_time   = strtotime("+1 month", $start_time);
for($i=$start_time; $i<$end_time; $i+=86400)
{
   $list[] = date('Y-m-d', $i);
}
$total_class_day = array_diff($list,$data);
#--------------------- total class of this month---------------------------#
$totalClassNo = 0 ;
foreach ($total_class_day as $total_class_days) {
  $class_day_no =  date('D', strtotime($total_class_days));

if($class_day_no == 'Sat'){
 $day_number = '1';
}elseif($class_day_no == 'Sun'){
  $day_number = '2';
}elseif($class_day_no == 'Mon'){
     $day_number = '3';
}elseif($class_day_no == 'Tue'){
     $day_number = '4';
}elseif($class_day_no == 'Wed'){
     $day_number = '5';
}elseif($class_day_no == 'Thu'){
     $day_number = '6';
}elseif($class_day_no == 'Fri'){
     $day_number = '7';
}

// count total holiday class
$count_total_class_month = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day_number)->count();
$totalClassNo = $totalClassNo+$count_total_class_month;
}
//echo $totalClassNo ;
#------------------------ end total class of this month-----------------------------#
$month_total_day =cal_days_in_month(CAL_GREGORIAN,$month,$year);

         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();
        return view('report.reportMonthlyClassWiseAttendentView')->with('result',$result)->with('month_total_day',$month_total_day)->with('from',$from)->with('to',$to)->with('month',$month)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('total_holiday_class',$total_holiday_class)->with('totalClassNo',$totalClassNo)->with('dept',$dept)->with('shift',$shift)->with('semister',$semister)->with('section',$section);
    }

    /*
    ** datewise classwise student attendent report form (class wise)
    */
    public function reportDatewiseClassWiseAttendentForm()
    {
      $year           = DB::table('student')->distinct()->get(array('year'));
      $shift          = DB::table('shift')->get();
      $dept           = DB::table('department')->where('status',1)->get();
      $semister       = DB::table('semister')->where('status',1)->get();
      return view('report.reportDatewiseClassWiseAttendentForm')
      ->with('year',$year)
      ->with('shift',$shift)
      ->with('dept',$dept)
      ->with('semister',$semister);
    }
    /*
    ** datewise classwise student attendent report view (class wise)
    */
    public function reportDatewiseClassWiseAttendentView(Request $request)
    {
        $year        = trim($request->year) ;
        $shift       = trim($request->shift);
        $dept        = trim($request->dept);
        $semister    = trim($request->semister);
        $section     = trim($request->section);
        $date_form   = trim($request->from); 
        $from        = date ("Y-m-d", strtotime($date_form));
        $date_to     = trim($request->to); 
        $date_too     = trim($request->to);
        $to          = date ("Y-m-d", strtotime($date_to));
        $result = DB::table('student')->where('year',$year)->where('shift_id',$shift)->where('dept_id', $dept )->where('semister_id',$semister)->where('section_id',$section)->orderBy('roll','asc')->get();
      #----------------total holiday without friday class calculation-------------------#
        $get_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereNotIn('type',[1])
                         ->whereBetween('holiday_date', [$from, $to])->get();

  
  $total_holiday_class = 0 ;
  foreach ($get_holiday as $holidays) {
  $day_no =  date('D', strtotime($holidays->holiday_date));
  //echo $day_no;
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
// count total holiday class
$holiday_total_class = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day)->count();
$total_holiday_class = $total_holiday_class+$holiday_total_class;
 }
#-----------------end total holiday class calulation---------------------#
  // total holiday 
 $get_all_holiday =  DB::table('holiday')
                    ->where('year',$year)
                    ->whereBetween('holiday_date', [$from, $to])->get(['holiday_date']);
                   $data = array();
                   foreach ($get_all_holiday as $data1) {
                     $data[] = $data1->holiday_date;
                   }

   
$date_from = strtotime($from); 
$date_to = strtotime($to); 
$list = array();
for ($i=$date_from; $i<=$date_to; $i+=86400) {  
    $list[] = date("Y-m-d", $i);  
}  
$total_class_day = array_diff($list,$data);
$totalClassNo = 0 ; 
foreach ($total_class_day as $total_class_days) {
  $class_day_no =  date('D', strtotime($total_class_days));
  if($class_day_no == 'Sat'){
 $day_number = '1';
}elseif($class_day_no == 'Sun'){
  $day_number = '2';
}elseif($class_day_no == 'Mon'){
     $day_number = '3';
}elseif($class_day_no == 'Tue'){
     $day_number = '4';
}elseif($class_day_no == 'Wed'){
     $day_number = '5';
}elseif($class_day_no == 'Thu'){
     $day_number = '6';
}elseif($class_day_no == 'Fri'){
     $day_number = '7';
}
// count total holiday class
$count_total_class_month = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day_number)->count();
$totalClassNo = $totalClassNo+$count_total_class_month;
}
         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();
         return view('report.reportDatewiseClassWiseAttendentView')->with('result',$result)->with('totalClassNo',$totalClassNo)->with('total_holiday_class',$total_holiday_class)->with('from',$from)->with('to',$to)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('dept',$dept)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('date_form',$date_form)->with('date_to',$date_too);
 
 }
#------------------------------ end class wise student attendent report-------------------------#

#----------------------------- START TEACHER ATTENDENT REPORT -----------------------------------#
    /*
    ** todya teacher attedent report (campus entrace)
    */
 public function reportTeacherTodayAttendentForm()
 {
        // get teacher information
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 3)
        ->where('users.trasfer_status', 0)
        ->orderBy('user_id','asc')
        ->get();
        return view("report.reportTeacherTodayAttendentForm")->with('result',$result)->with('today',$this->rcdate);
 }
    /*
    ** todya teacher attedent report (class wise)
    */
 public function reportTeacherClassWiseTodayAttendent()
 {
$day_no  = date("D");
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
        // get teacher information
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 3)
        ->where('users.trasfer_status', 0)
        ->orderBy('users.user_id','asc')
        ->get();
  return view("report.reportTeacherClassWiseTodayAttendent")->with('result',$result)->with('day',$day)->with('today',$this->rcdate);
 }
  /*
  ** monthly teacher attendent form (enter into campus)
  */
  public function reportTeacherMonthlyAttendent()
  {
    $year           = DB::table('student')->distinct()->get(array('year'));
    return view('report.reportTeacherMonthlyAttendent')->with('year',$year);
  }
  /*
  ** monthly teacher attendent view (enter into campus)
  */
  public function reportMonthlyTeacherAttendentView(Request $request)
  {
    $year   = trim($request->year);
    $month  = trim($request->month);
    // get teacher
    $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 3)
        ->where('users.trasfer_status', 0)
        ->orderBy('users.user_id','asc')
        ->get();
        // get holiday
        $from = $year.'-'.$month.'-01';
        $to   = $year.'-'.$month.'-31';
        $count_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereBetween('holiday_date', [$from, $to])->count();
        $month_total_day =cal_days_in_month(CAL_GREGORIAN,$month,$year);
        return view('report.reportMonthlyTeacherAttendentView')->with('result',$result)->with('count_holiday',$count_holiday)->with('month_total_day',$month_total_day)->with('from',$from)->with('to',$to)->with('month',$month)->with('year',$year);
  }
  /*
  ** datewise teacher attendent report Search page (enter into campus)
  */
  public function reportTeacherDatewiseAttendent()
  {
    $year           = DB::table('student')->distinct()->get(array('year'));
    return view('report.reportTeacherDatewiseAttendent')->wit;
  }
#------------------------ END TEACHER ATTENDENT REPORT---------------------------------------#

#------------------------ START DOOR ATTENDENT REPORT----------------------------------------#
public function reportStaffDoorAttendentForm()
{
  return view('report.reportStaffDoorAttendentForm');
}
// date wise staff door log view
public function reportStaffDoorAttendentView(Request $request)
{
        $from_date   = trim($request->from_date); 
        $from        = date ("Y-m-d", strtotime($from_date));
        $staff_type  = trim($request->staff_type);
          if($from > $this->rcdate1){
          echo 'f1';
          exit();
        }
        // get door holiday
        $door_holiday_count = DB::table('holiday')->where('door_holiday',0)->where('holiday_date',$from)->count();
        if($door_holiday_count > 0){
          echo 'f2';
          exit();
        }
        if($staff_type == '0'){
          // all staff
         $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
      
        }
        if($staff_type == '2'){
          // admin
          $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 2)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
    
        }
        if($staff_type == '3'){
          // teacher
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 3)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
        }
        if($staff_type == '4'){
          // craft
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 4)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
        }
         if($staff_type == '5'){
          // other staff
          $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 5)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
        }    
        return view('report.reportStaffDoorAttendentView')->with('result',$result)->with('from',$from)->with('staff_type',$staff_type)->with('from_date',$from_date);

 }
 // staff monthly attendent door report
 public function reportStaffMonthlyDoorAttendentForm()
 {
  $year           = DB::table('student')->distinct()->get(array('year'));
  return view('report.reportStaffMonthlyDoorAttendentForm')->with('year',$year);
 }
 // staff monthly door attendent report
 public function reportMonthlyStaffDoorAttendentView(Request $request)
 {
    $year         = trim($request->year);
    $month        = trim($request->month);
    $staff_type   = trim($request->staff_type);
    if($staff_type == '0'){
          // all staff
         $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type',[10])
        ->orderBy('users.user_id','asc')
        ->get();
        }
        if($staff_type == '2'){
          // admin
          $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 2)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type',[10])
        ->orderBy('users.user_id','asc')
        ->get();
    
        }
        if($staff_type == '3'){
          // teacher
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 3)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type',[10])
        ->orderBy('users.user_id','asc')
        ->get();
        }
        if($staff_type == '4'){
          // craft
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 4)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type',[10])
        ->orderBy('users.user_id','asc')
        ->get();
        }
         if($staff_type == '5'){
          // other staff
          $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 5)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type',[10])
        ->orderBy('users.user_id','asc')
        ->get();
        } 
        // get holiday
        $from = $year.'-'.$month.'-01';
        $to   = $year.'-'.$month.'-31';
        $count_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->where('door_holiday','0')
                         ->whereBetween('holiday_date', [$from, $to])->count();
        $month_total_day =cal_days_in_month(CAL_GREGORIAN,$month,$year);
        return view('report.reportMonthlyStaffDoorAttendentView')->with('result',$result)->with('count_holiday',$count_holiday)->with('month_total_day',$month_total_day)->with('from',$from)->with('to',$to)->with('month',$month)->with('year',$year)->with('staff_type',$staff_type);
 }
#------------------------ END START DOOR ATTENDENT REPORT------------------------------------#
#------------------------ STUDENT DOOR ATTENDENT REPORT--------------------------------------#
// date door log report of student from
  public function reportStudentDoorAttendentForm()
    {
      $year           = DB::table('student')->distinct()->get(array('year'));
      $shift          = DB::table('shift')->get();
      $dept           = DB::table('department')->where('status',1)->get();
      $semister       = DB::table('semister')->where('status',1)->get();
      return view('report.reportStudentDoorAttendentForm')
      ->with('year',$year)
      ->with('shift',$shift)
      ->with('dept',$dept)
      ->with('semister',$semister); 
 }
// view door report
 public function reportDailyStudentDoorReportView(Request $request)
 {
        $year     = trim($request->year) ;
        $shift    = trim($request->shift);
        $dept     = trim($request->dept);
        $semister = trim($request->semister);
        $section  = trim($request->section);
        $from_date   = trim($request->from); 
        $from        = date ("Y-m-d", strtotime($from_date));
          if($from > $this->rcdate1){
          echo 'f1';
          exit();
        }
        // get door holiday
        $door_holiday_count = DB::table('holiday')->where('door_holiday',0)->where('holiday_date',$from)->count();
        if($door_holiday_count > 0){
          echo 'f2';
          exit();
        }
         $count_student = DB::table('student')->where('year',$year)->where('shift_id',$shift)->where('dept_id', $dept )->where('semister_id',$semister)->where('section_id',$section)->orderBy('roll','asc')->count();
         // total student present
         $total_present_student = DB::table('tbl_door_log')->where('year',$year)->where('shift_id',$shift)->where('dep_id', $dept )->where('semister_id',$semister)->where('section_id',$section)->where('enter_date',$from)->groupBy('student_id')->count();
     
        // get student
        $result = DB::table('student')->where('year',$year)->where('shift_id',$shift)->where('dept_id', $dept )->where('semister_id',$semister)->where('section_id',$section)->orderBy('roll','asc')->get();
         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();
        return view('report.reportDailyStudentDoorReportView')->with('result',$result)->with('from',$from)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('section',$section)->with('semister',$semister)->with('dept',$dept)->with('shift',$shift)->with('count_student',$count_student)->with('total_present_student',$total_present_student);
 } 
#------------------------ END STUDENT DOOR ATTENDENT REPORT----------------------------------#
// report class held summary
 public function totalClassHeldSummary()
 {
  return view('report.totalClassHeldSummary');
 }
// teachet total class held summary report
 public function reportTotalClassHeldSummaryView(Request $request)
 {
      $from_date   = trim($request->from); 
      $from        = date ("Y-m-d", strtotime($from_date));
      $explode     = explode('-',$from);
      $from_year   = $explode[0];
      $get_current_day     = date("l",strtotime($from));
      $current_year = date('Y');
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
    if($from > $this->rcdate1){
          echo 'f1';
          exit();
        }
        // get door holiday
        $holiday_count = DB::table('holiday')->where('holiday_date',$from)->count();
        if($holiday_count > 0){
          echo 'f2';
          exit();
        }
        if($from_year != $current_year){
          echo 'f3';
          exit();
        }
      // get all shift
      $result = DB::table('shift')->get();
      return view('view_report.reportTotalClassHeldSummaryView')->with('result',$result)->with('get_current_day',$get_current_day)->with('from',$from)->with('current_day',$current_day)->with('from_year',$from_year);
 }
 // over all summary report
 public function overAllSummaryReport()
 {
  return view('report.overAllSummaryReport');
 }
 // over all summary report view
 public function overAllSummaryReportView(Request $request)
 {
      $from_date   = trim($request->from); 
      $from        = date ("Y-m-d", strtotime($from_date));
      $explode     = explode('-',$from);
      $from_year   = $explode[0];
      $get_current_day     = date("l",strtotime($from));
      $current_year = date('Y');
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
    if($from > $this->rcdate1){
          echo 'f1';
          exit();
        }
        // get door holiday
        $holiday_count = DB::table('holiday')->where('door_holiday',0)->where('holiday_date',$from)->count();
        if($holiday_count > 0){
          echo 'f2';
          exit();
        }
        if($from_year != $current_year){
          echo 'f3';
          exit();
        }
      // attendent holiday count
    $attendent_holiday_count = DB::table('holiday')->where('attendent_holiday',0)->where('holiday_date',$from)->count();
    // total staff
    $total_staff_count = DB::table('users')->where('trasfer_status',0)->whereNotIn('type',[10])->count();
    // total teacher count 
    $total_teacher_count = DB::table('users')->where('trasfer_status',0)->where('type',3)->count();
    // total staff enter into the campus
    $total_staff_enter_into_campus = DB::table('tbl_door_log')->where('type',1)->whereNotIn('user_type',[10])->where('enter_date',$from)->distinct('user_id')->count('user_id');

    // total staff leave
    $total_staff_leave_count  = DB::table('tbl_leave')->where('final_request_from',$from)->where('status',1)->count();
    $total_teacher_leave_count = DB::table('tbl_leave')
                                ->join('users', 'users.id', '=', 'tbl_leave.user_id')
                                ->select('tbl_leave.*')
                                ->where('users.type', 3)
                                ->where('final_request_from',$from)
                                ->where('status',1)
                                ->count();
    $total_teacher_attendent_in_class = DB::table('teacher_attendent')->where('created_at',$from)->where('status',1)->where('type',3)->distinct('teacherId')->count('teacherId');
    // total class of this day
    $total_class_count = DB::table('routine')
                                ->join('semister', 'routine.semister_id', '=', 'semister.id')
                                ->select('routine.*')
                                ->where('routine.year', $from_year)
                                ->where('routine.day', $current_day)
                                ->where('semister.status',1)
                                ->count();

    // total teacher attendent class
    $teacher_taken_total_class_class =  DB::table('teacher_attendent')->where('created_at',$from)->where('status',1)->where('type',3)->count();
    #--------------------------------- student section------------------------------------#
    $total_student_count = DB::table('student')
                                ->join('semister', 'student.semister_id', '=', 'semister.id')
                                ->select('student.*')
                                ->where('student.year', $from_year)
                                ->where('student.status', 0)
                                ->where('semister.status',1)
                                ->count();
    $total_student_enter_into_campus = DB::table('tbl_door_log')->where('type',2)->where('enter_date',$from)->distinct('student_id')->count('student_id');
    $total_student_enter_into_class = DB::table('student_attendent')->where('created_at',$from)->distinct('studentId')->count('studentId');
   // total hours class of this day
   $total_class_hour_in_routine = DB::table('routine')
                                ->join('semister', 'routine.semister_id', '=', 'semister.id')
                                ->select('routine.*')
                                ->where('routine.year', $from_year)
                                ->where('routine.day', $current_day)
                                ->where('semister.status',1)
                                ->get();
   // total hours class held
    $total_hours_class_held_query = DB::table('teacher_attendent')->where('created_at',$from)->where('status',1)->where('type',3)->get(); 

    return view('view_report.overAllSummaryReportView')
    ->with('total_staff_count',$total_staff_count)
    ->with('total_teacher_count',$total_teacher_count)
    ->with('total_staff_enter_into_campus',$total_staff_enter_into_campus)
    ->with('total_staff_leave_count',$total_staff_leave_count)
    ->with('total_teacher_leave_count',$total_teacher_leave_count)
    ->with('total_teacher_attendent_in_class',$total_teacher_attendent_in_class)
    ->with('total_class_count',$total_class_count)
    ->with('teacher_taken_total_class_class',$teacher_taken_total_class_class)
    ->with('from',$from)
    ->with('attendent_holiday_count',$attendent_holiday_count)
    ->with('total_student_count',$total_student_count)
    ->with('total_student_enter_into_campus',$total_student_enter_into_campus)
    ->with('total_student_enter_into_class',$total_student_enter_into_class)
    ->with('total_class_hour_in_routine',$total_class_hour_in_routine)
    ->with('total_hours_class_held_query',$total_hours_class_held_query)
    ;
 }
 // door log report
 public function doorLogReport()
 {
  return view('report.doorLogReport');
 }
 // report door log view
 public function reportDoorLogView(Request $request)
 {
   $from_date            = trim($request->from_date);
   $from                 = date('Y-m-d',strtotime($from_date));
   $type_of_person       = trim($request->type_of_person);
   $order_is             = trim($request->order_is);
   $see_how_many_person  = trim($request->see_how_many_person);
   if($order_is == '1'){
    $valid_order = 'asc';
   }else{
   $valid_order = 'desc';
   }
   $holiday_count = DB::table('holiday')->where('holiday_date',$from)->count();
   if($holiday_count > 0){
    echo "f2";
    exit();
   }

  if($type_of_person == '0'){
    // fecth all data from tbl_door_log
    $count = DB::table('tbl_door_log')->where('enter_date',$from)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->count();
    if($count == '0'){
      echo "f1";
      exit();
    }
     
   }
   if($type_of_person == 'staff'){
    // all staff

     $count = DB::table('tbl_door_log')->where('enter_date',$from)->where('type',1)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->count();
      if($count == '0'){
      echo "f1";
      exit();
    }

   }
   if($type_of_person == 'stu'){
   $count = DB::table('tbl_door_log')->where('enter_date',$from)->where('type',2)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->count();
   if($count == '0'){
      echo "f1";
      exit();
    }
   }
    if($type_of_person == '2'){
    // all admin

          $count = DB::table('tbl_door_log')->where('enter_date',$from)->where('user_type',2)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->count();
      if($count == '0'){
      echo "f1";
      exit();
    }

   }
    if($type_of_person == '3'){
    // all teacher

      $count = DB::table('tbl_door_log')->where('enter_date',$from)->where('user_type',3)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->count();
      if($count == '0'){
      echo "f1";
      exit();
    }
   }
    if($type_of_person == '4'){
    // all craft
  
        $count = DB::table('tbl_door_log')->where('enter_date',$from)->where('user_type',4)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->count();
    if($count == '0'){
      echo "f1";
      exit();
    }

   }
    if($type_of_person == '5'){
    // all staff

        $count = DB::table('tbl_door_log')->where('enter_date',$from)->where('user_type',5)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->count();
      if($count == '0'){
      echo "f1";
      exit();
    }

   }
    if($type_of_person == '10'){
    // all guest

      $count = DB::table('tbl_door_log')->where('enter_date',$from)->where('user_type',10)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->count();
    if($count == '0'){
      echo "f1";
      exit();
    }
   }
   if($type_of_person == '0'){
    // fecth all data from tbl_door_log
    $result = DB::table('tbl_door_log')->where('enter_date',$from)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->get();
     
   }
   if($type_of_person == 'staff'){
    // all staff
     $result = DB::table('tbl_door_log')->where('enter_date',$from)->where('type',1)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->get();

   }
   if($type_of_person == 'stu'){
    // all student
      $result = DB::table('tbl_door_log')->where('type',2)->where('enter_date',$from)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->get();
   }
    if($type_of_person == '2'){
    // all admin
          $result = DB::table('tbl_door_log')->where('enter_date',$from)->where('user_type',2)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->get();

   }
    if($type_of_person == '3'){
    // all teacher
      $result = DB::table('tbl_door_log')->where('enter_date',$from)->where('user_type',3)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->get();

   }
    if($type_of_person == '4'){
    // all craft
        $result = DB::table('tbl_door_log')->where('enter_date',$from)->where('user_type',4)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->get();

   }
    if($type_of_person == '5'){
    // all staff
        $result = DB::table('tbl_door_log')->where('enter_date',$from)->where('user_type',5)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->get();

   }
    if($type_of_person == '10'){
    // all guest
      $result = DB::table('tbl_door_log')->where('enter_date',$from)->where('user_type',10)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->get();
   }
   return view('view_report.reportDoorLogView')->with('result',$result)->with('type_of_person',$type_of_person)->with('order_is',$order_is)->with('see_how_many_person',$see_how_many_person)->with('from',$from);
 }
 // staff leave report
 public function staffLeaveReport()
 {
        // get all staff
  $result = DB::table('users')
  ->leftJoin('department', 'users.dept', '=', 'department.id')
  ->select('users.*', 'department.departmentName')
  ->where('users.trasfer_status', 0)
  ->whereNotIn('users.type', [10])
  ->orderBy('users.user_id','asc')
  ->get();
  return view('report.staffLeaveReport')->with('result',$result) ;
 }
 // staff leave report view
 public function staffLeaveReportView(Request $request)
 {
    $from_date = trim($request->from);
    $from      = date('Y-m-d',strtotime($from_date));
    $to_date   = trim($request->to);
    $to        = date('Y-m-d',strtotime($to_date));
    $staff     = trim($request->staff);

  if($staff == '0'){
  // for all staff
  $count = DB::table('users')
  ->join('tbl_leave','users.id', '=', 'tbl_leave.user_id')
  ->leftJoin('department', 'users.dept', '=', 'department.id','tbl_leave.final_request_from')
  ->select('users.*', 'department.departmentName')
  ->where('tbl_leave.type_status',0)
  ->whereBetween('tbl_leave.final_request_from', [$from, $to])
  ->count();
  if($count == '0'){
    echo 'f1';
    exit();
  }
  }else{
  // individual staff
  $count = DB::table('users')
  ->join('tbl_leave','users.id', '=', 'tbl_leave.user_id')
  ->leftJoin('department', 'users.dept', '=', 'department.id')
  ->select('users.*', 'department.departmentName','tbl_leave.final_request_from')
  ->where('tbl_leave.user_id',$staff)
  ->where('tbl_leave.type_status',0)
  ->whereBetween('tbl_leave.final_request_from', [$from, $to])
  ->count();
  if($count == '0'){
    echo 'f1';
    exit();
  }
    }

  if($staff == '0'){
  // for all staff
  $result = DB::table('users')
  ->join('tbl_leave','users.id', '=', 'tbl_leave.user_id')
  ->leftJoin('department', 'users.dept', '=', 'department.id')
  ->select('users.*', 'department.departmentName','tbl_leave.final_request_from')
  ->where('tbl_leave.type_status',0)
  ->whereBetween('tbl_leave.final_request_from', [$from, $to])
  ->get();
  }else{
  // individual staff
  $result = DB::table('users')
  ->join('tbl_leave','users.id', '=', 'tbl_leave.user_id')
  ->leftJoin('department', 'users.dept', '=', 'department.id','tbl_leave.final_request_from')
  ->select('users.*', 'department.departmentName','tbl_leave.final_request_from')
  ->where('tbl_leave.user_id',$staff)
  ->where('tbl_leave.type_status',0)
  ->whereBetween('tbl_leave.final_request_from', [$from, $to])
  ->get();
    }
    return view('view_report.staffLeaveReportView')->with('result',$result)->with('from',$from)->with('to',$to)->with('staff',$staff); 
 }
 // view today attendent list
 public function viewStudentAttendentList($routine_id , $rcdate)
 {
   $count_this_day_holiday  = DB::table('holiday')->where('holiday_date',$rcdate)->count();
   if($count_this_day_holiday > 0){
    // get shift name form rourine id
      $year_explode_shift = explode('-', $rcdate);
      $year_shift         = $year_explode_shift[0] ;

    $shift_query_from_routine = DB::table('routine')->where('id',$routine_id)->where('year',$year_shift)->limit(1)->first();

        Session::put('failed','Sorry ! Sorry This Day Is Class Holiday');
        return Redirect::to('showTodayAttendent/'.$shift_query_from_routine->shift_id);
        exit();
   }
   // get information
 $count  = DB::table('student_attendent')->where('class_no',$routine_id)->where('created_at',$rcdate)->count();
 if($count > 0){
  $info_query = DB::table('student_attendent')->where('class_no',$routine_id)->where('created_at',$rcdate)->first();

   $year            = $info_query->year ;
   $shift_id        = $info_query->shift_id ;
   $dept_id         = $info_query->dept_id ;
   $semister_id     = $info_query->semister_id ;
   $section_id      = $info_query->section_id ;
   $routine_id      = $info_query->class_no ;
   $routine_query   = DB::table('routine')->where('id',$routine_id)->where('year',$year)->first();
  $subject_id = $routine_query->subject_id ;
  $teacher_id = $routine_query->teacher_id ;
  }else{
  // get subject id and teacher id by routine
  $year_explode = explode('-', $rcdate);
  $year         = $year_explode[0] ;

  $routine_query = DB::table('routine')->where('id',$routine_id)->where('year',$year)->first();
  $subject_id = $routine_query->subject_id ;
  $teacher_id = $routine_query->teacher_id ;

   $shift_id    = $routine_query->shift_id ;
   $dept_id     = $routine_query->dept_id ;
   $semister_id = $routine_query->semister_id ;
   $section_id  = $routine_query->section_id ;
   $routine_id  = $routine_query->id ;
  }

   $dept_info = DB::table('department')->where('id',$dept_id)->first();
   $shift_info = DB::table('shift')->where('id',$shift_id)->first();
   $semister_info = DB::table('semister')->where('id',$semister_id)->first();
   $section_info = DB::table('section')->where('id',$section_id)->first();
   $subject_info = DB::table('subject')->where('id',$subject_id)->first();
   $teacher_info = DB::table('users')->where('id',$teacher_id)->first();
   // get leave info
   $teacher_leave_count = DB::table('tbl_leave')->where('user_id', $teacher_id)->where('final_request_from',$rcdate)->where('type_status',0)->count();
  // get traning info
   $teacher_traning_count = DB::table('tbl_leave')->where('user_id', $teacher_id)->where('final_request_from',$rcdate)->where('type_status',1)->count();
  // get attendent list of this class by join query
   $result = DB::table('student_attendent')
  ->join('routine','student_attendent.class_no', '=', 'routine.id')
  ->join('students', 'student_attendent.studentId', '=', 'students.id')
  ->join('student', 'student_attendent.studentId', '=', 'student.studentID')
  ->select('student_attendent.*', 'routine.subject_id','students.studentName','students.studentMobile','students.studentImage','student.registration')
  ->where('student_attendent.class_no',$routine_id)
  ->where('student_attendent.created_at',$rcdate)
   ->where('student.year',$year)
   ->where('student.shift_id',$shift_id)
   ->where('student.dept_id',$dept_id)
   ->where('student.semister_id',$semister_id)
   ->where('student.section_id',$section_id)
   ->orderBy('student_attendent.enter_time','asc')
  ->get();

  if($count > 0){

foreach($result as $value) {
    //do something
    $attentdent_id[] = $value->studentId;
}
$absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
   ->where('student.year',$year)
   ->where('student.shift_id',$shift_id)
   ->where('student.dept_id',$dept_id)
   ->where('student.semister_id',$semister_id)
   ->where('student.section_id',$section_id)
   ->whereNotIn('student.studentID',$attentdent_id)
   ->orderBy('student.roll','asc')
  ->get();
}else{
  $absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
   ->where('student.year',$year)
   ->where('student.shift_id',$shift_id)
   ->where('student.dept_id',$dept_id)
   ->where('student.semister_id',$semister_id)
   ->where('student.section_id',$section_id)
   ->orderBy('student.roll','asc')
   ->get();
}
  return view ('report.viewStudentAttendentList')->with('result',$result)->with('count',$count)->with('absent_result',$absent_result)->with('year',$year)->with('dept_info',$dept_info)->with('shift_info',$shift_info)->with('semister_info',$semister_info)->with('section_info',$section_info)->with('subject_info',$subject_info)->with('teacher_info',$teacher_info)->with('routine_query',$routine_query)->with('routine_id' ,$routine_id)->with('rcdate',$rcdate)->with('teacher_leave_count',$teacher_leave_count)->with('teacher_traning_count',$teacher_traning_count)->with('count_this_day_holiday',$count_this_day_holiday);

 }
 // view student attendent by department head
 public function viewStudentAttendentListByDeptHead($routine_id , $rcdate)
 {
     $count_this_day_holiday  = DB::table('holiday')->where('holiday_date',$rcdate)->count();
   if($count_this_day_holiday > 0){
    // get shift name form rourine id
      $year_explode_shift = explode('-', $rcdate);
      $year_shift         = $year_explode_shift[0] ;

    $shift_query_from_routine = DB::table('routine')->where('id',$routine_id)->where('year',$year_shift)->limit(1)->first();

        Session::put('failed','Sorry ! Sorry This Day Is Class Holiday');
        return Redirect::to('viewStudentAttendentListByDeptHead/'.$shift_query_from_routine->shift_id);
        exit();
   }
  // get information
  $count  = DB::table('student_attendent')->where('class_no',$routine_id)->where('created_at',$rcdate)->count();
 if($count > 0){
  $info_query = DB::table('student_attendent')->where('class_no',$routine_id)->where('created_at',$rcdate)->first();

   $year            = $info_query->year ;
   $shift_id        = $info_query->shift_id ;
   $dept_id         = $info_query->dept_id ;
   $semister_id     = $info_query->semister_id ;
   $section_id      = $info_query->section_id ;
   $routine_id      = $info_query->class_no ;
   $routine_query   = DB::table('routine')->where('id',$routine_id)->where('year',$year)->first();
  $subject_id = $routine_query->subject_id ;
  $teacher_id = $routine_query->teacher_id ;
  }else{
  // get subject id and teacher id by routine
  $year_explode = explode('-', $rcdate);
  $year         = $year_explode[0] ;

  $routine_query = DB::table('routine')->where('id',$routine_id)->where('year',$year)->first();
  $subject_id = $routine_query->subject_id ;
  $teacher_id = $routine_query->teacher_id ;

   $shift_id    = $routine_query->shift_id ;
   $dept_id     = $routine_query->dept_id ;
   $semister_id = $routine_query->semister_id ;
   $section_id  = $routine_query->section_id ;
   $routine_id  = $routine_query->id ;
  }

   $dept_info = DB::table('department')->where('id',$dept_id)->first();
   $shift_info = DB::table('shift')->where('id',$shift_id)->first();
   $semister_info = DB::table('semister')->where('id',$semister_id)->first();
   $section_info = DB::table('section')->where('id',$section_id)->first();
   $subject_info = DB::table('subject')->where('id',$subject_id)->first();
   $teacher_info = DB::table('users')->where('id',$teacher_id)->first();
   // get leave info
   $teacher_leave_count = DB::table('tbl_leave')->where('user_id', $teacher_id)->where('final_request_from',$rcdate)->where('type_status',0)->count();
  // get traning info
   $teacher_traning_count = DB::table('tbl_leave')->where('user_id', $teacher_id)->where('final_request_from',$rcdate)->where('type_status',1)->count();
  // get attendent list of this class by join query
   $result = DB::table('student_attendent')
  ->join('routine','student_attendent.class_no', '=', 'routine.id')
  ->join('students', 'student_attendent.studentId', '=', 'students.id')
  ->join('student', 'student_attendent.studentId', '=', 'student.studentID')
  ->select('student_attendent.*', 'routine.subject_id','students.studentName','students.studentMobile','students.studentImage','student.registration')
  ->where('student_attendent.class_no',$routine_id)
  ->where('student_attendent.created_at',$rcdate)
   ->where('student.year',$year)
   ->where('student.shift_id',$shift_id)
   ->where('student.dept_id',$dept_id)
   ->where('student.semister_id',$semister_id)
   ->where('student.section_id',$section_id)
   ->orderBy('student_attendent.enter_time','asc')
  ->get();

  if($count > 0){

foreach($result as $value) {
    //do something
    $attentdent_id[] = $value->studentId;
}
$absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
   ->where('student.year',$year)
   ->where('student.shift_id',$shift_id)
   ->where('student.dept_id',$dept_id)
   ->where('student.semister_id',$semister_id)
   ->where('student.section_id',$section_id)
   ->whereNotIn('student.studentID',$attentdent_id)
   ->orderBy('student.roll','asc')
  ->get();
}else{
  $absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
   ->where('student.year',$year)
   ->where('student.shift_id',$shift_id)
   ->where('student.dept_id',$dept_id)
   ->where('student.semister_id',$semister_id)
   ->where('student.section_id',$section_id)
   ->orderBy('student.roll','asc')
   ->get();
}
  return view ('report.viewStudentAttendentListByDeptHead')->with('result',$result)->with('count',$count)->with('absent_result',$absent_result)->with('year',$year)->with('dept_info',$dept_info)->with('shift_info',$shift_info)->with('semister_info',$semister_info)->with('section_info',$section_info)->with('subject_info',$subject_info)->with('teacher_info',$teacher_info)->with('routine_query',$routine_query)->with('routine_id' ,$routine_id)->with('rcdate',$rcdate)->with('teacher_leave_count',$teacher_leave_count)->with('teacher_traning_count',$teacher_traning_count)->with('count_this_day_holiday',$count_this_day_holiday);
 }

 #------------------------------------ PRESENT ABSENT REPORT-----------------------------------#
  public function reportPeriodicClassWiseTopPresentList()
  {
      $year           = DB::table('student')->distinct()->get(array('year'));
      $shift          = DB::table('shift')->get();
      $dept           = DB::table('department')->where('status',1)->get();
      $semister       = DB::table('semister')->where('status',1)->get();
     return view('report.reportPeriodicClassWiseTopPresentList')
      ->with('year',$year)
      ->with('shift',$shift)
      ->with('dept',$dept)
      ->with('semister',$semister);
  }
  // report perodic top present list
  public function reportPeriodicClassWiseTopPresentListView(Request $request)
  {
        $year        = trim($request->year) ;
        $shift       = trim($request->shift);
        $dept        = trim($request->dept);
        $semister    = trim($request->semister);
        $section     = trim($request->section);
        $date_form   = trim($request->from); 
        $from        = date ("Y-m-d", strtotime($date_form));
        $date_to     = trim($request->to); 
        $date_too    = trim($request->to);
        $to          = date ("Y-m-d", strtotime($date_to));

     $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
      ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT(student_attendent.studentId) AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
       ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','DESC')
      ->orderBy('student_attendent.roll','ASC')
      ->get();

       $get_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereNotIn('type',[1])
                         ->whereBetween('holiday_date', [$from, $to])->get();

  
  $total_holiday_class = 0 ;
  foreach ($get_holiday as $holidays) {
  $day_no =  date('D', strtotime($holidays->holiday_date));
  //echo $day_no;
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
// count total holiday class
$holiday_total_class = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day)->count();
$total_holiday_class = $total_holiday_class+$holiday_total_class;
 }
#-----------------end total holiday class calulation---------------------#
  // total holiday 
 $get_all_holiday =  DB::table('holiday')
                    ->where('year',$year)
                    ->whereBetween('holiday_date', [$from, $to])->get(['holiday_date']);
                   $data = array();
                   foreach ($get_all_holiday as $data1) {
                     $data[] = $data1->holiday_date;
                   }

   
$date_from = strtotime($from); 
$date_to = strtotime($to); 
$list = array();
for ($i=$date_from; $i<=$date_to; $i+=86400) {  
    $list[] = date("Y-m-d", $i);  
}  
$total_class_day = array_diff($list,$data);
$totalClassNo = 0 ; 
foreach ($total_class_day as $total_class_days) {
  $class_day_no =  date('D', strtotime($total_class_days));
  if($class_day_no == 'Sat'){
 $day_number = '1';
}elseif($class_day_no == 'Sun'){
  $day_number = '2';
}elseif($class_day_no == 'Mon'){
     $day_number = '3';
}elseif($class_day_no == 'Tue'){
     $day_number = '4';
}elseif($class_day_no == 'Wed'){
     $day_number = '5';
}elseif($class_day_no == 'Thu'){
     $day_number = '6';
}elseif($class_day_no == 'Fri'){
     $day_number = '7';
}
// count total holiday class
$count_total_class_month = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day_number)->count();
$totalClassNo = $totalClassNo+$count_total_class_month;
}

foreach($result as $value) {
    //do something
    $attentdent_id[] = $value->studentId;
}
$absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
        ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
   ->whereNotIn('student.studentID',$attentdent_id)
   ->orderBy('student.roll','asc')
   ->get();



          $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();
     return view('view_report.reportPeriodicClassWiseTopPresentListView')->with('result',$result)->with('totalClassNo',$totalClassNo)->with('total_holiday_class',$total_holiday_class)->with('from',$from)->with('to',$to)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('dept',$dept)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('date_form',$date_form)->with('date_to',$date_too)->with('absent_result',$absent_result);


  }
  // top perodict absent list
  public function reportPeriodicClassWiseTopAbsentList()
  {
      $year           = DB::table('student')->distinct()->get(array('year'));
      $shift          = DB::table('shift')->get();
      $dept           = DB::table('department')->where('status',1)->get();
      $semister       = DB::table('semister')->where('status',1)->get();
     return view('report.reportPeriodicClassWiseTopAbsentList')
      ->with('year',$year)
      ->with('shift',$shift)
      ->with('dept',$dept)
      ->with('semister',$semister);
  }
  // top perocid absent report list
  public function reportPeriodicClassWiseTopAbsentListView(Request $request)
  {
        $year        = trim($request->year) ;
        $shift       = trim($request->shift);
        $dept        = trim($request->dept);
        $semister    = trim($request->semister);
        $section     = trim($request->section);
        $date_form   = trim($request->from); 
        $from        = date ("Y-m-d", strtotime($date_form));
        $date_to     = trim($request->to); 
        $date_too    = trim($request->to);
        $to          = date ("Y-m-d", strtotime($date_to));

     $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
      ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT(student_attendent.studentId) AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
       ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','ASC')
      ->orderBy('student_attendent.roll','ASC')
      ->get();

       $get_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereNotIn('type',[1])
                         ->whereBetween('holiday_date', [$from, $to])->get();

  
  $total_holiday_class = 0 ;
  foreach ($get_holiday as $holidays) {
  $day_no =  date('D', strtotime($holidays->holiday_date));
  //echo $day_no;
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
// count total holiday class
$holiday_total_class = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day)->count();
$total_holiday_class = $total_holiday_class+$holiday_total_class;
 }
#-----------------end total holiday class calulation---------------------#
  // total holiday 
 $get_all_holiday =  DB::table('holiday')
                    ->where('year',$year)
                    ->whereBetween('holiday_date', [$from, $to])->get(['holiday_date']);
                   $data = array();
                   foreach ($get_all_holiday as $data1) {
                     $data[] = $data1->holiday_date;
                   }

   
$date_from = strtotime($from); 
$date_to = strtotime($to); 
$list = array();
for ($i=$date_from; $i<=$date_to; $i+=86400) {  
    $list[] = date("Y-m-d", $i);  
}  
$total_class_day = array_diff($list,$data);
$totalClassNo = 0 ; 
foreach ($total_class_day as $total_class_days) {
  $class_day_no =  date('D', strtotime($total_class_days));
  if($class_day_no == 'Sat'){
 $day_number = '1';
}elseif($class_day_no == 'Sun'){
  $day_number = '2';
}elseif($class_day_no == 'Mon'){
     $day_number = '3';
}elseif($class_day_no == 'Tue'){
     $day_number = '4';
}elseif($class_day_no == 'Wed'){
     $day_number = '5';
}elseif($class_day_no == 'Thu'){
     $day_number = '6';
}elseif($class_day_no == 'Fri'){
     $day_number = '7';
}
// count total holiday class
$count_total_class_month = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day_number)->count();
$totalClassNo = $totalClassNo+$count_total_class_month;
}
foreach($result as $value) {
    //do something
    $attentdent_id[] = $value->studentId;
}
$absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
        ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
   ->whereNotIn('student.studentID',$attentdent_id)
   ->orderBy('student.roll','asc')
   ->get();

          $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();
     return view('view_report.reportPeriodicClassWiseTopAbsentListView')->with('result',$result)->with('totalClassNo',$totalClassNo)->with('total_holiday_class',$total_holiday_class)->with('from',$from)->with('to',$to)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('dept',$dept)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('date_form',$date_form)->with('date_to',$date_too)->with('absent_result',$absent_result);
  }

  // class wise percentage sorting present list
  public function reportPeriodicClassWisePercentagePresentList()
  {
      $year           = DB::table('student')->distinct()->get(array('year'));
      $shift          = DB::table('shift')->get();
      $dept           = DB::table('department')->where('status',1)->get();
      $semister       = DB::table('semister')->where('status',1)->get();
     return view('report.reportPeriodicClassWisePercentagePresentList')
      ->with('year',$year)
      ->with('shift',$shift)
      ->with('dept',$dept)
      ->with('semister',$semister);
  }
// perodice class wise report view
  public function reportPeriodicClassWisePercentagePresentListView(Request $request)
  {
        $year        = trim($request->year) ;
        $shift       = trim($request->shift);
        $dept        = trim($request->dept);
        $semister    = trim($request->semister);
        $section     = trim($request->section);
        $date_form   = trim($request->from); 
        $from        = date ("Y-m-d", strtotime($date_form));
        $date_to     = trim($request->to); 
        $date_too    = trim($request->to);
        $to          = date ("Y-m-d", strtotime($date_to));
        $sorting_type = trim($request->sorting_type);
        $percentage_class_number = trim($request->percentage_class_number).'.00';

       $get_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereNotIn('type',[1])
                         ->whereBetween('holiday_date', [$from, $to])->get();
  $total_holiday_class = 0 ;
  foreach ($get_holiday as $holidays) {
  $day_no =  date('D', strtotime($holidays->holiday_date));
  //echo $day_no;
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
// count total holiday class
$holiday_total_class = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day)->count();
$total_holiday_class = $total_holiday_class+$holiday_total_class;
 }
#-----------------end total holiday class calulation---------------------#
  // total holiday 
 $get_all_holiday =  DB::table('holiday')
                    ->where('year',$year)
                    ->whereBetween('holiday_date', [$from, $to])->get(['holiday_date']);
                   $data = array();
                   foreach ($get_all_holiday as $data1) {
                     $data[] = $data1->holiday_date;
                   }

$date_from = strtotime($from); 
$date_to = strtotime($to); 
$list = array();
for ($i=$date_from; $i<=$date_to; $i+=86400) {  
    $list[] = date("Y-m-d", $i);  
}  
$total_class_day = array_diff($list,$data);
$totalClassNo = 0 ; 
foreach ($total_class_day as $total_class_days) {
  $class_day_no =  date('D', strtotime($total_class_days));
  if($class_day_no == 'Sat'){
 $day_number = '1';
}elseif($class_day_no == 'Sun'){
  $day_number = '2';
}elseif($class_day_no == 'Mon'){
     $day_number = '3';
}elseif($class_day_no == 'Tue'){
     $day_number = '4';
}elseif($class_day_no == 'Wed'){
     $day_number = '5';
}elseif($class_day_no == 'Thu'){
     $day_number = '6';
}elseif($class_day_no == 'Fri'){
     $day_number = '7';
}
// count total holiday class
$count_total_class_month = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day_number)->count();
$totalClassNo = $totalClassNo+$count_total_class_month;
}
   if($sorting_type == '1'){
  $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
      ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT(student_attendent.studentId) * 100 /".$totalClassNo." AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
       ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('student_attendent.roll','ASC')
      ->get();
    }elseif($sorting_type == '2'){
      $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
      ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT(student_attendent.studentId) * 100 /".$totalClassNo." AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
       ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','DESC')
      ->orderBy('student_attendent.roll','ASC')
      ->get();
    }elseif($sorting_type == '3'){
       $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
      ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT(student_attendent.studentId) * 100 /".$totalClassNo." AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
       ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','DESC')
      ->orderBy('student_attendent.roll','ASC')
      ->get();
    }

    foreach($result as $value) {
    //do something
    $attentdent_id[] = $value->studentId;
}
$absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
        ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
   ->whereNotIn('student.studentID',$attentdent_id)
   ->orderBy('student.roll','asc')
   ->get();

         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();
     return view('view_report.reportPeriodicClassWisePercentagePresentListView')->with('result',$result)->with('totalClassNo',$totalClassNo)->with('total_holiday_class',$total_holiday_class)->with('from',$from)->with('to',$to)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('dept',$dept)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('date_form',$date_form)->with('date_to',$date_too)->with('percentage_class_number',$percentage_class_number)->with('sorting_type',$sorting_type)->with('absent_result',$absent_result);

  }

  // percenatge absent list 
  public function reportPeriodicClassWisePercentageAbsentList()
  {
      $year           = DB::table('student')->distinct()->get(array('year'));
      $shift          = DB::table('shift')->get();
      $dept           = DB::table('department')->where('status',1)->get();
      $semister       = DB::table('semister')->where('status',1)->get();
     return view('report.reportPeriodicClassWisePercentageAbsentList')
      ->with('year',$year)
      ->with('shift',$shift)
      ->with('dept',$dept)
      ->with('semister',$semister);
  }
 // perodic absent list
  public function reportPeriodicClassWisePercentageAbsentListView(Request $request)
  {
        $year        = trim($request->year) ;
        $shift       = trim($request->shift);
        $dept        = trim($request->dept);
        $semister    = trim($request->semister);
        $section     = trim($request->section);
        $date_form   = trim($request->from); 
        $from        = date ("Y-m-d", strtotime($date_form));
        $date_to     = trim($request->to); 
        $date_too    = trim($request->to);
        $to          = date ("Y-m-d", strtotime($date_to));
        $sorting_type = trim($request->sorting_type);
        $percentage_class_number = trim($request->percentage_class_number).'.00';

       $get_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereNotIn('type',[1])
                         ->whereBetween('holiday_date', [$from, $to])->get();
  $total_holiday_class = 0 ;
  foreach ($get_holiday as $holidays) {
  $day_no =  date('D', strtotime($holidays->holiday_date));
  //echo $day_no;
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
// count total holiday class
$holiday_total_class = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day)->count();
$total_holiday_class = $total_holiday_class+$holiday_total_class;
 }
#-----------------end total holiday class calulation---------------------#
  // total holiday 
 $get_all_holiday =  DB::table('holiday')
                    ->where('year',$year)
                    ->whereBetween('holiday_date', [$from, $to])->get(['holiday_date']);
                   $data = array();
                   foreach ($get_all_holiday as $data1) {
                     $data[] = $data1->holiday_date;
                   }

$date_from = strtotime($from); 
$date_to = strtotime($to); 
$list = array();
for ($i=$date_from; $i<=$date_to; $i+=86400) {  
    $list[] = date("Y-m-d", $i);  
}  
$total_class_day = array_diff($list,$data);
$totalClassNo = 0 ; 
foreach ($total_class_day as $total_class_days) {
  $class_day_no =  date('D', strtotime($total_class_days));
  if($class_day_no == 'Sat'){
 $day_number = '1';
}elseif($class_day_no == 'Sun'){
  $day_number = '2';
}elseif($class_day_no == 'Mon'){
     $day_number = '3';
}elseif($class_day_no == 'Tue'){
     $day_number = '4';
}elseif($class_day_no == 'Wed'){
     $day_number = '5';
}elseif($class_day_no == 'Thu'){
     $day_number = '6';
}elseif($class_day_no == 'Fri'){
     $day_number = '7';
}
// count total holiday class
$count_total_class_month = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day_number)->count();
$totalClassNo = $totalClassNo+$count_total_class_month;
}
   if($sorting_type == '1'){
  $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
      ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT(student_attendent.studentId) * 100 /".$totalClassNo." AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
       ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('student_attendent.roll','ASC')
      ->get();
    }elseif($sorting_type == '2'){
      $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
      ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT(student_attendent.studentId) * 100 /".$totalClassNo." AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
       ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','ASC')
      ->orderBy('student_attendent.roll','ASC')
      ->get();
    }elseif($sorting_type == '3'){
       $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
      ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT(student_attendent.studentId) * 100 /".$totalClassNo." AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
       ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','ASC')
      ->orderBy('student_attendent.roll','ASC')
      ->get();
    }

    foreach($result as $value) {
    //do something
    $attentdent_id[] = $value->studentId;
}
$absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
        ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
   ->whereNotIn('student.studentID',$attentdent_id)
   ->orderBy('student.roll','asc')
   ->get();

         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();
     return view('view_report.reportPeriodicClassWisePercentageAbsentListView')->with('result',$result)->with('totalClassNo',$totalClassNo)->with('total_holiday_class',$total_holiday_class)->with('from',$from)->with('to',$to)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('dept',$dept)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('date_form',$date_form)->with('date_to',$date_too)->with('percentage_class_number',$percentage_class_number)->with('sorting_type',$sorting_type)->with('absent_result',$absent_result);

  }
 #------------------------------------ END PRESENT ABSENT REPORT-------------------------------#
 #------------------------------------ PRSENT ABSENT REPORT BY DAY-----------------------------#
  public function reportPeriodicStudentPresentList()
  {
      $year           = DB::table('student')->distinct()->get(array('year'));
      $shift          = DB::table('shift')->get();
      $dept           = DB::table('department')->where('status',1)->get();
      $semister       = DB::table('semister')->where('status',1)->get();
     return view('report.reportPeriodicStudentPresentList')
      ->with('year',$year)
      ->with('shift',$shift)
      ->with('dept',$dept)
      ->with('semister',$semister);
  }
  // peridic stuent attendent report
  public function reportPeriodicStudentPresentListView(Request $request)
  {
        $year        = trim($request->year) ;
        $shift       = trim($request->shift);
        $dept        = trim($request->dept);
        $semister    = trim($request->semister);
        $section     = trim($request->section);
        $date_form   = trim($request->from); 
        $from        = date ("Y-m-d", strtotime($date_form));
        $date_to     = trim($request->to); 
        $date_too    = trim($request->to);
        $to          = date ("Y-m-d", strtotime($date_to));
        $sorting_type = trim($request->sorting_type);
        $attendent_days = trim($request->attendent_days);

        $count_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereBetween('holiday_date', [$from, $to])->count();
        // total day caluclation
        $date1 = date_create($from);
        $date2 = date_create($to);
        //difference between two dates
        $diff       = date_diff($date1,$date2);
        $total_day  = $diff->format("%a")+1;
        if($sorting_type == '1'){
      $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
       ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT( DISTINCT student_attendent.created_at) AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
      ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('student_attendent.studentId','ASC')
      ->get();
    }elseif($sorting_type == '2'){
      $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
       ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT( DISTINCT student_attendent.created_at) AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
      ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','DESC')
      ->orderBy('student_attendent.studentId','ASC')
      ->get();
    }elseif($sorting_type == '3'){
         $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
       ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT( DISTINCT student_attendent.created_at) AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
      ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','DESC')
      ->orderBy('student_attendent.studentId','ASC')
      ->get();
    }

    foreach($result as $value) {
    //do something
    $attentdent_id[] = $value->studentId;
}
$absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
        ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
   ->whereNotIn('student.studentID',$attentdent_id)
   ->orderBy('student.roll','asc')
   ->get();

         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();
      return view('view_report.reportPeriodicStudentPresentListView')->with('result',$result)->with('count_holiday',$count_holiday)->with('total_day',$total_day)->with('from',$from)->with('to',$to)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('shift',$shift)->with('dept',$dept)->with('semister',$semister)->with('section',$section)->with('date_form',$date_form)->with('date_to',$date_to)->with('absent_result',$absent_result)->with('attendent_days',$attendent_days)->with('sorting_type',$sorting_type); 



  }
  // perodic absent list
  public function reportPeriodicStudentAbsentList()
  {
      $year           = DB::table('student')->distinct()->get(array('year'));
      $shift          = DB::table('shift')->get();
      $dept           = DB::table('department')->where('status',1)->get();
      $semister       = DB::table('semister')->where('status',1)->get();
     return view('report.reportPeriodicStudentAbsentList')
      ->with('year',$year)
      ->with('shift',$shift)
      ->with('dept',$dept)
      ->with('semister',$semister);
  }

  // perodic absent student list
  public function reportPeriodicStudentAbsentListView(Request $request)
  {
     $year        = trim($request->year) ;
        $shift       = trim($request->shift);
        $dept        = trim($request->dept);
        $semister    = trim($request->semister);
        $section     = trim($request->section);
        $date_form   = trim($request->from); 
        $from        = date ("Y-m-d", strtotime($date_form));
        $date_to     = trim($request->to); 
        $date_too    = trim($request->to);
        $to          = date ("Y-m-d", strtotime($date_to));
        $sorting_type = trim($request->sorting_type);
        $attendent_days = trim($request->attendent_days);

        $count_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereBetween('holiday_date', [$from, $to])->count();
        // total day caluclation
        $date1 = date_create($from);
        $date2 = date_create($to);
        //difference between two dates
        $diff       = date_diff($date1,$date2);
        $total_day  = $diff->format("%a")+1;
        if($sorting_type == '1'){
      $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
       ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT( DISTINCT student_attendent.created_at) AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
      ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('student_attendent.studentId','ASC')
      ->get();
    }elseif($sorting_type == '2'){
      $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
       ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT( DISTINCT student_attendent.created_at) AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
      ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','ASC')
      ->orderBy('student_attendent.studentId','ASC')
      ->get();
    }elseif($sorting_type == '3'){
         $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
       ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT( DISTINCT student_attendent.created_at) AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
      ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','ASC')
      ->orderBy('student_attendent.studentId','ASC')
      ->get();
    }

    foreach($result as $value) {
    //do something
    $attentdent_id[] = $value->studentId;
}
$absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
        ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
   ->whereNotIn('student.studentID',$attentdent_id)
   ->orderBy('student.roll','asc')
   ->get();

         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();
      return view('view_report.reportPeriodicStudentAbsentListView')->with('result',$result)->with('count_holiday',$count_holiday)->with('total_day',$total_day)->with('from',$from)->with('to',$to)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('shift',$shift)->with('dept',$dept)->with('semister',$semister)->with('section',$section)->with('date_form',$date_form)->with('date_to',$date_to)->with('absent_result',$absent_result)->with('attendent_days',$attendent_days)->with('sorting_type',$sorting_type); 

  }
 #----------------------------------- END PRESENT ABSENT REPORT BY DAY------------------------#
  // staff trainint report
  public function staffTrainingReport()
  {
            // get all staff
  $result = DB::table('users')
  ->leftJoin('department', 'users.dept', '=', 'department.id')
  ->select('users.*', 'department.departmentName')
  ->where('users.trasfer_status', 0)
  ->whereNotIn('users.type', [10])
  ->orderBy('users.user_id','asc')
  ->get();
  return view('report.staffTrainingReport')->with('result',$result) ;
  }
  // staff training report 
  public function staffTrainingReportView(Request $request)
  {
    $from_date = trim($request->from);
    $from      = date('Y-m-d',strtotime($from_date));
    $to_date   = trim($request->to);
    $to        = date('Y-m-d',strtotime($to_date));
    $staff     = trim($request->staff);

  if($staff == '0'){
  // for all staff
  $count = DB::table('users')
  ->join('tbl_leave','users.id', '=', 'tbl_leave.user_id')
  ->leftJoin('department', 'users.dept', '=', 'department.id','tbl_leave.final_request_from')
  ->select('users.*', 'department.departmentName')
  ->where('tbl_leave.type_status',1)
  ->whereBetween('tbl_leave.final_request_from', [$from, $to])
  ->count();
  if($count == '0'){
    echo 'f1';
    exit();
  }
  }else{
  // individual staff
  $count = DB::table('users')
  ->join('tbl_leave','users.id', '=', 'tbl_leave.user_id')
  ->leftJoin('department', 'users.dept', '=', 'department.id')
  ->select('users.*', 'department.departmentName','tbl_leave.final_request_from')
  ->where('tbl_leave.user_id',$staff)
  ->where('tbl_leave.type_status',1)
  ->whereBetween('tbl_leave.final_request_from', [$from, $to])
  ->count();
  if($count == '0'){
    echo 'f1';
    exit();
  }
    }

  if($staff == '0'){
  // for all staff
  $result = DB::table('users')
  ->join('tbl_leave','users.id', '=', 'tbl_leave.user_id')
  ->leftJoin('department', 'users.dept', '=', 'department.id')
  ->select('users.*', 'department.departmentName','tbl_leave.final_request_from')
  ->where('tbl_leave.type_status',1)
  ->whereBetween('tbl_leave.final_request_from', [$from, $to])
  ->get();
  }else{
  // individual staff
  $result = DB::table('users')
  ->join('tbl_leave','users.id', '=', 'tbl_leave.user_id')
  ->leftJoin('department', 'users.dept', '=', 'department.id','tbl_leave.final_request_from')
  ->select('users.*', 'department.departmentName','tbl_leave.final_request_from')
  ->where('tbl_leave.user_id',$staff)
  ->where('tbl_leave.type_status',1)
  ->whereBetween('tbl_leave.final_request_from', [$from, $to])
  ->get();
    }
    return view('view_report.staffTrainingReportView')->with('result',$result)->with('from',$from)->with('to',$to)->with('staff',$staff); 
  }
  // holiday report
  public function holidayReport()
  {

    return view('report.holidayReport');
  }
  // holiday report view
  public function holidayReportView(Request $request)
  {
    $from_date = trim($request->from);
    $from      = date('Y-m-d',strtotime($from_date));
    $to_date   = trim($request->to);
    $to        = date('Y-m-d',strtotime($to_date));
    $holiday_type     = trim($request->holiday_type);
    $explode_holiday_type = explode('/', $holiday_type);
    $holiday_type_is = $explode_holiday_type[0];

  if($holiday_type == ''){
  // for all staff
  $count = DB::table('holiday')
  ->whereBetween('holiday_date', [$from, $to])
  ->count();
  if($count == '0'){
    echo 'f1';
    exit();
  }
  }else{
  // individual staff
  $count = DB::table('holiday')
  ->where('type',$holiday_type_is)
  ->whereBetween('holiday_date', [$from, $to])
  ->count();
  if($count == '0'){
    echo 'f1';
    exit();
  }
  }
  if($holiday_type == ''){
  // for all staff
  $result = DB::table('holiday')
  ->whereBetween('holiday_date', [$from, $to])
  ->orderBy('holiday_date','asc')
  ->get();
  }else{
  // individual staff
  $result = DB::table('holiday')
  ->where('type',$holiday_type_is)
  ->whereBetween('holiday_date', [$from, $to])
  ->orderBy('holiday_date','asc')
  ->get();

    }
    return view('view_report.holidayReportView')->with('result',$result)->with('holiday_type_is',$holiday_type_is)->with('from',$from)->with('to',$to);
  }
  // buy sms report
  public function buySmsReport()
  {
    return view('report.buySmsReport');
  }
  // buy sms report view
  public function buySmsReportView(Request $request)
  {
    $from_date = trim($request->from);
    $from      = date('Y-m-d',strtotime($from_date));
    $to_date   = trim($request->to);
    $to        = date('Y-m-d',strtotime($to_date));
    $count = DB::table('buy_sms')
    ->whereBetween('created_at', [$from, $to])
    ->count();
    if($count == '0'){
      echo 'f1';
      exit();
    }
    $result = DB::table('buy_sms')
    ->whereBetween('created_at', [$from, $to])
    ->get();
    return view('view_report.buySmsReportView')->with('result',$result)->with('from',$from)->with('to',$to);

  }
  // previous teacher attendent report
  public function reportTeacherClassWisePreviousDateAttendent()
  {
    return view('report.reportTeacherClassWisePreviousDateAttendent');
  }
  // previous date class attendent report
  public function reportTeacherClassWisePreviousDateAttendentView(Request $request)
  {
      $from_date   = trim($request->from); 
      $from        = date ("Y-m-d", strtotime($from_date));
      $day_no  = date('D', strtotime($from));
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

      $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 3)
        ->where('users.trasfer_status', 0)
        ->orderBy('users.user_id','asc')
        ->get();
  return view("view_report.reportTeacherClassWisePreviousDateAttendentView")->with('result',$result)->with('day',$day)->with('today',$from);


  }
  // teacher today class
  public function teacherTodayClass($shift_id)
  {
         
       $count = DB::table('holiday')->where('holiday_date',$this->rcdate1)->count();
       if($count > 0){
        Session::put('failed','Sorry ! Today Is Class Holiday');
        return Redirect::to('teacherDashboard');
        exit();

       }
       $result = DB::table('department')->where('status',1)->get();
       $shift  = DB::table('shift')->where('id',$shift_id)->get();
       return view('report.teacherTodayClass')
       ->with('result',$result)
       ->with('shift',$shift)
       ->with('shift_id',$shift_id)
       ->with('session_teacher_id',$this->teacher_id);
  }
  // view student attendent list
  public function viewStudentAttendentListByTeacher($routine_id , $rcdate)
  {
    $count_this_day_holiday  = DB::table('holiday')->where('holiday_date',$rcdate)->count();
   if($count_this_day_holiday > 0){
    // get shift name form rourine id
      $year_explode_shift = explode('-', $rcdate);
      $year_shift         = $year_explode_shift[0] ;

    $shift_query_from_routine = DB::table('routine')->where('id',$routine_id)->where('year',$year_shift)->limit(1)->first();

        Session::put('failed','Sorry ! Sorry This Day Is Class Holiday');
        return Redirect::to('viewStudentAttendentListByTeacher/'.$shift_query_from_routine->shift_id);
        exit();
   }
   // get information
 $count  = DB::table('student_attendent')->where('class_no',$routine_id)->where('created_at',$rcdate)->count();
 if($count > 0){
  $info_query = DB::table('student_attendent')->where('class_no',$routine_id)->where('created_at',$rcdate)->first();

   $year            = $info_query->year ;
   $shift_id        = $info_query->shift_id ;
   $dept_id         = $info_query->dept_id ;
   $semister_id     = $info_query->semister_id ;
   $section_id      = $info_query->section_id ;
   $routine_id      = $info_query->class_no ;
   $routine_query   = DB::table('routine')->where('id',$routine_id)->where('year',$year)->first();
  $subject_id = $routine_query->subject_id ;
  $teacher_id = $routine_query->teacher_id ;
  }else{
  // get subject id and teacher id by routine
  $year_explode = explode('-', $rcdate);
  $year         = $year_explode[0] ;

  $routine_query = DB::table('routine')->where('id',$routine_id)->where('year',$year)->first();
  $subject_id = $routine_query->subject_id ;
  $teacher_id = $routine_query->teacher_id ;

   $shift_id    = $routine_query->shift_id ;
   $dept_id     = $routine_query->dept_id ;
   $semister_id = $routine_query->semister_id ;
   $section_id  = $routine_query->section_id ;
   $routine_id  = $routine_query->id ;
  }

   $dept_info = DB::table('department')->where('id',$dept_id)->first();
   $shift_info = DB::table('shift')->where('id',$shift_id)->first();
   $semister_info = DB::table('semister')->where('id',$semister_id)->first();
   $section_info = DB::table('section')->where('id',$section_id)->first();
   $subject_info = DB::table('subject')->where('id',$subject_id)->first();
   $teacher_info = DB::table('users')->where('id',$teacher_id)->first();
   // get leave info
   $teacher_leave_count = DB::table('tbl_leave')->where('user_id', $teacher_id)->where('final_request_from',$rcdate)->where('type_status',0)->count();
  // get traning info
   $teacher_traning_count = DB::table('tbl_leave')->where('user_id', $teacher_id)->where('final_request_from',$rcdate)->where('type_status',1)->count();
  // get attendent list of this class by join query
   $result = DB::table('student_attendent')
  ->join('routine','student_attendent.class_no', '=', 'routine.id')
  ->join('students', 'student_attendent.studentId', '=', 'students.id')
  ->join('student', 'student_attendent.studentId', '=', 'student.studentID')
  ->select('student_attendent.*', 'routine.subject_id','students.studentName','students.studentMobile','students.studentImage','student.registration')
  ->where('student_attendent.class_no',$routine_id)
  ->where('student_attendent.created_at',$rcdate)
   ->where('student.year',$year)
   ->where('student.shift_id',$shift_id)
   ->where('student.dept_id',$dept_id)
   ->where('student.semister_id',$semister_id)
   ->where('student.section_id',$section_id)
   ->orderBy('student_attendent.enter_time','asc')
  ->get();

  if($count > 0){

foreach($result as $value) {
    //do something
    $attentdent_id[] = $value->studentId;
}
$absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
   ->where('student.year',$year)
   ->where('student.shift_id',$shift_id)
   ->where('student.dept_id',$dept_id)
   ->where('student.semister_id',$semister_id)
   ->where('student.section_id',$section_id)
   ->whereNotIn('student.studentID',$attentdent_id)
   ->orderBy('student.roll','asc')
  ->get();
}else{
  $absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
   ->where('student.year',$year)
   ->where('student.shift_id',$shift_id)
   ->where('student.dept_id',$dept_id)
   ->where('student.semister_id',$semister_id)
   ->where('student.section_id',$section_id)
   ->orderBy('student.roll','asc')
   ->get();
}
  return view ('report.viewStudentAttendentListByTeacher')->with('result',$result)->with('count',$count)->with('absent_result',$absent_result)->with('year',$year)->with('dept_info',$dept_info)->with('shift_info',$shift_info)->with('semister_info',$semister_info)->with('section_info',$section_info)->with('subject_info',$subject_info)->with('teacher_info',$teacher_info)->with('routine_query',$routine_query)->with('routine_id' ,$routine_id)->with('rcdate',$rcdate)->with('teacher_leave_count',$teacher_leave_count)->with('teacher_traning_count',$teacher_traning_count)->with('count_this_day_holiday',$count_this_day_holiday);

  }
    public function sentSmsReport()
  {
    return view('report.sentSmsReport');
  }
    public function sentSmsReportView(Request $request)
  {
    $from_date = trim($request->from);
    $from      = date('Y-m-d',strtotime($from_date));
    $to_date   = trim($request->to);
    $to        = date('Y-m-d',strtotime($to_date));
    $type      = trim($request->type);

       if($type == ''){
      // get all
      $count =  DB::table('sending_sms_history')
                ->whereBetween('created_at', [$from, $to])->count();
                if($count == '0'){
                  echo 'f1';
                  exit();
                }



    }elseif($type == '1'){
      // all staff
      $count =  DB::table('sending_sms_history')
                ->where('type',$type)
                ->whereBetween('created_at', [$from, $to])->count();
                if($count == '0'){
                  echo 'f1';
                  exit();
                }

    }elseif($type == '2'){
      // all student
        $count =  DB::table('sending_sms_history')
                ->where('type',$type)
                ->whereBetween('created_at', [$from, $to])->count();
                if($count == '0'){
                  echo 'f1';
                  exit();
                }

    }


    if($type == ''){
      // get all
      $result =  DB::table('sending_sms_history')
                ->whereBetween('created_at', [$from, $to])->get();



    }elseif($type == '1'){
      // all staff
      $result =  DB::table('sending_sms_history')
                ->where('type',$type)
                ->whereBetween('created_at', [$from, $to])->get();

    }elseif($type == '2'){
      // all student
        $result =  DB::table('sending_sms_history')
                ->where('type',$type)
                ->whereBetween('created_at', [$from, $to])->get();

    }
    return view('view_report.sentSmsReportView')->with('result',$result)->with('type',$type)->with('from',$from)->with('to',$to);


  }

}
