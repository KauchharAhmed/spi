<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class PrintController extends Controller
{
     /**
     * print controller Class Constructor
     *
     * @return \Illuminate\Http\Response
     */
    private $rcdate ;
    private $dept_id ;
    private $rcdate1 ;
    public function __construct(){
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate = date('Y/m/d');
        $this->rcdate1 = date('Y/m/d');
        $this->dept_id  = Session::get('dept_id');
        $this->current_year = date('Y');
    }
    /**
     * Display search wise student list.
     * @return \Illuminate\Http\Response
     */
     public function printStudentList(Request $request)
     {
       $dep_id    = $this->dept_id;
       $shift     = $request->shift ;
       $semister  = $request->semister ;
       $year      = $request->year;
       $section   = $request->section;
       $roll      = $request->roll; 
        // 0 = active student
       // get only active student
       #--------------- search query by shift ----------------------#
       if($semister == ''){
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
        ->where('student.dept_id', $dep_id)
        ->where('student.shift_id', $shift)
        ->where('student.section_id', $section)
        ->where('student.status', 0)
        ->get();
       

     }elseif($shift == ''){
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
        ->where('student.dept_id', $dep_id)
        ->where('student.semister_id', $semister)
         ->where('student.section_id', $section)
        ->where('student.status', 0)
        ->get();
     }elseif($roll != ''){
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
     // get setting information
     $setting = DB::table('setting')->first();
     return view('print.printStudentList')->with('data',$data)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('year',$year)->with('roll',$roll)->with('setting',$setting);

     }

     /*
     ** print semister routine
     */
     public function printSemisterRoutine(Request $request)
     {
       $dep_id    = $this->dept_id;
       $shift     = $request->shift ;
       $semister  = $request->semister ;
       $year      = $request->year;
       $section   = $request->section;
        #--------- Day 1 of routine -----------------#
          $day1 = DB::table('routine')
        ->join('shift', 'routine.shift_id', '=', 'shift.id')
        ->join('semister', 'routine.semister_id', '=', 'semister.id')
        ->join('section', 'routine.section_id', '=', 'section.id')
        ->join('subject', 'routine.subject_id', '=', 'subject.id')
        ->join('users', 'routine.teacher_id', '=', 'users.id')
        ->select('routine.*','users.name','shift.shiftName','semister.semisterName','subject.subject_name','subject.subject_code')
        ->orderBy('routine.from','asc')
        ->where('routine.year', $year)
        ->where('routine.dept_id', $dep_id)
        ->where('routine.shift_id', $shift)
        ->where('routine.semister_id', $semister)
        ->where('routine.section_id', $section)
        ->where('routine.day', '1')
        ->get();
        #--------- End Day 1 Of Routine -----------------#
        #--------- Day 2 of routine -----------------#
          $day2 = DB::table('routine')
        ->join('shift', 'routine.shift_id', '=', 'shift.id')
        ->join('semister', 'routine.semister_id', '=', 'semister.id')
        ->join('section', 'routine.section_id', '=', 'section.id')
        ->join('subject', 'routine.subject_id', '=', 'subject.id')
        ->join('users', 'routine.teacher_id', '=', 'users.id')
        ->select('routine.*','users.name','shift.shiftName','semister.semisterName','subject.subject_name','subject.subject_code')
        ->orderBy('routine.from','asc')
        ->where('routine.year', $year)
        ->where('routine.dept_id', $dep_id)
        ->where('routine.shift_id', $shift)
        ->where('routine.semister_id', $semister)
         ->where('routine.section_id', $section)
        ->where('routine.day', '2')
        ->get();
        #--------- End Day 2 Of Routine -----------------#
        #--------- Day 3 of routine ---------------------#
          $day3 = DB::table('routine')
        ->join('shift', 'routine.shift_id', '=', 'shift.id')
        ->join('semister', 'routine.semister_id', '=', 'semister.id')
        ->join('section', 'routine.section_id', '=', 'section.id')
        ->join('subject', 'routine.subject_id', '=', 'subject.id')
        ->join('users', 'routine.teacher_id', '=', 'users.id')
        ->select('routine.*','users.name','shift.shiftName','semister.semisterName','subject.subject_name','subject.subject_code')
        ->orderBy('routine.from','asc')
        ->where('routine.year', $year)
        ->where('routine.dept_id', $dep_id)
        ->where('routine.shift_id', $shift)
        ->where('routine.semister_id', $semister)
         ->where('routine.section_id', $section)
        ->where('routine.day', '3')
        ->get();
        #--------- End Day 3 Of Routine -----------------#
        #--------- Day 4 of routine ---------------------#
          $day4 = DB::table('routine')
        ->join('shift', 'routine.shift_id', '=', 'shift.id')
        ->join('semister', 'routine.semister_id', '=', 'semister.id')
        ->join('section', 'routine.section_id', '=', 'section.id')
        ->join('subject', 'routine.subject_id', '=', 'subject.id')
        ->join('users', 'routine.teacher_id', '=', 'users.id')
        ->select('routine.*','users.name','shift.shiftName','semister.semisterName','subject.subject_name','subject.subject_code')
        ->orderBy('routine.from','asc')
        ->where('routine.year', $year)
        ->where('routine.dept_id', $dep_id)
        ->where('routine.shift_id', $shift)
        ->where('routine.semister_id', $semister)
         ->where('routine.section_id', $section)
        ->where('routine.day', '4')
        ->get();
        #--------- End Day 4 Of Routine -----------------#
        #--------- Day 5 of routine ---------------------#
          $day5 = DB::table('routine')
        ->join('shift', 'routine.shift_id', '=', 'shift.id')
        ->join('semister', 'routine.semister_id', '=', 'semister.id')
        ->join('section', 'routine.section_id', '=', 'section.id')
        ->join('subject', 'routine.subject_id', '=', 'subject.id')
        ->join('users', 'routine.teacher_id', '=', 'users.id')
        ->select('routine.*','users.name','shift.shiftName','semister.semisterName','subject.subject_name','subject.subject_code')
        ->orderBy('routine.from','asc')
        ->where('routine.year', $year)
        ->where('routine.dept_id', $dep_id)
        ->where('routine.shift_id', $shift)
        ->where('routine.semister_id', $semister)
         ->where('routine.section_id', $section)
        ->where('routine.day', '5')
        ->get();
        #--------- End Day 5 Of Routine -----------------#
        #--------- Day 6 of routine ---------------------#
          $day6 = DB::table('routine')
        ->join('shift', 'routine.shift_id', '=', 'shift.id')
        ->join('semister', 'routine.semister_id', '=', 'semister.id')
        ->join('section', 'routine.section_id', '=', 'section.id')
        ->join('subject', 'routine.subject_id', '=', 'subject.id')
        ->join('users', 'routine.teacher_id', '=', 'users.id')
        ->select('routine.*','users.name','shift.shiftName','semister.semisterName','subject.subject_name','subject.subject_code')
        ->orderBy('routine.from','asc')
        ->where('routine.year', $year)
        ->where('routine.dept_id', $dep_id)
        ->where('routine.shift_id', $shift)
        ->where('routine.semister_id', $semister)
         ->where('routine.section_id', $section)
        ->where('routine.day', '6')
        ->get();
        #--------- End Day 6 Of Routine -----------------#
        #--------- Day 7 of routine ---------------------#
          $day7 = DB::table('routine')
        ->join('shift', 'routine.shift_id', '=', 'shift.id')
        ->join('semister', 'routine.semister_id', '=', 'semister.id')
        ->join('section', 'routine.section_id', '=', 'section.id')
        ->join('subject', 'routine.subject_id', '=', 'subject.id')
        ->join('users', 'routine.teacher_id', '=', 'users.id')
        ->select('routine.*','users.name','shift.shiftName','semister.semisterName','subject.subject_name','subject.subject_code')
        ->orderBy('routine.from','asc')
        ->where('routine.year', $year)
        ->where('routine.dept_id', $dep_id)
        ->where('routine.shift_id', $shift)
        ->where('routine.semister_id', $semister)
         ->where('routine.section_id', $section)
        ->where('routine.day', '7')
        ->get();
        #--------- End Day 7 Of Routine -----------------#
        // get shift
        $shiftt                = DB::table('shift')->where('id',$shift)->first();
        // get semister
        $semisterr             = DB::table('semister')->where('id',$semister)->first();
        // get section        
        $sectionn              = DB::table('section')->where('id',$semister)->first();
        $department            = DB::table('department')->where('id',$dep_id)->first();
        $setting = DB::table('setting')->first();
        return view('print.printSemisterWiseRoutine')
        ->with('day1',$day1)
        ->with('day2',$day2)
        ->with('day3',$day3)
        ->with('day4',$day4)
        ->with('day5',$day5)
        ->with('day6',$day6)
        ->with('day7',$day7)
        ->with('department',$department)
        ->with('shift',$shiftt)
        ->with('semister',$semisterr)
        ->with('section',$sectionn)
        ->with('setting',$setting);
     }
     // print the id card
     public function printIdCard($id , $shift , $semister)
     {
      // update print success
      $data_update = array();
      $data_update['print_id_status'] = 1 ;
      DB::table('students')->where('id',$id)->update($data_update);
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
        return view('print.printIdCard')->with('data',$data)->with('shiftID',$shift)->with('semisterID',$semister);
     }

     // print teacher id card
     public function printTeacherIdCard($id)
     {
      // update print success
      $data_update = array();
      $data_update['print_id_status'] = 1 ;
      DB::table('users')->where('id',$id)->update($data_update);
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
  return view('print.printTeacherIdCard')->with('data',$data)->with('dept',$dept);
  }

  #------------------------ Print Today Attendent Report --------------------------#
  public function printTodayAttendentReport(Request $request)
  {
    $shift = trim($request->shift) ;
    $dept  = trim($request->dept) ;
    // get semister of 
    $result        = DB::table('semister')->where('status',1)->get();
    // get section of this department
    $section_name  = DB::table('section')->where('dept_id',$dept)->get();
    $shift_name    = DB::table('shift')->where('id',$shift)->first();
    $dept_name     = DB::table('department')->where('id',$dept)->first();
    return view('print.printTodayAttendentReport')->with('result',$result)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('section_name',$section_name)->with('shift_id',$shift)->with('dept_id',$dept);
  }

  #----------------- Print Monthly Student Attendance Reports ------------------#
  public function printMonthlyAttendentReport(Request $request)
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

    return view('print.printMonthlyAttendentReport')->with('result',$result)->with('count_holiday',$count_holiday)->with('month_total_day',$month_total_day)->with('from',$from)->with('to',$to)->with('month',$month)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('section',$section)->with('semister',$semister)->with('dept',$dept)->with('shift',$shift); 
  }

  #-------------------- Print Date Wise Student Attendent Reports ---------------------#
  public function printDateWiseAttendentReport(Request $request)
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
         $setting       = DB::table('setting')->first();
         return view('print.printDateWiseAttendentReport')->with('result',$result)->with('count_holiday',$count_holiday)->with('total_day',$total_day)->with('from',$from)->with('to',$to)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('shift',$shift)->with('dept',$dept)->with('semister',$semister)->with('section',$section)->with('date_form',$date_form)->with('date_to',$date_to)->with('setting',$setting); 
  }

  #-------------------- Print Monthly Class Wise Attendent Report -------------------------#
  public function printMonthlyClassWiseAttendentReport(Request $request)
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
         $setting       = DB::table('setting')->first();
          return view('print.printMonthlyClassWiseAttendentReport')->with('result',$result)->with('month_total_day',$month_total_day)->with('from',$from)->with('to',$to)->with('month',$month)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('total_holiday_class',$total_holiday_class)->with('totalClassNo',$totalClassNo)->with('dept',$dept)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('setting',$setting);
  }

  #--------------------- Print Today Teacher Attendent Reports --------------------#
  public function printTeacherTodayAttendentReport()
  {
    // get teacher information
    $result = DB::table('users')
    ->leftJoin('department', 'users.dept', '=', 'department.id')
    ->select('users.*', 'department.departmentName')
    ->where('users.type', 3)
    ->where('users.trasfer_status', 0)
    ->orderBy('users.user_id','asc')
    ->get();
    $setting = DB::table('setting')->first();
    return view("print.printTeacherTodayAttendentReport")->with('result',$result)->with('today',$this->rcdate)->with('setting',$setting);
  }
  // print door log attenden report pring
  public function printStaffNormalAttendentViewReport(Request $request)
  {
        $from_date   = trim($request->from_date); 
        $from        = date ("Y-m-d", strtotime($from_date));
        $staff_type  = trim($request->staff_type);
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
        $setting = DB::table('setting')->first(); 
        return view('print.printStaffNormalAttendentViewReport')->with('result',$result)->with('from',$from)->with('staff_type',$staff_type)->with('from_date',$from_date)->with('setting',$setting);
  }
  // print for dg office
  public function printStaffDgAttendentViewReport(Request $request)
  {
        $from_date   = trim($request->from_date); 
        $from        = date ("Y-m-d", strtotime($from_date));
        $staff_type  = trim($request->staff_type);
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
        $setting = DB::table('setting')->first(); 
        return view('print.printStaffDgAttendentViewReport')->with('result',$result)->with('from',$from)->with('staff_type',$staff_type)->with('from_date',$from_date)->with('setting',$setting);
  }
  // print monthly attendent door report
  public function printReportMontlyStaffDoorAttendentView(Request $request)
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
        // get holiday
        $from = $year.'-'.$month.'-01';
        $to   = $year.'-'.$month.'-31';
        $count_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->where('door_holiday','0')
                         ->whereBetween('holiday_date', [$from, $to])->count();
        $month_total_day =cal_days_in_month(CAL_GREGORIAN,$month,$year);
        $setting = DB::table('setting')->first();
        return view('print.printReportMontlyStaffDoorAttendentView')->with('result',$result)->with('count_holiday',$count_holiday)->with('month_total_day',$month_total_day)->with('from',$from)->with('to',$to)->with('month',$month)->with('year',$year)->with('staff_type',$staff_type)->with('setting',$setting);

  }
  // print daily attendent report
  public function printDailyStudentDoorReport(Request $request)
  {
        $year     = trim($request->year) ;
        $shift    = trim($request->shift);
        $dept     = trim($request->dept);
        $semister = trim($request->semister);
        $section  = trim($request->section);
        $from   = trim($request->from); 
        // get door holiday
        $door_holiday_count = DB::table('holiday')->where('door_holiday',0)->where('holiday_date',$from)->count();
        if($door_holiday_count > 0){
          echo 'f2';
          exit();
        }
         $count_student = DB::table('student')->where('year',$year)->where('shift_id',$shift)->where('dept_id', $dept )->where('semister_id',$semister)->where('section_id',$section)->orderBy('roll','asc')->count();
         // total student present
         $total_present_student = DB::table('tbl_door_log')->where('year',$year)->where('shift_id',$shift)->where('dep_id', $dept )->where('semister_id',$semister)->where('section_id',$section)->groupBy('student_id')->count();
     
        // get student
        $result = DB::table('student')->where('year',$year)->where('shift_id',$shift)->where('dept_id', $dept )->where('semister_id',$semister)->where('section_id',$section)->orderBy('roll','asc')->get();
         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();
         $setting       = DB::table('setting')->first();
        return view('print.printDailyStudentDoorReport')->with('result',$result)->with('from',$from)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('section',$section)->with('semister',$semister)->with('dept',$dept)->with('shift',$shift)->with('count_student',$count_student)->with('total_present_student',$total_present_student)->with('setting',$setting);
  }
  // total class held summary report
  public function printTotalClassHeldSummaryReportReport(Request $request)
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
      // get all shift
      $result = DB::table('shift')->get();
      $setting = DB::table('setting')->first();
      return view('print.printTotalClassHeldSummaryReportReport')->with('result',$result)->with('get_current_day',$get_current_day)->with('from',$from)->with('current_day',$current_day)->with('from_year',$from_year)->with('setting',$setting);
  }
  // print overall summary report
  public function printOverAllSummaryReport(Request $request)
  {
      $from        = trim($request->from); 
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
    $setting = DB::table('setting')->first();
    return view('print.printOverAllSummaryReport')
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
    ->with('setting',$setting)
    ;
  }
  // print daily door log
  public function printDailyDoorLog(Request $request)
  {
   $from                 = trim($request->from);
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
      echo 2;
          $count = DB::table('tbl_door_log')->where('enter_date',$from)->where('user_type',2)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->count();
      if($count == '0'){
      echo "f1";
      exit();
    }

   }
    if($type_of_person == '3'){
    // all teacher
      echo 3;
      $count = DB::table('tbl_door_log')->where('enter_date',$from)->where('user_type',3)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->count();
      if($count == '0'){
      echo "f1";
      exit();
    }
   }
    if($type_of_person == '4'){
    // all craft
      echo 4;
        $count = DB::table('tbl_door_log')->where('enter_date',$from)->where('user_type',4)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->count();
    if($count == '0'){
      echo "f1";
      exit();
    }

   }
    if($type_of_person == '5'){
    // all staff
      echo 5;
        $count = DB::table('tbl_door_log')->where('enter_date',$from)->where('user_type',5)->orderBy('enter_time',$valid_order)->limit($see_how_many_person)->count();
      if($count == '0'){
      echo "f1";
      exit();
    }

   }
    if($type_of_person == '10'){
    // all guest
      echo 10;
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
   $setting = DB::table('setting')->first();
   return view('print.printDailyDoorLog')->with('result',$result)->with('type_of_person',$type_of_person)->with('order_is',$order_is)->with('see_how_many_person',$see_how_many_person)->with('from',$from)->with('setting',$setting);
  }
  // print staff leave report
  public function printStaffLeaveReport(Request $request)
  {
    $from = trim($request->from);
    $to   = trim($request->to);
    $staff     = trim($request->staff);
  if($staff == '0'){
  // for all staff
  $result = DB::table('users')
  ->join('tbl_leave','users.id', '=', 'tbl_leave.user_id')
  ->leftJoin('department', 'users.dept', '=', 'department.id')
  ->select('users.*', 'department.departmentName','tbl_leave.final_request_from')
  ->where('tbl_leave.type_status',0)
  ->whereBetween('final_request_from', [$from, $to])
  ->get();
  }else{
  // individual staff
  $result = DB::table('users')
  ->join('tbl_leave','users.id', '=', 'tbl_leave.user_id')
  ->leftJoin('department', 'users.dept', '=', 'department.id','tbl_leave.final_request_from')
  ->select('users.*', 'department.departmentName','tbl_leave.final_request_from')
  ->where('tbl_leave.user_id',$staff)
  ->where('tbl_leave.type_status',0)
  ->whereBetween('final_request_from', [$from, $to])
  ->get();
    }
    $setting = DB::table('setting')->first();
    return view('print.printStaffLeaveReport')->with('result',$result)->with('from',$from)->with('to',$to)->with('staff',$staff)->with('setting',$setting); 
 }
 // print today teacher class wise attendent report
 public function printReportTeacherClassWiseTodayAttendent()
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
        $setting = DB::table('setting')->first();
        return view("print.printReportTeacherClassWiseTodayAttendent")->with('result',$result)->with('day',$day)->with('today',$this->rcdate)->with('setting',$setting);
 }
 // monthly teacher class attendent report
 public function printReportTeacherMonthlyAttendent(Request $request)
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
          $setting = DB::table('setting')->first();
        return view('print.printReportTeacherMonthlyAttendent')->with('result',$result)->with('count_holiday',$count_holiday)->with('month_total_day',$month_total_day)->with('from',$from)->with('to',$to)->with('month',$month)->with('year',$year)->with('setting',$setting);
 }
 // print datewise class wise attendent report
 public function printDatewiseClasswiseAttendentReport(Request $request)
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
         $setting       = DB::table('setting')->first();
         return view('print.printDatewiseClassWiseAttendentReport')->with('result',$result)->with('totalClassNo',$totalClassNo)->with('total_holiday_class',$total_holiday_class)->with('from',$from)->with('to',$to)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('setting',$setting);
 }





 #----------------------------- RESULT PRINT ---------------------------------#
 public function printSemesteResultMarksheet($probidhan_id , $year , $shift , $dept , $semister ,$section , $roll , $merit_status , $pass_fail_status)
 {

       $row = DB::table('tbl_result')
       ->where('probidhan_id', $probidhan_id)
        ->where('year',$year)
        ->where('shift_id',$shift)
        ->where('dept_id',$dept)
        ->where('semister_id',$semister)
        ->where('section_id',$section)
        ->where('roll',$roll)
        ->first();
      // get all subject of this student
        $result = DB::table('tbl_result_marks')
        ->join('subject', 'tbl_result_marks.subject_id', '=', 'subject.id')
        ->select('tbl_result_marks.*','subject.subject_name','subject.subject_code','subject.cradit','subject.total_marks as subject_total_marks','subject.theroy_marks','subject.continous_theory_marks','subject.practical_marks','subject.continous_practical_marks')
        ->where('tbl_result_marks.probidhan_id', $probidhan_id)
        ->where('tbl_result_marks.year',$year)
        ->where('tbl_result_marks.shift_id',$shift)
        ->where('tbl_result_marks.dept_id',$dept)
        ->where('tbl_result_marks.semister_id',$semister)
        ->where('tbl_result_marks.section_id',$section)
        ->where('tbl_result_marks.roll',$roll)
        ->get();
        // get student info
        $student_info = DB::table('student')
        ->join('students', 'student.studentID', '=', 'students.id')
        ->join('shift', 'student.shift_id', '=', 'shift.id')
        ->join('department', 'student.dept_id', '=', 'department.id')
        ->join('semister', 'student.semister_id', '=', 'semister.id')
        ->join('session', 'student.session', '=', 'session.id')
        ->join('section', 'student.section_id', '=', 'section.id')
        ->select('students.*','student.session','student.semister_status','student.year','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','section.section_name')
        ->orderBy('student.roll','asc')
        ->where('student.year', $year)
        ->where('student.shift_id', $shift)
        ->where('student.dept_id', $dept)
        ->where('student.semister_id', $semister)
        ->where('student.section_id', $section)
        ->where('student.roll', $roll)
        ->where('student.status', 0)
        ->first();
        $setting = DB::table('setting')->first();
        return view('print.printSemesteResultMarksheet')->with('row',$row)->with('result',$result)->with('setting',$setting)->with('student_info',$student_info)->with('probidhan_id',$probidhan_id)->with('year',$year)->with('shift',$shift)->with('dept',$dept)->with('semister',$semister)->with('section',$section)->with('pass_fail_status',$pass_fail_status);


 }
 #----------------------------- END RESULT PRINT------------------------------#

 #----------------------------- NORMAL PRINT----------------------------------#
 // department head list print
 public function printDepHeadList(Request $request)
 {
        // status 1 = active department head
        $result = DB::table('department_head')
        ->join('department', 'department_head.dep_id', '=', 'department.id')
        ->join('users', 'department_head.teacher_id', '=', 'users.id')
        ->select('department_head.*','users.name','users.mobile','users.image', 'department.departmentName')
        ->where('users.type', 3)
        ->where('department_head.status', 1)
        ->get();
      $setting = DB::table('setting')->first();
      return view('print.printDepHeadList')->with('result',$result)->with('setting',$setting);
 }
 // print teache list for super admin
 public function printTeacherListBySuperadmin(Request $request)
 {
         $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 3)
        ->where('users.trasfer_status', 0)
        ->get();
        $setting = DB::table('setting')->first();
       return view('print.printTeacherListBySuperadmin')->with('result',$result)->with('setting',$setting);
 }
 // print craft instructor list
 public function printCraftInstructorListBySuperadmin(Request $request)
 {
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 4)
        ->where('users.trasfer_status', 0)
        ->get();
        $setting = DB::table('setting')->first();
       return view('print.printCraftInstructorListBySuperadmin')->with('result',$result)->with('setting',$setting); 
 }
 // print others staff
 public function printOtherStaffListBySuperadmin(Request $request)
 {
    $result = DB::table('users')
    ->where('type', '5')
    ->where('users.trasfer_status', 0)
    ->orderBy('id', 'desc')
    ->get();
    $setting = DB::table('setting')->first();
    return view('print.printOtherStaffListBySuperadmin')->with('result',$result)->with('setting',$setting);
 }
 // print staff traing report
 public function printStaffTrainingReport(Request $request)
 {
    $from = trim($request->from);
    $to   = trim($request->to);
    $staff     = trim($request->staff);
  if($staff == '0'){
  // for all staff
  $result = DB::table('users')
  ->join('tbl_leave','users.id', '=', 'tbl_leave.user_id')
  ->leftJoin('department', 'users.dept', '=', 'department.id')
  ->select('users.*', 'department.departmentName','tbl_leave.final_request_from')
  ->where('tbl_leave.type_status',1)
  ->whereBetween('final_request_from', [$from, $to])
  ->get();
  }else{
  // individual staff
  $result = DB::table('users')
  ->join('tbl_leave','users.id', '=', 'tbl_leave.user_id')
  ->leftJoin('department', 'users.dept', '=', 'department.id','tbl_leave.final_request_from')
  ->select('users.*', 'department.departmentName','tbl_leave.final_request_from')
  ->where('tbl_leave.user_id',$staff)
  ->where('tbl_leave.type_status',1)
  ->whereBetween('final_request_from', [$from, $to])
  ->get();
    }
    $setting = DB::table('setting')->first();
    return view('print.printStaffTrainingReport')->with('result',$result)->with('from',$from)->with('to',$to)->with('staff',$staff)->with('setting',$setting); 
 }
 // holiday report print
 public function printHolidayReport(Request $request)
 {
    $from = trim($request->from);
    $to   = trim($request->to);
    $holiday_type_is     = trim($request->holiday_type);
  
  if($holiday_type_is == ''){
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
    $setting = DB::table('setting')->first();
    return view('print.printHolidayReport')->with('result',$result)->with('holiday_type_is',$holiday_type_is)->with('from',$from)->with('to',$to)->with('setting',$setting);

 }
 #---------------------------- END NORMAL PRINT-------------------------------#
 // print student list for superadmin
 public function printStudentListforSuperAdmin(Request $request)
 {
      $dep_id     = trim($request->dept);
      $shift      = trim($request->shift) ;
      $semister   = trim($request->semister) ;
      $year       = trim($request->year);
      $section    = trim($request->section);

      if($dep_id == ''){
        $dept_where               = DB::table('department')->where('status',1)->get();
        foreach ($dept_where as $dept_where_value) {
           $dept_all_value[] = $dept_where_value->id ;
        }
      }else{
        $dept_all_value[] = $dep_id ;

        if($section == ''){

        $section_where_query = DB::table('section')->where('dept_id',$dep_id)->get();
          foreach ($section_where_query as $section_where_value) {
            $section_all_value[] = $section_where_value->id;
         }

       }else{
          $section_all_value[] = $section ;
       }


      }
      //shift 
      if($shift == ''){
         $shift_where       = DB::table('shift')->get();
         foreach ($shift_where as $shift_where_value) {
            $shift_all_value[] = $shift_where_value->id;
         }
      }else{
          $shift_all_value[] = $shift;
      }

      if($semister == ''){

      $semister_where           = DB::table('semister')->where('status',1)->get();
      foreach ($semister_where as $semister_where_value) {
        $semester_all_value[] = $semister_where_value->id;
      }
     }else{
        $semester_all_value[] = $semister ;
     }

        if($section == ''){

        $section_where_query = DB::table('section')->get();
          foreach ($section_where_query as $section_where_value) {
            $section_all_value[] = $section_where_value->id;
         }

       }else{
          $section_all_value[] = $section ;
       }
       // get only active student
       #--------------- search query by shift ----------------------#
      
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
        ->whereIn('student.dept_id', $dept_all_value)
        ->whereIn('student.shift_id', $shift_all_value)
        ->whereIn('student.semister_id', $semester_all_value)
        ->whereIn('student.section_id', $section_all_value)
        ->where('student.status', 0)
        ->get();

        $setting = DB::table('setting')->first();

     return view('print.printStudentListforSuperAdmin')->with('data',$data)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('year',$year)->with('dep_id',$dep_id)->with('setting',$setting);
 }


    // print periodic class wise percentage present list
    public function printPeriodicClassWisePercentagePresentList(Request $request)
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
        $percentage_class_number = trim($request->percentage_class_number);

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
         $setting = DB::table('setting')->first();
     return view('print.printPeriodicClassWisePercentagePresentList')->with('result',$result)->with('totalClassNo',$totalClassNo)->with('total_holiday_class',$total_holiday_class)->with('from',$from)->with('to',$to)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('dept',$dept)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('date_form',$date_form)->with('date_to',$date_too)->with('percentage_class_number',$percentage_class_number)->with('sorting_type',$sorting_type)->with('absent_result',$absent_result)->with('setting',$setting);
    }

    // print periodic class wise percentage list
    public function printPeriodicClassWisePercentageAbsentList(Request $request)
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
        $percentage_class_number = trim($request->percentage_class_number);

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
         $setting = DB::table('setting')->first();
     return view('print.printPeriodicClassWisePercentageAbsentList')->with('result',$result)->with('totalClassNo',$totalClassNo)->with('total_holiday_class',$total_holiday_class)->with('from',$from)->with('to',$to)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('dept',$dept)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('date_form',$date_form)->with('date_to',$date_too)->with('percentage_class_number',$percentage_class_number)->with('sorting_type',$sorting_type)->with('absent_result',$absent_result)->with('setting',$setting);

   }

   // print periodic class wise top present list
   public function printPeriodicClassWiseTopPresentList(Request $request)
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
         $setting  = DB::table('setting')->first();
     return view('print.printPeriodicClassWiseTopPresentList')->with('result',$result)->with('totalClassNo',$totalClassNo)->with('total_holiday_class',$total_holiday_class)->with('from',$from)->with('to',$to)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('dept',$dept)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('date_form',$date_form)->with('date_to',$date_too)->with('absent_result',$absent_result)->with('setting',$setting);
   }

   // print periodic class wise top absent list
   public function printPeriodicClassWiseTopAbsentList(Request $request)
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
         $setting = DB::table('setting')->first();
     return view('print.printPeriodicClassWiseTopAbsentList')->with('result',$result)->with('totalClassNo',$totalClassNo)->with('total_holiday_class',$total_holiday_class)->with('from',$from)->with('to',$to)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('dept',$dept)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('date_form',$date_form)->with('date_to',$date_too)->with('absent_result',$absent_result)->with('setting',$setting);
   }

   // print periodic student present list
   public function printPeriodicStudentPresentList(Request $request)
   {
        $year        = trim($request->year);
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
         $setting = DB::table('setting')->first();
      return view('print.printPeriodicStudentPresentList')->with('result',$result)->with('count_holiday',$count_holiday)->with('total_day',$total_day)->with('from',$from)->with('to',$to)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('shift',$shift)->with('dept',$dept)->with('semister',$semister)->with('section',$section)->with('date_form',$date_form)->with('date_to',$date_to)->with('absent_result',$absent_result)->with('attendent_days',$attendent_days)->with('sorting_type',$sorting_type)->with('setting',$setting);
   }

   // print periodic student absent list
   public function printPeriodicStudentAbsentList(Request $request)
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
         $setting = DB::table('setting')->first();

      return view('print.printPeriodicStudentAbsentList')->with('result',$result)->with('count_holiday',$count_holiday)->with('total_day',$total_day)->with('from',$from)->with('to',$to)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('shift',$shift)->with('dept',$dept)->with('semister',$semister)->with('section',$section)->with('date_form',$date_form)->with('date_to',$date_to)->with('absent_result',$absent_result)->with('attendent_days',$attendent_days)->with('sorting_type',$sorting_type)->with('setting',$setting);
   }



}



