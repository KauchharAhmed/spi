<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class Routine extends Controller
{
    /**
     * Routine Controller Class Constructor
     *
     * @return \Illuminate\Http\Response
     */
    private $rcdate ;
    private $dep_id;
    public function __construct(){
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate   = date('Y/m/d');
        $this->dept_id  = Session::get('dept_id');
    }
    /**
     * Display all routine by department id list.
     *
     * @return \Illuminate\Http\Response
     */
    public function routineList()
    {
        $result = DB::table('routine')
        ->join('shift', 'routine.shift_id', '=', 'shift.id')
        ->join('semister', 'routine.semister_id', '=', 'semister.id')
        ->join('subject', 'routine.subject_id', '=', 'subject.id')
        ->join('users', 'routine.teacher_id', '=', 'users.id')
        ->select('routine.*','users.name','shift.shiftName','semister.semisterName','subject.subject_name','users.name')
        ->orderBy('routine.id','desc')
        ->where('routine.dept_id', $this->dept_id)
        ->get();
        return view('educationInfo.routineList')->with('result',$result);
    } 
    /**
     * Display routine form to add new subject to routine.
     *
     * @return \Illuminate\Http\Response
     */
    public function addRoutineForm()
    {
        // get department info
        $row                = DB::table('department')->where('id', $this->dept_id)->first();
        // get shift
        $shift              = DB::table('shift')->get();
        // get semister
        $result             = DB::table('semister')->where('status','1')->get();
        // get section of this department
        $section            = DB::table('section')->where('dept_id', $this->dept_id)->get();
        // get teacher
        $teacher            = DB::table('users')->where('type',3)->where('trasfer_status',0)->get();
        // get craft instuctor
        $craft_instructor   = DB::table('users')->where('type',4)->where('trasfer_status',0)->get();

       return view('educationInfo.addRoutineForm')->with('row', $row)->with('result', $result)->with('shift',$shift)->with('teacher',$teacher)->with('craft_instructor',$craft_instructor)->with('section',$section);
    }
    /**
     * display all subject by department id and semister id.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSubjectByDepAndSemister(Request $request)
    {
        // status 0 = active subject
        $dept_id     = $request->dept_id ;
        $semister_id = $request->semister_id ;
        $result      = DB::table('subject')
                 ->where('dept_id',$dept_id)
                 ->where('semister_id',$semister_id)
                 ->where('status',0)
                 ->get();
    echo "<option value=''>"."Select Subject"."</option>";
    foreach ($result as $value) {
    echo "<option value= $value->id>".$value->subject_name." -> ".$value->subject_code."</option>";
    }
   }
    /**
     * Store a newly created subject into routine.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addRoutineInfo(Request $request)
    {
    $this->validate($request, [
    'department'        => 'required',
    'year'              => 'required',
    'shift'             => 'required',
    'semister'          => 'required',
    'section'           => 'required',
    'subject'           => 'required',
    'teacher'           => 'required',
    'craft'             => 'required',
    'room_no'           => 'required',
    'day'               => 'required',
    'from'              => 'required',
    'to'                => 'required'
    ]);
     $dep_name      = trim($request->department);
     $year          = trim($request->year);
     $shift         = trim($request->shift);
     $semister      = trim($request->semister);
     $section       = trim($request->section);
     $subject       = trim($request->subject);
     $teacher       = trim($request->teacher);
     $craft         = trim($request->craft);
     $room_no       = trim($request->room_no);
     $day           = trim($request->day);
     #------ convert 12 hours to 24 hours -----------#
     $twenty_four_hour_from = trim($request->from); 
     $from                  = date("H:i:00", strtotime($twenty_four_hour_from));
     $twenty_four_hour_to   = trim($request->to); 
     $to                    = date("H:i:00", strtotime($twenty_four_hour_to));
     #-----end convert 12 hours to 24 hours ---------#
     $remarks       = trim($request->remarks);

     #------------check from time is big than to ---------------#
     if($from > $to){
        Session::put('failed','Sorry ! Date Format Is Wrong. From Time Is Not Big Than To Time');
        return Redirect::to('addRoutineForm');
        exit();
     }
    #------------ end check from time is big than to ------------------#

    #--------- check that this room is availalbe this day time --------#
     $avail_room = DB::table('routine')
     ->where('year',$year)
     ->where('room_no', $room_no)
     ->where('day', $day)
     ->where('from', '<=', $from)
     ->where('to', '>=', $to)
    ->count();
     if($avail_room){
        Session::put('failed','Sorry ! Room Is Booked In This Time. Try Again To New Time............');
        return Redirect::to('addRoutineForm');
        exit();
     }
    #----------end check that this room is availalbe this day time-----#
   #--------- if from date to date equal or small then --------#
     $avail_room_check = DB::table('routine')
     ->where('year',$year)
     ->where('room_no', $room_no)
     ->where('day', $day)
     ->where('to', '>=', $from)
    ->count();
     if($avail_room_check){
        Session::put('failed','Sorry ! Room Is Booked In This Time. Try Again To New Time------');
        return Redirect::to('addRoutineForm');
        exit();
     }
    #----------end check that this room is availalbe this day time-----#

    #-------------------- find the class number -----------------------#
     $class_number = DB::table('routine')
     ->where('shift_id',$shift)
     ->where('dept_id',$dep_name)
     ->where('year',$year)
     ->where('semister_id',$semister)
     ->where('section_id',$section)
     ->where('day', $day)
     ->orderBy('class_no', 'desc')
     ->take(1)
     ->first();
     if(!empty($class_number->class_no)){
      $class_no = $class_number->class_no + 1; 
     }else{
       $class_no = 1 ;
     }
     
    #-------------------- end find the class number -------------------#

     #---------------Data insert into the table----------------#
     $data=array();
     $data['added_id']      = $this->dept_id;
     $data['dept_id']       = $dep_name;
     $data['year']          = $year;
     $data['shift_id']      = $shift;
     $data['semister_id']   = $semister;
     $data['section_id']    = $section;
     $data['subject_id']    = $subject;
     $data['teacher_id']    = $teacher;
     $data['craft']         = $craft;
     $data['room_no']       = $room_no;
     $data['day']           = $day;
     $data['from']          = $from;
     $data['to']            = $to;
     $data['class_no']      = $class_no;
     $data['remarks']       = $remarks;
     $data['created_at']    = $this->rcdate ;
     $query = DB::table('routine')->insert($data);
     if($query){
        Session::put('succes','Subject Insert Into Routine Sucessfully');
        return Redirect::to('addRoutineForm');
    }else{
        Session::put('failed','Sorry ! Error Occued. Try Again');
        return Redirect::to('addRoutineForm');
    }
    #--------------- End data insert into the table----------------#
}
    /**
     * Display semister wise routine form .
     *
     * @return \Illuminate\Http\Response
     */
    public function semisterWiseRoutine()
    {
        // get shift
        $shift               = DB::table('shift')->get();
        // get current semister
        $semister            = DB::table('semister')->where('status','1')->get();
        // get section
         $section            = DB::table('section')->where('dept_id', $this->dept_id)->get();
       return view('educationInfo.semisterWiseRoutine')->with('shift',$shift)->with('semsiter',$semister)->with('section',$section);
    }
    /**
     * Display semisterwise routine list.
     * by day
     * @return \Illuminate\Http\Response
     */
    public function getSemisterWiseRoutine(Request $request)
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
        $sectionn              =  DB::table('section')->where('id',$semister)->first();
        return view('educationInfo.getSemisterWiseRoutine')
        ->with('day1',$day1)
        ->with('day2',$day2)
        ->with('day3',$day3)
        ->with('day4',$day4)
        ->with('day5',$day5)
        ->with('day6',$day6)
        ->with('day7',$day7)
        ->with('shift',$shiftt)
        ->with('semister',$semisterr)
        ->with('section',$sectionn)
        ->with('year',$year)
        ->with('shift_id',$shift)
        ->with('semister_id',$semister)
        ->with('section_id',$section);
    }
        // chaget routine subject view
    public function changeRoutine($id)
    {
        $row                = DB::table('department')->where('id', $this->dept_id)->first();
        $teacher            = DB::table('users')->where('type',3)->where('trasfer_status',0)->get();
        // get craft instuctor
        $craft_instructor   = DB::table('users')->where('type',4)->where('trasfer_status',0)->get();
        $result = DB::table('routine')
        ->join('shift', 'routine.shift_id', '=', 'shift.id')
        ->join('semister', 'routine.semister_id', '=', 'semister.id')
        ->join('section', 'routine.section_id', '=', 'section.id')
        ->join('subject', 'routine.subject_id', '=', 'subject.id')
        ->join('users', 'routine.teacher_id', '=', 'users.id')
        ->select('routine.*','users.name','shift.shiftName','semister.semisterName','section.section_name','subject.subject_name','subject.subject_code','users.name AS teacherName','users.short_name AS teacherShortName')
        ->where('routine.id', $id)
        ->first();
        return view('educationInfo.changeRoutine')->with('result',$result)->with('row',$row)->with('teacher',$teacher)->with('craft_instructor',$craft_instructor);
    }

    // edit routine info 
    public function editRoutineInfo(Request $request)
    {
    $this->validate($request, [
    'year'              => 'required',  
    'teacher'           => 'required',
    'room_no'           => 'required',
    'day'               => 'required',
    'from'              => 'required',
    'to'                => 'required',
    'id'                => 'required'
    ]);
    $year       = trim($request->year);
     $teacher       = trim($request->teacher);
     $room_no       = trim($request->room_no);
     $day           = trim($request->day);
     #------ convert 12 hours to 24 hours -----------#
     $twenty_four_hour_from = trim($request->from); 
     $from                  = date("H:i:00", strtotime($twenty_four_hour_from));
     $twenty_four_hour_to   = trim($request->to); 
     $to                    = date("H:i:00", strtotime($twenty_four_hour_to));
     $id                    = trim($request->id);
     #-----end convert 12 hours to 24 hours ---------#
     #------------check from time is big than to ---------------#
     if($from > $to){
        Session::put('failed','Sorry ! Date Format Is Wrong. From Time Is Not Big Than To Time');
        return Redirect::to('changeRoutine/'.$id);
        exit();
     }
    #------------ end check from time is big than to ------------------#

    #--------- check that this room is availalbe this day time --------#
     $avail_room = DB::table('routine')
     ->where('year',$year)
     ->where('room_no', $room_no)
     ->where('day', $day)
     ->where('from', '<=', $from)
     ->where('to', '>=', $to)
     ->whereNotIn('id',[$id])
    ->count();
     if($avail_room){
        Session::put('failed','Sorry ! Room Is Booked In This Time. Try Again To New Time............');
        return Redirect::to('changeRoutine/'.$id);
        exit();
     }
     $data = array();
     $data['teacher_id']    = $teacher;
     $data['room_no']       = $room_no;
     $data['day']           = $day;
     $data['from']          = $from;
     $data['to']            = $to;
     $data['modified_at']   = $this->rcdate;

     DB::table('routine')->where('id',$id)->update($data);
     Session::put('succes','Change Sucessfully');
     return Redirect::to('changeRoutine/'.$id);
    }


}
