<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class SettingController extends Controller
{
     /**
     * Setting Controller Class Constructor
     *
     * @return \Illuminate\Http\Response
     */
    private $rcdate ;
    private $dept_id ;
    private $current_time ;
    public function __construct(){
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate = date('Y/m/d');
        $this->dept_id            = Session::get('dept_id');
        $this->current_time  = date('H:i:s') ;
    }

    /**
    * get setting info for show and edit
    */
   public function setting()
   {
   	// with setting info
   	$data = DB::table('setting')->first();
     return view('educationInfo.setting')->with('data',$data);
   }
   /**
    * get setting info for show and edit
    */
   public function editSettingInfo(Request $request)
   {
    $this->validate($request, [   
    'full_name'           => 'required',
    'short_name'          => 'required',
    'mobile_number'       => 'required',
    'phone'               => 'required',
    'email_address'       => 'required',
    'address'             => 'required',
    'image'               => 'mimes:jpeg,jpg,png|max:100'
    ]);
    $full_name      = $request->full_name ;
    $short_name     = $request->short_name ;
    $mobile_number  = $request->mobile_number ;
    $phone          = $request->phone ;
    $email_address  = $request->email_address ;
    $address        = $request->address ;
    $image          = $request->file('image');

    $data = array();
    $data['full_name']  = $full_name ;
    $data['short_name'] = $short_name ;
    $data['mobile']     = $mobile_number ;
    $data['phone']      = $phone ; 
    $data['email']      = $email_address ;
    $data['address']    = $address ;
    
    if($image){
         $image_name        = str_random(20);
         $ext               = strtolower($image->getClientOriginalExtension());
         $image_full_name   ='logo-'.$image_name.'.'.$ext;
         $upload_path       = "images/";
         $image_url         = $upload_path.$image_full_name;
         $success           = $image->move($upload_path,$image_full_name);
         if($success){
             $data['image']= $image_url;
              //unlink(public_path('images/'.$product->image));
             DB::table('setting')->update($data);
             Session::put('succes','Institute Information Updated Sucessfully');
             return Redirect::to('setting');
        }
     }else{
             DB::table('setting')->update($data);
             Session::put('succes','Institute Information Updated Sucessfully');
             return Redirect::to('setting');
    } 
  }

  // machine number assign
  public function machineNumber()
  {
    $count= DB::table('machine')->where('dep_id', $this->dept_id)->count();
     if($count > 0){
        $machine_query = DB::table('machine')->where('dep_id', $this->dept_id)->first();
        $machine_no  = $machine_query->machine_no ;
     }else{
           $machine_no  = '';
     }
    return view('setting.machineNumber')->with('machine_no',$machine_no);
  }
  // add machine info
  public function addMachineInfo(Request $request)
  {
    $this->validate($request, [   
    'machine_no'           => 'required',
    'confirm_machine_no'   => 'required'
    ]);
    $machine_no             = $request->machine_no ;
    $confirm_machine_no     = $request->confirm_machine_no ;
  if($machine_no != $confirm_machine_no){
    Session::put('failed','Sorry ! Machine Number Not Match');
    return Redirect::to('machineNumber');
    exit();
  }
  // if new colum row then insert otherwise update
  $count= DB::table('machine')->where('dep_id', $this->dept_id)->count();
  if($count > 0){
    // update
    $data                 = array();
    $data['machine_no']   = $machine_no ;
    DB::table('machine')->where('dep_id',$this->dept_id)->update($data);
  }else{
    // insert query
    $data             = array();
    $data['dep_id']       = $this->dept_id ;
    $data['machine_no']   = $machine_no ;
    $data['created_at']   = $this->rcdate;
    DB::table('machine')->insert( $data);
  }
   Session::put('succes','Success');
  return Redirect::to('machineNumber');
   
  }
  #-------------------------- database backup----------------------------#
  public function databaseBackup()
  {
    return view('setting.databaseBackup');
  }
  // manualy student attendent permission
  public function superAdminManualStudentAttendentPermission()
  {
    $count = DB::table('tbl_superadmin_permission')->where('permission_type',1)->count();
    $result = DB::table('tbl_superadmin_permission')->where('permission_type',1)->first();
     return view('setting.superAdminManualStudentAttendentPermission')->with('count',$count)->with('result',$result);
  }

  public function addStudentAttendentPermissionInfo(Request $request)
  {
    $this->validate($request, [   
    'permission_status'     => 'required',
    ]);
    $permission_status    = $request->permission_status ;

    $count = DB::table('tbl_superadmin_permission')->where('permission_type',1)->count();
    $data = array();
    $data['status'] = $permission_status ;

    if($count == '0'){
      $data['permission_type'] = 1 ;
      $data['created_at'] = $this->rcdate ;
      DB::table('tbl_superadmin_permission')->insert($data);

    }else{
      // update
      $data['modified_at'] = $this->rcdate ;
      DB::table('tbl_superadmin_permission')->where('permission_type',1)->update($data);
    }

  Session::put('succes','Successfully Updated Permission');
  return Redirect::to('superAdminManualStudentAttendentPermission');

  }
  #----------------------------------- PASSWORD RECOVERY--------------------------------#
  // super admin password change
  public function superAdminChangePassword()
  {
    return view('setting.superAdminChangePassword');
  }
  // change super admin passwod
  public function changeSuperAdminPassword(Request $request)
  {
    $this->validate($request, [
    'old_password'              => 'required',
    'new_password'              => 'required',
    'confirm_new_password'      => 'required',
    'id'                        => 'required',
    'type'                      => 'required',
    ]);
     $salt                 = 'a123A321';
     $old_password         = trim($request->old_password);
     $new_password         = trim($request->new_password);
     $confirm_new_password = trim($request->confirm_new_password);
     $id                   = trim($request->id);
     $type                   = trim($request->type);
     $salt_old_password    = sha1($old_password.$salt);
     $change_password      = sha1($new_password.$salt);
     // check old password
     $check_old_password_query = DB::table('superadmin')->where('id',$id)->where('password',$salt_old_password)->count();
     if($check_old_password_query == '0'){
        // Old password does not match
        Session::put('failed','Sorry ! Your old Password Did Not Match. Try Again');
        return Redirect::to('superAdminChangePassword');  
        exit();
     } 
     // new password and confirm new password matcho
     if($new_password != $confirm_new_password){
        Session::put('failed','Sorry !New password And Confirm New Password Did Not Match. Try Again');
        return Redirect::to('superAdminChangePassword');  
        exit();
     }
     // insert password change history
    $data = array();
    $data['admin_id']       = $id ;
    $data['password']       = $change_password ;
    $data['type']           = 1 ;
    $data['status']         = 1 ;
    $data['created_time']   = $this->current_time ;
    $data['created_at']     = $this->rcdate ;
    DB::table('password_change_history')->insert($data);
    // change the password
    $data1 = array();
    $data1['password'] = $change_password ;
    $query = DB::table('superadmin')->where('id',$id)->update($data1);
    if($query){
   Session::put('superadmin_id',null);
  Session::put('type',null);
    Session::put('succes','Password Change Sucessfully'); 
    return Redirect::to('admin');
    }else{
        Session::put('failed','Sorry !Error Occured. Try Again');
        return Redirect::to('superAdminChangePassword');
    }

  }
  // forgoteen password
  public function forgottenPasswordForm()
  {
    return view('setting.forgottenPasswordForm');
  }
  // mobile number verify
  public function forgottenPasswordMobileVerify(Request $request)
  {
    $this->validate($request, [
    'login_id'              => 'required|size:11',
     'type'                 => 'required'
    ]);
     $mobile        = trim($request->login_id);
     $type          = trim($request->type);

      $avilable_sms_query = DB::table('sms_count')->first();
      $avialable_sms      = $avilable_sms_query->available_sms;
      $sending_sms        = $avilable_sms_query->sending_sms;

        $code = rand(999999,10000);
        $send_message = 'Your Account Recovery Code Is :'.$code.' From SPI' ;

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
       $total_sms =  $cal_msg ;

      if($avialable_sms < $total_sms) {
      Session::put('failed','Sorry ! Insufficent SMS Balance. Contact With Admin');
      return Redirect::to('forgottenPasswordForm');
      exit();
        }


     // verification the mobile number
     if($type == '1'){
      $count = DB::table('superadmin')->where('mobile',$mobile)->count();

     }else{
      // user table
      $count = DB::table('users')->where('mobile',$mobile)->where('type',$type)->count();
     }
     
     if($count == '0'){
        // mobile number not match
        Session::put('failed','Sorry ! Your Mobile Number Not Match. Try Again');
        return Redirect::to('forgottenPasswordForm');
        exit();
     }else{

      if($type == '1'){
        $query      = DB::table('superadmin')->where('mobile',$mobile)->first();
        $id         = $query->id ;
        $log_mobile = $query->mobile ;

      }else{
        $query   = DB::table('users')->where('mobile',$mobile)->where('type',$type)->first();
        $id         = $query->id ;
        $log_mobile = $query->mobile ;
      }
        // get this id
     
        // verification code sent on mobile
        // update recovery code
       
         $data                 = array();
         $data['recover_code'] = $code ;
         
          if($type == '1'){
            $update  = DB::table('superadmin')->where('id',$id)->update($data);
            }else{
            $update =DB::table('users')->where('id',$id)->update($data);
            }
            if($update){
              $random_value_is      = substr(md5(time()), 0, 100) ;
              $random_session_value = Session::put('random_verify_token',$random_value_is) ;
              $last_digit_mobile = substr($log_mobile, 8);

          $data_sms_count   = array();
          $data_sms_count['available_sms'] = $avialable_sms - $total_sms ;
          $data_sms_count['sending_sms']   = $sending_sms + $total_sms;
          DB::table('sms_count')->update($data_sms_count);

      
       $message = urlencode($send_message);
       $data_sms = array();
       $data_sms['sms']            = "Sent Account Recovery Code";
       $data_sms['sms_count']      = $total_sms;
       $data_sms['created_at']     = $this->rcdate;
       DB::table('sending_sms')->insert($data_sms);
         $last_sms_id_query = DB::table('sending_sms')->orderBy('id','desc')->limit(1)->first();
        $last_sms_id       = $last_sms_id_query->id ;

        $data_sms_insert = array();
        $data_sms_insert['sms_id']          = $last_sms_id ;
        $data_sms_insert['type']            = 1 ;
        $data_sms_insert['user_type']       = $type ;
        $data_sms_insert['user_id']         = $id ;
        $data_sms_insert['mobile_number']   = $mobile ;
        $data_sms_insert['sms_count']       = $cal_msg ;
        $data_sms_insert['sms_type']        = "Sent Password Recoovery Code";
        $data_sms_insert['sms_time']        = $this->current_time ;
        $data_sms_insert['created_at']      = $this->rcdate ;
        DB::table('sending_sms_history')->insert($data_sms_insert);
      file_get_contents("http://touchsitbd.com/systemsms/api.php?username=asianitinc@gmail.com&password=121lsr21LaraSoft&recipient=$mobile&message=$message");
        Session::put('succes','Thanks , Recovery Code Sent To Your Mobile Number Which Last 3 Digits is xxxxxxxx'.$last_digit_mobile.' Verify Code Enter Into Below Input Box');
           return Redirect::to('recoverPassword/'.base64_encode ($id).'/'.base64_encode($random_value_is).'/'.$type);

         }else{
        Session::put('failed','Sorry ! Error Occured. Try Again');
        return Redirect::to('forgottenPasswordForm');
         }
     }
   }
     // recover password form
     public function recoverPassword($id , $random_session_value,$type)
     {
      return view('setting.recoverPassword')->with('id',$id)->with('random_session_value',$random_session_value)->with('type',$type);
     } 

     // final recover code
     public function finalRecoveryAccount(Request $request)
     {
    $this->validate($request, [
    'code'                  => 'required',
    'password'              => 'required',
    'confirm_password'      => 'required',
    'id'                    => 'required',
    'random_session_value'   => 'required',
    'type'                  => 'required',
    ]);
     $salt                 = 'a123A321';
     $code                 = trim($request->code);
     $new_password         = trim($request->password);
     $confirm_new_password = trim($request->confirm_password);
     $idd                   = trim($request->id);
     $type                  = trim($request->type);
     $change_password       = sha1($new_password.$salt);

     $id                    = base64_decode($idd) ;
     $session_randmon_value = base64_decode($request->random_session_value) ;
     $seesion_random_value_match = Session::get('random_verify_token');

     if($session_randmon_value != $seesion_random_value_match)
     {
        Session::put('failed','Sorry ! Your Recovery Account Session Is Expired. Try Again');
        return Redirect::to('forgottenPasswordForm');
        exit();
     }

     // check old password
     if($type == '1'){
     $check_code_query = DB::table('superadmin')->where('id',$id)->where('recover_code',$code)->count();
     }else{
       $check_code_query = DB::table('users')->where('id',$id)->where('recover_code',$code)->count();
     }


     if($check_code_query == '0'){
        // Old password does not match
        Session::put('failed','Sorry ! Your Recovery Code Did Not Match. Try Again');
        return Redirect::to('recoverPassword/'.$idd.'/'.$request->random_session_value.'/'.$type);  
        exit();
     } 
     // new password and confirm new password matcho
     if($new_password != $confirm_new_password){
        Session::put('failed','Sorry ! New password And Confirm New Password Did Not Match. Try Again');
        return Redirect::to('recoverPassword/'.$idd.'/'.$request->random_session_value.'/'.$type); 
        exit();
     }
     // insert password change history
    $data = array();
    $data['admin_id']       = $id ;
    $data['password']       = $change_password ;
    $data['reconver_code']  = $code ;
    $data['type']           = $type ;
    $data['status']         = 2 ;
    $data['created_time']   = $this->current_time ;
    $data['created_at']     = $this->rcdate ;
    DB::table('password_change_history')->insert($data);
    // change the password
    $data1 = array();
    $data1['password'] = $change_password ;
    $data1['recover_code'] = '' ;

    if($type == '1'){
    $query = DB::table('superadmin')->where('id',$id)->update($data1);
    }else{
      $query = DB::table('users')->where('id',$id)->update($data1);
    }
    if($query){
    Session::put('succes','Your Account Recovery Sucessfully. Now You can Login'); 
    return Redirect::to('admin/');
    }else{
        Session::put('failed','Sorry !Error Occured. Try Again');
        return Redirect::to('forgottenPasswordForm');
    }

     }

  #----------------------------------- END PASSWORD RECOVER-----------------------------#

  


}
