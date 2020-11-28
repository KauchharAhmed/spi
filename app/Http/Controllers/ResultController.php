<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class ResultController extends Controller
{
     /**
     * Result controller Class Constructor
     *
     * @return \Illuminate\Http\Response
     */
    private $rcdate ;
    private $teacher_id ;
    private $type ;
    private $current_time ;
    public function __construct(){
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate             = date('Y/m/d');
        $this->teacher_id    	    = Session::get('teacher_id');
        $this->type               = Session::get('type');
        $this->current_time       = date('H:i:s');
    }
    // tearche search his routine to add marks
    public function teacherSearchToAddResult()
    {
      $year           = DB::table('student')->distinct()->get(array('year'));
      $shift          = DB::table('shift')->get();
      $dept           = DB::table('department')->where('status',1)->get();
      $semister       = DB::table('semister')->where('status',1)->get();
      return view('result.teacherSearchToAddResult')
      ->with('year',$year)
      ->with('shift',$shift)
      ->with('dept',$dept)
      ->with('semister',$semister);
    }
    // get teacher class wise routine 
    public function getTeacherRoutineWiseSubjectToAddMarks(Request $request)
    {
        $year 		= trim($request->year);
        $shift 		= trim($request->shift);
        $dept  		= trim($request->dept);
        $semister 	= trim($request->semister);
        $section 	= trim($request->section);
        // check year assian probidhan by year and semester
        $count_probidhan_year = DB::table('tbl_year_assign_probidhan')->where('year',$year)->where('semister_status',$semister)->count();
        if($count_probidhan_year == '0'){
        $count_probidhan = DB::table('tbl_year_assign_probidhan')->where('year',$year)->count();
        if($count_probidhan == '0'){
            echo "f2";
            exit();
        }
        }
        $count 		= DB::table('routine')->where('year',$year)->where('shift_id',$shift)->where('dept_id',$dept)->where('semister_id',$semister)->where('section_id',$section)->where('teacher_id',$this->teacher_id)->count();
        if($count =='0'){
        	echo "f1";
        	exit();
        }
        // get probidhan id
          $_probidhan_year_count = DB::table('tbl_year_assign_probidhan')->where('year',$year)->where('semister_status',$semister)->count();
          if($_probidhan_year_count > 0){
            $_probidhan_year_info = DB::table('tbl_year_assign_probidhan')->where('year',$year)->where('semister_status',$semister)->first();
          }else{
            $_probidhan_year_info = DB::table('tbl_year_assign_probidhan')->where('year',$year)->first();
          }
          $probidhan_id      = $_probidhan_year_info->probidhan_id ;
          $porbidhan_details = DB::table('tbl_probidhan')->where('id',$probidhan_id)->first(); 

         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();
         $result 		= DB::table('routine')->where('year',$year)->where('shift_id',$shift)->where('dept_id',$dept)->where('semister_id',$semister)->where('section_id',$section)->where('teacher_id',$this->teacher_id)->groupBy('subject_id')->get();
         return view('result.getTeacherRoutineWiseSubjectToAddMarks')->with('result',$result)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('probidhan_id',$probidhan_id)->with('porbidhan_details',$porbidhan_details)->with('shift',$shift)->with('dept',$dept)->with('semister',$semister)->with('section',$section);
    }
    // teacher marks add form
    public function teacherAddMarks($probidhan_id , $year , $shift , $dept , $semister , $section , $subject_id , $marks_type , $total_marks)
    {
        // get total students of this semester
         $result = DB::table('student')
        ->join('students', 'student.studentID', '=', 'students.id')
        ->join('shift', 'student.shift_id', '=', 'shift.id')
        ->join('department', 'student.dept_id', '=', 'department.id')
        ->join('semister', 'student.semister_id', '=', 'semister.id')
        ->join('session', 'student.session', '=', 'session.id')
        ->join('section', 'student.section_id', '=', 'section.id')
        ->select('students.*','student.studentID','student.session','student.semister_status','student.year','student.roll','student.registration','shift.shiftName','department.departmentName','semister.semisterName','session.sessionName','section.section_name')
        ->orderBy('student.roll','asc')
        ->where('student.year', $year)
        ->where('student.shift_id', $shift)
        ->where('student.dept_id', $dept)
        ->where('student.semister_id', $semister)
        ->where('student.section_id', $section)
        ->where('student.status', 0)
        ->limit(6)
        ->get();

         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();
         $porbidhan_details = DB::table('tbl_probidhan')->where('id',$probidhan_id)->first();
         // subject name info
         $subject_info = DB::table('subject')->where('id',$subject_id)->first();
        return view('result.teacherAddMarks')->with('result',$result)->with('year',$year)->with('shift_name',$shift_name)->with('dept_name',$dept_name)->with('semister_name',$semister_name)->with('section_name',$section_name)->with('probidhan_id',$probidhan_id)->with('porbidhan_details',$porbidhan_details)->with('shift',$shift)->with('dept',$dept)->with('semister',$semister)->with('section',$section)->with('subject_info',$subject_info)->with('subject_id',$subject_id)->with('marks_type',$marks_type)->with('total_marks',$total_marks);
    }
    // add teacher marks info
    public function addTeacherMarkInfoInsert(Request $request)
    {
        $probidhan_id       = trim($request->probidhan_id);
        $year               = trim($request->year);
        $shift              = trim($request->shift);
        $dept               = trim($request->dept);
        $semister           = trim($request->semister);
        $section            = trim($request->section);
        $subject_id         = trim($request->subject_id);
        $marks_type         = trim($request->marks_type);
        $total_marks        = trim($request->total_marks);

        $roll                  = $request->roll;
        $studentId_is          = $request->studentId;
        $gain_marks_is         = $request->gain_marks;
        
        #---------------------- check already exits---------------------------------#
        $check_exits_marks_count = DB::table('tbl_result_check_marks_type')->where('probidhan_id',$probidhan_id)->where('year',$year)->where('shift_id',$shift)->where('dept_id',$dept)->where('semister_id',$semister)->where('section_id',$section)->where('subject_id',$subject_id)->where('marks_type',$marks_type)->count();
        if($check_exits_marks_count > 0){
          // already added marks
        Session::put('failed','Sorry ! Already Marks Is Added.');
        return Redirect::to('teacherSearchToAddResult');
        exit();
        }
       #---------------------- end check aleady exits--------------------------------------#
       #--------------------- get subject info---------------------------------------------#
       $subject_info_query        = DB::table('subject')->where('id',$subject_id)->first();
       $_subject_total_marks_is_  = $subject_info_query->total_marks ;
       $_total_theory_marks_is_   = $subject_info_query->theroy_marks + $subject_info_query->continous_theory_marks ;

       $_total_practical_marks_is_ = $subject_info_query->practical_marks + $subject_info_query->continous_practical_marks ;

       #-------------------- end get subject info------------------------------------------#
       #---------------------- insert data into tbl_result_check_marks_type----------------#
        $data_tbl_result_check_marks_type_insert                  = array();
        $data_tbl_result_check_marks_type_insert['probidhan_id']  = $probidhan_id ;
        $data_tbl_result_check_marks_type_insert['year']          = $year ;
        $data_tbl_result_check_marks_type_insert['shift_id']      = $shift ;
        $data_tbl_result_check_marks_type_insert['dept_id']       = $dept ;
        $data_tbl_result_check_marks_type_insert['semister_id']   = $semister ;
        $data_tbl_result_check_marks_type_insert['section_id']    = $section ;
        $data_tbl_result_check_marks_type_insert['subject_id']    = $subject_id ;
        $data_tbl_result_check_marks_type_insert['marks_type']    = $marks_type ;
        $data_tbl_result_check_marks_type_insert['added_id']      = $this->teacher_id ;
        $data_tbl_result_check_marks_type_insert['added_id_type'] = $this->type ;
        $data_tbl_result_check_marks_type_insert['created_time']  = $this->current_time ;
        $data_tbl_result_check_marks_type_insert['created_at']    = $this->rcdate ;
        DB::table('tbl_result_check_marks_type')->insert($data_tbl_result_check_marks_type_insert);
       #---------------------- end insert data into tbl_result_check_marks_type-------------#
        // have 3 type marks entry systerm (get type by probidhan id)
        $pass_fail_status_query           = DB::table('tbl_probidhan')->where('id',$probidhan_id)->first();
        $pass_fail_status                 = $pass_fail_status_query->pass_fail_status ;
        $probidhan_pass_marks_percentage  = $pass_fail_status_query->pass_marks_percentage ; 

        if($pass_fail_status=='1'){
        #-------------- ### START PASS FAIL CAITERIA TYPE 1 ### -------------------#



        #-------------- ### END PASS FAIL CAITERIA TYPE 1 ### ---------------------#

        }elseif($pass_fail_status=='2'){
        #-------------- ### START PASS FAIL CAITERIA TYPE 2 ### -------------------#
        // pass fail structure (TC + TF) , (PC + PF)
        if($marks_type == '0'){
          $table_column = 'mid_term';
          $total_table_column = "total_theroy";
          $total_theory_or_practical_percentatage  = "total_theory_mark_percentage";
          $subject_total_theory_or_practical_marks = $_total_theory_marks_is_ ;
          $theory_or_practicla_pass_fail_status    = "theory_pass_fail_status";
        }elseif($marks_type == '1'){
          $table_column = 'contnious_theroy';
          $total_table_column = "total_theroy";
          $total_theory_or_practical_percentatage = "total_theory_mark_percentage";
          $subject_total_theory_or_practical_marks = $_total_theory_marks_is_ ;
          $theory_or_practicla_pass_fail_status    = "theory_pass_fail_status";
        }elseif($marks_type == '2'){
          $table_column = 'final_theory';
          $total_table_column = "total_theroy";
          $total_theory_or_practical_percentatage = "total_theory_mark_percentage";
          $subject_total_theory_or_practical_marks = $_total_theory_marks_is_ ;
           $theory_or_practicla_pass_fail_status    = "theory_pass_fail_status";
        }elseif($marks_type == '3'){
          $table_column = 'continious_practical';
          $total_table_column = "total_practical";
          $total_theory_or_practical_percentatage = "total_practical_mark_percentage";
          $subject_total_theory_or_practical_marks = $_total_practical_marks_is_ ;
          $theory_or_practicla_pass_fail_status    = "practical_pass_fail_status";
        }elseif($marks_type == '4'){
          $table_column = 'final_practical';
          $total_table_column = "total_practical";
          $total_theory_or_practical_percentatage  = "total_practical_mark_percentage";
          $subject_total_theory_or_practical_marks = $_total_practical_marks_is_ ;
          $theory_or_practicla_pass_fail_status    = "practical_pass_fail_status";
        }

          foreach ($roll as $key => $studentRoll) {
              $student_id = $studentId_is[$key];
              $gain_marks = $gain_marks_is[$key];
          // check table tbl_result_marks table
        $check_tbl_result_marks_table_count = DB::table('tbl_result_marks')->where('probidhan_id',$probidhan_id)->where('year',$year)->where('shift_id',$shift)->where('dept_id',$dept)->where('semister_id',$semister)->where('section_id',$section)->where('subject_id',$subject_id)->where('roll',$studentRoll)->count();
        $_calculation_theory_or_practical_percentage_marks_gain  = ($gain_marks * 100) / $subject_total_theory_or_practical_marks ;
        // total marks percentage calculation
        $_calculation_total_percentate_marks_gain                = ($gain_marks * 100) / $_subject_total_marks_is_ ;

        if($check_tbl_result_marks_table_count == '0'){
        // insert query
        $data_tbl_result_marks_insert                  = array();
        $data_tbl_result_marks_insert['probidhan_id']  = $probidhan_id ;
        $data_tbl_result_marks_insert['year']          = $year ;
        $data_tbl_result_marks_insert['shift_id']      = $shift ;
        $data_tbl_result_marks_insert['dept_id']       = $dept ;
        $data_tbl_result_marks_insert['semister_id']   = $semister ;
        $data_tbl_result_marks_insert['section_id']    = $section ;
        $data_tbl_result_marks_insert['subject_id']    = $subject_id ;
        $data_tbl_result_marks_insert['student_id']    = $student_id ;
        $data_tbl_result_marks_insert['roll']          = $studentRoll ;
        $data_tbl_result_marks_insert[$table_column]   = $gain_marks ;
        $data_tbl_result_marks_insert[$total_table_column]   = $gain_marks ;
        $data_tbl_result_marks_insert['total_marks']         = $gain_marks ;
        $data_tbl_result_marks_insert[$total_theory_or_practical_percentatage]  = $_calculation_theory_or_practical_percentage_marks_gain;
        $data_tbl_result_marks_insert['total_mark_percentage']  = $_calculation_total_percentate_marks_gain ;
        
        $data_tbl_result_marks_insert['added_id']         = $this->teacher_id ;
        $data_tbl_result_marks_insert['added_id_type']    = $this->type ;
        $data_tbl_result_marks_insert['created_time']     = $this->current_time ;
        $data_tbl_result_marks_insert['created_at']       = $this->rcdate ;
        DB::table('tbl_result_marks')->insert($data_tbl_result_marks_insert);

        }else{
           $get_subject_tbl_result_marks = DB::table('tbl_result_marks')->where('probidhan_id',$probidhan_id)->where('year',$year)->where('shift_id',$shift)->where('dept_id',$dept)->where('semister_id',$semister)->where('section_id',$section)->where('subject_id',$subject_id)->where('roll',$studentRoll)->first();
        if($marks_type == '0'){
            $total_gain_marks_type_marks_theroy_or_practical = $get_subject_tbl_result_marks->total_theroy ;

            $_get_theroy_or_practical_percentage_previus_marks = $get_subject_tbl_result_marks->total_theory_mark_percentage ;
        }elseif($marks_type == '1'){
           $total_gain_marks_type_marks_theroy_or_practical = $get_subject_tbl_result_marks->total_theroy ;
            $_get_theroy_or_practical_percentage_previus_marks = $get_subject_tbl_result_marks->total_theory_mark_percentage ;
        }elseif($marks_type == '2'){
           $total_gain_marks_type_marks_theroy_or_practical = $get_subject_tbl_result_marks->total_theroy ;
            $_get_theroy_or_practical_percentage_previus_marks = $get_subject_tbl_result_marks->total_theory_mark_percentage ;
        }elseif($marks_type == '3'){
          $total_gain_marks_type_marks_theroy_or_practical = $get_subject_tbl_result_marks->total_practical ;
           $_get_theroy_or_practical_percentage_previus_marks = $get_subject_tbl_result_marks->total_practical_mark_percentage ;
        }elseif($marks_type == '4'){
         $total_gain_marks_type_marks_theroy_or_practical = $get_subject_tbl_result_marks->total_practical ;
         $_get_theroy_or_practical_percentage_previus_marks = $get_subject_tbl_result_marks->total_practical_mark_percentage ;
        }
        $sum_total_theory_or_practical_marks = $total_gain_marks_type_marks_theroy_or_practical + $gain_marks ;
        $sum_grand_subject_total_marks        = $gain_marks + $get_subject_tbl_result_marks->total_marks ;
        
        $sum_total_tehory_or_practical_percentage_ = $_get_theroy_or_practical_percentage_previus_marks + $_calculation_theory_or_practical_percentage_marks_gain ;
        $sum_total_subject_marks_percentage_is_ = $get_subject_tbl_result_marks->total_mark_percentage + $_calculation_total_percentate_marks_gain ;

           $data_tbl_result_marks_update                       = array();
           $data_tbl_result_marks_update[$table_column]        = $gain_marks ;
           $data_tbl_result_marks_update[$total_table_column]  = $sum_total_theory_or_practical_marks ;
           $data_tbl_result_marks_update['total_marks']        = $sum_grand_subject_total_marks ;
           $data_tbl_result_marks_update[$total_theory_or_practical_percentatage]        = $sum_total_tehory_or_practical_percentage_ ;
           $data_tbl_result_marks_update['total_mark_percentage']  = $sum_total_subject_marks_percentage_is_ ;
           DB::table('tbl_result_marks')->where('probidhan_id',$probidhan_id)->where('year',$year)->where('shift_id',$shift)->where('dept_id',$dept)->where('semister_id',$semister)->where('section_id',$section)->where('subject_id',$subject_id)->where('roll',$studentRoll)->update($data_tbl_result_marks_update);
         }

           #------------------------ detarmain pass fail status--------------------------------#
            $get_pass_fail_status_query = DB::table('tbl_result_marks')->where('probidhan_id',$probidhan_id)->where('year',$year)->where('shift_id',$shift)->where('dept_id',$dept)->where('semister_id',$semister)->where('section_id',$section)->where('subject_id',$subject_id)->where('roll',$studentRoll)->first();
            if($marks_type == '0' OR $marks_type == '1' OR $marks_type == '2'){
              $theory_marks_percentag = $get_pass_fail_status_query->total_theory_mark_percentage ;
              if($theory_marks_percentag < $probidhan_pass_marks_percentage){
                // fail stuatus 2
                $fail_status = '2' ;
              }else{
               $fail_status = '1' ;
              }
            }elseif($marks_type == '3' OR $marks_type == '4' OR $marks_type == '5'){
              $practicl_marks_percentag = $get_pass_fail_status_query->total_practical_mark_percentage ;
              if($practicl_marks_percentag < $probidhan_pass_marks_percentage){
                // fail stuatus 2
                $fail_status = '2' ;
              }else{
                // pass 
                $fail_status = '1' ;
              }
            }
            // theory pass fail status update
            $data_therory_or_practical_pass_fail_status = array();
            $data_therory_or_practical_pass_fail_status[$theory_or_practicla_pass_fail_status] = $fail_status ;
             DB::table('tbl_result_marks')->where('probidhan_id',$probidhan_id)->where('year',$year)->where('shift_id',$shift)->where('dept_id',$dept)->where('semister_id',$semister)->where('section_id',$section)->where('subject_id',$subject_id)->where('roll',$studentRoll)->update($data_therory_or_practical_pass_fail_status);
           // subject pass fail status 
          $get_subject_pass_fail_status_query_pre_is = DB::table('tbl_result_marks')->where('probidhan_id',$probidhan_id)->where('year',$year)->where('shift_id',$shift)->where('dept_id',$dept)->where('semister_id',$semister)->where('section_id',$section)->where('subject_id',$subject_id)->where('roll',$studentRoll)->first();

          $get_theroy_pass_fail_status_previous_is_ = $get_subject_pass_fail_status_query_pre_is->theory_pass_fail_status ;

          $get_practical_pass_fail_status_previous_is_ = $get_subject_pass_fail_status_query_pre_is->practical_pass_fail_status ;
          if($get_theroy_pass_fail_status_previous_is_ == '2' OR $get_practical_pass_fail_status_previous_is_ == '2'){
            // subject fail status
            $subject_fail_status_calculation_is = '2';
          }else{
             $subject_fail_status_calculation_is = '1';
          }
            $subject_data_subject_pass_fail_status = array();
            $subject_data_subject_pass_fail_status['subject_pass_fail_status'] = $subject_fail_status_calculation_is ;
             DB::table('tbl_result_marks')->where('probidhan_id',$probidhan_id)->where('year',$year)->where('shift_id',$shift)->where('dept_id',$dept)->where('semister_id',$semister)->where('section_id',$section)->where('subject_id',$subject_id)->where('roll',$studentRoll)->update($subject_data_subject_pass_fail_status);
           #----------------------- end detarmain pass fail status-----------------------------#
        //}
        #-------------------------------- ### START RESULT TABLE ### --------------------------#
        // pass fail status
        $get_subject_pass_fail_status_query_for_tbl_result_ = DB::table('tbl_result_marks')->where('probidhan_id',$probidhan_id)->where('year',$year)->where('shift_id',$shift)->where('dept_id',$dept)->where('semister_id',$semister)->where('section_id',$section)->where('roll',$studentRoll)->where('subject_pass_fail_status',2)->count();

          if($get_subject_pass_fail_status_query_for_tbl_result_ == '0'){
            // subject fail status
            $subject_fail_status_calculation_for_tbl_result = '1';
          }else{
             $subject_fail_status_calculation_for_tbl_result = '2';
          }

        // count result table
        $_check_main_tbl_result_table_count_is = DB::table('tbl_result')->where('probidhan_id',$probidhan_id)->where('year',$year)->where('shift_id',$shift)->where('dept_id',$dept)->where('semister_id',$semister)->where('section_id',$section)->where('roll',$studentRoll)->count();
        if($_check_main_tbl_result_table_count_is == '0'){
          // global markshit no
          $global_markshit_query = DB::table('tbl_result')->count();
          if($global_markshit_query == '0'){
            $markshit_no = 1 ;
          }else{
            $get_global_markshit_query = DB::table('tbl_result')->orderBy('markhist_no','desc')->first();
            $markshit_no = $get_global_markshit_query->markhist_no + 1 ; 
          }
          // markshit serial
          $_serial_markshit_query = DB::table('tbl_result')->where('probidhan_id',$probidhan_id)->where('year',$year)->where('shift_id',$shift)->where('dept_id',$dept)->where('semister_id',$semister)->count();
          if($_serial_markshit_query == '0'){
            $_serial_markshit_no = 1 ;
          }else{
            $_get_serial_markshit_query = DB::table('tbl_result')->where('probidhan_id',$probidhan_id)->where('year',$year)->where('shift_id',$shift)->where('dept_id',$dept)->where('semister_id',$semister)->orderBy('serial_no','desc')->first();
            $_serial_markshit_no = $_get_serial_markshit_query->serial_no + 1 ;
          }
          // insert main table result table
          $data_tbl_result_insert_data_                     = array();
          $data_tbl_result_insert_data_['markhist_no']      = $markshit_no ;
          $data_tbl_result_insert_data_['serial_no']        = $_serial_markshit_no ;
          $data_tbl_result_insert_data_['probidhan_id']     = $probidhan_id ;
          $data_tbl_result_insert_data_['year']             = $year ;
          $data_tbl_result_insert_data_['shift_id']         = $shift;
          $data_tbl_result_insert_data_['dept_id']          = $dept  ;
          $data_tbl_result_insert_data_['semister_id']      = $semister;
          $data_tbl_result_insert_data_['section_id']       = $section;
          $data_tbl_result_insert_data_['student_id']       = $student_id ;
          $data_tbl_result_insert_data_['roll']             = $studentRoll ;
          $data_tbl_result_insert_data_['total_marks']      = $gain_marks ;
          $data_tbl_result_insert_data_['pass_fail_status'] = $subject_fail_status_calculation_for_tbl_result ;
          $data_tbl_result_insert_data_['added_id']         = $this->teacher_id ;
          $data_tbl_result_insert_data_['added_id_type']    = $this->type ;
          $data_tbl_result_insert_data_['created_time']     = $this->current_time ;
          $data_tbl_result_insert_data_['created_at']       = $this->rcdate ;
          DB::table('tbl_result')->insert($data_tbl_result_insert_data_);
        }else{
         // update main result table
          $_get_main_table_result_info_query = DB::table('tbl_result')->where('probidhan_id',$probidhan_id)->where('year',$year)->where('shift_id',$shift)->where('dept_id',$dept)->where('semister_id',$semister)->where('section_id',$section)->where('roll',$studentRoll)->first();
          $_previous_tbl_result_total_marks  = $_get_main_table_result_info_query->total_marks ;
          $_now_total_student_total_marks_is = $_previous_tbl_result_total_marks + $gain_marks ;
          // start update
          $data_tbl_result_update_data_                       = array();
          $data_tbl_result_update_data_['total_marks']        = $_now_total_student_total_marks_is ;
          $data_tbl_result_update_data_['pass_fail_status']   = $subject_fail_status_calculation_for_tbl_result ;
          DB::table('tbl_result')->where('probidhan_id',$probidhan_id)->where('year',$year)->where('shift_id',$shift)->where('dept_id',$dept)->where('semister_id',$semister)->where('section_id',$section)->where('roll',$studentRoll)->update($data_tbl_result_update_data_);

        }

        #-------------------------------- ### END RESULT TABLE ### ----------------------------#
        
        }// end foreach loop ($roll as $key => $studentRoll)
        // sucess meesage
        Session::put('succes','Thanks , Result Marks Added Successfuly');
        return Redirect::to('teacherSearchToAddResult');
        #-------------- ### END PASS FAIL CAITERIA TYPE 2 ### ---------------------#

        }elseif($pass_fail_status=='3'){
        #-------------- ### START PASS FAIL CAITERIA TYPE 3 ### -------------------#



        #-------------- ### END PASS FAIL CAITERIA TYPE 3 ### ---------------------#
        }   
    }// end main function brackets

}
