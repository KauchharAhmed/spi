<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class WebSectionController extends Controller
{
    //
    private $rcdate ;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate       = date('Y-m-d');
        $this->current_time = date('H:i:s');
    }

    #------------------------- Add Section -----------------------#
    public function addWebSection()
    {
    	return view('web_admin.addWebSection') ;
    }

    #------------------- Insert Section Info -----------------------#
    public function webSectionInfo(Request $request)
    {
    	$this->validate($request,[
    		'w_section_name' => 'required',
    		'image' 		 => 'required',
    		'image'          => 'mimes:jpeg,jpg,png|max:100|required'
    	]);

    	$w_section_name = trim($request->w_section_name);
    	$image          = $request->file('image');

    	#---------------- Check Duplicate Web Section Title -------------------#
    	$check_count = DB::table('w_section')->where('w_section_name',$w_section_name)->count();

    	if ($check_count > 0) {
    		Session::put('failed','Sorry ! Section Name Already Exit. Try Again');
	        return Redirect::to('addWebSection');
	      	exit();
    	}

    	if($image){
	        $image_name        = str_random(20);
	        $ext               = strtolower($image->getClientOriginalExtension());
	        $image_full_name   ='web_section-'.$image_name.'.'.$ext;
	        $upload_path       = "images/";
	        $image_url         = $upload_path.$image_full_name;
	        $success           = $image->move($upload_path,$image_full_name);

	        $data 					= array();
	        $data['w_section_name']	= $w_section_name;
	        $data['image']         	= $image_url;
	        DB::table('w_section')->insert($data);
	        Session::put('succes','Section Added Sucessfully');
	        return Redirect::to('addWebSection');
	    }

    }

    #---------------------- Manage Web Section ---------------------#
    public function manageWebSection()
    {
    	$result = DB::table('w_section')->get();
    	return view('web_admin.manageWebSection')->with('result',$result);
    }

    #----------------- Add Web Section Submenu -----------------#
    public function addWebSectionSubMenu()
    {
    	$result = DB::table('w_section')->get();
    	return view('web_admin.addWebSectionSubMenu')->with('result',$result);
    }

    #----------------------- Add Section Sub Menu -------------------#
    public function webSectionSubmenuInfo(Request $request)
    {
    	$this->validate($request,[
    		'w_section_id' 	=> 'required',
    		'submenu_name' 	=> 'required',
    	]);

    	$w_section_id 	= trim($request->w_section_id);
    	$submenu_name 	= trim($request->submenu_name);

    	#------------- Check Count ---------------#
    	$check_count = DB::table('w_section_submenu')->where('submenu_name',$submenu_name)->count();

    	if ($check_count > 0) {
    		Session::put('failed','Sorry ! Section Sub Menu Name Already Exit. Try Again');
	        return Redirect::to('addWebSectionSubMenu');
	      	exit();
    	}

    	$data = array() ;
    	$data['w_section_id'] 	= $w_section_id ;
    	$data['type'] 			= 1 ;
    	$data['submenu_name'] 	= $submenu_name ;
    	$data['status'] 		= 1;
    	$data['created_at'] 	= $this->rcdate;
 		
 		$query = DB::table('w_section_submenu')->insert($data);

 		Session::put('succes','Section Sub Menu Added Sucessfully');
	    return Redirect::to('addWebSectionSubMenu');
    }

    #-------------------- Web Section Page -------------------#
    public function addWebSectionPageInfo()
    {
        $result = DB::table('w_section')->where('status',1)->get();

        return view('web_admin.addWebSectionPageInfo')->with('result',$result);
    }

    #--------------------- Get Web Section Submenu --------------------#
    public function getWebSectionSubmenu(Request $request)
    {
        $web_section_id = trim($request->web_section_id);
        $count = DB::table('w_section_submenu')->where('w_section_id',$web_section_id)->where('status',1)->count();
        if($count > 0){
            $result = DB::table('w_section_submenu')->where('w_section_id',$web_section_id)->where('status',1)->get();
            echo "<option value=''>Select</option>";
            foreach ($result as $value1) {
                echo "<option value=".$value1->id.">".$value1->submenu_name."</option>";
            }
        }else{
            echo "<option value=''>Select</option>";
        }
    }

    #----------------- Insert page info ---------------------#
    public function webSectionPageInfo(Request $request)
    {
        $this->validate($request,[
            'web_section_id'        => 'required',
            'section_submenu_id'    => 'required',
            'page_title'            => 'required',
            'image'                 => 'mimes:pdf,doc,docx|max:1000'
        ]);   

        $web_section_id     = $request->web_section_id;
        $section_submenu_id = $request->section_submenu_id;
        $page_title         = trim($request->page_title);
        $page_content       = $request->page_content;
        $image              = $request->file('image');

        $check_count = DB::table('web_section_page')
                    ->where('web_section_id',$web_section_id)
                    ->where('web_subsection_id',$section_submenu_id)
                    ->where('status',1)
                    ->count();

        if ($check_count > 0) {
            Session()->put('failed',"Page Content Already Added.");
            return Redirect::to('addWebSectionPageInfo');
            exit();
        }
        $explode = explode(" ", $page_title);
        $emplode = implode('_', $explode);

        $data = array();
        $data['web_section_id']     = $web_section_id ;
        $data['web_subsection_id']  = $section_submenu_id ;
        $data['page_title']         = $page_title ;
        $data['page_content']       = $page_content ;
        $data['status']             = 1 ;

        if ($image) {
            $image_name        = str_random(4);
            $ext               = strtolower($image->getClientOriginalExtension());
            $image_full_name   = $emplode.'_'.$image_name.'.'.$ext;
            $upload_path       = "images/";
            $image_url         = $upload_path.$image_full_name;
            $success           = $image->move($upload_path,$image_full_name);

            $data['image']      = $image_url ;
        }
        $data['created_at']     = $this->rcdate ;
        $data['modified_at']    = $this->rcdate ;

        $query = DB::table('web_section_page')->insert($data);
        if ($query) {
            Session()->put('succes',"Page Content Added Sucessfully.");
            return Redirect::to('addWebSectionPageInfo');
            exit();
        }else{
            Session()->put('failed',"Sorry Somthing Went Wrong.");
            return Redirect::to('addWebSectionPageInfo');
            exit();
        }
    }

    #--------------------- MANAGE WEB PAGE INFO --------------------#
    public function manageWebSectionPageInfo()
    {
        $result = DB::table('web_section_page')
                ->join('w_section','web_section_page.web_section_id','=','w_section.id')
                ->join('w_section_submenu','web_section_page.web_subsection_id','=','w_section_submenu.id')
                ->select('web_section_page.*','w_section.w_section_name','w_section_submenu.submenu_name')
                ->get();
        return view('web_admin.manageWebSectionPageInfo')->with('result',$result);
    }




}
