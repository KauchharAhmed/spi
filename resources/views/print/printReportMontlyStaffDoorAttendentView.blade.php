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
      <center><h4 style="margin-top: 89px;"><span style="font-family:arial;border:1px solid #000;padding-top:4px;padding-bottom:4px;padding-left:27px;padding-right:27px;">MONTHLY DOOR LOG STAFF ATTENDENT REPORT</span></h4></center>      
      <div class="row">
        <table>
          <tr>
            <td>Year</td>
            <td>:</td>
            <td><b><?php echo $year ;?></b></td>
          </tr>
          <tr>
            <td>Month</td>
            <td>:</td>
            <td><b>
              <?php 
                         if($month == '01'){
                          echo "January";
                         }elseif($month == '02'){
                          echo "February";
                         }elseif($month == '03'){
                           echo "March";
                         }elseif($month == '04'){
                           echo "April";
                         }elseif($month == '05'){
                           echo "May";
                         }elseif($month == '06'){
                           echo "June";
                         }elseif($month == '07'){
                           echo "July";
                         }elseif($month == '08'){
                           echo "August";
                         }elseif($month == '09'){
                           echo "September";
                         }elseif($month == '10'){
                           echo "October";
                         }elseif($month == '11'){
                           echo "November";
                         }else{
                          echo "December";
                         }
                         ?>
                         <?php echo '( '.$month_total_day.' Days )' ;?> 
              
            </b></td>
          </tr>
          <tr>
            <td> Holidays</td>
            <td>:</td>
            <td><b><?php echo $count_holiday ; ?></b></td>
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
            <td>Total Staff</td>
            <td>:</td>
            <td><b><?php echo count($result);?></b></td>
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
                    <td class="nila"><strong>STAFF</strong></td>
                    <td class="nila"><strong>DEPT</strong></td>
                    <td class="nila"><strong>DEG</strong></td>
                    <td class="nila"><strong>TOTAL WORKING (DAYS)</strong></td>
                    <td class="nila"><strong>TOTAL LEAVE & TRAINING (DAYS)</strong></td>
                    <td class="nila"><strong>TOTAL WORKING (DAYS)<sub>with out leave & training</strong></td>
                    <td class="nila"><strong>PRESENT (DAYS)</strong></td>
                    <td class="nila"><strong>ABSENT (DAYS)</strong></td>
                    <td class="nila"><strong>PRESENT (DAYS)%</strong></td>
                    <td class="nila"><strong>ABSENT (DAYS)%</strong></td>
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
                                    <td class="nila"><?php 
                                      $total_class_day = $month_total_day - $count_holiday ;
                                      echo $total_class_day ; 
                                    ?></td> 
                                    <td class="nila"><?php 
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
                                      echo $total_leave_sum ; 
                                     }
                                   }else{
                                       $total_leave_sum = $total_from_leave_count+$total_leave;
                                       echo $total_leave_sum ;
                                     }
                                    ?> 
                                    </td>
                                    <td class="nila">
                                       <?php 
                                       $teache_class = $total_class_day-$total_leave_sum;
                                       echo $teache_class;
                                       ?>
                                    </td>
                                    <td class="nila">
                                       <?php 
                                      $count     = DB::table('tbl_door_log')
                                      ->distinct()
                                      //->where('year',$year)
                                      ->where('user_id',$value->id)
                                      ->whereBetween('enter_date', [$from, $to])
                                      ->get(array('enter_date'));
                                       $present = count($count) ;
                                       echo $present ;
                                      ?>
                                     </td>
                                    <td class="nila"> <?php 
                                     $absent =  $total_class_day - $total_leave_sum -$present;  ;
                                        echo $absent ;
                                    ?>  </td>
                                    <td class="nila"> 
                                      <?php
                                      //echo $teache_class ;
                                       $present_perchatage   = ($present*100)/$teache_class;
                                       echo number_format($present_perchatage,2).'%';
                                      ?>
                                      </td>
                                     <td class="nila">
                                      <?php
                                      $absent_perchatage   = ($absent*100)/$teache_class;
                                      echo number_format($absent_perchatage,2).'%';
                                      ?>
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

   