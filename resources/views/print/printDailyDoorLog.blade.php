<?php
$super_admin_id = Session::get('admin_id');
$type               = Session::get('type');
if($super_admin_id == null && $type != '1'){
return Redirect::to('/admin')->send();
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Report Print</title>
	<style type="text/css">
		table.nila {
			border-collapse: collapse;
		}

		table.nila, td.nila, th.nila {
			border: 1px solid black;
			padding:7px;
		}

    .logo{
      width: 120px;
      float: left;
    }

    .address{
      padding-left: 50px;
      width: 400px;
      float: left;
      line-height: 1px;
    }

    .bd_logo{
      width: 120px;
      float: right;
    }

	</style>
</head>
<body style="font-family:arial;">

      <div class="compnayInfo" style="margin-bottom: 20px;">
        <div class="logo">
          <img src="{{URL::to('images/bd_logo.png')}}" style="width: 100px;height: 100px;">
        </div>
        <div class="address">
          <h3><?php echo $setting->full_name;?></h3>
          <P><?php echo $setting->address;?></P>
          <p><?php echo $setting->mobile;?></p>
        </div>
        <div class="bd_logo">
          <img src="{{URL::to('images/spi_logo.jpg')}}" style="width: 100px;height: 100px;">
        </div>
      </div>
      <br>
      <center><h4 style="margin-top: 89px;"><span style="font-family:arial;border:1px solid #000;padding-top:4px;padding-bottom:4px;padding-left:27px;padding-right:27px;">DAILY DOOR LOG REPORT</span></h4></center>      
      <div class="row">
        <table>
          <tr>
            <td>DATE</td>
            <td>:</td>
            <td><b><?php echo date('d M Y',strtotime($from));?></b></td>
          </tr>
          <tr>
            <td>DAY</td>
            <td>:</td>
            <td><b><?php echo date('l',strtotime($from));?></b></td>
          </tr>
          <tr>
            <td>TYPE</td>
            <td>:</td>
            <td><b><?php
                         if($type_of_person == '0'){
                          echo "ALL";
                         }elseif($type_of_person == 'staff'){
                          echo "ALL STAFFS";
                         }elseif($type_of_person == 'stu'){
                          echo "ALL STUDENTS";
                         }elseif($type_of_person == '2'){
                          echo "ADMINS";
                         }elseif($type_of_person == '3'){
                          echo "TEACHERS";
                         }elseif($type_of_person == '5'){
                          echo "CRAFTS";
                         }elseif($type_of_person == '6'){
                          echo "OTHER STAFFS";
                         }elseif($type_of_person == '10'){
                          echo "GUEST";
                         }

                         ?></b></td>
          </tr>

          <tr>
            <td>LIST ORDER</td>
            <td>:</td>
            <td><b><?php if($order_is =='1'){ echo "First";}else{"Last";}  ?></b></td>
          </tr>
          <tr>
            <td>Search</td>
            <td>:</td>
            <td><b>1 To <?php echo $see_how_many_person  ?></b></td>
          </tr>
           
          <tr>
            <td>Printed on</td>
            <td>:</td>
            <td><b><?php echo date('d M Y, h:i:s A');  ?></b></td>
          </tr>
        </table>         
   <table width="100%" class="nila" style="font-size:14px;">
                  <thead>
                    <tr>    
                    <td class="nila"><strong>SL</strong></td>
                    <td class="nila"><strong>TYPE</strong></td>
                    <td class="nila"><strong>DEPT</strong></td>
                    <td class="nila"><strong>NAME</strong></td>
                    <td class="nila"><strong>ROLL(For Student)</strong></td>
                    <td class="nila"><strong>MOBILE  </strong></td>
                    <td class="nila"><strong>PICTURE</strong></td>
                    <td class="nila"><strong>ENTER TIME </strong></td>
            </tr>
            </thead>
                               <?php $i = 1 ; foreach ($result as $value) { ?>
                               <tbody>
                                   <tr>
                                    <td class="nila"><?php echo $i++ ; ?></td>
                                    <td class="nila">
                                      <?php
                                      if($value->type == '1'){
                                        // staff
                                        if($value->user_type == '2'){
                                          echo "ADMIN";
                                        }elseif($value->user_type == '3'){
                                          echo "TEACHER";
                                        }elseif($value->user_type == '4'){
                                          echo "CRAFT";
                                        }elseif($value->user_type == '5'){
                                          echo "OTHER STAFF";
                                        }elseif($value->user_type == '10'){
                                          echo "Visitor";
                                        }
                                      }else{
                                        // student
                                        echo "STUDENT";
                                      }
                                      ?>
                                      
                                    </td>   
                                    <td class="nila">
                                      <?php
                                      if($value->dep_id != '0'){
                                          $dept_info = DB::table('department')->where('id',$value->dep_id)->first();
                                        echo $dept_info->departmentName;
                                        }
                                      ?> 
                                    </td> 
                                    <td class="nila">
                                      <?php
                                      if($value->type == '1'){
                                        // staff
                                        $staff_name_query = DB::table('users')->where('id',$value->user_id)->first();
                                        echo $staff_name_query->name ;
                                      }else{
                                        // student
                                          $student_name_query = DB::table('students')->where('id',$value->student_id)->first();
                                          echo $student_name_query->studentName;
                                      }
                                      ?>
                                    </td> 
                                    <td class="nila">
                                      <?php if($value->roll > 0){
                                        echo $value->roll;
                                      }
                                      ?>
                                    </td>   
                                    <td class="nila">
                                       <?php
                                      if($value->type == '1'){
                                        // staff
                                        $staff_mobile_query = DB::table('users')->where('id',$value->user_id)->first();
                                        echo $staff_mobile_query->mobile ;
                                      }else{
                                        // student
                                          $student_mobile_query = DB::table('students')->where('id',$value->student_id)->first();
                                          echo $student_mobile_query->studentMobile;
                                      }

                                      ?>
                                    </td> 
                                    <td class="nila">
                                      <?php if($value->type == '1'){ $staff_image_query = DB::table('users')->where('id',$value->user_id)->first();?>
                                        <img width="50" height="50" style="border-radius: 50px" src=<?php echo $staff_image_query->image;?>>
                                       <?php  } ?>
                                       <?php if($value->type == '2'){   $student_image_query = DB::table('students')->where('id',$value->student_id)->first();?>
                                        <img width="50" height="50" style="border-radius: 50px" src=<?php echo $student_image_query->studentImage;?>>
                                       <?php  } ?>
                                    </td>
                                      <td class="nila">
                                      <?php echo date('h:i:s a',strtotime($value->enter_time));?>
                                    </td>
                                </tr>
                              </tbody>
                            <?php } ?>

                        </table>

	<script type="text/javascript">
	window.print();
	</script>
    </body>
</html>

   