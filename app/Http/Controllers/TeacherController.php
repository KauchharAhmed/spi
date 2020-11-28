<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class TeacherController extends Controller
{
    /**
     * Teacher controller Class Constructor
     *
     * @return \Illuminate\Http\Response
     */
    private $rcdate ;
    public function __construct(){
    date_default_timezone_set('Asia/Dhaka');
    $this->rcdate = date('Y/m/d');
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Display all teacher list.
     *
     * @return \Illuminate\Http\Response
     */
    public function teacherList()
    {
       $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 3)
        ->where('users.trasfer_status', 0)
        ->get();
       return view('staff.teacherList')->with('result',$result);
    }

    /**
     * Display teacher form to add new teacher.
     *
     * @return \Illuminate\Http\Response
     */
    public function addTeacherForm()
    {
        // with department 
        $result = DB::table('department')->get();
        return view('staff.addTeacherForm')->with('result',$result);
    }
    /**
     * Store a newly created teacher information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addTeacherInfo(Request $request)
    {
    // form validation
    $this->validate($request, [   
    'dep_name'              => 'required',
    'full_name'             => 'required',
    'des'                   => 'required',
    'mobile_number'         => 'required|size:11',
    'retype_mobile_number'  => 'required|size:11',
    'email_address'         => 'required',
    'image'                 => 'mimes:jpeg,jpg,png|max:100'
    ]);
     $dep_name            = trim($request->dep_name);
     $log_in_id           = trim($request->mobile_number);
     $full_name           = trim($request->full_name);
     $short_name          = trim($request->short_name);
     $des                 = trim($request->des);
     $email               = trim($request->email_address);
     $mobile              = trim($request->mobile_number);
     $retype_mobile_number= trim($request->retype_mobile_number);
     $join_date           = trim($request->join_date);
     $previous_institute  = trim($request->previous_institute);
     $index_no            = trim($request->index_no);
     $education_info      = trim($request->education_info);
     $address             = trim($request->address);
     $salt                = 'a123A321';
     $password            = sha1($mobile.$salt);
     $blood_group         = trim($request->blood_group);
     // cheking matching the two mobile number
     if($mobile != $retype_mobile_number)
     {
       Session::put('failed','Sorry ! Mobile Number And Retype Mobile Number Did Not Match');
        return Redirect::to('addTeacherForm');
        exit(); 
     }
     // check duplicatet mobile entry
     $users_mobile_count = DB::table('users')
     ->where('mobile', $mobile)
     ->count();
      if($users_mobile_count > 0){
        Session::put('failed','Sorry ! This Teacher Already Exits. Try To Add Another Teacher With Different Mobile Number');
        return Redirect::to('addTeacherForm');
        exit();
      }
      // check duplicatet email entry
     $users_email_count = DB::table('users')
     ->where('email', $email)
     ->count();
     if($users_email_count > 0){
        Session::put('failed','Sorry ! This Teacher Already Exits. Try To Add Another Teacher With Different Email Address');
        return Redirect::to('addTeacherForm');
        exit();
     }
    // get teacher user id
    $count_id = DB::table('users')->orderBy('user_id','desc')->count();
    if($count_id == '0'){
    $user_id = 1 ;
    }else{
    $user_id_query = DB::table('users')->orderBy('user_id','desc')->first();
    $user_id       = $user_id_query->user_id + 1 ;
   }
     $data=array();
     $data['user_id']               = $user_id ;
     $data['login_id']              = $log_in_id;
     $data['name']                  = $full_name;
     $data['short_name']            = $short_name;
     $data['email']                 = $email;
     $data['mobile']                = $mobile;
     $data['type']                  = '3'; 
     $data['dept']                  = $dep_name;
     $data['password']              = $password;
     $data['joinig_date']           = $join_date;
     $data['education_info']        = $education_info ;
     $data['previous_institute']    = $previous_institute;
     $data['degi']                  = $des;
     $data['index_no']              = $index_no;
     $data['address']               = $address;
     $data['blood_group']           = $blood_group;
     $data['created_at']            = $this->rcdate ;
     $image                 = $request->file('image');
     if($image){
         $image_name        = str_random(20);
         $ext               = strtolower($image->getClientOriginalExtension());
         $image_full_name   = $mobile.$image_name.'.'.$ext;
         $upload_path       ="images/";
         $image_url         =$upload_path.$image_full_name;
         $success           =$image->move($upload_path,$image_full_name);
         if($success){
             $data['image']=$image_url;
             DB::table('users')->insert($data);
             Session::put('succes','Teacher Added Sucessfully');
             return Redirect::to('teacherList');
        }
     }else{
        DB::table('users')->insert($data);
        Session::put('succes','Teacher Added Sucessfully');
        return Redirect::to('teacherList');
    }
    }
#-------------------------------- START CRAFT INSTRUCTOR--------------------#
    /**
     * Display all CRAFT INSTRUCTOR list.
     *
     * @return \Illuminate\Http\Response
     */
    public function craftInstructorList()
    {
       $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 4)
        ->where('users.trasfer_status', 0)
        ->get();
       return view('staff.craftInstructorList')->with('result',$result);
    }
    /**
     * Display craft instructor form to add new craft instructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCraftInstructorForm()
    {
        // with department 
        $result = DB::table('department')->get();
        return view('staff.addCraftInstructorForm')->with('result',$result);
    }
    /**
     * Store a newly created craft instructor information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addCraftInsInfo(Request $request)
    {
    // form validation
    $this->validate($request, [   
    'dep_name'              => 'required',
    'full_name'             => 'required',
    'des'                   => 'required',
    'mobile_number'         => 'required|size:11',
    'retype_mobile_number'  => 'required|size:11',
    'email_address'         => 'required',
    'image'                 => 'mimes:jpeg,jpg,png|max:100'
    ]);
     $dep_name            = trim($request->dep_name);
     $log_in_id           = trim($request->mobile_number);
     $full_name           = trim($request->full_name);
     $short_name          = trim($request->short_name);
     $des                 = trim($request->des);
     $email               = trim($request->email_address);
     $mobile              = trim($request->mobile_number);
     $retype_mobile_number= trim($request->retype_mobile_number);
     $join_date           = trim($request->join_date);
     $previous_institute  = trim($request->previous_institute);
     $index_no            = trim($request->index_no);
     $education_info      = trim($request->education_info);
     $address             = trim($request->address);
     $salt                = 'a123A321';
     $password            = sha1($mobile.$salt);
      $blood_group         = trim($request->blood_group);
     // cheking matching the two mobile number
     if($mobile != $retype_mobile_number)
     {
       Session::put('failed','Sorry ! Mobile Number And Retype Mobile Number Did Not Match');
        return Redirect::to('addCraftInstructorForm');
        exit(); 
     }
     // check duplicatet mobile entry
     $users_mobile_count = DB::table('users')
     ->where('mobile', $mobile)
     ->count();
      if($users_mobile_count > 0){
        Session::put('failed','Sorry ! This Craft Instructor Already Exits. Try To Add Another Craft Instructor With Different Mobile Number');
        return Redirect::to('addCraftInstructorForm');
        exit();
      }
      // check duplicatet email entry
     $users_email_count = DB::table('users')
     ->where('email', $email)
     ->count();
     if($users_email_count > 0){
        Session::put('failed','Sorry ! This Craft Instructorr Already Exits. Try To Add Another Craft Instructor With Different Email Address');
        return Redirect::to('addCraftInstructorForm');
        exit();
     }
      // get teacher user id
    $count_id = DB::table('users')->orderBy('user_id','desc')->count();
    if($count_id == '0'){
    $user_id = 1 ;
    }else{
    $user_id_query = DB::table('users')->orderBy('user_id','desc')->first();
    $user_id       = $user_id_query->user_id + 1 ;
   }
     $data=array();
      $data['user_id']               = $user_id ;
     $data['login_id']              = $log_in_id;
     $data['name']                  = $full_name;
     $data['short_name']            = $short_name;
     $data['email']                 = $email;
     $data['mobile']                = $mobile;
     $data['type']                  = '4'; 
     $data['dept']                  = $dep_name;
     $data['password']              = $password;
     $data['joinig_date']           = $join_date;
     $data['education_info']        = $education_info ;
     $data['previous_institute']    = $previous_institute;
     $data['degi']                  = $des;
     $data['index_no']              = $index_no;
     $data['address']               = $address;
     $data['blood_group']           = $blood_group;
     $data['created_at']            = $this->rcdate ;
     $image                 = $request->file('image');
     if($image){
         $image_name        = str_random(20);
         $ext               = strtolower($image->getClientOriginalExtension());
         $image_full_name   = $mobile.$image_name.'.'.$ext;
         $upload_path       ="images/";
         $image_url         =$upload_path.$image_full_name;
         $success           =$image->move($upload_path,$image_full_name);
         if($success){
             $data['image']=$image_url;
             DB::table('users')->insert($data);
             Session::put('succes','Craft Instructor Added Sucessfully');
             return Redirect::to('craftInstructorList');
        }
     }else{
        DB::table('users')->insert($data);
        Session::put('succes','Craft Instructor Added Sucessfully');
        return Redirect::to('craftInstructorList');
    }
    }
    // teacher edit information
    public function editTeacherInfo($id)
    {
        // get teache infomation
        $row = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName','department.id as dep_id')
        ->where('users.id', $id)
        ->first();
         $result = DB::table('department')->get();
         return view('staff.editTeacherInfo')->with('result',$result)->with('row',$row);
    }

    // edit teacher info
    public function updateTeacherInfo(Request $request)
    {
    // form validation
    $this->validate($request, [   
    'dep_name'              => 'required',
    'full_name'             => 'required',
    'des'                   => 'required',
    'mobile_number'         => 'required|size:11',
    'retype_mobile_number'  => 'required|size:11',
    'email_address'         => 'required',
    'image'                 => 'mimes:jpeg,jpg,png|max:100'
    ]);
     $dep_name            = trim($request->dep_name);
     $log_in_id           = trim($request->mobile_number);
     $full_name           = trim($request->full_name);
     $short_name          = trim($request->short_name);
     $des                 = trim($request->des);
     $email               = trim($request->email_address);
     $mobile              = trim($request->mobile_number);
     $retype_mobile_number= trim($request->retype_mobile_number);
     $join_date           = trim($request->join_date);
     $previous_institute  = trim($request->previous_institute);
     $index_no            = trim($request->index_no);
     $education_info      = trim($request->education_info);
     $address             = trim($request->address);
     $salt                = 'a123A321';
     $password            = sha1($mobile.$salt);
     $blood_group         = trim($request->blood_group);
     $id                  = trim($request->id);
     // cheking matching the two mobile number
     if($mobile != $retype_mobile_number)
     {
       Session::put('failed','Sorry ! Mobile Number And Retype Mobile Number Did Not Match');
        return Redirect::to('editTeacherInfo/'.$id);
        exit(); 
     }
     // check duplicatet mobile entry
     $users_mobile_count = DB::table('users')
     ->where('mobile', $mobile)
     ->whereNotIn('id',[$id])
     ->count();
      if($users_mobile_count > 0){
        Session::put('failed','Sorry ! This Teacher Already Exits. Try To Add Another Teacher With Different Mobile Number');
        return Redirect::to('editTeacherInfo/'.$id);
        exit(); 
      }
      // check duplicatet email entry
     $users_email_count = DB::table('users')
     ->where('email', $email)
     ->whereNotIn('id',[$id])
     ->count();
     if($users_email_count > 0){
        Session::put('failed','Sorry ! This Teacher Already Exits. Try To Add Another Teacher With Different Email Address');
        return Redirect::to('editTeacherInfo/'.$id);
        exit();
     }
     $data=array();
     $data['login_id']              = $log_in_id;
     $data['name']                  = $full_name;
     $data['short_name']            = $short_name;
     $data['email']                 = $email;
     $data['mobile']                = $mobile;
     $data['type']                  = '3'; 
     $data['dept']                  = $dep_name;
     $data['password']              = $password;
     $data['joinig_date']           = $join_date;
     $data['education_info']        = $education_info ;
     $data['previous_institute']    = $previous_institute;
     $data['degi']                  = $des;
     $data['index_no']              = $index_no;
     $data['address']               = $address;
     $data['blood_group']           = $blood_group;
     $data['created_at']            = $this->rcdate ;
     $image                         = $request->file('image');
     if($image){
         $image_name        = str_random(20);
         $ext               = strtolower($image->getClientOriginalExtension());
         $image_full_name   = $mobile.$image_name.'.'.$ext;
         $upload_path       ="images/";
         $image_url         =$upload_path.$image_full_name;
         $success           =$image->move($upload_path,$image_full_name);
         if($success){
             $data['image']=$image_url;
             DB::table('users')->where('id',$id)->update($data);
             Session::put('succes','Teacher Information Updated Sucessfully');
             return Redirect::to('teacherList');
        }
     }else{
     DB::table('users')->where('id',$id)->update($data);
     Session::put('succes','Teacher Information Updated Sucessfully');
     return Redirect::to('teacherList');
    }

    }
    // edit craft info
     public function editCraftInfo($id){
        $row = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName','department.id as dep_id')
        ->where('users.id', $id)
        ->first();
         $result = DB::table('department')->get();
         return view('staff.editCraftInfo')->with('result',$result)->with('row',$row);
     }
     // update the craft info
     public function updateCraftInfo(Request $request)
     {
    // form validation
    $this->validate($request, [   
    'dep_name'              => 'required',
    'full_name'             => 'required',
    'des'                   => 'required',
    'mobile_number'         => 'required|size:11',
    'retype_mobile_number'  => 'required|size:11',
    'email_address'         => 'required',
    'image'                 => 'mimes:jpeg,jpg,png|max:300'
    ]);
     $dep_name            = trim($request->dep_name);
     $log_in_id           = trim($request->mobile_number);
     $full_name           = trim($request->full_name);
     $short_name          = trim($request->short_name);
     $des                 = trim($request->des);
     $email               = trim($request->email_address);
     $mobile              = trim($request->mobile_number);
     $retype_mobile_number= trim($request->retype_mobile_number);
     $join_date           = trim($request->join_date);
     $previous_institute  = trim($request->previous_institute);
     $index_no            = trim($request->index_no);
     $education_info      = trim($request->education_info);
     $address             = trim($request->address);
     $salt                = 'a123A321';
     $password            = sha1($mobile.$salt);
     $blood_group         = trim($request->blood_group);
     $id                  = trim($request->id);
     // cheking matching the two mobile number
     if($mobile != $retype_mobile_number)
     {
       Session::put('failed','Sorry ! Mobile Number And Retype Mobile Number Did Not Match');
        return Redirect::to('editCraftInfo/'.$id);
        exit(); 
     }
     // check duplicatet mobile entry
     $users_mobile_count = DB::table('users')
     ->where('mobile', $mobile)
     ->whereNotIn('id',[$id])
     ->count();
      if($users_mobile_count > 0){
        Session::put('failed','Sorry ! This Teacher Already Exits. Try To Add Another Teacher With Different Mobile Number');
        return Redirect::to('editCraftInfo/'.$id);
        exit(); 
      }
      // check duplicatet email entry
     $users_email_count = DB::table('users')
     ->where('email', $email)
     ->whereNotIn('id',[$id])
     ->count();
     if($users_email_count > 0){
        Session::put('failed','Sorry ! This Teacher Already Exits. Try To Add Another Teacher With Different Email Address');
        return Redirect::to('editCraftInfo/'.$id);
        exit();
     }
     $data=array();
     $data['login_id']              = $log_in_id;
     $data['name']                  = $full_name;
     $data['short_name']            = $short_name;
     $data['email']                 = $email;
     $data['mobile']                = $mobile;
     $data['dept']                  = $dep_name;
     $data['password']              = $password;
     $data['joinig_date']           = $join_date;
     $data['education_info']        = $education_info ;
     $data['previous_institute']    = $previous_institute;
     $data['degi']                  = $des;
     $data['index_no']              = $index_no;
     $data['address']               = $address;
     $data['blood_group']           = $blood_group;
     $data['created_at']            = $this->rcdate ;
     $image                         = $request->file('image');
     if($image){
         $image_name        = str_random(20);
         $ext               = strtolower($image->getClientOriginalExtension());
         $image_full_name   = $mobile.$image_name.'.'.$ext;
         $upload_path       ="images/";
         $image_url         =$upload_path.$image_full_name;
         $success           =$image->move($upload_path,$image_full_name);
         if($success){
             $data['image']=$image_url;
             DB::table('users')->where('id',$id)->update($data);
             Session::put('succes','Craft Information Updated Sucessfully');
             return Redirect::to('craftInstructorList');
        }
     }else{
     DB::table('users')->where('id',$id)->update($data);
     Session::put('succes','Craft Information Updated Sucessfully');
     return Redirect::to('craftInstructorList');
    }
    }
 public function superAdminTeacherList()
    {
       $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 3)
        ->where('users.trasfer_status', 0)
        ->get();
       return view('staff.superAdminTeacherList')->with('result',$result);
    }
    // super admin craft instructor list
    public function superAdminCraftInstructorList()
    {
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 4)
        ->where('users.trasfer_status', 0)
        ->get();
       return view('staff.superAdminCraftInstructorList')->with('result',$result); 
    }
    // others staff list
    public function superAdminOtherStaffList()
    {
    $result = DB::table('users')
    ->where('type', '5')
    ->where('users.trasfer_status', 0)
    ->orderBy('id', 'desc')
    ->get();
    return view('staff.superAdminOtherStaffList')->with('result',$result);
    }


}
