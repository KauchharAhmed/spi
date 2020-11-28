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
          <p>Cell:<?php echo $setting->mobile;?></p>
        </div>
        <div class="bd_logo">
          <img src="{{URL::to('images/spi_logo.jpg')}}" style="width: 100px;height: 100px;">
        </div>
      </div>
      <br>
      <center><h4 style="margin-top: 89px;"><span style="font-family:arial;border:1px solid #000;padding-top:4px;padding-bottom:4px;padding-left:27px;padding-right:27px;">STAFF ATTENDENT REPORT</span></h4></center>      
      <div class="row">
        <table>
          <tr>
            <td>Date</td>
            <td>:</td>
            <td><b><?php echo date('d M Y',strtotime($from)) ;?></b></td>
          </tr>
          <tr>
            <td>Day</td>
            <td>:</td>
            <td><b><?php echo $day_no  = date("l",strtotime($from)); ?></b></td>
          </tr>
          <tr>
            <td>Staff Type</td>
            <td>:</td>
            <td><b><?php if($staff_type == '0'){
                                echo "ALL";
                               }elseif($staff_type == '2'){
                                echo "ADMIN";
                               }elseif($staff_type == '3'){
                                echo "TEACHER";
                               }elseif($staff_type == "4"){
                                echo "CRAFT";
                               }elseif($staff_type == "5"){
                                echo "OTHER STAFF";
                               }
                               ?></b></td>
          </tr>
          <tr>
            <td>Total Staffs</td>
            <td>:</td>
            <td><b><?php echo count($result);?></b></td>
          </tr>
        </table>
      <table width="100%" class="nila" style="font-size:14px;">
                  <thead>
                    <tr>    
                    <td class="nila"><strong>SL</strong></td>
                    <td class="nila"><strong>STAFF</strong></td>
                    <td class="nila"><strong>DEPT</strong></td>
                    <td class="nila"><strong>DEG</strong></td>
                    <td class="nila"><strong>STATUS</strong></td>
                    <td class="nila"><strong>ENTER TIME</strong></td>
                  </tr>
            </thead>
                         <tbody>
                                 <?php $i = 1 ;
                                foreach ($result as $value) { ?>
                                 <tr>
                                    <td class="nila"><?php echo $i++ ; ?></td>
                                    <td class="nila"><?php echo $value->name ; ?></td>   
                                    <td class="nila"><?php echo $value->departmentName ; ?></td> 
                                    <td class="nila"><?php echo $value->degi ; ?></td> 
                                    <td class="nila">
                                         <?php
                                       // check leave status
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
                                      if($leave > 0):?>
                                       <span style="color:orange"> <?php echo "LEAVE";?>
                                       </span>
                                        <?php elseif($training > 0):?>
                                        <span style="color:blue"> <?php echo "TRAINING";?>
                                       </span>
                                       <?php elseif($prsent_status > 0):?>
                                         <span style="color:green"> <?php echo "PRESENT";?>

                                         <?php else:?>
                                          <span style="color:red"> <?php echo "ABSENT";?>
                                     <?php endif;?>
                                    </td>
                                      <td class="nila">
                                      <?php if($prsent_status > 0){ ?>
                                       <span style="color:green">   <?php $present_time = DB::table('tbl_door_log')
                                      ->where('user_id',$value->id)
                                      ->where('enter_date',$from)
                                      ->orderBy('enter_time','asc')
                                      ->first();
                                      echo date('h:i:s a',strtotime($present_time->enter_time));
                                      ?>
                                      <?php } ?>
                                    </td> 
                                </tr>
                              <?php } ?>
                            </tbody>
                        </table>
                    

	<script type="text/javascript">
	window.print();
	</script>
    </body>
</html>

   