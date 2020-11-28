<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class RegistrationController extends Controller
{
     /**
     * Setting Controller Class Constructor
     *
     * @return \Illuminate\Http\Response
     */
    private $rcdate ;
    private $dept_id ;
    public function __construct(){
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate = date('Y/m/d');
        $this->current_time = date('h:i:s');
        $this->dept_id            = Session::get('dept_id');
    }

    /**
    * get setting info for show and edit
    */
   public function reg()
   {
        // get session
       $session    = DB::table('session')->orderBy('id','desc')->get();
        // get department info
        $row        = DB::table('department')->where('status',1)->get();
        // get shift
        $shift     = DB::table('shift')->get();
        // get current semister
        $result    = DB::table('semister')->where('status','1')->get();
        // get section
        //$section   = DB::table('section')->where('dept_id', $this->dept_id)->get();
        return view('student.reg')
       ->with('session',$session)
       ->with('row',$row)
       ->with('shift',$shift)
       ->with('result',$result);
   }
   // reg info
   public function regInfo(Request $request)
   {
      $this->validate($request, [   
    'department'        => 'required',
    'year'              => 'required',
    'session'           => 'required',
    'shift'             => 'required',
    'semister'          => 'required',
    'section'           => 'required',
    'roll'              => 'required',
    'confirm_roll'      => 'required',
    'registration'      => 'required',
    'student_name'      => 'required',
    'father_name'       => 'required',
    'student_mobile'    => 'required|size:11',
    'parents_mobile'    => 'required|size:11',
    'surecash_mobile'   => 'required|size:12',
    'image'             => 'mimes:jpeg,jpg,png|max:100|required'
    ]);
     $department     = trim($request->department);
     $year           = trim($request->year);
     $session        = trim($request->session);
     $shift          = trim($request->shift);
     $semister       = trim($request->semister);
     $section        = trim($request->section);
     $roll           = trim($request->roll);
     $confirm_roll   = trim($request->confirm_roll);
     $registration   = trim($request->registration);
     $student_name   = trim($request->student_name);
     $father_name    = trim($request->father_name);
     $student_mobile = trim($request->student_mobile);
     $mother_name    = trim($request->mother_name);
     $email          = trim($request->email);
     $parents_mobile = trim($request->parents_mobile);
     $surecash_mobile = trim($request->surecash_mobile);
     $date_of_birth  = trim($request->date_of_birth);
     $sex            = trim($request->sex);
     $religion       = trim($request->religion);
     $present_address= trim($request->present_address);
     $permanent_address   = trim($request->permanent_address);
     if($roll != $confirm_roll){
        Session::put('failed','Sorry ! Your Roll And Confirm Roll Did Not Match. Try Again');
        return Redirect::to('reg');
      exit();
     }

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
     ->where('roll', $roll)
     ->count();
      if($student_roll_count > 0){
        Session::put('failed','Sorry ! আপনার রেজিস্ট্রেশন পূর্বেই সম্পর্ন্ন হয়েছে । আপনাকে পুনরায় রেজিস্ট্রেশন করতে হবে না');
        return Redirect::to('reg');
        exit();
      }
    // check duplicate registraion entry
       $student_registration_count = DB::table('student')
     ->where('registration', $registration)
     ->count();
      if($student_registration_count > 0){
        Session::put('failed','Sorry ! আপনার রেজিস্ট্রেশন পূর্বেই সম্পর্ন্ন হয়েছে । আপনাকে পুনরায় রেজিস্ট্রেশন করতে হবে না');
        return Redirect::to('reg');
        exit();
      }

      $reg = DB::table('reg')
     ->where('roll', $roll)
     ->count();
      if($reg > 0){
       Session::put('failed','Sorry ! আপনার রেজিস্ট্রেশন পূর্বেই সম্পর্ন্ন হয়েছে । আপনাকে পুনরায় রেজিস্ট্রেশন করতে হবে না');
        return Redirect::to('reg');
        exit();
      }

      $reg = DB::table('reg')
     ->where('surecashMobile', $surecash_mobile)
     ->count();
      if($reg > 0){
       Session::put('failed','Sorry ! আপনার শিওরক্যাশ নম্বর পূর্বেই ব্যবহার করা হয়েছে। অন্য নম্বর দিয়ে আবার চেষ্টা করুন।');
        return Redirect::to('reg');
        exit();
      }

     #--------------------------- student basic information -------------------------#
     $data=array();
     $data['studentName']   = $student_name;
     $data['fatherName']    = $father_name;
     $data['motherName']    = $mother_name ; 
     $data['studentEmail']  = $email;
     $data['studentMobile'] = $student_mobile;
     $data['parentsMobile'] = $parents_mobile;
     $data['surecashMobile']  = $surecash_mobile;
     $data['studentBirthDate']= $date_of_birth ;
     $data['studentSex']      = $sex;
     $data['presentAdd']      = $present_address;
     $data['permanentAdd']    = $permanent_address;
     $data['studentReligion'] = $religion;
     $image                   = $request->file('image');
    #---------------------- student academic information--------------------------#
     $data['session']      = $session ;
     $data['year']         = $year;
     $data['shift_id']     = $shift;
     $data['dept_id']      = $department ; 
     $data['semister_id']  = $semister ;
     $data['section_id']   = $section ;
     $data['roll']         = $roll;
     $data['registration'] = $registration;
     $data['created_at']   = $this->rcdate;
     $send_message = "Mr ".$student_name.', Your Roll '.$roll.' Registration Completed Sucessfully. Sirajganj Polytechnic Institute. Any Query 01729661197';
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
      $total_sms = $cal_msg ;

      $avilable_sms_query = DB::table('sms_count')->first();
      $avialable_sms      = $avilable_sms_query->available_sms;
      $sending_sms        = $avilable_sms_query->sending_sms;

      if($avialable_sms < $total_sms) {
        Session::put('failed','Sorry ! Insufficent SMS Balance. SMS Not Sent Successfully');
        return Redirect::to('reg');
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

        $data_sms_insert = array();
        $data_sms_insert['added_id']        = "" ;
        $data_sms_insert['added_user_type'] = "" ;
        $data_sms_insert['sms_id']          = $last_sms_id ;
        $data_sms_insert['type']            = 2 ;
        $data_sms_insert['student_id']      = 0 ;
        $data_sms_insert['year']            = $year ;
        $data_sms_insert['dep_id']          = $department ;
        $data_sms_insert['shift_id']        = $shift ;
        $data_sms_insert['semister_id']     = $semister ;
        $data_sms_insert['section_id']      = $section ;
        $data_sms_insert['roll']            = $roll ;
        $data_sms_insert['mobile_number']   = $student_mobile ;
        $data_sms_insert['sms_count']       = $cal_msg ;
        $data_sms_insert['sms_type']        = "Registration For Smart ID Card";
        $data_sms_insert['sms_time']        = $this->current_time ;
        $data_sms_insert['created_at']      = $this->rcdate ;
        DB::table('sending_sms_history')->insert($data_sms_insert);

     if($image){
         $image_name        = str_random(20);
         $ext               = strtolower($image->getClientOriginalExtension());
         $image_full_name   ='reg_student-'.$roll.'-'.$image_name.'.'.$ext;
         $upload_path       = "images/";
         $image_url         = $upload_path.$image_full_name;
         $success           = $image->move($upload_path,$image_full_name);
        $data['studentImage']=$image_url;
             DB::table('reg')->insert($data);
             file_get_contents("http://touchsitbd.com/systemsms/api.php?username=asianitinc@gmail.com&password=121lsr21LaraSoft&recipient=$student_mobile&message=$message");
             Session::put('succes','Registration Completed Sucessfully And You Will Get SMS');
             return Redirect::to('reg');
     }else{
        DB::table('reg')->insert($data);
        file_get_contents("http://touchsitbd.com/systemsms/api.php?username=asianitinc@gmail.com&password=121lsr21LaraSoft&recipient=$student_mobile&message=$message");
           Session::put('succes','Registration Completed Sucessfully And You Will Get SMS');
           return Redirect::to('reg');
         }
    
   }
   // check reg
   public function checkReg()
   {
    return view('student.checkReg');
   }
   // student verify check
   public function studentVerifyCheckByStudent(Request $request)
   {
    $roll = trim($request->roll);
      $student_roll_count = DB::table('student')
     ->where('roll', $roll)
     ->count();
      if($student_roll_count > 0){
        echo 'f1';
        exit();
      }
      $reg = DB::table('reg')
     ->where('roll', $roll)
     ->count();
      if($reg > 0){
        echo 'f1';
        exit();
      }
      echo 'f2';

   }
     // function for registration student list
   public function studentRegList()
   {
     $result = DB::table('reg')
            ->join('session', 'session.id', '=', 'reg.session')
            ->join('department', 'department.id', '=', 'reg.dept_id')
            ->join('semister', 'semister.id', '=', 'reg.semister_id')
            ->join('shift', 'shift.id', '=', 'reg.shift_id')
            ->join('section', 'section.id', '=', 'reg.section_id')
            ->select('reg.*', 'session.id', 'session.sessionName', 'department.id', 'department.departmentName', 'semister.id', 'semister.semisterName', 'shift.id', 'shift.shiftName', 'section.id', 'section.section_name')
            ->get();
     return view('student.studentRegList')->with('result',$result);
   }



 }