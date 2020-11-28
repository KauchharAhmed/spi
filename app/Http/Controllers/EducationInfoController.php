<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class EducationInfoController extends Controller
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
#------------------------- START DEPARTMENT -------------------------------#
    /**
     * Display all department list.
     *
     * @return \Illuminate\Http\Response
     */
    public function depertemntList()
    {
     $result = DB::table('department')->get();
       return view('educationInfo.depertemntList')->with('result',$result);
    }
    /**
     * Display department form to add new department.
     *
     * @return \Illuminate\Http\Response
     */
    public function addDepartmentForm()
    {
        return view('educationInfo.addDepartmentForm');
    }
    /**
     * Store a newly created department.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addDepartmentInfo(Request $request)
    {
    $this->validate($request, [
    'dep_name'        => 'required',
    'dep_short_name'  => 'required',
    'dep_status'      => 'required'
    ]);
     $dep_name          = trim($request->dep_name);
     $dep_short_name    = trim($request->dep_short_name);
     $dep_status        = trim($request->dep_status);
     $remarks           = trim($request->remarks);
     //check duplicatet full depatemtn
     $long_dep_name = DB::table('department')
     ->where('departmentName', $dep_name)
     ->count();
      if($long_dep_name > 0){
        Session::put('failed','Sorry ! '.$dep_name.' Department Already Exits. Try To Add New Department');
        return Redirect::to('addDepartmentForm');
        exit();
      }
    //check duplicatet short depatemtn
     $short_dep_name = DB::table('department')
     ->where('departmentShortName', $dep_short_name)
     ->count();
      if($short_dep_name > 0){
        Session::put('failed','Sorry ! '.$dep_short_name.' Department Already Exits. Try To Add New Department');
        return Redirect::to('addDepartmentForm');
        exit();
      }
     /*
     * status 1 = technical deperatment 
     * status 2 = non-technical department
     */
     $data=array();
     $data['departmentName']        = $dep_name;
     $data['departmentShortName']   = $dep_short_name;
     $data['status']                = $dep_status;
     $data['remarks']               = $remarks;
     $data['created_at']            = $this->rcdate ;
     $query = DB::table('department')->insert($data);
     if($query){
        Session::put('succes','Department Added Sucessfully');
        return Redirect::to('depertemntList');
    }else{
        Session::put('failed','Sorry ! Error Occued. Try Again');
        return Redirect::to('depertemntList');
    }
    }
 #------------------------- START SHIFT--------------------------- #
    /**
     * Display all shift list.
     *
     * @return \Illuminate\Http\Response
     */
    public function shiftList()
    {
       $result = DB::table('shift')->get();
       return view('educationInfo.shiftList')->with('result',$result);
    }
    /**
     * Display shift form to add new shift.
     *
     * @return \Illuminate\Http\Response
     */
    public function addShiftForm()
    {
       return view('educationInfo.addShiftForm');
    }
   /**
     * Store a newly created shift info.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addShiftInfo(Request $request)
    {
    $this->validate($request, [
    'shift_name'        => 'required',
    ]);
     $shift_name        = trim($request->shift_name);
     $remarks           = trim($request->remarks);
     //check duplicatet full depatemtn
     $check_shift_name = DB::table('shift')
     ->where('shiftName', $shift_name)
     ->count();
      if($check_shift_name > 0){
        Session::put('failed','Sorry ! '.$shift_name.' Already Exits. Try To Add New Shift');
        return Redirect::to('addShiftForm');
        exit();
      }
     $data=array();
     $data['shiftName']        = $shift_name;
     $data['remarks']          = $remarks;
     $data['created_at']       = $this->rcdate ;
     $query = DB::table('shift')->insert($data);
     if($query){
        Session::put('succes','Shift Added Sucessfully');
        return Redirect::to('shiftList');
    }else{
        Session::put('failed','Sorry ! Error Occued. Try Again');
        return Redirect::to('shiftList');
    }
    }
#------------------------------- START SEMEISTER--------------------------#
    /**
     * semisterList.
     *
     * @return \Illuminate\Http\Response
     */
    public function semisterList()
    {
       $result = DB::table('semister')->get();
       return view('educationInfo.semisterList')->with('result',$result);
    } 
    /**
     * Display semister form to add new semister.
     *
     * @return \Illuminate\Http\Response
     */
    public function addSemisterForm()
    {
       return view('educationInfo.addSemisterForm');
    }
   /**
     * Store a newly created semister info.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */    
    public function addSemisterInfo(Request $request)
    {
    $this->validate($request, [
    'semister_name'         => 'required',
    'order'                 => 'required',
    'status'                => 'required'
     ]);
     $semister_name     = trim($request->semister_name);
     $order             = trim($request->order);
     $status            = trim($request->status);
     $remarks           = trim($request->remarks);
     //check duplicatet semester name
     $check_semister_name = DB::table('semister')
     ->where('semisterName', $semister_name)
     ->count();
      if($check_semister_name > 0){
        Session::put('failed','Sorry ! '.$semister_name.' Already Exits. Try To Add New Semister');
        return Redirect::to('addSemisterForm');
        exit();
      }
      // check duplicate order
     $check_order = DB::table('semister')
     ->where('order', $order)
     ->count();
      if($check_order > 0){
        Session::put('failed','Sorry ! '.$order.' Order Already Exits. Try To Add Semister With New Order Number');
        return Redirect::to('addSemisterForm');
        exit();
      }
      // status 1 = current
      // status 2 = non-current
     $data=array();
     $data['semisterName'] = $semister_name;
     $data['order']        = $order;
     $data['status']       = $status;
     $data['remarks']      = $remarks;
     $data['created_at']   = $this->rcdate ;
     $query = DB::table('semister')->insert($data);
     if($query){
        Session::put('succes','Semister Added Sucessfully');
        return Redirect::to('semisterList');
    }else{
        Session::put('failed','Sorry ! Error Occued. Try Again');
        return Redirect::to('semisterList');
    }
    }
    #----------------------- END SEMISTER----------------------------#
    #-------------------START ACADEMIC SESSION ----------------------#
    /**
     * Session List.
     *
     * @return \Illuminate\Http\Response
     */
    public function sessionList()
    {
        $result = DB::table('session')->get();
        return view('educationInfo.sessionList')->with('result',$result);
    }
     /**
     * Display session form to add new session.
     *
     * @return \Illuminate\Http\Response
     */
   public function addSessionForm()
   {
     return view('educationInfo.addSessionForm') ;
   } 
    /**
     * Store a newly created sessison info.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
     public function addSessionInfo(Request $request)
     {
        $this->validate($request, [
       'session'        => 'required',
    ]);
     $session        = trim($request->session);
     $remarks        = trim($request->remarks);
     //check duplicatet session
     $check_session_name = DB::table('session')
     ->where('sessionName', $session)
     ->count();
      if($check_session_name > 0){
        Session::put('failed','Sorry ! '.$session.' Already Exits. Try To Add New Session');
        return Redirect::to('addSessionForm');
        exit();
      }
     $data=array();
     $data['sessionName']      = $session;
     $data['remarks']          = $remarks;
     $data['created_at']       = $this->rcdate ;
     $query = DB::table('session')->insert($data);
     if($query){
        Session::put('succes','Session Added Sucessfully');
        return Redirect::to('sessionList');
    }else{
        Session::put('failed','Sorry ! Error Occued. Try Again');
        return Redirect::to('sessionList');
    }
     }  

    #-------------------END ACADEMIC SESSION ------------------------#
    #--------------------------START SECTION ------------------------#
     public function sectionList()
     {
        $result = DB::table('section')->join('department', 'section.dept_id', '=', 'department.id')->get();
        return view('educationInfo.sectionList')->with('result',$result);
     }
    public function addSectionForm()
    {
       $result = DB::table('department')->where('status',1)->get();
       return view('educationInfo.addSectionForm')->with('result',$result);
    }
    // add sectin info
    public function addSectionInfo(Request $request)
    {
        $this->validate($request, [
       'section'        => 'required',
       'department'     => 'required'
    ]);
     $section        = trim($request->section);
     $department     = trim($request->department);
     $remarks        = trim($request->remarks);
     //check duplicatet section
     $check_section_name = DB::table('section')
     ->where('section_name', $section)
     ->where('dept_id', $department)
     ->count();
      if($check_section_name > 0){
        Session::put('failed','Sorry ! '.$section.' Already Exits In This Department. Try To Add New Section');
        return Redirect::to('addSectionForm');
        exit();
      }
     $data=array();
     $data['section_name']     = $section;
     $data['dept_id']          = $department;
     $data['remarks']          = $remarks;
     $data['created_at']       = $this->rcdate ;
     $query = DB::table('section')->insert($data);
     if($query){
        Session::put('succes','Session Added Sucessfully');
        return Redirect::to('sectionList');
    }else{
        Session::put('failed','Sorry ! Error Occued. Try Again');
        return Redirect::to('sectionList');
    }
    }

    // get sectin name by ajax request by department 
    public function getSectionByDepartment(Request $request)
    {
       $dept = trim($request->dept);
       $result = DB::table('section')->where('dept_id',$dept)->get();
       echo '<option value="">Select Section</option>';
       foreach ($result as $value) {
         echo '<option value='.$value->id.'>'.$value->section_name.'</option>';
     }
   }

public function getSectionByDepartmentForSuperadmin(Request $request)
    {
       $dept = trim($request->dept);
       $result = DB::table('section')->where('dept_id',$dept)->get();
       echo '<option value="">All</option>';
       foreach ($result as $value) {
         echo '<option value='.$value->id.'>'.$value->section_name.'</option>';
     }
   }
// office start time
public function officeStartTime()
{
    $result = DB::table('shift')->get();
    return view('educationInfo.officeStartTime')->with('result',$result);
}
// edit current office time 
public function editStartOfficeTime($id)
{
    $result = DB::table('shift')->where('id',$id)->first();
    return view('educationInfo.editStartOfficeTime')->with('result',$result);
}
// edit office time of staff
public function editOfficeTimeStart(Request $request)
{
    $this->validate($request, [
       'change_office_time'        => 'required',
       'shift_id'                  => 'required'
    ]);
     $change_office_time        = trim($request->change_office_time);
     $shift_id                  = trim($request->shift_id);
     $twent_fours__time         = date("H:i", strtotime($change_office_time));
     $office_change_time        = $twent_fours__time.':00'; 
     $data = array();
     $data['office_start'] = $office_change_time ;
     DB::table('shift')->where('id',$shift_id)->update($data); 
     Session::put('succes','Office Time Change Sucessfully');
     return Redirect::to('officeStartTime');
}
// probidhan
// probidhan list
public function probidhanList()
{
  $result = DB::table('tbl_probidhan')->get();
  return view('educationInfo.probidhanList')->with('result',$result);
}
// add new probidhan form
public function addNewProbidhanForm()
{
  // get all semester list
  $semister = DB::table('semister')->get();
  return view('educationInfo.addNewProbidhanForm')->with('semister',$semister);
}
// add new probidhan info
public function addNewProbidhanInfo(Request $request)
{
    $this->validate($request, [
       'probidhan_name'                    => 'required',
       'probidhan_pass_fail_status'        => 'required',
       'mid_tearm_marks_percentage'        => 'required',
       'pass_marks_percentage'             => 'required',
       'dropout_subject'                   => 'required',
    ]);
     $probidhan_name               = trim($request->probidhan_name);
     $probidhan_pass_fail_status   = trim($request->probidhan_pass_fail_status);
     $mid_tearm_marks_percentage   = trim($request->mid_tearm_marks_percentage);
     $pass_marks_percentage        = trim($request->pass_marks_percentage);
     $dropout_subject              = trim($request->dropout_subject);
     $active_semister              = $request->active_semister ;
     $remarks                      = trim($request->remarks);
     $count_active_semester        = count($active_semister);
    if($count_active_semester  == '0'){
        Session::put('failed','Sorry ! Please Check Atleast One Semester');
        return Redirect::to('addNewProbidhanForm');
        exit(); 
     }

    if($pass_marks_percentage  > 100){
        Session::put('failed','Sorry ! Pass Marks Percentage Can Not Be Greater Than Hundred');
        return Redirect::to('addNewProbidhanForm');
        exit(); 
     }
     //check duplicatet session
     $check = DB::table('tbl_probidhan')
     ->where('probidhan_name', $probidhan_name)
     ->count();
      if($check > 0){
        Session::put('failed','Sorry ! '.$probidhan_name.' Already Exits. Try To Add New Probidhan');
        return Redirect::to('addNewProbidhanForm');
        exit();
      }
     $data = array();
     $data['probidhan_name']                = $probidhan_name ;
     $data['pass_fail_status']              = $probidhan_pass_fail_status ;
     $data['mid_tearm_percentage']          = $mid_tearm_marks_percentage ;
     $data['pass_marks_percentage']         = $pass_marks_percentage ;
     $data['dropout_subject']               = $dropout_subject ;
     $data['remarks']                       = $remarks ;
     $data['created_at']                    = $this->rcdate ;
    DB::table('tbl_probidhan')->insert($data);
    // get last probidhan id
    $last_probidhan     = DB::table('tbl_probidhan')->orderBy('id','desc')->first();
    $last_probidhan_id  = $last_probidhan->id ;
    $data1 = array();
    foreach ($active_semister as $active_value) {
        $data1['probidhan_id']  = $last_probidhan_id ;
        $data1['semister_id']   = $active_value;
        $data1['created_at']    = $this->rcdate;
        DB::table('tbl_probidhan_semister')->insert($data1);
     } 
    Session::put('succes','Probidhan Added Sucessfully');
    return Redirect::to('probidhanList');

}
// assion probidhan list
public function assionProbidhanList()
{
    // join query
    $result =  DB::table('tbl_year_assign_probidhan')
        ->join('tbl_probidhan', 'tbl_year_assign_probidhan.probidhan_id', '=', 'tbl_probidhan.id')
        ->select('tbl_year_assign_probidhan.*','tbl_probidhan.probidhan_name')
        ->get();
    return view('educationInfo.assionProbidhanList')->with('result',$result);
}
// probidhan assion
public function addNewProbidhanAssionForm()
{
    $semister  = DB::table('semister')->where('order',1)->first();
    $probidhan = DB::table('tbl_probidhan')->get();
    return view('educationInfo.addNewProbidhanAssionForm')->with('semister',$semister)->with('probidhan',$probidhan);
}
// add assign year probidhan info
public function addAssignYearProbidhanInfo(Request $request)
{
    $this->validate($request, [
       'year'             => 'required',
       'probidhan'        => 'required',
       'probidhan_status' => 'required',
    ]);
     $year              = trim($request->year);
     $probidhan         = trim($request->probidhan);
     $probidhan_status  = trim($request->probidhan_status);
     $remarks           = trim($request->remarks);
     // validation 
     // check duplicate by probidhan status
     $check_1 = DB::table('tbl_year_assign_probidhan')->where('year',$year)->where('semister_status',$probidhan_status)->where('probidhan_id',$probidhan)->count();
     if($check_1 > 0){
        Session::put('failed','Sorry ! Already Assign Probidhan Of This '.$year.' Year . Try Again By New Year');
        return Redirect::to('assionProbidhanList');
        exit();
     }
    // probidhan stauts > 0 // then check 5 years perion
     if($probidhan_status > '0'){
      // ceheck last semeste probidhan status
    $count = DB::table('tbl_year_assign_probidhan')->where('semister_status',$probidhan_status)->where('probidhan_id',$probidhan)->orderBy('year','desc')->count();
    if($count > 0){
    $previus_probidhan = DB::table('tbl_year_assign_probidhan')->where('semister_status',$probidhan_status)->where('probidhan_id',$probidhan)->orderBy('year','desc')->first();
    $previous_probidhan_year = $previus_probidhan->year ;
    $years_different = $year - $previous_probidhan_year ;
    if($years_different < 5){
        Session::put('failed','Sorry ! You Can Assign Probidhan In Year After 5 Years');
        return Redirect::to('assionProbidhanList');
        exit();
    }
    }
    }
    // insert data into probidhan
    $data                       = array();
    $data['year']               = $year ;
    $data['probidhan_id']       = $probidhan ;
    $data['semister_status']    = $probidhan_status ;
    $data['remarks']            = $remarks ;
    $data['created_at']         = $this->rcdate ;
    DB::table('tbl_year_assign_probidhan')->insert($data);
    Session::put('succes','Assign Probidhan In Year Added Sucessfully');
    return Redirect::to('assionProbidhanList');
}
#----------------------------END ACADEMIC SECTION --------------------------------------#
}
