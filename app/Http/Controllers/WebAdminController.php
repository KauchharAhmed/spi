<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class WebAdminController extends Controller
{
    //
    private $rcdate ;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate       = date('Y-m-d');
        $this->current_time = date('H:i:s');
    }
    #----------------------- WEB ADMIN ACCESS -----------------------#
    public function webAdmin($superadmin_id,$type)
    {
    	if ($type == "1") {
	    	$super_admin = DB::table('superadmin')
			    ->where('id', $superadmin_id)
			    ->where('status',1)
			     ->first();
	        Session::put('superadmin_name',$super_admin->name);
	        Session::put('superadmin_id',$super_admin->id);
	        Session::put('type',$super_admin->status);
	        return Redirect::to('/webMasterDashboard');
    	}else{
    		return Redirect::to('admin');
      		exit();
    	}
    }

    #------------------- WEB ADMIN DASHBOARD -------------------------#
    public function webMasterDashboard()
    {
    	return view('web_admin.webMasterDashboard');
    }

    #-------------------------- WEB PRINCIPAL MESSAGE ------------------------#
    public function principalMessageList()
    {
        $result = DB::table('w_principal_message')
                ->get();

        return view('web_admin.principalMessageList')->with('result',$result);
    }

    #-------------------- ADD NEW PRINCIPAL MESSAGE --------------------#
    public function addNewPrincipalMessage()
    {
        return view('web_admin.addNewPrincipalMessage');
    }

    #-------------------- INSERT PRINCIPAL MESSAGE ---------------------#
    public function insertPrincipalMessage(Request $request)
    {
        $this->validate($request,[
            "principal_name"    => 'required',
            "principal_message" => 'required',
            'image'             => 'mimes:jpeg,jpg,png|max:300',
        ]);

        $principal_name     = trim($request->principal_name);
        $principal_message  = trim($request->principal_message);
        $join_date          = trim($request->join_date);
        $joinDate           = date('Y-m-d',strtotime($join_date));
        $image              = $request->file('image');

        // check duplicate entry
        $count = DB::table('w_principal_message')->where('status',0)->count();
        if ($count > 0) {
            Session::put('failed','Sorry ! Already Have a Active Principal Please Deactive First. Try To Again');
            return Redirect::to('addNewPrincipalMessage');
            exit();
        }

        if (empty($image)) {
            Session::put('failed','Sorry ! Please Select Principal Image.');
            return Redirect::to('addNewPrincipalMessage');
            exit();
        }else{

            $image_name        = str_random(20);
            $ext               = strtolower($image->getClientOriginalExtension());
            $image_full_name   = $image_name.'.'.$ext;
            $upload_path       = "web_images/";
            $image_url         = $image_full_name;
            $success           = $image->move($upload_path,$image_full_name);

            $data = array();
            $data['principal_name']     = $principal_name ;
            $data['join_date']          = $joinDate ;
            $data['principal_message']  = $principal_message ;
            $data['image']              = $image_url ;
            $data['created_at']         = $this->rcdate ;
            $query = DB::table('w_principal_message')->insert($data);
            if ($query) {
                Session::put('succes','Thanks , Principal Message Added Successfully.');
                return Redirect::to('addNewPrincipalMessage');
            }else{
                Session::put('failed','Sorry ! Error Occrued. Try Again');
                return Redirect::to('addNewPrincipalMessage');
            }
        }
    }

    #--------------------- PRINCIPAL CHANGE STATUS ----------------------#
    public function changePrincipalStatus($id)
    {
        $check_status = DB::table('w_principal_message')->where('id',$id)->first();
        $status = $check_status->status;

        if ($status == "1") {
            $count_active_status = DB::table('w_principal_message')->where('status',0)->count();
            if ($count_active_status > 0) {
                Session::put('failed','Sorry ! Already Have a active Principal.');
                return Redirect::to('principalMessageList');
                exit();
            }

            $now_status = 0;
            $data = array();
            $data['status'] = $now_status;

            DB::table('w_principal_message')->where('id',$id)->update($data);
            Session::put('succes','Thanks , Status Changed Successfully.');
            return Redirect::to('principalMessageList');
        }else{
        	$now_status = 1;
            $data = array();
            $data['status'] = $now_status;

            DB::table('w_principal_message')->where('id',$id)->update($data);
            Session::put('succes','Thanks , Status Changed Successfully.');
            return Redirect::to('principalMessageList');
        }
    }

    #------------------------ Get Single Principal Message ----------------------#
    public function editPrincipalMessage($id)
    {
    	$value = DB::table('w_principal_message')->where('id',$id)->first();

    	return view('web_admin.editPrincipalMessage')->with('value',$value);
    }

    #---------------------- Update Principal Message -------------------------#
    public function updatePrincipalMessage(Request $request)
    {
    	$this->validate($request,[
            "principal_name"    => 'required',
            "principal_message" => 'required',
            'image'             => 'mimes:jpeg,jpg,png|max:300',
        ]);

        $primary_id     	= trim($request->primary_id);
        $principal_name     = trim($request->principal_name);
        $principal_message  = trim($request->principal_message);
        $join_date          = trim($request->join_date);
        $regine_date        = trim($request->regine_date);
        $joinDate           = date('Y-m-d',strtotime($join_date));
        $regineDate         = date('Y-m-d',strtotime($regine_date));
        $image              = $request->file('image');

        $data = array();
        $data['principal_name']     = $principal_name ;
        $data['join_date']          = $joinDate ;
        $data['principal_message']  = $principal_message ;

        if (!empty($image)) {
        	$image_name        = str_random(20);
            $ext               = strtolower($image->getClientOriginalExtension());
            $image_full_name   = $image_name.'.'.$ext;
            $upload_path       = "web_images/";
            $image_url         = $image_full_name;
            $success           = $image->move($upload_path,$image_full_name);
            $data['image']              = $image_url ;
        }
            
        $data['modifiyed_at']       = $this->rcdate ;
        $data['regine_date']       	= $regineDate ;
        $query = DB::table('w_principal_message')->where('id',$primary_id)->update($data);

        if ($query) {
            Session::put('succes','Thanks , Principal Message Update Successfully.');
            return Redirect::to('principalMessageList');
        }else{
            Session::put('failed','Sorry ! Error Occrued. Try Again');
            return Redirect::to('principalMessageList');
        }
    }
    // web notice
    public function webAddNotice()
    {
        return view('web_admin.webAddNotice');
    }
    // function for add web notice info
    public function webAddNoticeInfo(Request $request)
    {
       $this->validate($request,[
            "notice_title"            => 'required',
            "notice_created_date"     => 'required',
            'image'                   => 'mimes:pdf|max:500',
        ]);
        $notice_title       = trim($request->notice_title);
        $notice_details     = trim($request->notice_details);
        $notice_date        = trim($request->notice_created_date);
        $noticeDate         = date('Y-m-d',strtotime($notice_date));
        $image              = $request->file('image'); 
        $data = array();
        $data['notice_title']   = $notice_title ;
        $data['notice_details'] = $notice_details ;
        $data['notice_date']    = $noticeDate ;
        if (!empty($image)) {
            $image_name        = str_random(20);
            $ext               = strtolower($image->getClientOriginalExtension());
            $image_full_name   = $image_name.'.'.$ext;
            $upload_path       = "notice_doc/";
            $image_url         = $image_full_name;
            $success           = $image->move($upload_path,$image_full_name);
            $data['image']     = $image_url ;
        }   
        $data['created_at']  = $this->rcdate ;
        DB::table('w_notice')->insert($data);
        Session::put('succes','Thanks , Notice Added Successfully.');
        return Redirect::to('webManageNotice');
    }
    // web manage notice
    public function webManageNotice()
    {
        $result = DB::table('w_notice')->orderBy('id','desc')->get();
        return view('web_admin.webManageNotice')->with('result',$result);
    }
    // delert notice
    public function w_notice_delete($id)
    {
       DB::table('w_notice')->where('id',$id)->delete();
       Session::put('succes','Thanks , Notice Deleted Successfully.');
       return Redirect::to('webManageNotice');
    }
    // banner add
    public function webBannerAdd()
    {
     return view('web_admin.webBannerAdd');
    }
    // web banner info
    public function webAddBannerInfo(Request $request)
    {
        $this->validate($request,[
            "banner_title"            => 'required',
            'image'                   => 'mimes:jpg,jpeg,png|max:500',
        ]);
        $banner_title       = trim($request->banner_title);
        $image              = $request->file('image'); 
        $data = array();
        $data['banner_title']   = $banner_title ;
        if (!empty($image)) {
            $image_name        = str_random(20);
            $ext               = strtolower($image->getClientOriginalExtension());
            $image_full_name   = $image_name.'.'.$ext;
            $upload_path       = "web_images/";
            $image_url         = $image_full_name;
            $success           = $image->move($upload_path,$image_full_name);
            $data['image']     = $image_url ;
        }   
        $data['created_at']  = $this->rcdate ;
        DB::table('w_banner')->insert($data);
        Session::put('succes','Thanks , Banner Added Successfully.');
        return Redirect::to('webBannerAdd');
    }
    // web manager
    public function webManageBanner()
    {
        $result = DB::table('w_banner')->orderBy('id','desc')->get();
        return view('web_admin.webManageBanner')->with('result',$result);
    }
   // latest news and event
    public function webLatestNewsAndEventAdd()
    {
       return view('web_admin.webLatestNewsAndEventAdd');  
    }
    // web add event and news info
    public function webAddEventInfo(Request $request)
    {
            $this->validate($request,[
            "notice_title"            => 'required',
            "notice_created_date"     => 'required',
            'image'                   => 'mimes:jpg,jpeg,png|max:300|required',
        ]);
        $notice_title       = trim($request->notice_title);
        $notice_details     = trim($request->notice_details);
        $notice_date        = trim($request->notice_created_date);
        $noticeDate         = date('Y-m-d',strtotime($notice_date));
        $image              = $request->file('image'); 
        $data = array();
        $data['event_title']   = $notice_title ;
        $data['event_details'] = $notice_details ;
        $data['event_date']    = $noticeDate ;
        if (!empty($image)) {
            $image_name        = str_random(20);
            $ext               = strtolower($image->getClientOriginalExtension());
            $image_full_name   = $image_name.'.'.$ext;
            $upload_path       = "web_images/";
            $image_url         = $image_full_name;
            $success           = $image->move($upload_path,$image_full_name);
            $data['image']     = $image_url ;
        }   
        $data['created_at']  = $this->rcdate ;
        DB::table('w_event')->insert($data);
        Session::put('succes','Thanks , New ANd Event Added Successfully.');
        return Redirect::to('webLatestNewsAndEventAdd');
    }
   // mange latest news and event
    public function webManageLatestNewsAndEvent()
    {
      $result = DB::table('w_event')->orderBy('id','desc')->get();
      return view('web_admin.webManageLatestNewsAndEvent')->with('result',$result);  
   }
   // web add photo gallary
   public function webAddPhotoGallary()
   {
     return view('web_admin.webAddPhotoGallary');
   }
   // submit photo gallary
   public function webAddPhotoGallaryInfo(Request $request)
   {
        $this->validate($request,[
            "notice_title"            => 'required',
            'image'                   => 'mimes:jpg,jpeg,png|max:300|required',
        ]);
        $notice_title       = trim($request->notice_title);
        $image              = $request->file('image'); 
        $data = array();
        $data['photo_title']   = $notice_title ;
        if (!empty($image)) {
            $image_name        = str_random(20);
            $ext               = strtolower($image->getClientOriginalExtension());
            $image_full_name   = $image_name.'.'.$ext;
            $upload_path       = "web_images/";
            $image_url         = $image_full_name;
            $success           = $image->move($upload_path,$image_full_name);
            $data['image']     = $image_url ;
        }   
        $data['created_at']  = $this->rcdate ;
        DB::table('w_photo_gallary')->insert($data);
        Session::put('succes','Thanks , New Photo Gallary Added Successfully.');
        return Redirect::to('webAddPhotoGallary');
   }
   // photo gallary manage
   public function webManagePhotoGallary()
   {
    $result = DB::table('w_photo_gallary')->orderBy('id','desc')->get();
    return view('web_admin.webManagePhotoGallary')->with('result',$result);
   }


}
