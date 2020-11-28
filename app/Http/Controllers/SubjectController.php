<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class SubjectController extends Controller
{
    /**
     * SubjectController Class Constructor
     *
     * @return \Illuminate\Http\Response
     */
    private $rcdate ;
    public function __construct(){
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate = date('Y/m/d');
    }
    /**
     * Display all subject list by depatment.
     *
     * @return \Illuminate\Http\Response
     */
    public function subjectList()
    {
        $dept_id      = Session::get('dept_id');
        $result = DB::table('subject')
        ->join('semister', 'subject.semister_id', '=', 'semister.id')
        ->select('subject.*', 'semister.semisterName')
        ->where('subject.dept_id', $dept_id)
        ->get();
       return view('educationInfo.subjectList')->with('result',$result);
    }
    /**
     * Display add subject form to add new subject.
     *
     * @return \Illuminate\Http\Response
     */
    public function addSubjectForm()
    {
        $dept_id      = Session::get('dept_id');
        // get department info
        $row = DB::table('department')->where('id', $dept_id)->first();
        // get semister
        $result = DB::table('semister')->where('status',1)->get();
        return view('educationInfo.addSubjectForm')->with('row', $row)->with('result', $result);
    }
      /**
     * Store a newly created subject.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addSubjectInfo(Request $request)
    {
    $this->validate($request, [
    'dept_id'           => 'required',
    'semister_id'       => 'required',
    'subject_name'      => 'required', 
    'subject_code'      => 'required',
    'cradit'            => 'required',
    'subject_type'      => 'required',
    'subject_status'    => 'required',
    'cont_theroy_marks' => 'required',
    'theroy_marks'      => 'required',
    'practical_marks'   => 'required',
    'cont_practical_marks'   => 'required'
 ]);
     $dep_head_id               = Session::get('department_head_id');
     $dept_id                   = trim($request->dept_id);
     $semister_id               = trim($request->semister_id);
     $subject_name              = trim($request->subject_name);
     $subject_code              = trim($request->subject_code);
     $cradit                    = trim($request->cradit);
     $subject_type              = trim($request->subject_type);
     $subject_status            = trim($request->subject_status);
     $theroy_marks              = trim($request->theroy_marks);
     $cont_theroy_marks         = trim($request->cont_theroy_marks);
     $practical_marks           = trim($request->practical_marks);
     $cont_practical_marks      = trim($request->cont_practical_marks);
     $remarks                   = trim($request->remarks);
     $total_marks               = $theroy_marks + $cont_theroy_marks + $practical_marks + $cont_practical_marks ;
     //check duplicatet subject name
     $chekc_sub_name = DB::table('subject')
     ->where('subject_name', $subject_name)
     ->where('dept_id',$dept_id)
     ->count();
      if($chekc_sub_name > 0){
        Session::put('failed','Sorry ! '.$subject_name.' Already Exits. Try To Add New Subject');
        return Redirect::to('addSubjectForm');
        exit();
      }
    //check duplicatet subject code of this department
     $chekc_sub_code = DB::table('subject')
     ->where('subject_code', $subject_code)
     ->where('dept_id', $dept_id)
     ->count();
      if($chekc_sub_code > 0){
        Session::put('failed','Sorry ! This Code '.$subject_code.' Already Exits. Try To Add New Subject With Different Subject Code');
        return Redirect::to('addSubjectForm');
        exit();
      }
     /*
     * subjet type 1 = therotical subject 
     * subjet type 2 = practical subject
     * subjet type 3 = Therotical and practical subject
     */
     $data=array();
     $data['added_id']                  = $dep_head_id;
     $data['dept_id']                   = $dept_id;
     $data['semister_id']               = $semister_id;
     $data['subject_name']              = $subject_name;
     $data['subject_code']              = $subject_code;
     $data['cradit']                    = $cradit;
     $data['subject_type']              = $subject_type;
     $data['theroy_marks']              = $theroy_marks;
     $data['continous_theory_marks']    = $cont_theroy_marks; 
     $data['practical_marks']           = $practical_marks;
     $data['continous_practical_marks'] = $cont_practical_marks;
     $data['total_marks']               = $total_marks ;
     $data['subject_status']            = $subject_status ;
     $data['remarks']                   = $remarks;
     $data['created_at']                = $this->rcdate ;
     $query = DB::table('subject')->insert($data);
     if($query){
        // get last subject id
        $get_last_subject_id = DB::table('subject')->orderBy('id','desc')->limit(1)->first();
        $last_subject_id = $get_last_subject_id->id ;
        /*
        **
        1 = contiious theory marks
        2 = final theroy marks
        3 = contious practical marks
        4 = final practical marks
        */
        $data1['subject_id'] = $last_subject_id ;
        $data1['type']       = 1 ;
        $data1['type_name']  = "Contious Theory Marks"; 
        $data1['marks']      = $cont_theroy_marks ;
        $query1 = DB::table('subject_marks_type')->insert($data1);

        $data2['subject_id'] = $last_subject_id ;
        $data2['type']       = 2 ;
        $data2['type_name']  = "Final Theory Marks"; 
        $data2['marks']      = $theroy_marks ;
        $query2 = DB::table('subject_marks_type')->insert($data2);

        $data3['subject_id'] = $last_subject_id ;
        $data3['type']       = 3 ;
        $data3['type_name']  = "Contious Practical Marks"; 
        $data3['marks']      = $cont_practical_marks ;
        $query3 = DB::table('subject_marks_type')->insert($data3);

        $data4['subject_id'] = $last_subject_id ;
        $data4['type']       = 4 ;
        $data4['type_name']  = "Final Practical Marks"; 
        $data4['marks']      =  $practical_marks ;
        $query3 = DB::table('subject_marks_type')->insert($data4);
        Session::put('succes',$subject_name.' Subject Added Sucessfully');
        return Redirect::to('subjectList');
    }else{
        Session::put('failed','Sorry ! Error Occued. Try Again');
        return Redirect::to('subjectList');
    }// query barackets
    }


     
}