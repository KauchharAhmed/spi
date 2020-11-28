<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;
class UserController extends Controller
{
    /**
     * UserController Class Constructor
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
     * Display all admin list.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminList()
    {
    $result = DB::table('users')
    ->where('type', '2')
    ->orderBy('id', 'desc')
    ->get();
    return view('admin/adminList')->with('result',$result);
    }
    /**
     * Display admin form.
     *
     * @return \Illuminate\Http\Response
     */
    public function addAdminForm()
    {

        return view('admin/addAdminForm');
    }
    /**
     * Store a newly created admin information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addAdminInfo(Request $request)
    {
    // form validation
    $this->validate($request, [
    'full_name'      => 'required',
    'mobile_number'  => 'required|size:11',
    'email_address'  => 'required',
    'image'          => 'mimes:jpeg,jpg,png|max:100'
    ]);
     $log_in_id = trim($request->mobile_number);
     $full_name = trim($request->full_name);
     $email     = trim($request->email_address);
     $mobile    = trim($request->mobile_number);
     $address   = trim($request->address);
     $salt      = 'a123A321';
     $password  = sha1($mobile.$salt);
     // check duplicatet mobile entry
     $users_mobile_count = DB::table('users')
     ->where('mobile', $mobile)
     ->count();
      if($users_mobile_count > 0){
        Session::put('failed','Sorry ! This Admin Already Exits. Try To Add Another Admin With Different Mobile Number');
        return Redirect::to('addAdminForm');
        exit();
      }
      // check duplicatet email entry
     $users_email_count = DB::table('users')
     ->where('email', $email)
     ->count();
     if($users_email_count > 0){
        Session::put('failed','Sorry ! This Admin Already Exits. Try To Add Another Admin With Different Email Address');
        return Redirect::to('addAdminForm');
        exit();
     }
     $data=array();
     $data['login_id']      = $log_in_id;
     $data['name']          = $full_name;
     $data['email']         = $email;
     $data['mobile']        = $mobile;
     $data['type']          = '2';
     $data['password']      = $password;
     $data['address']       = $address;
     $data['created_at']    = $this->rcdate ;
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
             Session::put('succes','Admin Added Sucessfully');
             return Redirect::to('adminList');
        }
     }else{
        DB::table('users')->insert($data);
        Session::put('succes','Admin Added Sucessfully');
        return Redirect::to('adminList');
    }
   } 
    /**
     * Show the form for editing the admin info with admin data.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function editAdminForm($id)
   {
      $row = DB::table('users')->where('id',$id)->first();
      return view('admin.editAdminForm')->with('row',$row);
   }
    /**
     * Update the admini information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editAdminInfo(Request $request)
    {
    // form validation
    $this->validate($request, [
    'full_name'      => 'required',
    'mobile_number'  => 'required|size:11',
    'email_address'  => 'required',
    'id'             => 'required',
    'image'          => 'mimes:jpeg,jpg,png|max:100'
    ]);
     $full_name = trim($request->full_name);
     $email     = trim($request->email_address);
     $mobile    = trim($request->mobile_number);
     $address   = trim($request->address);
     $id        = trim($request->id);
     // check duplicatet mobile entry

     $users_mobile_count = DB::table('users')
                    ->where('mobile', $mobile)
                    ->whereNotIn('id', [$id])
                    ->count();
      if($users_mobile_count > 0){
        Session::put('failed','Sorry ! This Mobile Number Exits To Another Admin. Try With Different Mobile Number');
        return Redirect::to('editAdminForm/'.$id);
        exit();
      }
      // check duplicatet email entry
     $users_email_count = DB::table('users')
     ->where('email', $email)
     ->whereNotIn('id', [$id])
     ->count();
     if($users_email_count > 0){
        Session::put('failed','Sorry ! This Email Address Exits To Another Admin. Try With Different Email Address');
        return Redirect::to('editAdminForm/'.$id);
        exit();
     }
     $data=array();
     $data['name']          = $full_name;
     $data['email']         = $email;
     $data['address']       = $address;
     $data['updated_at']    = $this->rcdate ;
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
             DB::table('users')->where('id', $id)->update($data);
             Session::put('succes','Admin Information Updated Sucessfully');
             return Redirect::to('adminList');
        }
     }else{
        DB::table('users')->where('id', $id)->update($data);
        Session::put('succes','Admin Information Updated Sucessfully');
        return Redirect::to('adminList');
    }

    }
    /**
     * Remove the admin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAdmin($id)
    {
      $query = DB::table('users')->where('id', $id)->delete();
      if($query){
          Session::put('succes','Admin Deleted Sucessfully');
          return redirect::to('adminList');
      }else{
            Session::put('failed','Sorry !You Can Not Delete This Admin. Its Already Use Into System');
            return redirect::to('adminList');
      }
    
    }
#---------------------- OTHER STAFF --------------------------------#
  /**
     * Display all staff list.
     *
     * @return \Illuminate\Http\Response
     */
    public function staffList()
    {
    $result = DB::table('users')
    ->where('type', '5')
    ->where('users.trasfer_status', 0)
    ->orderBy('id', 'desc')
    ->get();
    return view('staff.staffList')->with('result',$result);
    }
    /**
     * Display staff form.
     *
     * @return \Illuminate\Http\Response
     */
    public function addStaffForm()
    {
        return view('staff.addStaffForm');
    }
    /**
     * Store a newly created teacher information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addStaffInfo(Request $request)
    {
    // form validation
    $this->validate($request, [   
    'full_name'             => 'required',
    'des'                   => 'required',
    'mobile_number'         => 'required|size:11',
    'retype_mobile_number'  => 'required|size:11',
    'image'                 => 'mimes:jpeg,jpg,png|max:100'
    ]);
     $log_in_id           = trim($request->mobile_number);
     $full_name           = trim($request->full_name);
     $des                 = trim($request->des);
     $email               = trim($request->email_address);
     $mobile              = trim($request->mobile_number);
     $retype_mobile_number= trim($request->retype_mobile_number);
     $join_date           = trim($request->join_date);
     $previous_institute  = trim($request->previous_institute);
     $education_info      = trim($request->education_info);
     $address             = trim($request->address);
     $salt                = 'a123A321';
     $password            = sha1($mobile.$salt);
     $blood_group         = trim($request->blood_group);
     // cheking matching the two mobile number
     if($mobile != $retype_mobile_number)
     {
       Session::put('failed','Sorry ! Mobile Number And Retype Mobile Number Did Not Match');
        return Redirect::to('addStaffForm');
        exit(); 
     }
     // check duplicatet mobile entry
     $users_mobile_count = DB::table('users')
     ->where('mobile', $mobile)
     ->count();
      if($users_mobile_count > 0){
        Session::put('failed','Sorry ! This Staff Already Exits. Try To Add Another Staff With Different Mobile Number');
        return Redirect::to('addStaffForm');
        exit();
      }
      // check duplicatet email entry
     // $users_email_count = DB::table('users')
     // ->where('email', $email)
     // ->count();
     // if($users_email_count > 0){
     //    Session::put('failed','Sorry ! This Staff Already Exits. Try To Add Another Staff With Different Email Address');
     //    return Redirect::to('addStaffForm');
     //    exit();
     // }
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
     $data['email']                 = $email;
     $data['mobile']                = $mobile;
     $data['type']                  = '5'; 
     $data['password']              = $password;
     $data['joinig_date']           = $join_date;
     $data['education_info']        = $education_info ;
     $data['previous_institute']    = $previous_institute;
     $data['degi']                  = $des;
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
             DB::table('users')->insert($data);
             Session::put('succes','Staff Added Sucessfully');
             return Redirect::to('staffList');
        }
     }else{
        DB::table('users')->insert($data);
        Session::put('succes','Staff Added Sucessfully');
        return Redirect::to('staffList');
    }
    }
    // get all staff by category
    public function getAllStaffForAddLeave(Request $request)
    {
        $staff_type = $request->staff_type ;
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', $staff_type)
        ->where('users.trasfer_status', 0)
        ->orderBy('users.user_id','asc')
        ->get();
        echo "<option value=''>Select Staff</option>";
        foreach ($result as $value) {
        $details = $value->name.' -> '.$value->departmentName.' -> '.$value->mobile ;
        echo "<option value=".$value->id.">".$details."</option>";
    }
}
}
