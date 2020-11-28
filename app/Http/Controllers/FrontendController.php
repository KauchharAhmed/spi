<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DateTime;
use DB;
use Session;

class FrontendController extends Controller
{
     /**
     * Display fornt end index page.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function process_event()
    {
     	return view('process_event');
    } 
    // for door one
    public function door_one()
    {
        return view('door_one');
    }
    // for door 2
    public function door_two()
    {
        return view('door_two');
    }

    #------------------- Get Mission And Vission Page ----------------------#
   public function index()
    {
        // get last 10 notice
        $last_10_notice = DB::table('w_notice')->orderBy('id','desc')->limit(10)->get();
        // get event and nes
        $get_event      = DB::table('w_event')->where('status',0)->orderBy('event_date','asc')->limit(3)->get();
        // photo gallary
        $get_photo_gallary = DB::table('w_photo_gallary')->orderBy('id','desc')->limit(6)->get();
        $get_section = DB::table('w_section')->get();
        return view('web.index')->with('last_10_notice',$last_10_notice)->with('get_event',$get_event)->with('get_photo_gallary',$get_photo_gallary)->with('get_section',$get_section);
    }



    public function missionVision()
    {
        return view('web.missionVision');
    } 

    #------------------- Get SPI History Page ----------------------#
    public function history()
    {
        return view('web.history');
    } 

    #------------------- Get All Notice Page ----------------------#
    public function notice()
    {
        $last_100_notice = DB::table('w_notice')->orderBy('id','desc')->limit(100)->get();
        return view('web.notice')->with('last_100_notice',$last_100_notice);
    } 

    #------------------- Get Contact Us Page ----------------------#
    public function contactUs()
    {
        return view('web.contactUs');
    } 

    #------------------- Get Photo Gallery Page ----------------------#
    public function photoGallery()
    {
        return view('web.photoGallery');
    } 

    #------------------- Get Video Gallery Page ----------------------#
    public function videoGallery()
    {
        return view('web.videoGallery');
    } 

    #------------------- Get Single News Or Event Page ----------------------#
    public function singleNews()
    {
        return view('web.singleNews');
    } 

    #------------------- Principal's maessage details ----------------------#
    public function prinicipalMessage()
    {
        return view('web.prinicipalMessage');
    }
    // spi staff list
    public function spiStaffList()
    {
    $result = DB::table('users')
  ->leftJoin('department', 'users.dept', '=', 'department.id')
  ->select('users.*', 'department.departmentName')
  ->whereNotIn('users.type',[10])
   ->where('users.trasfer_status','=',0)
   ->orderBy('user_id','asc')
  ->get();
  return view('web.spiStaffList')->with('result',$result);
    }
    // spi department info
    public function spiDeptInfo($dept_id)
    {
      // get shift
      $shift = DB::table('shift')->get();
      // get current semester
      $semester = DB::table('semister')->where('status',1)->get();
      // get staff of this department
      $staff    = DB::table('users')->where('dept','=',$dept_id)->where('trasfer_status','=', 0)->orderBy('user_id','asc')->get();
      $dept_status = DB::table('department')->where('id',$dept_id)->first();
      return view('web.spiDeptInfo')->with('semester',$semester)->with('staff',$staff)->with('dept_status',$dept_status)->with('shift',$shift);
    }
    // spi class routine
    public function spiClassRoutine()
    {
        $dept                = DB::table('department')->where('status',1)->get();
        // get shift
        $shift               = DB::table('shift')->get();
        // get current semister
        $semister            = DB::table('semister')->where('status','1')->get();
       return view('web.spiClassRoutine')->with('shift',$shift)->with('semsiter',$semister)->with('dept',$dept);
    }
  // view semister wise routine
    public function getStudentSemisterWiseRoutine(Request $request)
    {
       $dep_id    = trim($request->dept);
       $shift     = trim($request->shift) ;
       $semister  = trim($request->semister) ;
       $year      = trim($request->year);
       $section   = trim($request->section);
        #--------- Day 1 of routine -----------------#
          $day1 = DB::table('routine')
        ->join('shift', 'routine.shift_id', '=', 'shift.id')
        ->join('semister', 'routine.semister_id', '=', 'semister.id')
        ->join('section', 'routine.section_id', '=', 'section.id')
        ->join('subject', 'routine.subject_id', '=', 'subject.id')
        ->join('users', 'routine.teacher_id', '=', 'users.id')
        ->select('routine.*','users.name','shift.shiftName','semister.semisterName','subject.subject_name','subject.subject_code')
        ->orderBy('routine.from','asc')
        ->where('routine.year', $year)
        ->where('routine.dept_id', $dep_id)
        ->where('routine.shift_id', $shift)
        ->where('routine.semister_id', $semister)
        ->where('routine.section_id', $section)
        ->where('routine.day', '1')
        ->get();
        #--------- End Day 1 Of Routine -----------------#
        #--------- Day 2 of routine -----------------#
          $day2 = DB::table('routine')
        ->join('shift', 'routine.shift_id', '=', 'shift.id')
        ->join('semister', 'routine.semister_id', '=', 'semister.id')
        ->join('section', 'routine.section_id', '=', 'section.id')
        ->join('subject', 'routine.subject_id', '=', 'subject.id')
        ->join('users', 'routine.teacher_id', '=', 'users.id')
        ->select('routine.*','users.name','shift.shiftName','semister.semisterName','subject.subject_name','subject.subject_code')
        ->orderBy('routine.from','asc')
        ->where('routine.year', $year)
        ->where('routine.dept_id', $dep_id)
        ->where('routine.shift_id', $shift)
        ->where('routine.semister_id', $semister)
         ->where('routine.section_id', $section)
        ->where('routine.day', '2')
        ->get();
        #--------- End Day 2 Of Routine -----------------#
        #--------- Day 3 of routine ---------------------#
          $day3 = DB::table('routine')
        ->join('shift', 'routine.shift_id', '=', 'shift.id')
        ->join('semister', 'routine.semister_id', '=', 'semister.id')
        ->join('section', 'routine.section_id', '=', 'section.id')
        ->join('subject', 'routine.subject_id', '=', 'subject.id')
        ->join('users', 'routine.teacher_id', '=', 'users.id')
        ->select('routine.*','users.name','shift.shiftName','semister.semisterName','subject.subject_name','subject.subject_code')
        ->orderBy('routine.from','asc')
        ->where('routine.year', $year)
        ->where('routine.dept_id', $dep_id)
        ->where('routine.shift_id', $shift)
        ->where('routine.semister_id', $semister)
         ->where('routine.section_id', $section)
        ->where('routine.day', '3')
        ->get();
        #--------- End Day 3 Of Routine -----------------#
        #--------- Day 4 of routine ---------------------#
          $day4 = DB::table('routine')
        ->join('shift', 'routine.shift_id', '=', 'shift.id')
        ->join('semister', 'routine.semister_id', '=', 'semister.id')
        ->join('section', 'routine.section_id', '=', 'section.id')
        ->join('subject', 'routine.subject_id', '=', 'subject.id')
        ->join('users', 'routine.teacher_id', '=', 'users.id')
        ->select('routine.*','users.name','shift.shiftName','semister.semisterName','subject.subject_name','subject.subject_code')
        ->orderBy('routine.from','asc')
        ->where('routine.year', $year)
        ->where('routine.dept_id', $dep_id)
        ->where('routine.shift_id', $shift)
        ->where('routine.semister_id', $semister)
         ->where('routine.section_id', $section)
        ->where('routine.day', '4')
        ->get();
        #--------- End Day 4 Of Routine -----------------#
        #--------- Day 5 of routine ---------------------#
          $day5 = DB::table('routine')
        ->join('shift', 'routine.shift_id', '=', 'shift.id')
        ->join('semister', 'routine.semister_id', '=', 'semister.id')
        ->join('section', 'routine.section_id', '=', 'section.id')
        ->join('subject', 'routine.subject_id', '=', 'subject.id')
        ->join('users', 'routine.teacher_id', '=', 'users.id')
        ->select('routine.*','users.name','shift.shiftName','semister.semisterName','subject.subject_name','subject.subject_code')
        ->orderBy('routine.from','asc')
        ->where('routine.year', $year)
        ->where('routine.dept_id', $dep_id)
        ->where('routine.shift_id', $shift)
        ->where('routine.semister_id', $semister)
         ->where('routine.section_id', $section)
        ->where('routine.day', '5')
        ->get();
        #--------- End Day 5 Of Routine -----------------#
        #--------- Day 6 of routine ---------------------#
          $day6 = DB::table('routine')
        ->join('shift', 'routine.shift_id', '=', 'shift.id')
        ->join('semister', 'routine.semister_id', '=', 'semister.id')
        ->join('section', 'routine.section_id', '=', 'section.id')
        ->join('subject', 'routine.subject_id', '=', 'subject.id')
        ->join('users', 'routine.teacher_id', '=', 'users.id')
        ->select('routine.*','users.name','shift.shiftName','semister.semisterName','subject.subject_name','subject.subject_code')
        ->orderBy('routine.from','asc')
        ->where('routine.year', $year)
        ->where('routine.dept_id', $dep_id)
        ->where('routine.shift_id', $shift)
        ->where('routine.semister_id', $semister)
         ->where('routine.section_id', $section)
        ->where('routine.day', '6')
        ->get();
        #--------- End Day 6 Of Routine -----------------#
        #--------- Day 7 of routine ---------------------#
          $day7 = DB::table('routine')
        ->join('shift', 'routine.shift_id', '=', 'shift.id')
        ->join('semister', 'routine.semister_id', '=', 'semister.id')
        ->join('section', 'routine.section_id', '=', 'section.id')
        ->join('subject', 'routine.subject_id', '=', 'subject.id')
        ->join('users', 'routine.teacher_id', '=', 'users.id')
        ->select('routine.*','users.name','shift.shiftName','semister.semisterName','subject.subject_name','subject.subject_code')
        ->orderBy('routine.from','asc')
        ->where('routine.year', $year)
        ->where('routine.dept_id', $dep_id)
        ->where('routine.shift_id', $shift)
        ->where('routine.semister_id', $semister)
         ->where('routine.section_id', $section)
        ->where('routine.day', '7')
        ->get();
        #--------- End Day 7 Of Routine -----------------#
        // get shift
        $shiftt                = DB::table('shift')->where('id',$shift)->first();
        // get semister
        $semisterr             = DB::table('semister')->where('id',$semister)->first();
        // get section        
        $sectionn              =  DB::table('section')->where('id',$semister)->first();
        $dept_info             =  DB::table('department')->where('id',$dep_id)->first();
        return view('web.getStudentSemisterWiseRoutine')
        ->with('day1',$day1)
        ->with('day2',$day2)
        ->with('day3',$day3)
        ->with('day4',$day4)
        ->with('day5',$day5)
        ->with('day6',$day6)
        ->with('day7',$day7)
        ->with('shift',$shiftt)
        ->with('semister',$semisterr)
        ->with('section',$sectionn)
        ->with('year',$year)
        ->with('shift_id',$shift)
        ->with('semister_id',$semister)
        ->with('section_id',$section)
        ->with('dept_info',$dept_info)
        ;
    }

    #-------------------- Get Section Single Page Info ----------------------#
    public function sectionPageInfo($section_id,$sub_section_id)
    {
        $check_count = DB::table('web_section_page')
                    ->where('web_section_id',$section_id)
                    ->where('web_subsection_id',$sub_section_id)
                    ->where('status',1)
                    ->count();
        if($check_count > 0){
            $result = DB::table('web_section_page')
                    ->where('web_section_id',$section_id)
                    ->where('web_subsection_id',$sub_section_id)
                    ->where('status',1)
                    ->first();
            return view('web.sectionPageInfo')->with('row',$result);
        }else{
            return Redirect::to('/');
        }

    }
}
