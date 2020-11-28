<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class AdminController extends Controller
{
      /**
     * EducationInfoController Class Constructor
     *
     * @return \Illuminate\Http\Response
     */
    private $rcdate ;
    public function __construct(){
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate = date('Y/m/d');
    }
    /**
     * Display admin login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }
    #----------------------- SUPER ADMIN ---------------------- #
    /**
     * super admin login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function superAdminLogin(Request $request)
    {
     // form validation
    $this->validate($request, [
    'login_id' => 'required|size:11',
    'password' => 'required',
    'type'     => 'required'
    ]);
     $log_in_id = trim($request->login_id);
     $salt      = 'a123A321';
     $password  = trim(sha1($request->password.$salt));
     $type      = trim($request->type);
    #--------------- super admin login -----------------------#
     if($type == '1'){
     $super_admin = DB::table('superadmin')
     ->where('mobile', $log_in_id)
     ->where('password', $password)
     ->where('status',1)
      ->first();
      if($super_admin){
          Session::put('superadmin_name',$super_admin->name);
          Session::put('superadmin_id',$super_admin->id);
          Session::put('type',$super_admin->status);
          return Redirect::to('/superadminDashboard');
      }else{
          Session::put('login_faild','Sorry!! Your Information Did Not Match. Try Again');
          return Redirect::to('/admin');

      }
  }
  #--------------- admin login -----------------------#
  elseif($type == '2'){
     $admin = DB::table('users')
     ->where('mobile', $log_in_id)
     ->where('password', $password)
     ->where('type',2)
     ->where('trasfer_status',0)
      ->first();
      if($admin){
          Session::put('admin_name',$admin->name);
          Session::put('admin_id',$admin->id);
          Session::put('type',$admin->type);
          Session::put('image',$admin->image);
          return Redirect::to('/adminDashboard');
      }else{
          Session::put('login_faild','Sorry!! Your Information Did Not Match. Try Again');
          return Redirect::to('/admin');

      }
  }
#------------------------- department head login ---------------------
  elseif($type == '6'){
      $dept_head = DB::table('department_head')
     ->where('login_id', $log_in_id)
     ->where('password', $password)
     ->where('type',6)
      ->first();
      if($dept_head){
        $teacher_id = $dept_head->teacher_id ;
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.name','users.image', 'department.departmentName','department.id')
        ->where('users.id', $teacher_id)
        ->where('users.type', 3)
        //->where('users.trasfer_status', 0)
        ->first();
          Session::put('department_head_name',$result->name);
          Session::put('department_head_id',$dept_head->id);
          Session::put('type',$dept_head->type);
          Session::put('dept_id',$result->id);
          Session::put('dept_name',$result->departmentName);
          Session::put('image',$result->image);
          return Redirect::to('/departmentHeadDashboard');
      }else{
          Session::put('login_faild','Sorry!! Your Information Did Not Match. Try Again');
          return Redirect::to('/admin');

      }
  }
  #--------------------Teacher Login--------------------------------#
     elseif($type == '3'){
     $teacher = DB::table('users')
     ->where('mobile', $log_in_id)
     ->where('password', $password)
     ->where('type',3)
     ->where('trasfer_status',0)
      ->first();
      if($teacher){
          Session::put('teacher_name',$teacher->name);
          Session::put('teacher_id',$teacher->id);
          Session::put('teacher_dept_id',$teacher->dept);
          Session::put('type',$teacher->type);
          Session::put('image',$teacher->image);
          return Redirect::to('/teacherDashboard');
      }else{
          Session::put('login_faild','Sorry!! Your Information Did Not Match. Try Again');
          return Redirect::to('/admin');

      }
  }
  #--------------------- Craft Instructor Login----------------------# 
  elseif($type == '4'){
     $craft = DB::table('users')
     ->where('mobile', $log_in_id)
     ->where('password', $password)
     ->where('type',4)
     ->where('trasfer_status',0)
      ->first();
      if($craft){
          Session::put('craft_name',$craft->name);
          Session::put('craft_id',$craft->id);
          Session::put('craft_dept_id',$craft->dept);
          Session::put('type',$craft->type);
          Session::put('image',$craft->image);
          return Redirect::to('/craftDashboard');
      }else{
          Session::put('login_faild','Sorry!! Your Information Did Not Match. Try Again');
          return Redirect::to('/admin');

      }
  }

}

// access from web admin
    public function superAdminFromWebAdmin($superadmin_id,$type)
    {
      if ($type == "1") {
         $super_admin = DB::table('superadmin')
          ->where('id', $superadmin_id)
          ->where('status',1)
           ->first();
          Session::put('superadmin_name',$super_admin->name);
          Session::put('superadmin_id',$super_admin->id);
          Session::put('type',$super_admin->status);
           return Redirect::to('/superadminDashboard');
      }else{
        return Redirect::to('admin');
          exit();
      }
    }


    /**
     * After login successull super admin enter into dashobard 
     * @return \Illuminate\Http\Response
     */
    public function superadminDashboard()
    {
      //get admin
      $admin   = DB::table('users')->where('type',2)->where('trasfer_status',0)->count();
      $teacher = DB::table('users')->where('type',3)->where('trasfer_status',0)->count();
      $craft   = DB::table('users')->where('type',4)->where('trasfer_status',0)->count();
      $staff   = DB::table('users')->where('type',5)->where('trasfer_status',0)->count();
      return view('admin.superadminDashboard')->with('admin',$admin)->with('teacher',$teacher)->with('craft',$craft)->with('staff',$staff);
    }
    /**
     * After login successull admin enter into dashobard 
     * @return \Illuminate\Http\Response
     */
    public function adminDashboard()
    {
      $admin   = DB::table('users')->where('type',2)->where('trasfer_status',0)->count();
      $teacher = DB::table('users')->where('type',3)->where('trasfer_status',0)->count();
      $craft   = DB::table('users')->where('type',4)->where('trasfer_status',0)->count();
      $staff   = DB::table('users')->where('type',5)->where('trasfer_status',0)->count();
      return view('admin.adminDashboard')->with('admin',$admin)->with('teacher',$teacher)->with('craft',$craft)->with('staff',$staff);
    }
    /**
     * After login successull department head enter into dashobard 
     * @return \Illuminate\Http\Response
     */
    public function departmentHeadDashboard()
    {
      $dept_id  = Session::get('dept_id') ;
      $teacher  = DB::table('users')->where('type',3)->where('dept',$dept_id)->where('trasfer_status',0)->count();
      $craft    = DB::table('users')->where('type',4)->where('dept',$dept_id)->where('trasfer_status',0)->count();
      return view('admin.departmentHeadDashboard')->with('teacher',$teacher)->with('craft',$craft);
    }

    /**
     * After login successull teacher enter into dashobard 
     * @return \Illuminate\Http\Response
     */
   public function teacherDashboard()
   {
     return view('admin.teacherDashboard');
   }

   /**
     * After login successull craft enter into dashobard 
     * @return \Illuminate\Http\Response
     */
   public function craftDashboard()
   {
    return view('admin.craftDashboard');
   }

    /**
     * super admin logout process 
     * @return \Illuminate\Http\Response
     */
    public function superAdminLogout()
   {
       Session::put('superadmin_id',null);
       Session::put('type',null);
       return Redirect::to('admin');
   }
    /**
    *admin logout process 
    * @return \Illuminate\Http\Response
    */
   public function adminLogout()
   {
       Session::put('admin_id',null);
       Session::put('type',null);
       return Redirect::to('admin');
   }

      /**
     * department head logout process
     * @return \Illuminate\Http\Response
     */

      public function departmentHeadLogout()
   {
       Session::put('department_head_id',null);
       Session::put('type',null);
       return Redirect::to('admin');
   }
    /**
     * teacher logout process
     * @return \Illuminate\Http\Response
     */
    public function teacherLogout()
    {
     Session::put('teacher_id',null);
     Session::put('type',null);
     return Redirect::to('admin');
    }
   /**
     * craft Logout process
     * @return \Illuminate\Http\Response
     */
    public function craftLogout()
    {
     Session::put('craft_id',null);
     Session::put('type',null);
     return Redirect::to('admin');
    }
  #---------------------------------- DEPARTMENT HEAD-----------------------------#
    /**
     * Display all deparntment INSTRUCTOR list.
     *
     * @return \Illuminate\Http\Response
     */
    public function departmetnHeadList()
    {
        // status 1 = active department head
        $result = DB::table('department_head')
        ->join('department', 'department_head.dep_id', '=', 'department.id')
        ->join('users', 'department_head.teacher_id', '=', 'users.id')
        ->select('department_head.*','users.name','users.mobile','users.image', 'department.departmentName')
        ->where('users.type', 3)
        ->where('department_head.status', 1)
        ->get();
      return view('admin.departmetnHeadList')->with('result',$result);
    }
    /**
     * Display department head form to add new department head.
     *
     * @return \Illuminate\Http\Response
     */
    public function addDepartmentHeadForm()
    {
        $result = DB::table('department')->get();
        return view('admin.addDepartmentHeadForm')->with('result',$result);
    }
     /**
     * get the teacher name by department click by ajax request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getTeacher(Request $request)
    {
      $dep =  $request->dep ;
      $result = DB::table('users')
    ->where('type', '3')
    ->where('dept', $dep)
    ->where('trasfer_status', 0)
    ->orderBy('id', 'desc')
    ->get();
     echo "<option value=''>"."Select Teacher"."</option>";
    foreach ($result as $value) {
      echo "<option value= $value->id>".$value->name."</option>";
    }

}
    /**
     * Store a newly department head information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  public function addDepartmentHeadInfo(Request $request)
  {
    $this->validate($request, [
    'dep_id'          => 'required',
    'teacher_id'      => 'required',
    'title'           => 'required',
    'image'           => 'mimes:jpeg,jpg,png|max:100'
    ]);
     $dep_id          = trim($request->dep_id);
     $teacher_id      = trim($request->teacher_id);
     $title           = trim($request->title);
     $image           = $request->file('image');
     //check duplicate depertment
     $check_dep = DB::table('department_head')
     ->where('dep_id', $dep_id)
     ->count();
      if($check_dep > 0){
        Session::put('failed','Sorry ! Department Head Already Exits Of This Department. Try To Add New Department Head');
        return Redirect::to('addDepartmentHeadForm');
        exit();
      }
    //check duplicatet teacher id
     $check_teacher = DB::table('department_head')
     ->where('teacher_id', $teacher_id)
     ->count();
      if($check_teacher > 0){
        Session::put('failed','Sorry ! Tearcher Already Exits As A Department Head. Try To Add New Department Head');
        return Redirect::to('addDepartmentForm');
        exit();
      }
      // get login id and password of this depatment head from users table
      $teacher_info = DB::table('users')
     ->where('id', $teacher_id)
     ->where('type', 3)
     ->first();
     $log_in_id = $teacher_info->login_id ;
     $password  = $teacher_info->password ;
     /*
     *  title 1 = permanet department head  and title 2 = acting depatement head
     *  user type 6
     *  status 1 = active and status 2 = inactive 
     */
     $data=array();
     $data['login_id']   = $log_in_id;
     $data['password']   = $password;
     $data['dep_id']     = $dep_id ;
     $data['teacher_id'] = $teacher_id ;
     $data['title']      = $title ;
     $data['type']       = 6;
     $data['status']     = 1;
     $data['created_at'] = $this->rcdate ;
         $image_name        = str_random(20);
         $ext               = strtolower($image->getClientOriginalExtension());
         $image_full_name   ='signature-'.$image_name.'.'.$ext;
         $upload_path       = "images/";
         $image_url         = $upload_path.$image_full_name;
         $success           = $image->move($upload_path,$image_full_name);
         if($success){
             $data['signature'] = $image_url;
     $query = DB::table('department_head')->insert($data);
     if($query){
        Session::put('succes','Department Head Added Sucessfully');
        return Redirect::to('departmetnHeadList');
    }else{
        Session::put('failed','Sorry ! Error Occued. Try Again');
        return Redirect::to('departmetnHeadList');
    }
  }

  }

  /**
  * add staff rfid number form
  */
  public function addStaffRfidNumber($id)
  {
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
    return view('admin.addStaffRfidNumber')->with('data',$data)->with('dept',$dept);
  }
  /**
  * add staff rfid number
  */
 public function addStaffRfidNoInfo(Request $request)
 {
    $this->validate($request, [
    'rfid'          => 'required',
    'confirm_rfid'          => 'required',
    ]);
        $rfid_no       = $request->rfid ;
        $confirm_rfid  = $request->confirm_rfid ;
        $id            = $request->id ;

        if($rfid_no != $confirm_rfid)
        {
           Session::put('failed','Sorry ! Rfid Card Number And Confirm Rfid Card Number Did Not Match. Try Again');
           return Redirect::to('addStaffRfidNumber/'.$id);
           exit();
        }
        // check duplicate card number 
        $checkDuplicateStu = DB::table('students')->where('rfIdNumber',$rfid_no)->count();
        if($checkDuplicateStu > 0){
        Session::put('failed','Sorry ! Card Number Already Exits For Student');
           return Redirect::to('addStaffRfidNumber/'.$id);
        exit();
        }
        $checkDuplicateUser = DB::table('users')->where('rfidCardNo',$rfid_no)->count();
        if($checkDuplicateUser > 0){
        Session::put('failed','Sorry ! Card Number Already Exits');
          return Redirect::to('addStaffRfidNumber/'.$id);
        exit();
        }

        // check already added rfid card number
        $check = DB::table('users')->where('id',$id)->first();
        if($check->rfidCardNo != ''){
              Session::put('failed','Sorry ! Card Number Already Added Of This Staff');
        return Redirect::to('addStaffRfidNumber/'.$id);
        exit();
        }
        $data = array();
        $data['rfidCardNo'] = $rfid_no ;
        $query = DB::table('users')->where('id',$id)->update($data);
        if($query){
        Session::put('succes','Card Number Added Sucessfully');
         return Redirect::to('addStaffRfidNumber/'.$id);
        }else{
        Session::put('failed','Sorry !Card Number Not Insert Try Again');
          return Redirect::to('addStaffRfidNumber/'.$id);
        exit();
        }

 }
    
}
