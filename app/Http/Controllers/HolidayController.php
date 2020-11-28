<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DateTime;
use DB;
use Session;

class HolidayController extends Controller
{
     /**
     * HolidayController Class Constructor
     *
     * @return \Illuminate\Http\Response
     */
    private $rcdate ;
    private $year ;
    public function __construct(){
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate = date('Y/m/d');
        $this->year   = date('Y');
    }
    /**
     * create weekly holiday by any year
     */
    public function createWeeklyHoliday()
    {
    	return view('educationInfo.createWeeklyHoliday');
    }
    /**
     * add weekly holiday info of this year 
     */
    public function createWeeklyHolidayInfo(Request $request)
    {
    $this->validate($request, [
    'year' => 'required'
    ]);
    $year = trim($request->year);
    // check duplicate holiday of this year
      $check = DB::table('holiday')
     ->where('year', $year)
     ->where('type',1)
     ->count();
      if($check > 0){
        Session::put('failed','Sorry ! Weekly Holiday Of '.$year.' Already Created');
        return Redirect::to('createWeeklyHoliday');
        exit();
      }

      $start  = $year.'-01-01';
      $ending = $year.'-12-31';
      // insert weekly holiday
      $begin  = new DateTime($start);
      $end    = new DateTime($ending);
      while ($begin <= $end)  
     {
    if($begin->format("D") == "Fri") 
    {
        $data['year']           = $year ;
        $data['type']           = 1 ;
        $data['holiday_date']   = $begin->format("Y-m-d") ;
        $data['created_at']     = $this->rcdate ;
        DB::table('holiday')->insert($data);
    }
    $begin->modify('+1 day');

   }
   Session::put('succes','Weekly Holiday Create Of '.$year.' Successfully');
    return Redirect::to('createWeeklyHoliday');

    }
    /**
     * display other holiday form 
     */
    public function otherHolidayForm()
    {
    return view('educationInfo.otherHolidayForm');	
    }
    /**
     * create other holiday info 
     */
    public function addOtherHolidayInfo(Request $request)
    {
    $this->validate($request, [
    'holiday_type' => 'required',
    'holiday_date' => 'required'
   ]);
    $holiday_type = trim($request->holiday_type);
    $explode = explode('/',$holiday_type);
    $type_of_holiday = $explode[0];
    $holiday_status  = $explode[1];
    if($holiday_status == '0'){
      $door_holiday      = '0';
      $attendent_holiday = '0';
    }else{
      $door_holiday      = '1';
      $attendent_holiday = '0';
    }

    $holiday_date = trim($request->holiday_date);
    $remarks      = trim($request->remarks);
    // first create weekly holiday
    $check_weekly = DB::table('holiday')
     ->where('year', $this->year)
     ->count();
      if($check_weekly == 0){
        Session::put('failed','Sorry ! Create Weekly Holiday First');
        return Redirect::to('createWeeklyHoliday');
        exit();
      }
    // check duplicate
    $check = DB::table('holiday')
     ->where('year', $this->year)
     ->where('holiday_date',$holiday_date)
     ->count();
      if($check > 0){
        Session::put('failed','Sorry ! Holiday Of '.$holiday_date.' Already Created');
        return Redirect::to('otherHolidayForm');
        exit();
      }

        $data['year']           = $this->year ;
        $data['type']           = $type_of_holiday ;
        $data['door_holiday']   = $door_holiday ;
        $data['attendent_holiday'] = $attendent_holiday ;
        $data['holiday_date']   = $holiday_date ;
        $data['created_at']     = $this->rcdate ;
        DB::table('holiday')->insert($data);
        Session::put('succes','Holiday Created Successfully');
        return Redirect::to('otherHolidayForm');
  }
  /**
  * show all holiday 
  */ 
  public function showAllHoliday()
  {
      $result = DB::table('holiday')
     ->orderBy('id','desc')
     ->get();
     return view('educationInfo.showAllHoliday')->with('result',$result);
  }
 /**
  * delete holiday 
  */
  public function deleteHoliday($id)
  {
   $query = DB::table('holiday')->where('id',$id)->delete();
   if($query){
        Session::put('succes','Holiday Deleted Successfully');
        return Redirect::to('showAllHoliday');
   }else{
        Session::put('failed','Sorry ! Holiday Did Not Deleter. Try Again To Delte');
        return Redirect::to('showAllHoliday');
   }
  }

}
