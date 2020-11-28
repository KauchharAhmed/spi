<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class StudentController extends Controller
{
     /**
     * StudentController Class Constructor
     *
     * @return \Illuminate\Http\Response
     */
    private $rcdate ;
    private $department_head_id ;
    private $current_year ;
    public function __construct(){
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate             = date('Y/m/d');
        $this->current_year       = date('Y');
        $this->dept_id            = Session::get('dept_id');
        $this->department_head_id = Session::get('department_head_id');
    }
     /**
     * Display student form to add new student.
     *
     * @return \Illuminate\Http\Response
     */
    public function newStudentRegForm()
    {
    	// get session
    	$session    = DB::table('session')->orderBy('id','desc')->get();
        // get department info
        $row        = DB::table('department')->where('id', $this->dept_id)->first();
        // get shift
        $shift     = DB::table('shift')->get();
        // get current semister
        $result    = DB::table('semister')->where('status','1')->get();
        // get section
        $section   = DB::table('section')->where('dept_id', $this->dept_id)->get();
       return view('student.newStudentRegForm')
       ->with('session',$session)
       ->with('row',$row)
       ->with('shift',$shift)
       ->with('result',$result)
       ->with('section',$section);

    }
    /**
     * Store a newly created student.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addNewStudentInfo(Request $request)
    {
    $this->validate($request, [   
    'department'        => 'required',
    'year'              => 'required',
    'session'           => 'required',
    'shift'             => 'required',
    'semister'          => 'required',
    'section'           => 'required',
    'roll'              => 'required',
    'registration'      => 'required',
    'activity_status'   => 'required',
    'student_name'      => 'required',
    'father_name'       => 'required',
    //'student_mobile'    => 'required|size:11',
    'image'             => 'mimes:jpeg,jpg,png|max:200'
    ]);
     $department     = trim($request->department);
     $log_in_id      = trim($request->roll);
     $year           = trim($request->year);
     $rfid           = trim($request->rfid);
     $session        = trim($request->session);
     $shift          = trim($request->shift);
     $semister       = trim($request->semister);
     $section        = trim($request->section);
     $roll           = trim($request->roll);
     $registration   = trim($request->registration);
     $activity_status= trim($request->activity_status);
     $student_name   = trim($request->student_name);
     $father_name    = trim($request->father_name);
     $student_mobile = trim($request->student_mobile);
     $mother_name    = trim($request->mother_name);
     $email          = trim($request->email);
     $parents_mobile = trim($request->parents_mobile);
     $date_of_birth  = trim($request->date_of_birth);
     $sex            = trim($request->sex);
     $religion       = trim($request->religion);
     $present_address= trim($request->present_address);
     $permanent_address   = trim($request->permanent_address);
     $remarks             = trim($request->remarks);
     $salt                = 'a123A321';
     $password            = sha1($registration.$salt);
     // check duplicatet mobile entry
    //  $student_mobile_count = DB::table('students')
    //  ->where('studentMobile', $student_mobile)
    //  ->count();
    //   if($student_mobile_count > 0){
    //     Session::put('failed','Sorry ! This Mobile Number '.$student_mobile.' Already Exits');
    //     return Redirect::to('newStudentRegForm');
    //     exit();
    //   }
    // check duplicatet roll entry
     $student_roll_count = DB::table('student')
     ->where('session', $session)
     ->where('shift_id', $shift)
     ->where('dept_id', $department)
     ->where('semister_id', $semister)
     ->where('section_id',$section)
     ->where('roll', $roll)
     ->count();
      if($student_roll_count > 0){
        Session::put('failed','Sorry ! This Roll Number '.$roll.' Already Exits');
        return Redirect::to('newStudentRegForm');
        exit();
      }
    // check duplicate registraion entry
       $student_registration_count = DB::table('student')
     ->where('session', $session)
     ->where('shift_id', $shift)
     ->where('dept_id', $department)
     ->where('semister_id', $semister)
     ->where('section_id',$section)
     ->where('registration', $registration)
     ->count();
      if($student_registration_count > 0){
        Session::put('failed','Sorry ! This Registraion Number '.$registration.' Already Exits');
        return Redirect::to('newStudentRegForm');
        exit();
      }
     #--------------------------- student basic information -------------------------#
     $data=array();
     $data['rfIdNumber']    = $rfid;
     $data['added_id']      = $this->department_head_id;
     $data['studentLogin']  = $log_in_id ;
     $data['studentName']   = $student_name;
     $data['fatherName']    = $father_name;
     $data['motherName']    = $mother_name ; 
     $data['studentEmail']  = $email;
     $data['studentMobile'] = $student_mobile;
     $data['parentsMobile'] = $parents_mobile;
     $data['studentBirthDate']= $date_of_birth ;
     $data['studentSex']      = $sex;
     $data['presentAdd']      = $present_address;
     $data['permanentAdd']    = $permanent_address;
     $data['studentPwd']      = $password;
     $data['studentReligion'] = $religion;
     $data['studentPwd']      = $password ;
     $data['created_at']      = $this->rcdate ;
     $image                   = $request->file('image');
    #---------------------- student academic information--------------------------#
     $data1['session']      = $session ;
     $data1['year']         = $year;
     $data1['shift_id']     = $shift;
     $data1['dept_id']      = $department ; 
     $data1['semister_id']  = $semister ;
     $data1['section_id']   = $section ;
     $data1['roll']         = $roll;
     $data1['registration'] = $registration;
     $data1['semister_status'] = 1;
     $data1['activity_status'] = $activity_status;
     $data1['created_at']   = $this->rcdate;
     if($image){
         $image_name        = str_random(20);
         $ext               = strtolower($image->getClientOriginalExtension());
         $image_full_name   ='student-'.$roll.'-'.$image_name.'.'.$ext;
         $upload_path       = "images/";
         $image_url         = $upload_path.$image_full_name;
         $success           = $image->move($upload_path,$image_full_name);
         if($success){
             $data['studentImage']=$image_url;
             DB::table('students')->insert($data);
             // get last student id 
             $student_id = DB::table('students')
             ->orderBy('id', 'desc')->take(1)->first();
             $data1['studentID'] = $student_id->id ;
             DB::table('student')->insert($data1);
             Session::put('succes','New Student Added Sucessfully');
             return Redirect::to('newStudentRegForm');
        }
     }else{
        DB::table('students')->insert($data);
         // get last student id 
        $student_id = DB::table('students')
             ->orderBy('id', 'desc')->take(1)->first();
             $data1['studentID'] = $student_id->id ;
             DB::table('student')->insert($data1);
        Session::put('succes','New Student Added Sucessfully');
        return Redirect::to('newStudentRegForm');
    }
    }
    /**
     * Display student search form.
     *
     * @return \Illuminate\Http\Response
     */
     public function studentList()
     {
        // get shift
        $shift               = DB::table('shift')->get();
        // get current semister
        $semister            = DB::table('semister')->get();
        // get section
         $section            = DB::table('section')->where('dept_id', $this->dept_id)->get();
        return view('student.studentList')->with('shift',$shift)->with('semsiter',$semister)->with('section',$section);
     }
    /**
     * Display search wise student list.
     * @return \Illuminate\Http\Response
     */
     public function getStudentList(Request $request)
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
        ->select('students.*','student.session','student.semister_status','student.year','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','section.section_name')
        ->orderBy('student.roll','asc')
        ->where('student.year', $year)
        ->where('student.shift_id', $shift)
        ->where('student.dept_id', $dep_id)
        ->where('student.semister_id', $semister)
        ->where('student.section_id', $section)
        ->where('student.status', 0)
        ->get();
     }

     return view('student.viewAllStudent')->with('data',$data)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('year',$year)->with('roll',$roll);

     }

    /**
     * Add student rfif card number form
     */
    public function addStudentRfidNumber($id , $shift , $semister)
    {
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
        return view('student.addStudentRfidNumber')->with('data',$data)->with('shiftID',$shift)->with('semisterID',$semister);
    }
      /**
     * Add Student Rfid card number
     */
    public function addStudentRfidNo(Request $request)
    {
    $this->validate($request, [
    'rfid'          => 'required',
    'confirm_rfid'  => 'required'
    ]);

        $id       = $request->id ;
        $shift    = $request->shift ;
        $semister = $request->semister ;

        $rfid_no         = trim($request->rfid);
        $confirm_rfid = trim($request->confirm_rfid);
        if($rfid_no != $confirm_rfid){
        Session::put('failed','Sorry ! Rfid Number And Confirm Rfid Number Did Not Match');
        return Redirect::to('addStudentRfidNumber/'.$id.'/'.$shift.'/'.$semister);
        exit();   
        }
        // check duplicate card number 
        $checkDuplicateStu = DB::table('students')->where('rfIdNumber',$rfid_no)->count();
        if($checkDuplicateStu > 0){
        Session::put('failed','Sorry ! Card Number Already Exits');
        return Redirect::to('addStudentRfidNumber/'.$id.'/'.$shift.'/'.$semister);
        exit();
        }
        $checkDuplicateUser = DB::table('users')->where('rfidCardNo',$rfid_no)->count();
        if($checkDuplicateUser > 0){
        Session::put('failed','Sorry ! Card Number Already Exits For Staff');
        return Redirect::to('addStudentRfidNumber/'.$id.'/'.$shift.'/'.$semister);
        exit();
        }

        // check already added rfid card number
        $check = DB::table('students')->where('id',$id)->first();
        if($check->rfIdNumber != ''){
        Session::put('failed','Sorry ! Card Number Already Added Of This Student');
        return Redirect::to('addStudentRfidNumber/'.$id.'/'.$shift.'/'.$semister);
        exit();
        }
        $data = array();
        $data['rfIdNumber'] = $rfid_no ;
        $query = DB::table('students')->where('id',$id)->update($data);
        if($query){
        Session::put('succes','Card Number Added Sucessfully');
        return Redirect::to('addStudentRfidNumber/'.$id.'/'.$shift.'/'.$semister);
        }else{
        Session::put('failed','Sorry !Card Number Not Insert Try Again');
        return Redirect::to('addStudentRfidNumber/'.$id.'/'.$shift.'/'.$semister);
        exit();
        }
     }

     // studnt login form
     public function studentLogin()
     {
        return view('student.studentLogin');
     }
     // student login process
     public function studentLoginProcess(Request $request)
     {
             // form validation
    $this->validate($request, [
    'login_id' => 'required|',
    'password' => 'required'
]);
     $log_in_id = trim($request->login_id);
     $salt      = 'a123A321';
     $password  = trim(sha1($request->password.$salt));
 
    #--------------- student login -----------------------#
     $student = DB::table('students')
     ->where('studentLogin', $log_in_id)
     ->where('studentPwd', $password)
      ->first();
      if($student){
        echo "true";
      }else{
        echo "false";
      }
      // if($super_admin){
      //     Session::put('superadmin_name',$super_admin->name);
      //     Session::put('superadmin_id',$super_admin->id);
      //     Session::put('type',$super_admin->status);
      //     return Redirect::to('/superadminDashboard');
      // }else{
      //     Session::put('login_faild','Sorry!! Your Information Did Not Match. Try Again');
      //     return Redirect::to('/admin');

      // }

     }
     // student promossion
     public function studentPromossion()
     {
         $year               = DB::table('student')->distinct()->get(['year']) ;
        // get shift
        $shift               = DB::table('shift')->get();
        // get current semister
        $semister            = DB::table('semister')->where('status','1')->get();
        // get section
         $section            = DB::table('section')->where('dept_id', $this->dept_id)->get();
        return view('student.studentPromossion')->with('shift',$shift)->with('semsiter',$semister)->with('section',$section)->with('year',$year);
     }
     // promission student list
      public function promossionStudentList(Request $request)
      {
       $dep_id    = $this->dept_id;
       $shift     = $request->shift ;
       $semister  = $request->semister ;
       $year      = $request->year;
       $section   = $request->section;
         $count = DB::table('student')
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
        ->count();
        if($count == '0'){
            echo 'f1';
            exit();
        }
     
        $data = DB::table('student')
        ->join('students', 'student.studentID', '=', 'students.id')
        ->join('shift', 'student.shift_id', '=', 'shift.id')
        ->join('department', 'student.dept_id', '=', 'department.id')
        ->join('semister', 'student.semister_id', '=', 'semister.id')
        ->join('session', 'student.session', '=', 'session.id')
        ->join('section', 'student.section_id', '=', 'section.id')
        ->select('students.*','student.studentID','student.status','student.session','student.semister_status','student.year','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','session.id AS sessionId','section.section_name')
        ->orderBy('student.roll','asc')
        ->where('student.year', $year)
        ->where('student.shift_id', $shift)
        ->where('student.dept_id', $dep_id)
        ->where('student.semister_id', $semister)
        ->where('student.section_id', $section)
        ->where('student.status', 0)
        ->get();
     
     return view('student.viewAllStudentToPromote')->with('data',$data)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('year',$year);
      }

      // auto promossoin in new semister
      public function autoPromossionInNewSemister(Request $request)
      {
       $dep_id    = $this->dept_id;
       $session   = trim($request->session);
       $shift     = trim($request->shift) ;
       $semister  = trim($request->semister) ;
       $year      = trim($request->year);
       $section   = trim($request->section);
       $roll      = $request->roll; 
       $old_semister_query  = DB::table('semister')->where('id',$semister)->first();
       $semister_order      = $old_semister_query->order;
       $new_semister_order  = $semister_order + 1 ;
       $new_semister_query  = DB::table('semister')->where('order',$new_semister_order)->first();  
       $new_semister_id     = $new_semister_query->id ;
        // check duplicate entry
       $count = DB::table('promossion_check')
               ->where('old_year',$year)
               ->where('old_semister_id',$semister)
               ->where('shift_id',$shift)
               ->where('dept_id',$dep_id)
               ->where('section_id',$section)
               ->where('new_year',$this->current_year )
               ->where('new_semister_id', $new_semister_id)
               ->count();
            if($count > 0){
            Session::put('failed','Sorry !Already Completed Promote');
            return Redirect::to('studentPromossion');
             exit();
            }
       // promission check table
        $data_promossion_check                    = array();
        //$data_promossion_check['session_id']      = $session ;
        $data_promossion_check['old_year']        = $year ;
        $data_promossion_check['old_semister_id'] = $semister ;
        $data_promossion_check['shift_id']        = $shift ;
        $data_promossion_check['dept_id']         = $dep_id ;
        $data_promossion_check['section_id']      = $section;
        $data_promossion_check['new_year']        = $this->current_year ;
        $data_promossion_check['new_semister_id'] = $new_semister_id ;
        $data_promossion_check['created_at']      = $this->rcdate ;
        DB::table('promossion_check')->insert($data_promossion_check);

       foreach ($roll as $value) {
        $student_id_query = DB::table('student')      
        ->where('year', $year)
        ->where('shift_id', $shift)
        ->where('dept_id', $dep_id)
        ->where('semister_id', $semister)
        ->where('section_id', $section)
        ->where('roll', $value)
        ->first();

        $studentID            = $student_id_query->studentID ;
        $reg                  = $student_id_query->registration ;
        $session_for_promote  = $student_id_query->session ;
        $data_promossion                    = array();
        $data_promossion['session_id']      = $session_for_promote ;
        $data_promossion['studentID']       = $studentID ;
        $data_promossion['old_year']        = $year ;
        $data_promossion['old_semister_id'] = $semister ;
        $data_promossion['shift_id']        = $shift ;
        $data_promossion['dept_id']         = $dep_id ;
        $data_promossion['section_id']      = $section;
        $data_promossion['new_year']        = $this->current_year ;
        $data_promossion['new_semister_id'] = $new_semister_id ;
        $data_promossion['roll']            = $value ;
        $data_promossion['registration']    = $reg  ;
        $data_promossion['created_at']      = $this->rcdate ;
        DB::table('promossion')->insert($data_promossion);
       }

     // main promossition into student table
        foreach ($roll as $value1) {
        $student_id_queryy = DB::table('student')      
        ->where('year', $year)
        ->where('shift_id', $shift)
        ->where('dept_id', $dep_id)
        ->where('semister_id', $semister)
        ->where('section_id', $section)
        ->where('roll', $value1)
        ->first();
        $studentIDD = $student_id_queryy->studentID ;
        $regg       = $student_id_queryy->registration ;
        $sessionn   = $student_id_queryy->session ;
        $data                    = array();
        $data['studentID']       = $studentIDD ;
        $data['session']         = $sessionn ;
        $data['year']            = $this->current_year  ;
        $data['shift_id']        = $shift ;
        $data['dept_id']         = $dep_id ;
        $data['semister_id']     = $new_semister_id ;
        $data['section_id']      = $section;
        $data['roll']            = $value1 ;
        $data['registration']    = $regg ;
        $data['semister_status'] = 1 ;
        $data['student_type']    = 1 ;
        $data['created_at']      = $this->rcdate ;
        DB::table('student')->insert($data);
        // update semiste  status
        $data1 = array();
        $data1['semister_status'] = 2 ;
        DB::table('student')
        ->where('year', $year)
        ->where('shift_id', $shift)
        ->where('dept_id', $dep_id)
        ->where('semister_id', $semister)
        ->where('section_id', $section)
        ->where('roll', $value1)
        ->update($data1);
       }
        Session::put('succes','Promossition Completed Sucessfully');
        return Redirect::to('studentPromossion');

      }
      // add student door log
      public function addStudentDoorLogNumber($id , $shift , $semister)
      {
        // rfid machine number
        $machine_query = DB::table('machine')->where('dep_id',$this->dept_id)->first();
        $machine_no  = $machine_query->machine_no ;
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
        return view('student.addStudentDoorLogNumber')->with('data',$data)->with('shiftID',$shift)->with('semisterID',$semister)->with('machine_no',$machine_no);
    }
    // add student door log number
    public function addStudentDoorLogNo(Request $request)
    {
    $this->validate($request, [
    'rfid'          => 'required'
    ]);
        $rfid_salt = $request->rfid_salt ;
        $rfid_no  = $rfid_salt.$request->rfid ;
        $id       = $request->id ;
        $shift    = $request->shift ;
        $semister = $request->semister ;
        // check duplicate card number 
        $checkDuplicateStu = DB::table('students')->where('door_log_id',$rfid_no)->count();
        if($checkDuplicateStu > 0){
        Session::put('failed','Sorry ! Card Number Already Exits');
        return Redirect::to('addStudentDoorLogNumber/'.$id.'/'.$shift.'/'.$semister);
        exit();
        }
        $checkDuplicateUser = DB::table('users')->where('rfidCardNo',$rfid_no)->count();
        if($checkDuplicateUser > 0){
        Session::put('failed','Sorry ! Card Number Already Exits--');
        return Redirect::to('addStudentDoorLogNumber/'.$id.'/'.$shift.'/'.$semister);
        exit();
        }

        // check already added rfid card number
        $check = DB::table('students')->where('id',$id)->first();
        if($check->door_log_id != ''){
        Session::put('failed','Sorry ! Card Number Already Added Of This Student');
        return Redirect::to('addStudentDoorLogNumber/'.$id.'/'.$shift.'/'.$semister);
        exit();
        }
        $data = array();
        $data['door_log_id'] = $rfid_no ;
        $query = DB::table('students')->where('id',$id)->update($data);
        if($query){
        Session::put('succes','Card Number Added Sucessfully');
        return Redirect::to('addStudentDoorLogNumber/'.$id.'/'.$shift.'/'.$semister);
        }else{
        Session::put('failed','Sorry !Card Number Not Insert Try Again');
        return Redirect::to('addStudentDoorLogNumber/'.$id.'/'.$shift.'/'.$semister);
        exit();
        } 
    }
    // student promission check
    public function studentPromossionList()
    {
        $year               = DB::table('student')->distinct()->get(['year']) ;
        // get shift
        $shift               = DB::table('shift')->get();
    return view('student.studentPromossionList')->with('shift',$shift)->with('year',$year);
     }

     // student promission list
     public function studentPromissionList(Request $request)
     {
        $year = trim($request->year);
        $shift = trim($request->shift);
          $result = DB::table('promossion_check')
        ->join('shift', 'promossion_check.shift_id', '=', 'shift.id')
        ->join('department', 'promossion_check.dept_id', '=', 'department.id')
        ->join('semister', 'promossion_check.new_semister_id', '=', 'semister.id')
        ->join('section','promossion_check.section_id','=','section.id')
        ->select('promossion_check.*','shift.shiftName','department.departmentName','semister.semisterName','section.section_name')
        ->where('promossion_check.new_year', $year)
        ->where('promossion_check.shift_id', $shift)
        ->where('promossion_check.dept_id', $this->dept_id)
        ->get();
        return  view('student.studentPromissionList')->with('result',$result);
     }
    // update student session
     public function updateSessionStudentList()
     {
        // get shift
        $shift               = DB::table('shift')->get();
        // get current semister
        $semister            = DB::table('semister')->where('status','1')->get();
        // get section
         $section            = DB::table('section')->where('dept_id', $this->dept_id)->get();
        return view('student.updateSessionStudentList')->with('shift',$shift)->with('semsiter',$semister)->with('section',$section);
     }
    // student list for update session
     public function getStudentListToUpdateSession(Request $request)
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
        ->select('students.*','student.session','student.year','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','section.section_name','student.id as new_semister_student_id')
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
        ->select('students.*','student.session','student.year','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','section.section_name','student.id as new_semister_student_id')
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
        ->select('students.*','student.session','student.semister_status','student.year','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','section.section_name','student.id as new_semister_student_id')
        ->orderBy('student.roll','asc')
        ->where('student.year', $year)
        ->where('student.shift_id', $shift)
        ->where('student.dept_id', $dep_id)
        ->where('student.semister_id', $semister)
        ->where('student.section_id', $section)
        ->where('student.status', 0)
        ->get();
     }
     // get all session
     $session = DB::table('session')->get();

     return view('student.getStudentListToUpdateSession')->with('data',$data)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('year',$year)->with('roll',$roll)->with('session',$session); 
     }
     /// update student teacher info
     public function updateStudentSessionInfo(Request $request)
     {
        $id         = $request->id;
        $session_id    = $request->session_id;
        foreach ($id as $key => $id_value) {
              $session = $session_id[$key];
              // update query
              $data = array();
              $data['session'] = $session ;
              DB::table('student')->where('id',$id_value)->update($data);
        }
        Session::put('succes','Session Updated Sucessfully');
        return Redirect::to('updateSessionStudentList');
     }
   // student verify
     public function studentVerify()
     {
        return view('student.studentVerify');
     }
     // student verify check
     public function studentVerifyCheck(Request $request)
     {
       $roll = trim($request->roll);
       // get roll information and semister status is 1
        $data = DB::table('student')
        ->join('students', 'student.studentID', '=', 'students.id')
        ->join('shift', 'student.shift_id', '=', 'shift.id')
        ->join('department', 'student.dept_id', '=', 'department.id')
        ->join('semister', 'student.semister_id', '=', 'semister.id')
        ->join('session', 'student.session', '=', 'session.id')
        ->join('section', 'student.section_id', '=', 'section.id')
        ->select('students.*','student.session','student.semister_status','student.year','student.studentID','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','section.section_name','student.id as new_semister_student_id')
        ->where('student.roll', $roll)
        ->where('student.semister_status',1)
        ->first();

         $count = DB::table('student')
        ->join('students', 'student.studentID', '=', 'students.id')
        ->join('shift', 'student.shift_id', '=', 'shift.id')
        ->join('department', 'student.dept_id', '=', 'department.id')
        ->join('semister', 'student.semister_id', '=', 'semister.id')
        ->join('session', 'student.session', '=', 'session.id')
        ->join('section', 'student.section_id', '=', 'section.id')
        ->select('students.*','student.session','student.semister_status','student.year','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','section.section_name','student.id as new_semister_student_id')
        ->where('student.roll', $roll)
        ->where('student.semister_status',1)
        ->count();

        if($count == '0'){
            echo "f1";
            exit();
        }

        return view('student.studentVerifyCheck')->with('data',$data);
     }
     // update student image
     public function editStudentInfo($id)
     {
        $row = DB::table('students')->where('id',$id)->first();
        $roll = DB::table('student')->where('studentID',$id)->first();
        return view('student.editStudentInfo')->with('row',$row)->with('roll',$roll);
     }
     // update student info
     public function updateStudentInfo(Request $request)
     {
    $this->validate($request, [   
    'image'      => 'mimes:jpeg,jpg,png|max:200'
    ]);
     $mobile     = trim($request->mobile);
     $id         = trim($request->id);
     $roll       = trim($request->roll);
     
     if($mobile != ''){
     $count = DB::table('students')->where('studentMobile',$mobile)->whereNotIn('id',[$id])->count();
     if($count > 0){
        Session::put('failed','Sorry !Mobile Number Already Exits');
        return Redirect::to('editStudentInfo/'.$id);
        exit();
     }
 }
     $image = $request->file('image');
     $data = array();
     $data['studentMobile'] = $mobile ;
      if($image){
         $image_name        = str_random(20);
         $ext               = strtolower($image->getClientOriginalExtension());
         $image_full_name   ='student-'.$roll.'-'.$image_name.'.'.$ext;
         $upload_path       = "images/";
         $image_url         = $upload_path.$image_full_name;
         $success           = $image->move($upload_path,$image_full_name);
         if($success){
             $data['studentImage']=$image_url;
             DB::table('students')->where('id',$id)->update($data);
             Session::put('succes','Student Info Updated Sucessfully');
             return Redirect::to('editStudentInfo/'.$id);
        }
     }else{
            DB::table('students')->where('id',$id)->update($data);
            Session::put('succes','Student Info Updated Sucessfully');
            return Redirect::to('editStudentInfo/'.$id);
    }
    }

    // chck duplicate  verify
    public function duplicateVerifyCheck($roll)
    {
         $count = DB::table('student')
        ->join('students', 'student.studentID', '=', 'students.id')
        ->join('shift', 'student.shift_id', '=', 'shift.id')
        ->join('department', 'student.dept_id', '=', 'department.id')
        ->join('semister', 'student.semister_id', '=', 'semister.id')
        ->join('session', 'student.session', '=', 'session.id')
        ->join('section', 'student.section_id', '=', 'section.id')
        ->select('students.*','student.id AS student_table_id','student.session','student.semister_status','student.year','student.studentID','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','section.section_name','student.id as new_semister_student_id')
        ->where('student.roll', $roll)
        ->groupBy('students.id')
        ->count();
          $data = DB::table('student')
        ->join('students', 'student.studentID', '=', 'students.id')
        ->join('shift', 'student.shift_id', '=', 'shift.id')
        ->join('department', 'student.dept_id', '=', 'department.id')
        ->join('semister', 'student.semister_id', '=', 'semister.id')
        ->join('session', 'student.session', '=', 'session.id')
        ->join('section', 'student.section_id', '=', 'section.id')
        ->select('students.*','student.id AS student_table_id','student.session','student.semister_status','student.year','student.studentID','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','section.section_name','student.id as new_semister_student_id')
        ->where('student.roll', $roll)
        ->get();
       return view('student.duplicateVerifyCheck')->with('data',$data)->with('count',$count);
       
    }

    // delete duplicate value
    public function deleteDuplicateValue($studentId,$student_table_id,$roll)
    {
        // delete query
        DB::table('student')->where('studentID',$studentId)->where('id',$student_table_id)->delete();
        DB::table('students')->where('id',$studentId)->delete();
        Session::put('succes','Student Adjust Sucessfully. Now You Can Drop Out That');
        return Redirect::to('duplicateVerifyCheck/'.$roll);
    }

    // super Admin Student List
    public function superAdminStudentList()
    {
        // get dept
        $dept               = DB::table('department')->where('status',1)->get();
        // get shift
        $shift              = DB::table('shift')->get();
        // get current semister
        $semister           = DB::table('semister')->where('status',1)->get();
        // get section
        $section            = DB::table('section')->where('dept_id', $this->dept_id)->get();
        return view('student.superAdminStudentList')->with('shift',$shift)->with('semsiter',$semister)->with('section',$section)->with('dept',$dept);
    }
   // get studetn for super admin
   public function getStudentListForSuperAdmin(Request $request)
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

     return view('student.viewAllStudentForSuperAdmin')->with('data',$data)->with('shift',$shift)->with('semister',$semister)->with('section',$section)->with('year',$year)->with('dept',$dep_id);

   }




}
