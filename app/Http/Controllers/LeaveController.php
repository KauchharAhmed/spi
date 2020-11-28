<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;


class LeaveController extends Controller
{
	   /**
     * LeaveController Class Constructor
     *
     * @return \Illuminate\Http\Response
     */
    private $rcdate ;
    public function __construct(){
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate = date('Y/m/d');
    }
  /*
  ** view leave  form
  */
  public function requestLeave()
  {
  return view('staff.requestLeave');	
  }
  /*
  ** sent leave request to principal
  */
  public function requestLeaveInfo(Request $request)
  {
  	 $this->validate($request, [
    'from'        		=> 'required',
    'to'  				=> 'required',
    'leve_type'     	=> 'required',
    'application_type'  => 'required',
    'editordata'        => 'required'
   ]);
  	 $teacher_id            = Session::get('teacher_id');
  	 $date_form 			      = trim($request->from); 
     $from          		    = date ("Y-m-d", strtotime($date_form));
     $date_to               = trim($request->to); 
     $to    				        = date ("Y-m-d", strtotime($date_to));
     $leve_type        		  = trim($request->leve_type);
     $application_type      = trim($request->application_type);
     $editordata           	= trim($request->editordata);

     // from date big than to date
     if($from > $to){
     	  Session::put('failed','Sorry ! From '.$from.' Date Will Not Big Than To '.$to.' Try To Again');
        return Redirect::to('requestLeave');
        exit();
     }
     //check duplicate from date
     $chek_from_date = DB::table('tbl_leave')
     ->where('request_from', $from)
     ->where('user_id', $teacher_id)
     ->count();
      if($chek_from_date > 0){
        Session::put('failed','Sorry ! This Day '.$from.' Leave Request Already Send');
        return Redirect::to('requestLeave');
        exit();
     }
    
    //check to date
      $chek_to_date = DB::table('tbl_leave')
     ->where('request_to', $to)
     ->where('user_id', $teacher_id)
     ->count();
      if($chek_to_date > 0){
        Session::put('failed','Sorry ! This Day '.$to.' Leave Request Already Send');
        return Redirect::to('requestLeave');
        exit();
     }
    
     // get day between tow days
$date1 = date_create($from);
$date2 = date_create($to);
//difference between two dates
$diff = date_diff($date1,$date2);
$day_count = $diff->format("%a")+1;

     $data=array();
     $data['user_id']        			= $teacher_id ;
     $data['application_person']   		= 'Self';
     $data['leave_type']                = $leve_type;
     $data['application_type']          = $application_type ;
     $data['request_from']        		= $from;
     $data['request_to']   				= $to;
     $data['application']               = $editordata ;
     $data['day']                       = $day_count;
     $data['created_at']                = $this->rcdate ;
     $query = DB::table('tbl_leave')->insert($data);
     if($query){
        Session::put('succes','Your Leave Application Sending Successfully. You Will Get Notify After The Decision Of Principal');
        return Redirect::to('requestLeave');
    }else{
        Session::put('failed','Sorry ! Problem Created. Try Again');
        return Redirect::to('requestLeave');
    }
    }
    /*
    ** leave request list
    */
    public function leaveRequestList()
    {  
    	$teacher_id            = Session::get('teacher_id');
    	$result = DB::table('tbl_leave')->orderBy('id','desc')->where('user_id',$teacher_id)->get();
    	return view('staff.leaveRequestList')->with('result',$result);
    }
    /*
    ** view teacher application
    */
    public function viewApplication($id)
    {
        $teacher_id            = Session::get('teacher_id');
    	$row = DB::table('tbl_leave')->where('id',$id)->where('user_id',$teacher_id)->first();
    	return view('staff.applicationView')->with('row',$row);
    }
    /*
    ** DELETE THE APPLICATION
    */
    public function deleteApplication($id)
    {
        $teacher_id            = Session::get('teacher_id');
    	$row = DB::table('tbl_leave')->where('id',$id)->where('user_id',$teacher_id)->delete();
    	Session::put('succes','Your Leave Application Remove Successfully');
    	return Redirect::to('leaveRequestList');
    } 

    #----------------------- CRAFT LEAVE REQUEST ---------------------------#
    /*
  	** view craft leave  form
  	*/
  	public function craftRequestLeave()
  	{
  		return view('staff.craftRequestLeave');	
  	}
  	 /*
  	** sent leave request to principal
  	*/
  	public function craftRequestLeaveInfo(Request $request)
    {
  	 $this->validate($request, [
    'from'        		=> 'required',
    'to'  				=> 'required',
    'leve_type'     	=> 'required',
    'application_type'  => 'required',
    'editordata'        => 'required'
   ]);
  	 $craft_id              = Session::get('craft_id');
  	 $date_form 			= trim($request->from); 
     $from          		= date ("Y-m-d", strtotime($date_form));
     $date_to               = trim($request->to); 
     $to    				= date ("Y-m-d", strtotime($date_to));
     $leve_type        		= trim($request->leve_type);
     $application_type      = trim($request->application_type);
     $editordata           	= trim($request->editordata);

     // from date big than to date
     if($from > $to){
     	  Session::put('failed','Sorry ! From '.$from.' Date Will Not Big Than To '.$to.' Try To Again');
        return Redirect::to('craftRequestLeave');
        exit();
     }
     //check duplicate from date
     $chek_from_date = DB::table('tbl_leave')
     ->where('request_from', $from)
     ->where('user_id', $craft_id)
     ->count();
      if($chek_from_date > 0){
        Session::put('failed','Sorry ! This Day '.$from.' Leave Request Already Send');
        return Redirect::to('craftRequestLeave');
        exit();
     }
    
    //check to date
      $chek_to_date = DB::table('tbl_leave')
     ->where('request_to', $to)
     ->where('user_id', $craft_id)
     ->count();
      if($chek_to_date > 0){
        Session::put('failed','Sorry ! This Day '.$to.' Leave Request Already Send');
        return Redirect::to('craftRequestLeave');
        exit();
     }
    
     // get day between tow days
$date1 = date_create($from);
$date2 = date_create($to);
//difference between two dates
$diff = date_diff($date1,$date2);
$day_count = $diff->format("%a")+1;

     $data=array();
     $data['user_id']        			= $craft_id ;
     $data['application_person']   		= 'Self';
     $data['leave_type']                = $leve_type;
     $data['application_type']          = $application_type ;
     $data['request_from']        		= $from;
     $data['request_to']   				= $to;
     $data['application']               = $editordata ;
     $data['day']                       = $day_count;
     $data['created_at']                = $this->rcdate ;
     $query = DB::table('tbl_leave')->insert($data);
     if($query){
        Session::put('succes','Your Leave Application Sending Successfully. You Will Get Notify After The Decision Of Principal');
        return Redirect::to('craftRequestLeave');
    }else{
        Session::put('failed','Sorry ! Problem Created. Try Again');
        return Redirect::to('craftRequestLeave');
    }
    }
  
  	/*
  	** view craft leave  list
  	*/
  	public function craftLeaveRequestList()
    {
    	$craft_id              = Session::get('craft_id');
    	$result = DB::table('tbl_leave')->orderBy('id','desc')->where('user_id',$craft_id)->get();
    	return view('staff.craftLeaveRequestList')->with('result',$result);
    }
    /*
  	** view craft full application
  	*/
    public function viewCraftApplication($id)
    {
    	$craft_id                = Session::get('craft_id');
    	$row = DB::table('tbl_leave')->where('id',$id)->where('user_id',$craft_id)->first();
    	return view('staff.craftApplicationView')->with('row',$row);

    }
    /*
  	** delte craft application
  	*/
   public function deleteCraftApplication($id)
   {
        $craft_id                = Session::get('craft_id');
    	$row = DB::table('tbl_leave')->where('id',$id)->where('user_id',$craft_id)->delete();
    	Session::put('succes','Your Leave Application Remove Successfully');
    	return Redirect::to('craftLeaveRequestList');
   }
   #--------------------- END LEAVE REQUEST -------------------------------#
   #--------------------- PRINCIPAL AREA ----------------------------------#
   /*
  	** view pending leave request for principal
  	*/
   public function pendingLeaveRequest()
   {
   	     $result = DB::table('tbl_leave')
        ->join('users', 'tbl_leave.user_id', '=', 'users.id')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('tbl_leave.*','users.name','users.degi','users.type','department.departmentName')
        ->orderBy('tbl_leave.id','desc')
        ->where('tbl_leave.status',0)
        ->get();
     	return view('staff.pendingLeaveRequest')->with('result',$result);
   }
   /*
  	** requested application view
  	*/
   public function requestedApplicationView($id)
   {
   	$row = DB::table('tbl_leave')->where('id',$id)->first();
    return view('staff.requestedApplicationView')->with('row',$row);
   }
   /*
  	** approved the application
  	*/
   public function approvedApplication($id)
   {
   	 // get this informatin
   	 $row  = DB::table('tbl_leave')->where('id', $id)->first();
   	 $data = array();
     $data['final_request_from'] 	= $row->request_from;
     $data['final_request_to'] 		= $row->request_to;
     $data['final_day'] 			= $row->day;
   	 $data['status'] 				= 1 ;
     $query = DB::table('tbl_leave')->where('id', $id)->update($data);
     if($query){
     Session::put('succes','Leave Request Approved Successfully');
     return Redirect::to('pendingLeaveRequest');	
     }else{
       Session::put('failed','Sorry ! Application Not Approved. Try Again');
       return Redirect::to('pendingLeaveRequest');
   }
  }
  /*
  **  not approved the application
  */
  public function notApprovedApplication($id)
  {
     $data = array();
   	 $data['status'] = 2 ;
     $query = DB::table('tbl_leave')->where('id', $id)->update($data);
     if($query){
     Session::put('succes','Leave Request Not Approved Successfully');
     return Redirect::to('pendingLeaveRequest');	
     }else{
       Session::put('failed','Sorry !  Try Again');
       return Redirect::to('pendingLeaveRequest');
   }
  }
  /*
  **  approved leave application
  */

  public function approvedLeaveList()
  {
  	    $result = DB::table('tbl_leave')
        ->join('users', 'tbl_leave.user_id', '=', 'users.id')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('tbl_leave.*','users.name','users.degi','users.type','department.departmentName')
        ->orderBy('tbl_leave.id','desc')
        ->where('tbl_leave.status',1)
        ->get();
     	return view('staff.approvedLeaveList')->with('result',$result);
  }
  /*
  **  reject application list
  */
  public function rejectApplicationList()
  {
      	 $result = DB::table('tbl_leave')
        ->join('users', 'tbl_leave.user_id', '=', 'users.id')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('tbl_leave.*','users.name','users.degi','users.type','department.departmentName')
        ->orderBy('tbl_leave.id','desc')
        ->where('tbl_leave.status',2)
        ->get();
     	return view('staff.rejectApplicationList')->with('result',$result);
  }
  /*
  **  Staff leave add by principal
  */
  public function addStaffLeave()
  {
      return view('staff.addStaffLeave');
  }
  /*
  **  add staff leave info
  */
  public function addStaffLeaveInfo(Request $request)
  {
    $this->validate($request, [
    'staff_id'        => 'required',
    'from'            => 'required',
    'leve_type'       => 'required',
    'application_type' => 'required',
   ]);
     $staff_id              = trim($request->staff_id);
     $date_form             = trim($request->from); 
     $from                  = date ("Y-m-d", strtotime($date_form));
     $leve_type             = trim($request->leve_type);
     $application_type      = trim($request->application_type);
     $editordata            = trim($request->editordata);
     // check this date is holiday
     $holiday_count = DB::table('holiday')->where('holiday_date',$from)->count();
     if($holiday_count > 0){
      Session::put('failed','Sorry ! '.$date_form.' Date Is Holiday');
      return Redirect::to('addStaffLeave');
      exit();
     }
     //check duplicate from date
     $chek_from_date = DB::table('tbl_leave')
     ->where('final_request_from', $from)
     ->where('user_id', $staff_id)
     ->count();
      if($chek_from_date > 0){
        Session::put('failed','Sorry ! This Day '.$from.'  Already Added For This Staff Leave');
        return Redirect::to('addStaffLeave');
        exit();
     }
     $data=array();
     $data['user_id']                 = $staff_id ;
     $data['application_person']      = 'Not Self';
     $data['leave_type']              = $leve_type;
     $data['application_type']        = $application_type ;
     $data['request_from']            = $from;
     $data['request_to']              = $from;
     $data['application']               = $editordata ;
     $data['day']                       = '1';
     $data['final_request_from']        = $from;
     $data['final_request_to']          = $from;
     $data['final_day']                 = '1';
     $data['status']                    = '1';
     $data['created_at']                = $this->rcdate ;
     $query = DB::table('tbl_leave')->insert($data);
     if($query){
        Session::put('succes','Staff Leave Added Successfully.');
        return Redirect::to('addStaffLeave');
      exit();
    }else{
        Session::put('failed','Sorry ! Problem Created. Try Again');
       return Redirect::to('addStaffLeave');
       exit();
    }

  }
  // manage staff leave
  public function manageStaffLeave()
  {
    $result = DB::table('tbl_leave')
        ->join('users', 'tbl_leave.user_id', '=', 'users.id')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('tbl_leave.*','users.name','users.degi','users.type','department.departmentName')
        ->orderBy('tbl_leave.id','desc')
        ->where('tbl_leave.status',1)
        ->where('tbl_leave.type_status',0)
        ->get();
    return view('staff.manageStaffLeave')->with('result',$result);
  }
  // delete staff leave
  public function deleteStaffLeave($id)
  {
    DB::table('tbl_leave')->where('id',$id)->delete();
    Session::put('succes','Staff Leave Deleted Successfully.');
    return Redirect::to('manageStaffLeave');
  }
 // add staff traning
  public function addStaffTraining()
  {
    return view('staff.addStaffTraining');
  }
// add staff traning info
  public function addStaffTraningInfo(Request $request)
  {
    $this->validate($request, [
    'staff_id'        => 'required',
    'from'            => 'required',
   ]);
     $staff_id              = trim($request->staff_id);
     $date_form             = trim($request->from); 
     $from                  = date ("Y-m-d", strtotime($date_form));
     $editordata            = trim($request->editordata);
     // check this date is holiday
     $holiday_count = DB::table('holiday')->where('holiday_date',$from)->count();
     if($holiday_count > 0){
      Session::put('failed','Sorry ! '.$date_form.' Date Is Holiday');
      return Redirect::to('addStaffTraining');
      exit();
     }
     //check duplicate from date
     $chek_from_date = DB::table('tbl_leave')
     ->where('final_request_from', $from)
     ->where('user_id', $staff_id)
     ->where('type_status',0)
     ->count();
      if($chek_from_date > 0){
        Session::put('failed','Sorry ! This Day '.$from.'  Already Added For This Staff Leave');
        return Redirect::to('addStaffTraining');
        exit();
     }
     // check duplicate from date
     $check_duplicate_from = DB::table('tbl_leave')
     ->where('final_request_from', $from)
     ->where('user_id', $staff_id)
     ->where('type_status',1)
     ->count();
      if($check_duplicate_from > 0){
        Session::put('failed','Sorry ! This Day '.$from.'  Already Added For This Staff Traning');
        return Redirect::to('addStaffTraining');
        exit();
     }
     $data=array();
     $data['user_id']                 = $staff_id ;
     $data['application_person']      = 'Not Self';
     $data['request_from']            = $from;
     $data['request_to']              = $from;
     $data['application']               = $editordata ;
     $data['day']                       = '1';
     $data['final_request_from']        = $from;
     $data['final_request_to']          = $from;
     $data['final_day']                 = '1';
     $data['status']                    = '1';
     $data['type_status']               = '1';
     $data['created_at']                = $this->rcdate ;
     $query = DB::table('tbl_leave')->insert($data);
     if($query){
        Session::put('succes','Staff Traning Added Successfully.');
        return Redirect::to('addStaffTraining');
      exit();
    }else{
        Session::put('failed','Sorry ! Problem Created. Try Again');
       return Redirect::to('addStaffTraining');
       exit();
    }
  }
  // manage staff traning
  public function manageStaffTraining()
  {
        $result = DB::table('tbl_leave')
        ->join('users', 'tbl_leave.user_id', '=', 'users.id')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('tbl_leave.*','users.name','users.degi','users.type','department.departmentName')
        ->orderBy('tbl_leave.id','desc')
        ->where('tbl_leave.status',1)
        ->where('tbl_leave.type_status',1)
        ->get();
    return view('staff.manageStaffTraining')->with('result',$result);
  }
  // delete staff traning
  public function deleteStaffTraning($id)
  {
    DB::table('tbl_leave')->where('id',$id)->delete();
    Session::put('succes','Staff Traning Deleted Successfully.');
    return Redirect::to('manageStaffTraining');
  }
  

 }
