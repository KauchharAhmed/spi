<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;
use DateTime;

class CsvController extends Controller
{
    private $rcdate ;
    private $rcdate1 ;
    private $year ;
    private $dept_id ;
    public function __construct(){
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate             = date('Y/m/d');
        $this->rcdate1            = date('Y-m-d');
        $this->year               = date('Y');
        $this->dept_id            = Session::get('dept_id');   
    }

  public function csvTeacherTodayAttendentReport()
{

         // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=teacher_today_attendent_report.csv');
          // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');
        // setting 
        $setting = DB::table('setting')->first();
        // output the column headings into csv file
        $date_is = date('d-M-Y',strtotime($this->rcdate1)) ;
        $date_attendent = "DATE : ".$date_is ;
        $day_is  = date('l',strtotime($this->rcdate1)) ;
        $day_attendent = "DAY : ".$day_is ;
        $report_created = "Report Created : ".date('d M Y, h:i:s A'); 

        fputcsv($output, array('','',$setting->full_name,'','',''));
        fputcsv($output, array('','',$setting->address,'','',''));
        fputcsv($output, array('','','Mobile : '.$setting->mobile,'','',''));
        fputcsv($output, array('','','','',''));
        fputcsv($output, array('','','TEACHER TODAY CLASS ATTENDENT REPORT','','',''));

        fputcsv($output, array('','',$date_attendent,'','',''));
        fputcsv($output, array('','',$day_attendent,'','',''));
        fputcsv($output, array('','',$report_created,'','',''));
        fputcsv($output, array('','','','','',''));

        fputcsv($output, array('SL NO','TEACHER NAME','DEPT','DEG','MOBILE','STATUS'));
   
        // get teacher information
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 3)
        ->where('users.trasfer_status', 0)
        ->get();
            $i = 1 ;
        foreach ($result as $value) {

        	            $leave = DB::table('tbl_leave')
                                      ->where('user_id',$value->id)
                                      ->where('final_request_from', '<=', $this->rcdate1)
                                      ->where('final_request_to', '>=', $this->rcdate1)
                                      ->where('type_status', '0')
                                      ->count();
                                      $traning = DB::table('tbl_leave')
                                      ->where('user_id',$value->id)
                                      ->where('final_request_from', '<=', $this->rcdate1)
                                      ->where('final_request_to', '>=', $this->rcdate1)
                                      ->where('type_status', '1')
                                      ->count();
                                      // check present or absent
                                      $present        = DB::table('teacher_attendent')
                                      ->where('teacherId',$value->id)
                                      ->where('created_at',$this->rcdate1)
                                      ->groupBy('teacherId')
                                      ->get();
                                      $prsent_status =  count($present) ;

                                        if($leave > 0){
                                        	$status = "LEAVE";
                                        }
                                        elseif($traning > 0){
                                          $status = "TRAINING";
                                        }
                                 
                                      elseif($prsent_status > 0){
                                           $status = "PRESENT";
                                       }
                                      else{
                                          $status = "ABSENT";
                                      }

            fputcsv($output, array($i++,$value->name,$value->departmentName,$value->degi,$value->mobile,$status));
         } 

        }

      // teache today all class report
      public function csvReportTeacherClassWiseTodayAttendent(Request $request)
      {
      	header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=teacher_class_wise_today_attendent_report.csv');
          // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');
        // setting 
        $setting = DB::table('setting')->first();
        $today = $this->rcdate1 ;
        // output the column headings into csv file
        $date_is = date('d-M-Y',strtotime($this->rcdate1)) ;
        $date_attendent = "DATE : ".$date_is ;
        $day_is  = date('l',strtotime($this->rcdate1)) ;
        $day_attendent = "DAY : ".$day_is ;
        $report_created = "Report Created : ".date('d M Y, h:i:s A'); 

        fputcsv($output, array('','','',$setting->full_name,'','','',''));
        fputcsv($output, array('','','',$setting->address,'','','',''));
        fputcsv($output, array('','','','Mobile : '.$setting->mobile,'','','',''));
        fputcsv($output, array('','','','','','','',''));
        fputcsv($output, array('','','','TEACHER CLASS WISE TODAY CLASS ATTENDENT REPORT','','','',''));

        fputcsv($output, array('','','',$date_attendent,'','','',''));
        fputcsv($output, array('','','',$day_attendent,'','','',''));
        fputcsv($output, array('','','',$report_created,'','','',''));
        fputcsv($output, array('','','','','','','',''));

        fputcsv($output, array('SL NO','TEACHER NAME','DEPT','DEG','TODAY TOTAL CLASS','PRESENT CLASS','ABSENT CLASS','PRESENT CLASS %','ABSENT CLASS %'));
			$day_no  = date("D");
			if($day_no == 'Sat'){
			 $day = '1';
			}elseif($day_no == 'Sun'){
			  $day = '2';
			}elseif($day_no == 'Mon'){
			     $day = '3';
			}elseif($day_no == 'Tue'){
			     $day = '4';
			}elseif($day_no == 'Wed'){
			     $day = '5';
			}elseif($day_no == 'Thu'){
			     $day = '6';
			}elseif($day_no == 'Fri'){
			     $day = '7';
			}
        // get teacher information
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 3)
        ->where('users.trasfer_status', 0)
        ->orderBy('users.user_id','asc')
        ->get();
        $i = 1 ;
        foreach ($result as $value) { 
        	    $from_year = date('Y');
                                 $total_class =  DB::table('routine')
                                ->join('semister', 'routine.semister_id', '=', 'semister.id')
                                ->select('routine.*')
                                ->where('teacher_id',$value->id)
                                ->where('routine.year', $from_year)
                                ->where('routine.day', $day)
                                ->where('semister.status',1)
                                ->count();
                      
                                      $leave = DB::table('tbl_leave')
                                      ->where('user_id',$value->id)
                                      ->where('final_request_from', '<=', $today)
                                      ->where('final_request_to', '>=', $today)
                                      ->where('type_status', '0')
                                      ->count();
                                      $traning = DB::table('tbl_leave')
                                      ->where('user_id',$value->id)
                                      ->where('final_request_from', '<=', $today)
                                      ->where('final_request_to', '>=', $today)
                                      ->where('type_status', '1')
                                      ->count();



                                      if($leave > 0){
                                      	$status_present = "LEAVE";
                                      }elseif($traning > 0){
                                        $status_present = "TRAINING";

                                      }else{
                                      $present = DB::table('teacher_attendent')
                                      ->where('teacherId',$value->id)
                                      ->where('created_at', $today)
                                      ->where('status',1)
                                      ->count();
                                      $status_present = $present ;
                                   
                                      }

                                      if($leave > 0)
                                      {
                                      	$status_absent = "LEAVE";
                                      }elseif($traning > 0){
                                        $status_absent = "TRAINING";

                                      }else{
                                      	$absent = $total_class-$present ;

                                      	$status_absent = $absent ;
                                      }

                                      if($leave > 0){
                                      	$status_present_percentage = "LEAVE";
                                      }elseif($traning > 0){
                                        $status_present_percentage = "TRAINING";

                                      }else{
                                      	if($total_class >0){
                                        $present_percentage = ($present*100)/$total_class;
                                       $present_percentage_is = number_format($present_percentage,2).' %';
                                       $status_present_percentage = $present_percentage_is ;
                                      }
                                  }

                                  if($leave > 0){
                                    $status_absent_percentage = "LEAVE";
                                  }elseif($traning > 0){
                                        $status_absent_percentage = "TRAINING";

                                      }else{
                                  	 if($total_class >0){
                                        $absent_percentage = ($absent*100)/$total_class;

                                        $absent_percentage_is = number_format($absent_percentage,2).' %' ;
                                        $status_absent_percentage = $absent_percentage_is ;
                                      }
                                  }
					fputcsv($output, array($i++,$value->name,$value->departmentName,$value->degi,$total_class,$status_present,$status_absent,$status_present_percentage,$status_absent_percentage));
        }
      
      }
      // monthly teacher attendnt report
      public function csvReportTeacherMonthlyAttendent(Request $request)
      {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=monthly_teacher_attendent_report.csv');
          // create a file pointer connected to the output stream
      $output = fopen('php://output', 'w');
      $year   = trim($request->year);
      $month  = trim($request->month);

      if($month == '01'){
                          $report_month = "January";
                         }elseif($month == '02'){
                          $report_month = "February";
                         }elseif($month == '03'){
                           $report_month = "March";
                         }elseif($month == '04'){
                           $report_month = "April";
                         }elseif($month == '05'){
                          $report_month = "May";
                         }elseif($month == '06'){
                           $report_month = "June";
                         }elseif($month == '07'){
                          $report_month = "July";
                         }elseif($month == '08'){
                          $report_month = "August";
                         }elseif($month == '09'){
                           $report_month = "September";
                         }elseif($month == '10'){
                           $report_month = "October";
                         }elseif($month == '11'){
                           $report_month = "November";
                         }else{
                          $report_month = "December";
                         }
    // get teacher
    $i = 1 ;
    $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 3)
        ->where('users.trasfer_status', 0)
        ->orderBy('users.user_id','asc')
        ->get();
        // get holiday
        $from = $year.'-'.$month.'-01';
        $to   = $year.'-'.$month.'-31';
        $count_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereBetween('holiday_date', [$from, $to])->count();
        $month_total_day =cal_days_in_month(CAL_GREGORIAN,$month,$year);
        // setting 
        $setting = DB::table('setting')->first();

        $report_created = "REPORT CREATED : ".date('d M Y, h:i:s A'); 

        fputcsv($output, array('','','',$setting->full_name,'','','',''));
        fputcsv($output, array('','','',$setting->address,'','','',''));
        fputcsv($output, array('','','','Mobile : '.$setting->mobile,'','','',''));
        fputcsv($output, array('','','','','','','',''));
        fputcsv($output, array('','','','MONTHLY TEACHER CLASS ATTENDENT REPORT','','','',''));

        fputcsv($output, array('','','','YEAR : '.$year,'','','',''));
        fputcsv($output, array('','','','MONTH : '.$report_month,'','','',''));
        fputcsv($output, array('','','','MONTH TOTAL DAYS : '.$month_total_day.' DAYS','','','',''));
        fputcsv($output, array('','','','HOLIDAYS : '.$count_holiday.' DAYS','','','',''));
        fputcsv($output, array('','','',$report_created,'','','',''));
        fputcsv($output, array('','','','','','','',''));

        fputcsv($output, array('SL NO','TEACHER NAME','DEPT','DEG','TOTAL CLASS (DAYS)','TOTAL LEAVE & TRAINING (DAYS)','TOTAL CLSS (DAYS) without leave & training','PRESENT (DAYS)','ABSENT (DAYS)','PRESENT (DAYS)%','ABSENT (DAYS)%'));

        foreach ($result as $value) {

         $total_class_day = $month_total_day - $count_holiday ;

           $like = $year.'-'.$month;
                        $withoutlike = $year.'-'.$month.'-'.$month_total_day;
                             // status 1 = only approved leave
                            // total leave 
                             $total_leave = DB::table('tbl_leave')
                             ->where('user_id',$value->id)
                             ->where('final_request_from','LIKE',"%{$like}%")
                             ->where('final_request_to','LIKE',"%{$like}%")
                             ->where('status',1)
                             ->sum('final_day');
                              // if cross that month then this day
                              $total_from_leave_count = DB::table('tbl_leave')
                             ->where('user_id',$value->id)
                             ->where('final_request_from','LIKE',"%{$like}%")
                             ->where('final_request_to','>',$withoutlike)
                             ->where('status',1)
                             ->count();

                         if($total_from_leave_count > 0){
                          // if cross that month then this day
                           $total_from_leave = DB::table('tbl_leave')
                           ->where('user_id',$value->id)
                           ->where('final_request_from','LIKE',"%{$like}%")
                           ->where('final_request_to','>',$withoutlike)
                           ->where('status',1)
                           ->get();
                             foreach ($total_from_leave as $total_from_leavee) {
                           $total_from_leave_get =  $total_from_leavee->final_request_from;

                           $explode = explode('-', $total_from_leave_get);
                           $last_date = $explode[2];
                           $single_leave_day = $month_total_day - $last_date ;

                           $total_leave_sum  = $total_leave + $single_leave_day + 1;
           
                         }
                       }else{
                           $total_leave_sum = $total_from_leave_count+$total_leave;
                     
                         }
                      $teache_class = $total_class_day-$total_leave_sum;

                         $count        = DB::table('teacher_attendent')
                          ->distinct()
                          ->where('year',$year)
                          ->where('teacherId',$value->id)
                          ->whereBetween('created_at', [$from, $to])
                          ->get(array('created_at'));
                           $present = count($count) ;
                     
                          $absent =  $total_class_day - $total_leave_sum -$present; 

                         $present_perchatage    = ($present*100)/$teache_class;
                         $present_perchatage_is = number_format($present_perchatage,2).'%';

                          $absent_perchatage   = ($absent*100)/$teache_class;
                          $absent_perchatage_is= number_format($absent_perchatage,2).'%';

                        fputcsv($output, array($i++,$value->name,$value->departmentName,$value->degi,$total_class_day,$total_leave_sum,$teache_class,$present,$absent,$present_perchatage_is,$absent_perchatage_is));
     
        }

      }
      // csv staff door report
      public function csvStaffNormalAttendentViewReport(Request $request)
      {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=door_staff_attendent_report.csv');
        $output = fopen('php://output', 'w');
        $from_date   = trim($request->from_date); 
        $from        = date ("Y-m-d", strtotime($from_date));
        $staff_type  = trim($request->staff_type);
        $setting     = DB::table('setting')->first(); 

        $report_created = "REPORT CREATED : ".date('d M Y, h:i:s A'); 

        if($staff_type == '0'){
                                $staff_type_is =  "ALL";
                               }elseif($staff_type == '2'){
                                $staff_type_is = "ADMIN";
                               }elseif($staff_type == '3'){
                                $staff_type_is = "TEACHER";
                               }elseif($staff_type == "4"){
                                $staff_type_is = "CRAFT";
                               }elseif($staff_type == "5"){
                                $staff_type_is = "OTHER STAFF";
                               }

        if($staff_type == '0'){
          // all staff
         $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
        }
        if($staff_type == '2'){
          // admin
          $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 2)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
        }
        if($staff_type == '3'){
          // teacher
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 3)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
        }
        if($staff_type == '4'){
          // craft
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 4)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
        }
         if($staff_type == '5'){
          // other staff
          $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 5)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
        }

        fputcsv($output, array('','','',$setting->full_name,'','','',''));
        fputcsv($output, array('','','',$setting->address,'','','',''));
        fputcsv($output, array('','','','Mobile : '.$setting->mobile,'','','',''));
        fputcsv($output, array('','','','','','','',''));
        fputcsv($output, array('','','','DOOR LOG STAFF ATTENDENT REPORT','','','',''));

        fputcsv($output, array('','','','DATE : '.date('d M Y',strtotime($from)),'','','',''));
        fputcsv($output, array('','','','DAY : '.date("l",strtotime($from)),'','','',''));
        fputcsv($output, array('','','','STAFF TYPE : '.$staff_type_is,'','','',''));
        fputcsv($output, array('','','','TOTAL STAFFS : '.count($result),'','','',''));
        fputcsv($output, array('','','','TIME STATUS INDICATOR : : L : Late Time  A : Actual Time  B : Before Office Time','','','',''));
        fputcsv($output, array('','','',$report_created,'','','',''));
        fputcsv($output, array('','','','','','','',''));

        fputcsv($output, array('SL','STAFF','DEPT','DEG','STATUS','OFFICE START','FIRST ENTER TIME','TIME STATUS','ENTER NUMBERS','ENTER TIMES'));

        $i = 1 ;
        foreach ($result as $value) {
                      $leave = DB::table('tbl_leave')
                                      ->where('user_id',$value->id)
                                      ->where('final_request_from', '<=', $from)
                                      ->where('final_request_to', '>=', $from)
                                      ->where('type_status', 0)
                                      ->count();
                                      $training = DB::table('tbl_leave')
                                      ->where('user_id',$value->id)
                                      ->where('final_request_from', '<=', $from)
                                      ->where('final_request_to', '>=', $from)
                                      ->where('type_status', 1)
                                      ->count();
                                      // check present or absent
                                      $present        = DB::table('tbl_door_log')
                                      ->where('user_id',$value->id)
                                      ->where('enter_date',$from)
                                      ->orderBy('enter_time','asc')
                                      ->get();
                                      $prsent_status =  count($present) ;

                                        if($leave > 0){
                                          $attendeent_status = "LEAVE";
                                        }elseif($training > 0){
                                          $attendeent_status = "TRAINING";

                                        } elseif($prsent_status > 0){
                                          $attendeent_status = "PRESENT";

                                        }else{
                                           $attendeent_status = "ABSENT";
                                        }

                                    if($prsent_status > 0){ 
                                      $office_time_query = DB::table('tbl_door_log')
                                      ->where('user_id',$value->id)
                                      ->where('enter_date',$from)
                                      ->orderBy('enter_time','asc')
                                      ->first();
                                     $office_start_time = date('h:i:s a',strtotime($office_time_query->office_start));
                                    }else{
                                      $office_start_time = '';
                                    }

                                 if($prsent_status > 0){ 
                                  $present_time = DB::table('tbl_door_log')
                                      ->where('user_id',$value->id)
                                      ->where('enter_date',$from)
                                      ->orderBy('enter_time','asc')
                                      ->first();
                                      $present_enter_time = date('h:i:s a',strtotime($present_time->enter_time));
                                 }else{
                                  $present_enter_time ='';
                                 }

                                if($prsent_status > 0){ 
                          
                                      $diff_enter_time_in_sec =  strtotime($office_time_query->enter_time);
                                      $diff_offce_time_in_sec =  strtotime($office_time_query->office_start);
                                      $now_calculation_time   = $diff_enter_time_in_sec - $diff_offce_time_in_sec ;
                                      $different_time_is_now  = abs($now_calculation_time); 

                                       if($now_calculation_time > 0){
                                        $status_indicator = "L : ".gmdate("H:i:s", $different_time_is_now);
                                       }elseif($now_calculation_time == 0) {
                                         $status_indicator = "A : ".gmdate("H:i:s", $different_time_is_now) ;
                                       }else{
                                        $status_indicator = "B : ".gmdate("H:i:s", $different_time_is_now) ;
                                       }
                                     }else{
                                      $status_indicator = '';
                                     }

                                    if($prsent_status > 0)
                                      {
                                        $prsent_status_number = $prsent_status;
                                      }else{
                                         $prsent_status_number = '';
                                      }

                                    if($prsent_status > 0){ 
                                     $multiple_enter_time_value = array();
                                     foreach ($present as $present_time_value) { 
                                     $multiple_enter_time_value[] = date('h:i:s a',strtotime($present_time_value->enter_time)) ; 
                                      }

                                      $multiple_enter_time_value_implode = implode(',',$multiple_enter_time_value) ;
                                    }else{
                                      $multiple_enter_time_value_implode = '';
                                    }

        fputcsv($output, array($i++,$value->name,$value->departmentName,$value->degi,$attendeent_status,$office_start_time,$present_enter_time,$status_indicator,$prsent_status_number,$multiple_enter_time_value_implode));
     
        }

      }
      // dg office door attendent report
      public function csvStaffDgAttendentViewReport(Request $request)
      {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=dg_office_door_staff_attendent_report.csv');
        $output = fopen('php://output', 'w');
        $from_date   = trim($request->from_date); 
        $from        = date ("Y-m-d", strtotime($from_date));
        $staff_type  = trim($request->staff_type);
        $setting     = DB::table('setting')->first(); 

        $report_created = "REPORT CREATED : ".date('d M Y, h:i:s A'); 

        if($staff_type == '0'){
                                $staff_type_is =  "ALL";
                               }elseif($staff_type == '2'){
                                $staff_type_is = "ADMIN";
                               }elseif($staff_type == '3'){
                                $staff_type_is = "TEACHER";
                               }elseif($staff_type == "4"){
                                $staff_type_is = "CRAFT";
                               }elseif($staff_type == "5"){
                                $staff_type_is = "OTHER STAFF";
                               }

        if($staff_type == '0'){
          // all staff
         $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
        }
        if($staff_type == '2'){
          // admin
          $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 2)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
        }
        if($staff_type == '3'){
          // teacher
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 3)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
        }
        if($staff_type == '4'){
          // craft
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 4)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
        }
         if($staff_type == '5'){
          // other staff
          $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 5)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
        }

        fputcsv($output, array('','','',$setting->full_name,'','','',''));
        fputcsv($output, array('','','',$setting->address,'','','',''));
        fputcsv($output, array('','','','Mobile : '.$setting->mobile,'','','',''));
        fputcsv($output, array('','','','','','','',''));
        fputcsv($output, array('','','','STAFF ATTENDENT REPORT','','','',''));

        fputcsv($output, array('','','','DATE : '.date('d M Y',strtotime($from)),'','','',''));
        fputcsv($output, array('','','','DAY : '.date("l",strtotime($from)),'','','',''));
        fputcsv($output, array('','','','STAFF TYPE : '.$staff_type_is,'','','',''));
        fputcsv($output, array('','','','TOTAL STAFFS : '.count($result),'','','',''));
        fputcsv($output, array('','','',$report_created,'','','',''));
        fputcsv($output, array('','','','','','','',''));

        fputcsv($output, array('SL','STAFF','DEPT','DEG','STATUS','ENTER TIME'));

        $i = 1 ;
        foreach ($result as $value) {
                  $leave = DB::table('tbl_leave')
                                      ->where('user_id',$value->id)
                                      ->where('final_request_from', '<=', $from)
                                      ->where('final_request_to', '>=', $from)
                                      ->where('type_status', 0)
                                      ->count();
                                      $training = DB::table('tbl_leave')
                                      ->where('user_id',$value->id)
                                      ->where('final_request_from', '<=', $from)
                                      ->where('final_request_to', '>=', $from)
                                      ->where('type_status', 1)
                                      ->count();
                                      // check present or absent
                                      $present        = DB::table('tbl_door_log')
                                      ->where('user_id',$value->id)
                                      ->where('enter_date',$from)
                                      ->orderBy('enter_time','asc')
                                      ->get();
                                      $prsent_status =  count($present) ;

                                        if($leave > 0){
                                          $attendeent_status = "LEAVE";
                                        }elseif($training > 0){
                                          $attendeent_status = "TRAINING";

                                        }  elseif($prsent_status > 0){
                                          $attendeent_status = "PRESENT";

                                        }else{
                                           $attendeent_status = "ABSENT";
                                        }


                                 if($prsent_status > 0){ 
                                  $present_time = DB::table('tbl_door_log')
                                      ->where('user_id',$value->id)
                                      ->where('enter_date',$from)
                                      ->orderBy('enter_time','asc')
                                      ->first();
                                      $present_enter_time = date('h:i:s a',strtotime($present_time->enter_time));
                                 }else{
                                  $present_enter_time ='';
                                 }
        fputcsv($output, array($i++,$value->name,$value->departmentName,$value->degi,$attendeent_status,$present_enter_time));
     
      }
    }

    // monthly door report
    public function csvReportMontlyStaffDoorAttendentView(Request $request)
    {
      header('Content-Type: text/csv; charset=utf-8');
      header('Content-Disposition: attachment; filename= monthly_door_log_staff_attendent_report.csv');
      $output = fopen('php://output', 'w');

    $year         = trim($request->year);
    $month        = trim($request->month);
    $staff_type   = trim($request->staff_type);
    $setting     = DB::table('setting')->first();
    $report_created = "REPORT CREATED : ".date('d M Y, h:i:s A'); 
        if($staff_type == '0'){
                                $staff_type_is =  "ALL";
                               }elseif($staff_type == '2'){
                                $staff_type_is = "ADMIN";
                               }elseif($staff_type == '3'){
                                $staff_type_is = "TEACHER";
                               }elseif($staff_type == "4"){
                                $staff_type_is = "CRAFT";
                               }elseif($staff_type == "5"){
                                $staff_type_is = "OTHER STAFF";
                               }

                      if($month == '01'){
                         $month_is = "January";
                         }elseif($month == '02'){
                          $month_is = "February";
                         }elseif($month == '03'){
                           $month_is = "March";
                         }elseif($month == '04'){
                           $month_is = "April";
                         }elseif($month == '05'){
                           $month_is = "May";
                         }elseif($month == '06'){
                            $month_is = "June";
                         }elseif($month == '07'){
                            $month_is = "July";
                         }elseif($month == '08'){
                          $month_is = "August";
                         }elseif($month == '09'){
                           $month_is = "September";
                         }elseif($month == '10'){
                           $month_is = "October";
                         }elseif($month == '11'){
                          $month_is = "November";
                         }else{
                          $month_is = "December";
                         }

    if($staff_type == '0'){
          // all staff
         $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
        }
        if($staff_type == '2'){
          // admin
          $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 2)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
    
        }
        if($staff_type == '3'){
          // teacher
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 3)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
        }
        if($staff_type == '4'){
          // craft
        $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 4)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
        }
         if($staff_type == '5'){
          // other staff
          $result = DB::table('users')
        ->leftJoin('department', 'users.dept', '=', 'department.id')
        ->select('users.*', 'department.departmentName')
        ->where('users.type', 5)
        ->where('users.trasfer_status', 0)
        ->whereNotIn('users.type', [10])
        ->orderBy('users.user_id','asc')
        ->get();
        } 
        // get holiday
        $from = $year.'-'.$month.'-01';
        $to   = $year.'-'.$month.'-31';
        $count_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->where('door_holiday','0')
                         ->whereBetween('holiday_date', [$from, $to])->count();
        $month_total_day =cal_days_in_month(CAL_GREGORIAN,$month,$year);

        fputcsv($output, array('','','',$setting->full_name,'','','',''));
        fputcsv($output, array('','','',$setting->address,'','','',''));
        fputcsv($output, array('','','','Mobile : '.$setting->mobile,'','','',''));
        fputcsv($output, array('','','','','','','',''));
        fputcsv($output, array('','','','MONTHLY DOOR LOG STAFF ATTENDENT REPORT','','','',''));

        fputcsv($output, array('','','','YEAR : '.$year,'','','',''));
        fputcsv($output, array('','','','MONTH : '.$month_is,'','','',''));
        fputcsv($output, array('','','','MONTH TOTAL DAYS : '.$month_total_day,'','','',''));
        fputcsv($output, array('','','','HOLIDAYS : '.$count_holiday,'','','',''));
        fputcsv($output, array('','','','STAFF TYPE : '.$staff_type_is,'','','',''));
         fputcsv($output, array('','','','TOTAL STAFFS : '.count($result),'','','',''));
        fputcsv($output, array('','','',$report_created,'','','',''));
        fputcsv($output, array('','','','','','','',''));

        fputcsv($output, array('SL','STAFF','DEPT','DEG','TOTAL WORKING (DAYS)','TOTAL LEAVE (DAYS)','TOTAL WORKING (DAYS)with out leave','PRESENT (DAYS)','ABSENT (DAYS)','PRESENT (DAYS)%','ABSENT (DAYS)%'));
        $i = 1 ;
        foreach ($result as $value) {
         $total_class_day = $month_total_day - $count_holiday ;
          $like = $year.'-'.$month;
                                      $withoutlike = $year.'-'.$month.'-'.$month_total_day;
                                       // status 1 = only approved leave
                                      // total leave 
                                       $total_leave = DB::table('tbl_leave')
                                       ->where('user_id',$value->id)
                                       ->where('final_request_from','LIKE',"%{$like}%")
                                       ->where('final_request_to','LIKE',"%{$like}%")
                                       ->where('status',1)
                                       ->sum('final_day');
                                        // if cross that month then this day
                                        $total_from_leave_count = DB::table('tbl_leave')
                                       ->where('user_id',$value->id)
                                       ->where('final_request_from','LIKE',"%{$like}%")
                                       ->where('final_request_to','>',$withoutlike)
                                       ->where('status',1)
                                       ->count();

                                     if($total_from_leave_count > 0){
                                      // if cross that month then this day
                                       $total_from_leave = DB::table('tbl_leave')
                                       ->where('user_id',$value->id)
                                       ->where('final_request_from','LIKE',"%{$like}%")
                                       ->where('final_request_to','>',$withoutlike)
                                       ->where('status',1)
                                       ->get();
                                         foreach ($total_from_leave as $total_from_leavee) {
                                       $total_from_leave_get =  $total_from_leavee->final_request_from;

                                       $explode = explode('-', $total_from_leave_get);
                                       $last_date = $explode[2];
                                       $single_leave_day = $month_total_day - $last_date ;
                                       $total_leave_sum  = $total_leave + $single_leave_day + 1;
                                      
                                     }
                                   }else{
                                       $total_leave_sum = $total_from_leave_count+$total_leave;
                                       
                                     }
                                     $teache_class = $total_class_day-$total_leave_sum;
                                      $count     = DB::table('tbl_door_log')
                                      ->distinct()
                                      //->where('year',$year)
                                      ->where('user_id',$value->id)
                                      ->whereBetween('enter_date', [$from, $to])
                                      ->get(array('enter_date'));
                                       $present = count($count) ;
                                        $absent =  $total_class_day - $total_leave_sum -$present;  ;
                                      $present_perchatage   = ($present*100)/$teache_class;
                                      $present_perchatage_is = number_format($present_perchatage,2).'%';
                                    $absent_perchatage   = ($absent*100)/$teache_class;
                                    $absent_perchatage_is= number_format($absent_perchatage,2).'%';

          fputcsv($output, array($i++,$value->name,$value->departmentName,$value->degi,$total_class_day,$total_leave_sum,$teache_class,$present,$absent,$present_perchatage_is,$absent_perchatage_is));
        }

      
    }
    // csv monthly class attendent report
    public function csvMonthlyAttendentReport(Request $request)
    {
      header('Content-Type: text/csv; charset=utf-8');
      header('Content-Disposition: attachment; filename=monthly_student_class_attendent_report.csv');
       $output = fopen('php://output', 'w');
        $report_created = "REPORT CREATED : ".date('d M Y, h:i:s A');
       $setting     = DB::table('setting')->first();
        $year     = trim($request->year) ;
        $shift    = trim($request->shift);
        $dept     = trim($request->dept);
        $semister = trim($request->semister);
        $section  = trim($request->section);
        $month    = trim($request->month);

                      if($month == '01'){
                         $month_is = "January";
                         }elseif($month == '02'){
                          $month_is = "February";
                         }elseif($month == '03'){
                           $month_is = "March";
                         }elseif($month == '04'){
                           $month_is = "April";
                         }elseif($month == '05'){
                           $month_is = "May";
                         }elseif($month == '06'){
                            $month_is = "June";
                         }elseif($month == '07'){
                            $month_is = "July";
                         }elseif($month == '08'){
                          $month_is = "August";
                         }elseif($month == '09'){
                           $month_is = "September";
                         }elseif($month == '10'){
                           $month_is = "October";
                         }elseif($month == '11'){
                          $month_is = "November";
                         }else{
                          $month_is = "December";
                         }
        // get student
        $result = DB::table('student')->where('year',$year)->where('shift_id',$shift)->where('dept_id', $dept )->where('semister_id',$semister)->where('section_id',$section)->orderBy('roll','asc')->get();
        // get holiday
        $from = $year.'-'.$month.'-01';
        $to   = $year.'-'.$month.'-31';
        $count_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereBetween('holiday_date', [$from, $to])->count();
        $month_total_day =cal_days_in_month(CAL_GREGORIAN,$month,$year);
  
         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();

         fputcsv($output, array('','','',$setting->full_name,'','','',''));
        fputcsv($output, array('','','',$setting->address,'','','',''));
        fputcsv($output, array('','','','Mobile : '.$setting->mobile,'','','',''));
        fputcsv($output, array('','','','','','','',''));
        fputcsv($output, array('','','','MONTHLY STUDENT CLASS ATTENDENT REPORT','','','',''));

        fputcsv($output, array('','','','YEAR : '.$year,'','','',''));
        fputcsv($output, array('','','','SHIFT : '.$shift_name->shiftName,'','','',''));
        fputcsv($output, array('','','','DEPARTMENT NAME : '.$dept_name->departmentName,'','','',''));
        fputcsv($output, array('','','','SECTION : '.$section_name->section_name,'','','',''));
        fputcsv($output, array('','','','MONTH : '.$month_is,'','','',''));
         fputcsv($output, array('','','','MONTH TOTAL DAYS : '.$month_total_day,'','','',''));
         fputcsv($output, array('','','','HOLIDAYS : '.$count_holiday,'','','',''));
        fputcsv($output, array('','','',$report_created,'','','',''));
        fputcsv($output, array('','','','','','','',''));

        fputcsv($output, array('SL NO','ROLL','REGISTRATION','TOTAL CLASS (DAYS)','PRESENT (DAYS)','ABSENT (DAYS)','PRESENT (DAYS)%','ABSENT (DAYS)%'));
        $i = 1 ;
        foreach ($result as $value) {
          $total_class_day = $month_total_day - $count_holiday ;
          $count        = DB::table('student_attendent')
                                      ->distinct()
                                      ->where('year',$value->year)
                                      ->where('section_id',$value->section_id)
                                      ->where('shift_id',$value->shift_id)
                                      ->where('dept_id',$value->dept_id)
                                      ->where('semister_id',$value->semister_id)
                                      ->where('roll',$value->roll)
                                      ->whereBetween('created_at', [$from, $to])
                                      ->get(array('created_at'));
                                       $present = count($count) ;
                              $absent =  $total_class_day - $present ; 
                               $present_perchatage    = ($present*100)/$total_class_day;
                               $present_perchatage_is = number_format($present_perchatage,2).'%';
                             $absent_perchatage   = ($absent*100)/$total_class_day;
                             $absent_perchatage_is = number_format($absent_perchatage,2).'%';

              fputcsv($output, array($i++,$value->roll,$value->registration,$total_class_day,$present,$absent,$present_perchatage_is,$absent_perchatage_is));
          
        }

    }
    // csv datewise attendnt report
    public function csvDateWiseAttendentReport(Request $request)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=periodic_student_class_attendent_report.csv');
        $output = fopen('php://output', 'w');
        $report_created = "REPORT CREATED : ".date('d M Y, h:i:s A');
        $setting     = DB::table('setting')->first();
        $year        = trim($request->year) ;
        $shift       = trim($request->shift);
        $dept        = trim($request->dept);
        $semister    = trim($request->semister);
        $section     = trim($request->section);
        $date_form   = trim($request->from); 
        $from        = date ("Y-m-d", strtotime($date_form));
        $date_to     = trim($request->to); 
        $to          = date ("Y-m-d", strtotime($date_to));
        $result = DB::table('student')->where('year',$year)->where('shift_id',$shift)->where('dept_id', $dept )->where('semister_id',$semister)->where('section_id',$section)->orderBy('roll','asc')->get();
        // count holiday
        $count_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereBetween('holiday_date', [$from, $to])->count();
        // total day caluclation
        $date1 = date_create($from);
        $date2 = date_create($to);
        //difference between two dates
        $diff       = date_diff($date1,$date2);
        $total_day  = $diff->format("%a")+1;
         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();
         $date_range = date ("d M Y", strtotime($from)).' To '.date("d M Y", strtotime($to)) ;
        fputcsv($output, array('','','',$setting->full_name,'','','',''));
        fputcsv($output, array('','','',$setting->address,'','','',''));
        fputcsv($output, array('','','','Mobile : '.$setting->mobile,'','','',''));
        fputcsv($output, array('','','','','','','',''));
        fputcsv($output, array('','','','PERIODIC STUDENTS ATTENDENT REPORTS','','','',''));

        fputcsv($output, array('','','','YEAR : '.$year,'','','',''));
        fputcsv($output, array('','','','SHIFT : '.$shift_name->shiftName,'','','',''));
        fputcsv($output, array('','','','DEPARTMENT NAME : '.$dept_name->departmentName,'','','',''));
        fputcsv($output, array('','','','SECTION : '.$section_name->section_name,'','','',''));
        fputcsv($output, array('','','','TOTAL DAYS : '.$total_day,'','','',''));
        fputcsv($output, array('','','','HOLIDAYS : '.$count_holiday,'','','',''));
        fputcsv($output, array('','','','DATE RANGE : '.$date_range,'','','',''));
        fputcsv($output, array('','','',$report_created,'','','',''));
        fputcsv($output, array('','','','','','','',''));
        fputcsv($output, array('SL NO','ROLL','REGISTRATION','TOTAL CLASS (DAYS)','PRESENT (DAYS)','ABSENT (DAYS)','PRESENT (DAYS)%','ABSENT (DAYS)%'));
         $i = 1 ;
         foreach ($result as $value) {
                $count        = DB::table('student_attendent')
                                      ->distinct()
                                      ->where('year',$value->year)
                                      ->where('section_id',$value->section_id)
                                      ->where('shift_id',$value->shift_id)
                                      ->where('dept_id',$value->dept_id)
                                      ->where('semister_id',$value->semister_id)
                                      ->where('roll',$value->roll)
                                      ->whereBetween('created_at', [$from, $to])
                                      ->get(array('created_at'));
                                       $present = count($count) ;
                                        $total_class_day = $total_day - $count_holiday ;
                                        $absent =  $total_class_day - $present ; 
                                        $present_perchatage       = ($present*100)/$total_class_day;
                                        $present_perchatage_is    =number_format($present_perchatage,2).'%';
                                        $absent_perchatage   = ($absent*100)/$total_class_day;
                                        $absent_perchatage_is= number_format($absent_perchatage,2).'%';
              fputcsv($output, array($i++,$value->roll,$value->registration,$total_class_day,$present,$absent,$present_perchatage_is,$absent_perchatage_is));
         }

      
    }
    // monthly class wise attendent report
    public function csvMonthlyClassWiseAttendentReport(Request $request)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=monthly_student_class_wise_attendent_report.csv');
        $output = fopen('php://output', 'w');
        $report_created = "REPORT CREATED : ".date('d M Y, h:i:s A');
        $setting     = DB::table('setting')->first();

        $year     = trim($request->year) ;
        $shift    = trim($request->shift);
        $dept     = trim($request->dept);
        $semister = trim($request->semister);
        $section  = trim($request->section);
        $month    = trim($request->month);

          if($month == '01'){
                $month_is = "January";
               }elseif($month == '02'){
                $month_is = "February";
               }elseif($month == '03'){
                 $month_is = "March";
               }elseif($month == '04'){
                $month_is = "April";
               }elseif($month == '05'){
                 $month_is = "May";
               }elseif($month == '06'){
              $month_is ="June";
               }elseif($month == '07'){
                $month_is = "July";
               }elseif($month == '08'){
                $month_is = "August";
               }elseif($month == '09'){
                $month_is = "September";
               }elseif($month == '10'){
                 $month_is = "October";
               }elseif($month == '11'){
                $month_is = "November";
               }else{
                $month_is = "December";
               }


        // get student
        $result = DB::table('student')->where('year',$year)->where('shift_id',$shift)->where('dept_id', $dept )->where('semister_id',$semister)->where('section_id',$section)->orderBy('roll','asc')->get();
 
        #---------------- total holiday class calculation-------------------#
        $from = $year.'-'.$month.'-01';
        $to   = $year.'-'.$month.'-31';
        $get_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereNotIn('type',[1])
                         ->whereBetween('holiday_date', [$from, $to])->get();

  
      $total_holiday_class = 0 ;
      foreach ($get_holiday as $holidays) {
      $day_no =  date('D', strtotime($holidays->holiday_date));
      //echo $day_no;
    if($day_no == 'Sat'){
     $day = '1';
    }elseif($day_no == 'Sun'){
      $day = '2';
    }elseif($day_no == 'Mon'){
         $day = '3';
    }elseif($day_no == 'Tue'){
         $day = '4';
    }elseif($day_no == 'Wed'){
         $day = '5';
    }elseif($day_no == 'Thu'){
         $day = '6';
    }elseif($day_no == 'Fri'){
         $day = '7';
    }
    // count total holiday class
    $holiday_total_class = DB::table('routine')
    ->where('year',$year)
    ->where('shift_id',$shift)
    ->where('dept_id',$dept)
    ->where('semister_id',$semister)
    ->where('section_id',$section)
    ->where('day',$day)->count();
    $total_holiday_class = $total_holiday_class+$holiday_total_class;
     }
    #-----------------end total holiday class calulation---------------------#
     // month total holiday 
     $get_all_holiday =  DB::table('holiday')
                        ->where('year',$year)
                        ->whereBetween('holiday_date', [$from, $to])->get(['holiday_date']);
                       $data = array();
                       foreach ($get_all_holiday as $data1) {
                         $data[] = $data1->holiday_date;
                       }
    $start_date = $year.'-'.$month.'-01';;
    $start_time = strtotime($start_date);
    $end_time   = strtotime("+1 month", $start_time);
    for($i=$start_time; $i<$end_time; $i+=86400)
    {
       $list[] = date('Y-m-d', $i);
    }
    $total_class_day = array_diff($list,$data);
    #--------------------- total class of this month---------------------------#
    $totalClassNo = 0 ;
    foreach ($total_class_day as $total_class_days) {
      $class_day_no =  date('D', strtotime($total_class_days));

    if($class_day_no == 'Sat'){
     $day_number = '1';
    }elseif($class_day_no == 'Sun'){
      $day_number = '2';
    }elseif($class_day_no == 'Mon'){
         $day_number = '3';
    }elseif($class_day_no == 'Tue'){
         $day_number = '4';
    }elseif($class_day_no == 'Wed'){
         $day_number = '5';
    }elseif($class_day_no == 'Thu'){
         $day_number = '6';
    }elseif($class_day_no == 'Fri'){
         $day_number = '7';
    }

    // count total holiday class
    $count_total_class_month = DB::table('routine')
    ->where('year',$year)
    ->where('shift_id',$shift)
    ->where('dept_id',$dept)
    ->where('semister_id',$semister)
    ->where('section_id',$section)
    ->where('day',$day_number)->count();
    $totalClassNo = $totalClassNo+$count_total_class_month;
    }
    //echo $totalClassNo ;
    #------------------------ end total class of this month-----------------------------#
    $month_total_day =cal_days_in_month(CAL_GREGORIAN,$month,$year);

         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();

           fputcsv($output, array('','','',$setting->full_name,'','','',''));
        fputcsv($output, array('','','',$setting->address,'','','',''));
        fputcsv($output, array('','','','Mobile : '.$setting->mobile,'','','',''));
        fputcsv($output, array('','','','','','','',''));
        fputcsv($output, array('','','','MONTHLY CLASS WISE STUDENTS ATTENDENT REPORTS','','','',''));

        fputcsv($output, array('','','','YEAR : '.$year,'','','',''));
        fputcsv($output, array('','','','SHIFT : '.$shift_name->shiftName,'','','',''));
        fputcsv($output, array('','','','DEPARTMENT NAME : '.$dept_name->departmentName,'','','',''));
        fputcsv($output, array('','','','SECTION : '.$section_name->section_name,'','','',''));
        fputcsv($output, array('','','','MONTH : '.$month_is,'','','',''));
        fputcsv($output, array('','','','MONTH DAYS : '.$month_total_day,'','','',''));
        fputcsv($output, array('','','','HOLIDAYS SUBJECT CLASS: '.$total_holiday_class,'','','',''));
        fputcsv($output, array('','','',$report_created,'','','',''));
        fputcsv($output, array('','','','','','','',''));
        fputcsv($output, array('SL NO','ROLL','REGISTRATION','TOTAL SUBJECTS CLASS','PRESENT SUBJECT CLASS','ABSENT SUBJECT CLASS ','PRESENT SUBJECT CLASS %','ABSENT SUBJECT CLASS %'));

        $i = 1 ;
        foreach ($result as $value) {
           $present        = DB::table('student_attendent')
                                      ->where('year',$value->year)
                                      ->where('section_id',$value->section_id)
                                      ->where('shift_id',$value->shift_id)
                                      ->where('dept_id',$value->dept_id)
                                      ->where('semister_id',$value->semister_id)
                                      ->where('roll',$value->roll)
                                      ->whereBetween('created_at', [$from, $to])
                                      ->count();
                                       $absent =  $totalClassNo - $present ;
                                       $present_perchatage   = ($present*100)/$totalClassNo;
                                       $present_perchatage_is = number_format($present_perchatage,2);
                                       $absent_perchatage   = ($absent*100)/$totalClassNo;
                                      $absent_perchatage_is = number_format($absent_perchatage,2);
                                fputcsv($output, array($i++,$value->roll,$value->registration,$totalClassNo,$present,$absent,$present_perchatage_is,$absent_perchatage_is));


          
        }

    }
    // csv datewise class wise student attendent report
    public function csvDatewiseClasswiseAttendentReport(Request $request)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=periodic_student_class_wise_attendent_report.csv');
        $output = fopen('php://output', 'w');
        $report_created = "REPORT CREATED : ".date('d M Y, h:i:s A');
        $setting     = DB::table('setting')->first();
        $year        = trim($request->year) ;
        $shift       = trim($request->shift);
        $dept        = trim($request->dept);
        $semister    = trim($request->semister);
        $section     = trim($request->section);
        $date_form   = trim($request->from); 
        $from        = date ("Y-m-d", strtotime($date_form));
        $date_to     = trim($request->to); 
        $date_too     = trim($request->to);
        $to          = date ("Y-m-d", strtotime($date_to));
        $result = DB::table('student')->where('year',$year)->where('shift_id',$shift)->where('dept_id', $dept )->where('semister_id',$semister)->where('section_id',$section)->orderBy('roll','asc')->get();
      #----------------total holiday without friday class calculation-------------------#
        $get_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereNotIn('type',[1])
                         ->whereBetween('holiday_date', [$from, $to])->get();

  
  $total_holiday_class = 0 ;
  foreach ($get_holiday as $holidays) {
  $day_no =  date('D', strtotime($holidays->holiday_date));
  //echo $day_no;
if($day_no == 'Sat'){
 $day = '1';
}elseif($day_no == 'Sun'){
  $day = '2';
}elseif($day_no == 'Mon'){
     $day = '3';
}elseif($day_no == 'Tue'){
     $day = '4';
}elseif($day_no == 'Wed'){
     $day = '5';
}elseif($day_no == 'Thu'){
     $day = '6';
}elseif($day_no == 'Fri'){
     $day = '7';
}
// count total holiday class
$holiday_total_class = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day)->count();
$total_holiday_class = $total_holiday_class+$holiday_total_class;
 }
#-----------------end total holiday class calulation---------------------#
// total holiday 
 $get_all_holiday =  DB::table('holiday')
                    ->where('year',$year)
                    ->whereBetween('holiday_date', [$from, $to])->get(['holiday_date']);
                   $data = array();
                   foreach ($get_all_holiday as $data1) {
                     $data[] = $data1->holiday_date;
                   }
$date_from = strtotime($from); 
$date_to = strtotime($to); 
$list = array();
for ($i=$date_from; $i<=$date_to; $i+=86400) {  
    $list[] = date("Y-m-d", $i);  
}  
$total_class_day = array_diff($list,$data);
$totalClassNo = 0 ; 
foreach ($total_class_day as $total_class_days) {
  $class_day_no =  date('D', strtotime($total_class_days));
  if($class_day_no == 'Sat'){
 $day_number = '1';
}elseif($class_day_no == 'Sun'){
  $day_number = '2';
}elseif($class_day_no == 'Mon'){
     $day_number = '3';
}elseif($class_day_no == 'Tue'){
     $day_number = '4';
}elseif($class_day_no == 'Wed'){
     $day_number = '5';
}elseif($class_day_no == 'Thu'){
     $day_number = '6';
}elseif($class_day_no == 'Fri'){
     $day_number = '7';
}
// count total holiday class
$count_total_class_month = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day_number)->count();
$totalClassNo = $totalClassNo+$count_total_class_month;
}
         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();

         $date_range_is = date ("d M Y", strtotime($from)).' To '.date("d M Y", strtotime($to));

        fputcsv($output, array('','','',$setting->full_name,'','','',''));
        fputcsv($output, array('','','',$setting->address,'','','',''));
        fputcsv($output, array('','','','Mobile : '.$setting->mobile,'','','',''));
        fputcsv($output, array('','','','','','','',''));
        fputcsv($output, array('','','','PERIODIC CLASS WISE STUDENT ATTENDENT REPORT','','','',''));

        fputcsv($output, array('','','','YEAR : '.$year,'','','',''));
        fputcsv($output, array('','','','SHIFT : '.$shift_name->shiftName,'','','',''));
        fputcsv($output, array('','','','DEPARTMENT NAME : '.$dept_name->departmentName,'','','',''));
        fputcsv($output, array('','','','SECTION : '.$section_name->section_name,'','','',''));
        fputcsv($output, array('','','','DATE RANGE : '.$date_range_is,'','','',''));
        fputcsv($output, array('','','','HOLIDAYS SUBJECT CLASS: '.$total_holiday_class,'','','',''));
        fputcsv($output, array('','','',$report_created,'','','',''));
        fputcsv($output, array('','','','','','','',''));
        fputcsv($output, array('SL NO','ROLL','REGISTRATION','TOTAL SUBJECTS CLASS','PRESENT SUBJECT CLASS','ABSENT SUBJECT CLASS ','PRESENT SUBJECT CLASS %','ABSENT SUBJECT CLASS %'));
        $i = 1 ;
        foreach ($result as $value) {

            $present        = DB::table('student_attendent')
                                      ->where('year',$value->year)
                                      ->where('section_id',$value->section_id)
                                      ->where('shift_id',$value->shift_id)
                                      ->where('dept_id',$value->dept_id)
                                      ->where('semister_id',$value->semister_id)
                                      ->where('roll',$value->roll)
                                      ->whereBetween('created_at', [$from, $to])
                                      ->count();
                                $absent =  $totalClassNo - $present ;

                                if($totalClassNo == '0'){

                                      }else{
                                      $present_perchatage   = ($present*100)/$totalClassNo;
                                    $present_perchatage_is= number_format($present_perchatage,2).'%';
                                    }
                                    if($totalClassNo == '0'){

                                      }else{
                                      $absent_perchatage   = ($absent*100)/$totalClassNo;
                                      $absent_perchatage_is= number_format($absent_perchatage,2).'%';
                                    }

                        fputcsv($output, array($i++,$value->roll,$value->registration,$totalClassNo,$present,$absent,$present_perchatage_is,$absent_perchatage_is));

     
        }

    }
    // csv daily door student attendent report
    public function csvDailyStudentDoorReport(Request $request)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=daily_student_door_report.csv');
        $output = fopen('php://output', 'w');
        $report_created = "REPORT CREATED : ".date('d M Y, h:i:s A');
        $setting     = DB::table('setting')->first();
        $year     = trim($request->year) ;
        $shift    = trim($request->shift);
        $dept     = trim($request->dept);
        $semister = trim($request->semister);
        $section  = trim($request->section);
        $from_date   = trim($request->from); 
        $from        = date ("Y-m-d", strtotime($from_date));
          if($from > $this->rcdate1){
          echo 'f1';
          exit();
        }
        // get door holiday
        $door_holiday_count = DB::table('holiday')->where('door_holiday',0)->where('holiday_date',$from)->count();
        if($door_holiday_count > 0){
          echo 'f2';
          exit();
        }
         $count_student = DB::table('student')->where('year',$year)->where('shift_id',$shift)->where('dept_id', $dept )->where('semister_id',$semister)->where('section_id',$section)->orderBy('roll','asc')->count();
         // total student present
         $total_present_student = DB::table('tbl_door_log')->where('year',$year)->where('shift_id',$shift)->where('dep_id', $dept )->where('semister_id',$semister)->where('section_id',$section)->where('enter_date',$from)->groupBy('student_id')->count();
     
        // get student
        $result = DB::table('student')->where('year',$year)->where('shift_id',$shift)->where('dept_id', $dept )->where('semister_id',$semister)->where('section_id',$section)->orderBy('roll','asc')->get();
         $shift_name    = DB::table('shift')->where('id',$shift)->first();
         $dept_name     = DB::table('department')->where('id',$dept)->first();
         $semister_name = DB::table('semister')->where('id',$semister)->first();
         $section_name  = DB::table('section')->where('id',$section)->first();

         $absent_student_is = $count_student - $total_present_student ;
        fputcsv($output, array('','','',$setting->full_name,'','','',''));
        fputcsv($output, array('','','',$setting->address,'','','',''));
        fputcsv($output, array('','','','Mobile : '.$setting->mobile,'','','',''));
        fputcsv($output, array('','','','','','','',''));
        fputcsv($output, array('','','','DAILY STUDENT DOOR ATTENDENT REPORT','','','',''));

        fputcsv($output, array('','','','YEAR : '.$year,'','','',''));
        fputcsv($output, array('','','','SHIFT : '.$shift_name->shiftName,'','','',''));
        fputcsv($output, array('','','','DEPARTMENT NAME : '.$dept_name->departmentName,'','','',''));
        fputcsv($output, array('','','','SECTION : '.$section_name->section_name,'','','',''));
        fputcsv($output, array('','','','DATE : '.date('d-M-Y',strtotime($from_date)),'','','',''));
        fputcsv($output, array('','','','TOTAL STUDENTS : '.$count_student,'','','',''));
        fputcsv($output, array('','','','PRESENTS : '.$total_present_student,'','','',''));
        fputcsv($output, array('','','','ABSENTS : '.$absent_student_is,'','','',''));
        fputcsv($output, array('','','',$report_created,'','','',''));
        fputcsv($output, array('','','','','','','',''));
        fputcsv($output, array('SL NO','NAME','ROLL','REGISTRATION','MOBILE','STATUS','FIRST ENTER','ENTER NUMBER ','ENTER TIME'));
        $i = 1 ;
        foreach ($result as $value) {
              $student_info = DB::table('students')->where('id',$value->studentID)->first();
              $present        = DB::table('tbl_door_log')
                                      ->where('student_id',$value->studentID)
                                      ->where('enter_date',$from)
                                      ->orderBy('enter_time','asc')
                                      ->get();
                                      $prsent_status =  count($present) ;
                                      if($prsent_status > 0){
                                       $attendent_status_is = "PRESENT";
                                     }else{
                                       $attendent_status_is = "ABSENT";
                                     }

                                   if($prsent_status > 0){ 
                                     $present_time = DB::table('tbl_door_log')
                                      ->where('student_id',$value->studentID)
                                      ->where('enter_date',$from)
                                      ->orderBy('enter_time','asc')
                                      ->first();
                                      $present_time_is =  date('h:i:s a',strtotime($present_time->enter_time));
                                    }else{
                                         $present_time_is = '';
                                     
                                    }

                                        if($prsent_status > 0){ 
                                     $multiple_enter_time_value = array();
                                     foreach ($present as $present_time_value) { 
                                     $multiple_enter_time_value[] = date('h:i:s a',strtotime($present_time_value->enter_time)) ; 
                                      }

                                      $multiple_enter_time_value_implode = implode(',',$multiple_enter_time_value) ;
                                    }else{
                                      $multiple_enter_time_value_implode = '';
                                    }

                     fputcsv($output, array($i++,$student_info->studentName,$value->roll,$value->registration,$student_info->studentMobile,$attendent_status_is,$present_time_is,$prsent_status,$multiple_enter_time_value_implode));




           }
     

    }

    // csv student list for superadmin
    public function csvStudentListforSuperAdmin(Request $request)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=student_list.csv');
        $output = fopen('php://output', 'w');
        $report_created = "REPORT CREATED : ".date('d M Y, h:i:s A');
        $setting     = DB::table('setting')->first();

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
        foreach ($data as $value1) { }
        if($dep_id != ''){ $dept_is = $value1->departmentName; }else{ $dept_is = "All"; }
        if($shift != ''){ $shift_is = $value1->shiftName; }else{ $shift_is = "All"; }
        if($semister != ''){ $semister_is = $value1->semisterName; }else{ $semister_is = "All"; }
        if($section != ''){ $section_is = $value1->section_name; }else{ $section_is = "All"; }

        fputcsv($output, array('','','',$setting->full_name,'','','',''));
        fputcsv($output, array('','','',$setting->address,'','','',''));
        fputcsv($output, array('','','','Mobile : '.$setting->mobile,'','','',''));
        fputcsv($output, array('','','','','','','',''));
        fputcsv($output, array('','','','STUDENT LIST','','','',''));

        fputcsv($output, array('','','','YEAR : '.$year,'','','',''));
        fputcsv($output, array('','','','DEPARTMENT NAME : '.$dept_is,'','','',''));
        fputcsv($output, array('','','','SHIFT : '.$shift_is,'','','',''));
        fputcsv($output, array('','','','SEMESTER : '.$semister_is,'','','',''));
        fputcsv($output, array('','','','SECTION : '.$section_is,'','','',''));
        fputcsv($output, array('','','',$report_created,'','','',''));
        fputcsv($output, array('','','','','','','',''));
        fputcsv($output, array('SL NO','SESSION','NAME','DEPT','SHIFT','SEMISTER','SECTION','ROLL','REGISTRATION','MOBILE'));
        $i = 1;
        foreach ($data as $value) {
           fputcsv($output, array($i++,$value->sessionName,$value->studentName,$value->departmentName,$value->shiftName,$value->semisterName,$value->section_name,$value->roll,$value->registration,$value->studentMobile));
        }
    }

    // csv periodic class wise percentage present list
    public function csvPeriodicClassWisePercentagePresentList(Request $request)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=periodic_classwise_percentage_present_list.csv');
        $output = fopen('php://output', 'w');
        $report_created = "REPORT CREATED : ".date('d M Y, h:i:s A');
        $setting     = DB::table('setting')->first();

        $year        = trim($request->year) ;
        $shift       = trim($request->shift);
        $dept        = trim($request->dept);
        $semister    = trim($request->semister);
        $section     = trim($request->section);
        $date_form   = trim($request->from); 
        $from        = date ("Y-m-d", strtotime($date_form));
        $date_to     = trim($request->to); 
        $date_too    = trim($request->to);
        $to          = date ("Y-m-d", strtotime($date_to));
        $sorting_type = trim($request->sorting_type);
        $percentage_class_number = trim($request->percentage_class_number);

       $get_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereNotIn('type',[1])
                         ->whereBetween('holiday_date', [$from, $to])->get();
  $total_holiday_class = 0 ;
  foreach ($get_holiday as $holidays) {
  $day_no =  date('D', strtotime($holidays->holiday_date));
  //echo $day_no;
if($day_no == 'Sat'){
 $day = '1';
}elseif($day_no == 'Sun'){
  $day = '2';
}elseif($day_no == 'Mon'){
     $day = '3';
}elseif($day_no == 'Tue'){
     $day = '4';
}elseif($day_no == 'Wed'){
     $day = '5';
}elseif($day_no == 'Thu'){
     $day = '6';
}elseif($day_no == 'Fri'){
     $day = '7';
}
// count total holiday class
$holiday_total_class = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day)->count();
$total_holiday_class = $total_holiday_class+$holiday_total_class;
 }
#-----------------end total holiday class calulation---------------------#
  // total holiday 
 $get_all_holiday =  DB::table('holiday')
                    ->where('year',$year)
                    ->whereBetween('holiday_date', [$from, $to])->get(['holiday_date']);
                   $data = array();
                   foreach ($get_all_holiday as $data1) {
                     $data[] = $data1->holiday_date;
                   }

$date_from = strtotime($from); 
$date_to = strtotime($to); 
$list = array();
for ($i=$date_from; $i<=$date_to; $i+=86400) {  
    $list[] = date("Y-m-d", $i);  
}  
$total_class_day = array_diff($list,$data);
$totalClassNo = 0 ; 
foreach ($total_class_day as $total_class_days) {
  $class_day_no =  date('D', strtotime($total_class_days));
  if($class_day_no == 'Sat'){
 $day_number = '1';
}elseif($class_day_no == 'Sun'){
  $day_number = '2';
}elseif($class_day_no == 'Mon'){
     $day_number = '3';
}elseif($class_day_no == 'Tue'){
     $day_number = '4';
}elseif($class_day_no == 'Wed'){
     $day_number = '5';
}elseif($class_day_no == 'Thu'){
     $day_number = '6';
}elseif($class_day_no == 'Fri'){
     $day_number = '7';
}
// count total holiday class
$count_total_class_month = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day_number)->count();
$totalClassNo = $totalClassNo+$count_total_class_month;
}
   if($sorting_type == '1'){
  $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
      ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT(student_attendent.studentId) * 100 /".$totalClassNo." AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
       ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('student_attendent.roll','ASC')
      ->get();
    }elseif($sorting_type == '2'){
      $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
      ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT(student_attendent.studentId) * 100 /".$totalClassNo." AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
       ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','DESC')
      ->orderBy('student_attendent.roll','ASC')
      ->get();
    }elseif($sorting_type == '3'){
       $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
      ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT(student_attendent.studentId) * 100 /".$totalClassNo." AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
       ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','DESC')
      ->orderBy('student_attendent.roll','ASC')
      ->get();
    }

    foreach($result as $value) {
    //do something
    $attentdent_id[] = $value->studentId;
}
$absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
        ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
   ->whereNotIn('student.studentID',$attentdent_id)
   ->orderBy('student.roll','asc')
   ->get();

    $shift_name    = DB::table('shift')->where('id',$shift)->first();
    $dept_name     = DB::table('department')->where('id',$dept)->first();
    $semister_name = DB::table('semister')->where('id',$semister)->first();
    $section_name  = DB::table('section')->where('id',$section)->first();

    if($sorting_type == '1'){
    $sorting_type_is = "Equal";
    }elseif($sorting_type == '2'){
    $sorting_type_is = "Morethan";
    }elseif($sorting_type == '3'){
    $sorting_type_is = "Lessthan";
    }
    $explode = explode('.', $percentage_class_number) ;
    $percentage_class_number_is = $explode[0].' %' ;
    $date_range = date ("d M Y", strtotime($from)).' To '.date("d M Y", strtotime($to));

    fputcsv($output, array('','','',$setting->full_name,'','','',''));
    fputcsv($output, array('','','',$setting->address,'','','',''));
    fputcsv($output, array('','','','Mobile : '.$setting->mobile,'','','',''));
    fputcsv($output, array('','','','','','','',''));
    fputcsv($output, array('','','','PERIODIC CLASS WISE PERCENTAGE PRESENT LIST','','','',''));

    fputcsv($output, array('','','','YEAR : '.$year,'','','',''));
    fputcsv($output, array('','','','SHIFT : '.$shift_name->shiftName,'','','',''));
    fputcsv($output, array('','','','DEPARTMENT NAME : '.$dept_name->departmentName,'','','',''));
    fputcsv($output, array('','','','SEMESTER : '.$semister_name->semisterName,'','','',''));
    fputcsv($output, array('','','','SECTION : '.$section_name->section_name,'','','',''));
    fputcsv($output, array('','','','DATE RANGE : '.$date_range,'','','',''));
    fputcsv($output, array('','','','TOTAL SUBJECTS CLASS : '.$totalClassNo,'','','',''));
    fputcsv($output, array('','','','HOLIDAYS SUBJECTS CLASS : '.$total_holiday_class,'','','',''));
    fputcsv($output, array('','','','SORTING TYPE : '.$sorting_type_is,'','','',''));
    fputcsv($output, array('','','','SORTING PERCENTAGE : '.$percentage_class_number_is,'','','',''));
    fputcsv($output, array('','','',$report_created,'','','',''));
    fputcsv($output, array('','','','','','','',''));

    fputcsv($output, array('SL NO','TOP RANK','ROLL','REGISTRATION','PRESENT SUBJECT CLASS','PRESENT SUBJECT CLASS %'));

      $i = 1;
      $j = 1;
      foreach ($result as $value) {
          if($sorting_type == '1' AND $percentage_class_number == $value->count){
            $present = DB::table('student_attendent')
                    ->where('year',$value->year)
                    ->where('section_id',$value->section_id)
                    ->where('shift_id',$value->shift_id)
                    ->where('dept_id',$value->dept_id)
                    ->where('semister_id',$value->semister_id)
                    ->where('roll',$value->roll)
                    ->whereBetween('created_at', [$from, $to])
                    ->count();
            if($totalClassNo == '0'){

            }else{
              $present_perchatage   = ($present*100)/$totalClassNo;
              $present_perchatage_is = number_format($present_perchatage,2).'%';
            }
            fputcsv($output, array($i++,$j++,$value->roll,$value->registration,$present,$present_perchatage_is));
          }elseif($sorting_type == '2' AND $percentage_class_number < $value->count){
                $present = DB::table('student_attendent')
                  ->where('year',$value->year)
                  ->where('section_id',$value->section_id)
                  ->where('shift_id',$value->shift_id)
                  ->where('dept_id',$value->dept_id)
                  ->where('semister_id',$value->semister_id)
                  ->where('roll',$value->roll)
                  ->whereBetween('created_at', [$from, $to])
                  ->count();
              if($totalClassNo == '0'){ }else{
                $present_perchatage   = ($present*100)/$totalClassNo;
                $present_perchatage_is = number_format($present_perchatage,2).'%';
              }
              fputcsv($output, array($i++,$j++,$value->roll,$value->registration,$present,$present_perchatage_is));
          }elseif($sorting_type == '3' AND $percentage_class_number > $value->count){
            $present = DB::table('student_attendent')
                  ->where('year',$value->year)
                  ->where('section_id',$value->section_id)
                  ->where('shift_id',$value->shift_id)
                  ->where('dept_id',$value->dept_id)
                  ->where('semister_id',$value->semister_id)
                  ->where('roll',$value->roll)
                  ->whereBetween('created_at', [$from, $to])
                  ->count();
              if($totalClassNo == '0'){ }else{
                $present_perchatage   = ($present*100)/$totalClassNo;
                $present_perchatage_is = number_format($present_perchatage,2).'%';
              }
              fputcsv($output, array($i++,$j++,$value->roll,$value->registration,$present,$present_perchatage_is));
          }
      }
      if($sorting_type == '1' AND $percentage_class_number == '0'){
        foreach ($absent_result as $absent_value) {
            fputcsv($output, array($i++,$j++,$absent_value->roll,$absent_value->registration,"0","0.00 %"));
        }
      }elseif($sorting_type == '3'){
        foreach ($absent_result as $absent_value) {
            fputcsv($output, array($i++,$j++,$absent_value->roll,$absent_value->registration,"0","0.00 %"));
        }
      }


  }

    // csv periodic class wise percentage absent list
    public function csvPeriodicClassWisePercentageAbsentList(Request $request)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=periodic_classwise_percentage_absent_list.csv');
        $output = fopen('php://output', 'w');
        $report_created = "REPORT CREATED : ".date('d M Y, h:i:s A');
        $setting     = DB::table('setting')->first();

        $year        = trim($request->year) ;
        $shift       = trim($request->shift);
        $dept        = trim($request->dept);
        $semister    = trim($request->semister);
        $section     = trim($request->section);
        $date_form   = trim($request->from); 
        $from        = date ("Y-m-d", strtotime($date_form));
        $date_to     = trim($request->to); 
        $date_too    = trim($request->to);
        $to          = date ("Y-m-d", strtotime($date_to));
        $sorting_type = trim($request->sorting_type);
        $percentage_class_number = trim($request->percentage_class_number);

       $get_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereNotIn('type',[1])
                         ->whereBetween('holiday_date', [$from, $to])->get();
  $total_holiday_class = 0 ;
  foreach ($get_holiday as $holidays) {
  $day_no =  date('D', strtotime($holidays->holiday_date));
  //echo $day_no;
if($day_no == 'Sat'){
 $day = '1';
}elseif($day_no == 'Sun'){
  $day = '2';
}elseif($day_no == 'Mon'){
     $day = '3';
}elseif($day_no == 'Tue'){
     $day = '4';
}elseif($day_no == 'Wed'){
     $day = '5';
}elseif($day_no == 'Thu'){
     $day = '6';
}elseif($day_no == 'Fri'){
     $day = '7';
}
// count total holiday class
$holiday_total_class = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day)->count();
$total_holiday_class = $total_holiday_class+$holiday_total_class;
 }
#-----------------end total holiday class calulation---------------------#
  // total holiday 
 $get_all_holiday =  DB::table('holiday')
                    ->where('year',$year)
                    ->whereBetween('holiday_date', [$from, $to])->get(['holiday_date']);
                   $data = array();
                   foreach ($get_all_holiday as $data1) {
                     $data[] = $data1->holiday_date;
                   }

$date_from = strtotime($from); 
$date_to = strtotime($to); 
$list = array();
for ($i=$date_from; $i<=$date_to; $i+=86400) {  
    $list[] = date("Y-m-d", $i);  
}  
$total_class_day = array_diff($list,$data);
$totalClassNo = 0 ; 
foreach ($total_class_day as $total_class_days) {
  $class_day_no =  date('D', strtotime($total_class_days));
  if($class_day_no == 'Sat'){
 $day_number = '1';
}elseif($class_day_no == 'Sun'){
  $day_number = '2';
}elseif($class_day_no == 'Mon'){
     $day_number = '3';
}elseif($class_day_no == 'Tue'){
     $day_number = '4';
}elseif($class_day_no == 'Wed'){
     $day_number = '5';
}elseif($class_day_no == 'Thu'){
     $day_number = '6';
}elseif($class_day_no == 'Fri'){
     $day_number = '7';
}
// count total holiday class
$count_total_class_month = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day_number)->count();
$totalClassNo = $totalClassNo+$count_total_class_month;
}
   if($sorting_type == '1'){
  $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
      ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT(student_attendent.studentId) * 100 /".$totalClassNo." AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
       ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('student_attendent.roll','ASC')
      ->get();
    }elseif($sorting_type == '2'){
      $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
      ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT(student_attendent.studentId) * 100 /".$totalClassNo." AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
       ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','ASC')
      ->orderBy('student_attendent.roll','ASC')
      ->get();
    }elseif($sorting_type == '3'){
       $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
      ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT(student_attendent.studentId) * 100 /".$totalClassNo." AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
       ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','ASC')
      ->orderBy('student_attendent.roll','ASC')
      ->get();
    }

    foreach($result as $value) {
    //do something
    $attentdent_id[] = $value->studentId;
}
$absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
        ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
   ->whereNotIn('student.studentID',$attentdent_id)
   ->orderBy('student.roll','asc')
   ->get();

    $shift_name    = DB::table('shift')->where('id',$shift)->first();
    $dept_name     = DB::table('department')->where('id',$dept)->first();
    $semister_name = DB::table('semister')->where('id',$semister)->first();
    $section_name  = DB::table('section')->where('id',$section)->first();

    if($sorting_type == '1'){
    $sorting_type_is = "Equal";
    }elseif($sorting_type == '2'){
    $sorting_type_is = "Morethan";
    }elseif($sorting_type == '3'){
    $sorting_type_is = "Lessthan";
    }
    $explode = explode('.', $percentage_class_number) ;
    $percentage_class_number_is = $explode[0].' %' ;
    $date_range = date ("d M Y", strtotime($from)).' To '.date("d M Y", strtotime($to));

    fputcsv($output, array('','','',$setting->full_name,'','','',''));
    fputcsv($output, array('','','',$setting->address,'','','',''));
    fputcsv($output, array('','','','Mobile : '.$setting->mobile,'','','',''));
    fputcsv($output, array('','','','','','','',''));
    fputcsv($output, array('','','','PERIODIC CLASS WISE PERCENTAGE ABSENT LIST','','','',''));

    fputcsv($output, array('','','','YEAR : '.$year,'','','',''));
    fputcsv($output, array('','','','SHIFT : '.$shift_name->shiftName,'','','',''));
    fputcsv($output, array('','','','DEPARTMENT NAME : '.$dept_name->departmentName,'','','',''));
    fputcsv($output, array('','','','SEMESTER : '.$semister_name->semisterName,'','','',''));
    fputcsv($output, array('','','','SECTION : '.$section_name->section_name,'','','',''));
    fputcsv($output, array('','','','DATE RANGE : '.$date_range,'','','',''));
    fputcsv($output, array('','','','TOTAL SUBJECTS CLASS : '.$totalClassNo,'','','',''));
    fputcsv($output, array('','','','HOLIDAYS SUBJECTS CLASS : '.$total_holiday_class,'','','',''));
    fputcsv($output, array('','','','SORTING TYPE : '.$sorting_type_is,'','','',''));
    fputcsv($output, array('','','','SORTING PERCENTAGE : '.$percentage_class_number_is,'','','',''));
    fputcsv($output, array('','','',$report_created,'','','',''));
    fputcsv($output, array('','','','','','','',''));

    fputcsv($output, array('SL NO','TOP RANK','ROLL','REGISTRATION','ABSENT SUBJECT CLASS','ABSENT SUBJECT CLASS %'));

    $i = 1;
    $j = 1;
    foreach ($result as $value) {
        if($sorting_type == '1' AND $percentage_class_number == 100 - $value->count){
                $present = DB::table('student_attendent')
                    ->where('year',$value->year)
                    ->where('section_id',$value->section_id)
                    ->where('shift_id',$value->shift_id)
                    ->where('dept_id',$value->dept_id)
                    ->where('semister_id',$value->semister_id)
                    ->where('roll',$value->roll)
                    ->whereBetween('created_at', [$from, $to])
                    ->count();
                    $absent = $totalClassNo - $present ;
                if($totalClassNo == '0'){  }else{
                  $absent_perchatage   = ($absent*100)/$totalClassNo;
                  $absent_perchatage_is = number_format($absent_perchatage,2).'%';
                }
            fputcsv($output, array($i++,$j++,$value->roll,$value->registration,$absent,$absent_perchatage_is));
        }elseif($sorting_type == '2' AND $percentage_class_number < 100 - $value->count){
                $present  = DB::table('student_attendent')
                    ->where('year',$value->year)
                    ->where('section_id',$value->section_id)
                    ->where('shift_id',$value->shift_id)
                    ->where('dept_id',$value->dept_id)
                    ->where('semister_id',$value->semister_id)
                    ->where('roll',$value->roll)
                    ->whereBetween('created_at', [$from, $to])
                    ->count();
                     $absent = $totalClassNo - $present ;
                  if($totalClassNo == '0'){  }else{
                  $absent_perchatage   =($absent*100)/$totalClassNo;
                  $absent_perchatage_is = number_format($absent_perchatage,2).'%';
                  }
              fputcsv($output, array($i++,$j++,$value->roll,$value->registration,$absent,$absent_perchatage_is));
        }elseif($sorting_type == '3' AND $percentage_class_number > 100 - $value->count){
            $present  = DB::table('student_attendent')
                    ->where('year',$value->year)
                    ->where('section_id',$value->section_id)
                    ->where('shift_id',$value->shift_id)
                    ->where('dept_id',$value->dept_id)
                    ->where('semister_id',$value->semister_id)
                    ->where('roll',$value->roll)
                    ->whereBetween('created_at', [$from, $to])
                    ->count();
                     $absent = $totalClassNo - $present ;
                  if($totalClassNo == '0'){  }else{
                  $absent_perchatage   =($absent*100)/$totalClassNo;
                  $absent_perchatage_is = number_format($absent_perchatage,2).'%';
                  }
            fputcsv($output, array($i++,$j++,$value->roll,$value->registration,$absent,$absent_perchatage_is));
        }
    }

    if($sorting_type == '1' AND $percentage_class_number == '100'){
      foreach ($absent_result as $absent_value) {
          fputcsv($output, array($i++,$j++,$absent_value->roll,$absent_value->registration,"100","100.00 %"));
      }
    }elseif($sorting_type == '2'){
      foreach ($absent_result as $absent_value) {
          fputcsv($output, array($i++,$j++,$absent_value->roll,$absent_value->registration,"100","100.00 %"));
      }
    }

    }

    // csv periodic class wise top present list
    public function csvPeriodicClassWiseTopPresentList(Request $request)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=periodic_classwise_top_present_list.csv');
        $output = fopen('php://output', 'w');
        $report_created = "REPORT CREATED : ".date('d M Y, h:i:s A');
        $setting     = DB::table('setting')->first();

      $year        = trim($request->year) ;
      $shift       = trim($request->shift);
      $dept        = trim($request->dept);
      $semister    = trim($request->semister);
      $section     = trim($request->section);
      $date_form   = trim($request->from); 
      $from        = date ("Y-m-d", strtotime($date_form));
      $date_to     = trim($request->to); 
      $date_too    = trim($request->to);
      $to          = date ("Y-m-d", strtotime($date_to));

     $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
      ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT(student_attendent.studentId) AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
       ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','DESC')
      ->orderBy('student_attendent.roll','ASC')
      ->get();

       $get_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereNotIn('type',[1])
                         ->whereBetween('holiday_date', [$from, $to])->get();

  
  $total_holiday_class = 0 ;
  foreach ($get_holiday as $holidays) {
  $day_no =  date('D', strtotime($holidays->holiday_date));
  //echo $day_no;
if($day_no == 'Sat'){
 $day = '1';
}elseif($day_no == 'Sun'){
  $day = '2';
}elseif($day_no == 'Mon'){
     $day = '3';
}elseif($day_no == 'Tue'){
     $day = '4';
}elseif($day_no == 'Wed'){
     $day = '5';
}elseif($day_no == 'Thu'){
     $day = '6';
}elseif($day_no == 'Fri'){
     $day = '7';
}
// count total holiday class
$holiday_total_class = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day)->count();
$total_holiday_class = $total_holiday_class+$holiday_total_class;
 }
#-----------------end total holiday class calulation---------------------#
  // total holiday 
 $get_all_holiday = DB::table('holiday')
                    ->where('year',$year)
                    ->whereBetween('holiday_date', [$from, $to])->get(['holiday_date']);
                   $data = array();
                   foreach ($get_all_holiday as $data1) {
                     $data[] = $data1->holiday_date;
                   }

   
$date_from = strtotime($from); 
$date_to = strtotime($to); 
$list = array();
for ($i=$date_from; $i<=$date_to; $i+=86400) {  
    $list[] = date("Y-m-d", $i);  
}  
$total_class_day = array_diff($list,$data);
$totalClassNo = 0 ; 
foreach ($total_class_day as $total_class_days) {
  $class_day_no =  date('D', strtotime($total_class_days));
  if($class_day_no == 'Sat'){
 $day_number = '1';
}elseif($class_day_no == 'Sun'){
  $day_number = '2';
}elseif($class_day_no == 'Mon'){
     $day_number = '3';
}elseif($class_day_no == 'Tue'){
     $day_number = '4';
}elseif($class_day_no == 'Wed'){
     $day_number = '5';
}elseif($class_day_no == 'Thu'){
     $day_number = '6';
}elseif($class_day_no == 'Fri'){
     $day_number = '7';
}
// count total holiday class
$count_total_class_month = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day_number)->count();
$totalClassNo = $totalClassNo+$count_total_class_month;
}

foreach($result as $value) {
    //do something
    $attentdent_id[] = $value->studentId;
}
$absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
        ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
   ->whereNotIn('student.studentID',$attentdent_id)
   ->orderBy('student.roll','asc')
   ->get();

     $shift_name    = DB::table('shift')->where('id',$shift)->first();
     $dept_name     = DB::table('department')->where('id',$dept)->first();
     $semister_name = DB::table('semister')->where('id',$semister)->first();
     $section_name  = DB::table('section')->where('id',$section)->first();
     $date_range = date ("d M Y", strtotime($from)).' To '.date("d M Y", strtotime($to));

    fputcsv($output, array('','','',$setting->full_name,'','','',''));
    fputcsv($output, array('','','',$setting->address,'','','',''));
    fputcsv($output, array('','','','Mobile : '.$setting->mobile,'','','',''));
    fputcsv($output, array('','','','','','','',''));
    fputcsv($output, array('','','','PERIODIC CLASS WISE STUDENT TOP PRESENT LIST','','','',''));

    fputcsv($output, array('','','','YEAR : '.$year,'','','',''));
    fputcsv($output, array('','','','SHIFT : '.$shift_name->shiftName,'','','',''));
    fputcsv($output, array('','','','DEPARTMENT NAME : '.$dept_name->departmentName,'','','',''));
    fputcsv($output, array('','','','SEMESTER : '.$semister_name->semisterName,'','','',''));
    fputcsv($output, array('','','','SECTION : '.$section_name->section_name,'','','',''));
    fputcsv($output, array('','','','DATE RANGE : '.$date_range,'','','',''));
    fputcsv($output, array('','','','TOTAL SUBJECTS CLASS (With out Holiday) : '.$totalClassNo,'','','',''));
    fputcsv($output, array('','','','HOLIDAYS SUBJECTS CLASS : '.$total_holiday_class,'','','',''));
    fputcsv($output, array('','','',$report_created,'','','',''));
    fputcsv($output, array('','','','','','','',''));

    fputcsv($output, array('SL NO','TOP RANK','ROLL','REGISTRATION','PRESENT SUBJECT CLASS','ABSENT SUBJECT CLASS','PRESENT SUBJECT CLASS %','ABSENT SUBJECT CLASS %'));

    $i = 1;
    $j = 1;
    foreach ($result as $value) {
        $present = $value->count ;
        $absent  =  $totalClassNo - $present ;
        if($totalClassNo == '0'){
        }else{
          $present_perchatage   = ($present*100)/$totalClassNo;
          $present_perchatage_is = number_format($present_perchatage,2).'%';
        }
        if($totalClassNo == '0'){
        }else{
          $absent_perchatage   = ($absent*100)/$totalClassNo;
          $absent_perchatage_is = number_format($absent_perchatage,2).'%';
        }

        fputcsv($output, array($i++,$j++,$value->roll,$value->registration,$present,$absent,$present_perchatage_is,$absent_perchatage_is));
    }
    foreach ($absent_result as $absent_value) {
        fputcsv($output, array($i++,$j++,$absent_value->roll,$absent_value->registration,"0",$totalClassNo,"0.00 %","100.00 %"));
    }



    }

    // csv periodic class wise top absent list
    public function csvPeriodicClassWiseTopAbsentList(Request $request)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=periodic_classwise_top_absent_list.csv');
        $output = fopen('php://output', 'w');
        $report_created = "REPORT CREATED : ".date('d M Y, h:i:s A');
        $setting     = DB::table('setting')->first();

        $year        = trim($request->year) ;
        $shift       = trim($request->shift);
        $dept        = trim($request->dept);
        $semister    = trim($request->semister);
        $section     = trim($request->section);
        $date_form   = trim($request->from); 
        $from        = date ("Y-m-d", strtotime($date_form));
        $date_to     = trim($request->to); 
        $date_too    = trim($request->to);
        $to          = date ("Y-m-d", strtotime($date_to));

     $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
      ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT(student_attendent.studentId) AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
       ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','ASC')
      ->orderBy('student_attendent.roll','ASC')
      ->get();

       $get_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereNotIn('type',[1])
                         ->whereBetween('holiday_date', [$from, $to])->get();

  
  $total_holiday_class = 0 ;
  foreach ($get_holiday as $holidays) {
  $day_no =  date('D', strtotime($holidays->holiday_date));
  //echo $day_no;
if($day_no == 'Sat'){
 $day = '1';
}elseif($day_no == 'Sun'){
  $day = '2';
}elseif($day_no == 'Mon'){
     $day = '3';
}elseif($day_no == 'Tue'){
     $day = '4';
}elseif($day_no == 'Wed'){
     $day = '5';
}elseif($day_no == 'Thu'){
     $day = '6';
}elseif($day_no == 'Fri'){
     $day = '7';
}
// count total holiday class
$holiday_total_class = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day)->count();
$total_holiday_class = $total_holiday_class+$holiday_total_class;
 }
#-----------------end total holiday class calulation---------------------#
  // total holiday 
 $get_all_holiday =  DB::table('holiday')
                    ->where('year',$year)
                    ->whereBetween('holiday_date', [$from, $to])->get(['holiday_date']);
                   $data = array();
                   foreach ($get_all_holiday as $data1) {
                     $data[] = $data1->holiday_date;
                   }

   
$date_from = strtotime($from); 
$date_to = strtotime($to); 
$list = array();
for ($i=$date_from; $i<=$date_to; $i+=86400) {  
    $list[] = date("Y-m-d", $i);  
}  
$total_class_day = array_diff($list,$data);
$totalClassNo = 0 ; 
foreach ($total_class_day as $total_class_days) {
  $class_day_no =  date('D', strtotime($total_class_days));
  if($class_day_no == 'Sat'){
 $day_number = '1';
}elseif($class_day_no == 'Sun'){
  $day_number = '2';
}elseif($class_day_no == 'Mon'){
     $day_number = '3';
}elseif($class_day_no == 'Tue'){
     $day_number = '4';
}elseif($class_day_no == 'Wed'){
     $day_number = '5';
}elseif($class_day_no == 'Thu'){
     $day_number = '6';
}elseif($class_day_no == 'Fri'){
     $day_number = '7';
}
// count total holiday class
$count_total_class_month = DB::table('routine')
->where('year',$year)
->where('shift_id',$shift)
->where('dept_id',$dept)
->where('semister_id',$semister)
->where('section_id',$section)
->where('day',$day_number)->count();
$totalClassNo = $totalClassNo+$count_total_class_month;
}
foreach($result as $value) {
    //do something
    $attentdent_id[] = $value->studentId;
}
$absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
        ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
   ->whereNotIn('student.studentID',$attentdent_id)
   ->orderBy('student.roll','asc')
   ->get();

    $shift_name    = DB::table('shift')->where('id',$shift)->first();
    $dept_name     = DB::table('department')->where('id',$dept)->first();
    $semister_name = DB::table('semister')->where('id',$semister)->first();
    $section_name  = DB::table('section')->where('id',$section)->first();
    $date_range = date ("d M Y", strtotime($from)).' To '.date("d M Y", strtotime($to));

    fputcsv($output, array('','','',$setting->full_name,'','','',''));
    fputcsv($output, array('','','',$setting->address,'','','',''));
    fputcsv($output, array('','','','Mobile : '.$setting->mobile,'','','',''));
    fputcsv($output, array('','','','','','','',''));
    fputcsv($output, array('','','','PERIODIC CLASS WISE STUDENT TOP ABSENT LIST','','','',''));

    fputcsv($output, array('','','','YEAR : '.$year,'','','',''));
    fputcsv($output, array('','','','SHIFT : '.$shift_name->shiftName,'','','',''));
    fputcsv($output, array('','','','DEPARTMENT NAME : '.$dept_name->departmentName,'','','',''));
    fputcsv($output, array('','','','SEMESTER : '.$semister_name->semisterName,'','','',''));
    fputcsv($output, array('','','','SECTION : '.$section_name->section_name,'','','',''));
    fputcsv($output, array('','','','DATE RANGE : '.$date_range,'','','',''));
    fputcsv($output, array('','','','TOTAL SUBJECTS CLASS (With out Holiday) : '.$totalClassNo,'','','',''));
    fputcsv($output, array('','','','HOLIDAYS SUBJECTS CLASS : '.$total_holiday_class,'','','',''));
    fputcsv($output, array('','','',$report_created,'','','',''));
    fputcsv($output, array('','','','','','','',''));

    fputcsv($output, array('SL NO','TOP RANK','ROLL','REGISTRATION','PRESENT SUBJECT CLASS','ABSENT SUBJECT CLASS','PRESENT SUBJECT CLASS %','ABSENT SUBJECT CLASS %'));

    $i = 1;
    $j = 1;
    foreach ($absent_result as $absent_value) {
        fputcsv($output, array($i++,$j++,$absent_value->roll,$absent_value->registration,"0",$totalClassNo,"0.00 %","100.00 %"));
    }

    foreach ($result as $value) {
        $present = $value->count ;
        $absent =  $totalClassNo - $present ;
        if($totalClassNo == '0'){  }else{
          $present_perchatage   = ($present*100)/$totalClassNo;
          $present_perchatage_is = number_format($present_perchatage,2).'%';
        }
        if($totalClassNo == '0'){  }else{
          $absent_perchatage   = ($absent*100)/$totalClassNo;
          $absent_perchatage_is = number_format($absent_perchatage,2).'%';
        }

        fputcsv($output, array($i++,$j++,$value->roll,$value->registration,$present,$absent,$present_perchatage_is,$absent_perchatage_is));
    }
    

    }

    // csv periodic student present list
    public function csvPeriodicStudentPresentList(Request $request)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=periodic_student_present_list.csv');
        $output = fopen('php://output', 'w');
        $report_created = "REPORT CREATED : ".date('d M Y, h:i:s A');
        $setting     = DB::table('setting')->first();

        $year        = trim($request->year);
        $shift       = trim($request->shift);
        $dept        = trim($request->dept);
        $semister    = trim($request->semister);
        $section     = trim($request->section);
        $date_form   = trim($request->from); 
        $from        = date ("Y-m-d", strtotime($date_form));
        $date_to     = trim($request->to); 
        $date_too    = trim($request->to);
        $to          = date ("Y-m-d", strtotime($date_to));
        $sorting_type = trim($request->sorting_type);
        $attendent_days = trim($request->attendent_days);

        $count_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereBetween('holiday_date', [$from, $to])->count();
        // total day caluclation
        $date1 = date_create($from);
        $date2 = date_create($to);
        //difference between two dates
        $diff       = date_diff($date1,$date2);
        $total_day  = $diff->format("%a")+1;
        if($sorting_type == '1'){
      $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
       ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT( DISTINCT student_attendent.created_at) AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
      ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('student_attendent.studentId','ASC')
      ->get();
    }elseif($sorting_type == '2'){
      $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
       ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT( DISTINCT student_attendent.created_at) AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
      ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','DESC')
      ->orderBy('student_attendent.studentId','ASC')
      ->get();
    }elseif($sorting_type == '3'){
         $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
       ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT( DISTINCT student_attendent.created_at) AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
      ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','DESC')
      ->orderBy('student_attendent.studentId','ASC')
      ->get();
    }

    foreach($result as $value) {
    //do something
    $attentdent_id[] = $value->studentId;
  }
$absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
        ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
   ->whereNotIn('student.studentID',$attentdent_id)
   ->orderBy('student.roll','asc')
   ->get();

    $shift_name    = DB::table('shift')->where('id',$shift)->first();
    $dept_name     = DB::table('department')->where('id',$dept)->first();
    $semister_name = DB::table('semister')->where('id',$semister)->first();
    $section_name  = DB::table('section')->where('id',$section)->first();
    $date_range = date ("d M Y", strtotime($from)).' To '.date("d M Y", strtotime($to));

    if($sorting_type == '1'){
      $sorting_type_is = "Equal";
    }elseif($sorting_type == '2'){
      $sorting_type_is = "Morethan";
    }elseif($sorting_type == '3'){
      $sorting_type_is = "Lessthan";
    } 

    fputcsv($output, array('','','',$setting->full_name,'','','',''));
    fputcsv($output, array('','','',$setting->address,'','','',''));
    fputcsv($output, array('','','','Mobile : '.$setting->mobile,'','','',''));
    fputcsv($output, array('','','','','','','',''));
    fputcsv($output, array('','','','PERIODIC STUDENT PRESENT ATTENDENT REPORT','','','',''));

    fputcsv($output, array('','','','YEAR : '.$year,'','','',''));
    fputcsv($output, array('','','','SHIFT : '.$shift_name->shiftName,'','','',''));
    fputcsv($output, array('','','','DEPARTMENT NAME : '.$dept_name->departmentName,'','','',''));
    fputcsv($output, array('','','','SEMESTER : '.$semister_name->semisterName,'','','',''));
    fputcsv($output, array('','','','SECTION : '.$section_name->section_name,'','','',''));
    fputcsv($output, array('','','','DATE RANGE : '.$date_range,'','','',''));
    fputcsv($output, array('','','','TOTAL DAYS : '.$total_day. " Days",'','','',''));
    fputcsv($output, array('','','','HOLIDAYS : '.$count_holiday." Days",'','','',''));
    fputcsv($output, array('','','','SORTING TYPE : '.$sorting_type_is,'','','',''));
    fputcsv($output, array('','','','SORTING DAYS : '.$attendent_days,'','','',''));
    fputcsv($output, array('','','',$report_created,'','','',''));
    fputcsv($output, array('','','','','','','',''));

    fputcsv($output, array('SL NO','TOP RANK','ROLL','REGISTRATION','TOTAL CLASS (DAYS)','PRESENT (DAYS)','PRESENT (DAYS) %'));

    $i = 1;
    $j = 1;
    foreach ($result as $value) {
        if($sorting_type == '1' AND $attendent_days == $value->count){
            $total_class_day = $total_day - $count_holiday ;
            $present_perchatage   = ($value->count*100)/$total_class_day;
            $present_perchatage_is = number_format($present_perchatage,2).'%';

            fputcsv($output, array($i++,$j++,$value->roll,$value->registration,$total_class_day,$value->count,$present_perchatage_is));
        }elseif($sorting_type == '2' AND $attendent_days < $value->count){
            $total_class_day = $total_day - $count_holiday ;
            $present_perchatage   = ($value->count*100)/$total_class_day;
            $present_perchatage_is = number_format($present_perchatage,2).'%';

            fputcsv($output, array($i++,$j++,$value->roll,$value->registration,$total_class_day,$value->count,$present_perchatage_is));
        }elseif($sorting_type == '3' AND $attendent_days > $value->count){
            $total_class_day = $total_day - $count_holiday ;
            $present_perchatage   = ($value->count*100)/$total_class_day;
            $present_perchatage_is = number_format($present_perchatage,2).'%';

            fputcsv($output, array($i++,$j++,$value->roll,$value->registration,$total_class_day,$value->count,$present_perchatage_is));
        }
    }
    if($sorting_type == '1' AND $attendent_days == '0'){
      foreach ($absent_result as $absent_value) {
        $total_class_day = $total_day - $count_holiday ;
        fputcsv($output, array($i++,$j++,$absent_value->roll,$absent_value->registration,$total_class_day,"0","0.00 %"));
      }
    }elseif($sorting_type == '3'){
      foreach ($absent_result as $absent_value) {
        $total_class_day = $total_day - $count_holiday ;
        fputcsv($output, array($i++,$j++,$absent_value->roll,$absent_value->registration,$total_class_day,"0","0.00 %"));
      }
    }


    }

    // csv periodic student absent attendent report
    public function csvPeriodicStudentAbsentList(Request $request)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=periodic_student_absent_list.csv');
        $output = fopen('php://output', 'w');
        $report_created = "REPORT CREATED : ".date('d M Y, h:i:s A');
        $setting     = DB::table('setting')->first();

        $year        = trim($request->year) ;
        $shift       = trim($request->shift);
        $dept        = trim($request->dept);
        $semister    = trim($request->semister);
        $section     = trim($request->section);
        $date_form   = trim($request->from); 
        $from        = date ("Y-m-d", strtotime($date_form));
        $date_to     = trim($request->to); 
        $date_too    = trim($request->to);
        $to          = date ("Y-m-d", strtotime($date_to));
        $sorting_type = trim($request->sorting_type);
        $attendent_days = trim($request->attendent_days);

        $count_holiday =  DB::table('holiday')
                         ->where('year',$year)
                         ->whereBetween('holiday_date', [$from, $to])->count();
        // total day caluclation
        $date1 = date_create($from);
        $date2 = date_create($to);
        //difference between two dates
        $diff       = date_diff($date1,$date2);
        $total_day  = $diff->format("%a")+1;
        if($sorting_type == '1'){
      $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
       ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT( DISTINCT student_attendent.created_at) AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
      ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('student_attendent.studentId','ASC')
      ->get();
    }elseif($sorting_type == '2'){
      $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
       ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT( DISTINCT student_attendent.created_at) AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
      ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','ASC')
      ->orderBy('student_attendent.studentId','ASC')
      ->get();
    }elseif($sorting_type == '3'){
         $result = DB::table('student_attendent')
      ->join('students','student_attendent.studentId','=','students.id')
      ->join('student','students.id','=','student.studentID')
       ->select('student_attendent.*','student.roll','student.registration', DB::raw("COUNT( DISTINCT student_attendent.created_at) AS count"))
      ->where('student_attendent.year',$year)
      ->where('student_attendent.shift_id',$shift)
      ->where('student_attendent.dept_id',$dept)
      ->where('student_attendent.semister_id',$semister)
      ->where('student_attendent.section_id',$section)
      ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
      ->whereBetween('student_attendent.created_at', [$from, $to])
      ->groupBy('student_attendent.studentId')
      ->orderBy('count','ASC')
      ->orderBy('student_attendent.studentId','ASC')
      ->get();
    }

    foreach($result as $value) {
    //do something
    $attentdent_id[] = $value->studentId;
}
$absent_result = DB::table('students')
  ->join('student', 'students.id', '=', 'student.studentID')
  ->select('student.*', 'students.studentName','students.studentMobile','students.studentImage','student.registration')
        ->where('student.year',$year)
      ->where('student.shift_id',$shift)
      ->where('student.dept_id',$dept)
      ->where('student.semister_id',$semister)
      ->where('student.section_id',$section)
   ->whereNotIn('student.studentID',$attentdent_id)
   ->orderBy('student.roll','asc')
   ->get();

    $shift_name    = DB::table('shift')->where('id',$shift)->first();
    $dept_name     = DB::table('department')->where('id',$dept)->first();
    $semister_name = DB::table('semister')->where('id',$semister)->first();
    $section_name  = DB::table('section')->where('id',$section)->first();
    $date_range = date ("d M Y", strtotime($from)).' To '.date("d M Y", strtotime($to));

    if($sorting_type == '1'){
      $sorting_type_is = "Equal";
    }elseif($sorting_type == '2'){
      $sorting_type_is = "Morethan";
    }elseif($sorting_type == '3'){
      $sorting_type_is = "Lessthan";
    }

    fputcsv($output, array('','','',$setting->full_name,'','','',''));
    fputcsv($output, array('','','',$setting->address,'','','',''));
    fputcsv($output, array('','','','Mobile : '.$setting->mobile,'','','',''));
    fputcsv($output, array('','','','','','','',''));
    fputcsv($output, array('','','','PERIODIC STUDENT ABSENT ATTENDENT REPORT','','','',''));

    fputcsv($output, array('','','','YEAR : '.$year,'','','',''));
    fputcsv($output, array('','','','SHIFT : '.$shift_name->shiftName,'','','',''));
    fputcsv($output, array('','','','DEPARTMENT NAME : '.$dept_name->departmentName,'','','',''));
    fputcsv($output, array('','','','SEMESTER : '.$semister_name->semisterName,'','','',''));
    fputcsv($output, array('','','','SECTION : '.$section_name->section_name,'','','',''));
    fputcsv($output, array('','','','DATE RANGE : '.$date_range,'','','',''));
    fputcsv($output, array('','','','TOTAL DAYS : '.$total_day. " Days",'','','',''));
    fputcsv($output, array('','','','HOLIDAYS : '.$count_holiday." Days",'','','',''));
    fputcsv($output, array('','','','SORTING TYPE : '.$sorting_type_is,'','','',''));
    fputcsv($output, array('','','','SORTING DAYS : '.$attendent_days,'','','',''));
    fputcsv($output, array('','','',$report_created,'','','',''));
    fputcsv($output, array('','','','','','','',''));

    fputcsv($output, array('SL NO','TOP RANK','ROLL','REGISTRATION','TOTAL CLASS (DAYS)','ABSENT (DAYS)','ABSENT (DAYS) %'));

    $i = 1;
    $j = 1;
    $total_class_days_is = $total_day - $count_holiday ;
    if($sorting_type == '1' AND $attendent_days == $total_class_days_is){
      foreach ($absent_result as $absent_value) {
        $total_class_day = $total_day - $count_holiday ;

        fputcsv($output, array($i++,$j++,$absent_value->roll,$absent_value->registration,$total_class_day,$total_class_day,"100.00 %"));
      }
    }elseif($sorting_type == '2'){
      foreach ($absent_result as $absent_value) {
        $total_class_day = $total_day - $count_holiday ;

        fputcsv($output, array($i++,$j++,$absent_value->roll,$absent_value->registration,$total_class_day,$total_class_day,"100.00 %"));
      }
    }

    foreach ($result as $value) {
        if($sorting_type == '1' AND $attendent_days == $total_class_days_is - $value->count){
            $total_class_day = $total_day - $count_holiday ;
            $absent = $total_class_day - $value->count ;
            $absent_perchatage   = ($absent*100)/$total_class_day;
            $absent_perchatage_is = number_format($absent_perchatage,2).'%';

            fputcsv($output, array($i++,$j++,$value->roll,$value->registration,$total_class_day,$absent,$absent_perchatage_is));
        }elseif($sorting_type == '2' AND $attendent_days < $total_class_days_is - $value->count){
            $total_class_day = $total_day - $count_holiday ;
            $absent = $total_class_day - $value->count ;
            $absent_perchatage   = ($absent*100)/$total_class_day;
            $absent_perchatage_is = number_format($absent_perchatage,2).'%';

            fputcsv($output, array($i++,$j++,$value->roll,$value->registration,$total_class_day,$absent,$absent_perchatage_is));
        }elseif($sorting_type == '3' AND $attendent_days > $total_class_days_is - $value->count){
            $total_class_day = $total_day - $count_holiday ;
            $absent = $total_class_day - $value->count ;
            $absent_perchatage   = ($absent*100)/$total_class_day;
            $absent_perchatage_is = number_format($absent_perchatage,2).'%';

            fputcsv($output, array($i++,$j++,$value->roll,$value->registration,$total_class_day,$absent,$absent_perchatage_is));
        }
    }



    }



}




