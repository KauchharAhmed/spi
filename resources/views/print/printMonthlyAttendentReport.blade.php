<?php
$department_head_id = Session::get('admin_id');
$type               = Session::get('type');
if($department_head_id == null && $type != '1'){
return Redirect::to('/admin')->send();
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title> Report Print</title>
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
          <h3>SIRAJGANJ POLYTECHNIC INSTITUTE</h3>
          <P>Fokirtola,Sirajganj</P>
          <p>Cell:01710450614</p>
        </div>
        <div class="bd_logo">
          <img src="{{URL::to('images/spi_logo.jpg')}}" style="width: 100px;height: 100px;">
        </div>
      </div>
      <br>

      <center><h4 style="margin-top: 89px;"><span style="font-family:arial;border:1px solid #000;padding-top:4px;padding-bottom:4px;padding-left:27px;padding-right:27px;">MONTHLY STUDENT'S ATTENDENT REPORTS</span></h4></center>      
      <div class="row">

        <table>
          <tr>
            <td>Year</td>
            <td>:</td>
            <td><b><?php echo $year ; ?></b></td>
          </tr>
          <tr>
            <td>Shift</td>
            <td>:</td>
            <td><b><?php echo $shift_name->shiftName ; ?></b></td>
          </tr>
          <tr>
            <td>Department</td>
            <td>:</td>
            <td><b><?php echo $dept_name->departmentName;  ?></b></td>
          </tr>

          <tr>
            <td>Semester</td>
            <td>:</td>
            <td><b><?php echo $semister_name->semisterName ;  ?></b></td>
          </tr>
          <tr>
            <td>Section</td>
            <td>:</td>
            <td><b><?php echo $section_name->section_name ;  ?></b></td>
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
            <td>Holiday's</td>
            <td>:</td>
            <td><b>
              <?php echo $count_holiday." Days"; ?>
            </b></td>
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

                    <td class="nila"><strong>SL NO</strong></td>
                    <td class="nila"><strong>ROLL</strong></td>
                    <td class="nila"><strong>REGISTRATION</strong></td>
                    <td class="nila"><strong>TOTAL CLASS (DAYS)</strong></td>
                    <td class="nila"><strong>PRESENT (DAYS)</strong></td>
                    <td class="nila"><strong>ABSENT (DAYS)  </strong></td>
                    <td class="nila"><strong>PRESENT (DAYS)%</strong></td>
                    <td class="nila"><strong>ABSENT (DAYS)% </strong></td>
     
            </tr>
            </thead>
                               <?php $i = 1 ; foreach ($result as $value) { ?>
                               <tbody>
                                 <tr>
                                    <td class="nila"><?php echo $i++ ; ?></td>
                                    <td class="nila"><?php echo $value->roll ; ?></td>   
                                    <td class="nila"><?php echo $value->registration ; ?></td>    
                                    <td class="nila"><?php 
                                     $total_class_day = $month_total_day - $count_holiday ;
                                     echo $total_class_day ; 
                                    ?></td> 
                                    <td class="nila">
                                       <?php 
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
                                       echo $present ;
                                      ?>
                                     </td>
                                    <td class="nila"> <?php 
                                    $absent =  $total_class_day - $present ; 
                                    echo $absent ;
                                    ?>  </td>
                                    <td class="nila"> 
                                      <?php
                                      $present_perchatage   = ($present*100)/$total_class_day;
                                      echo number_format($present_perchatage,2).'%';
                                      ?>
                                      </td>
                                     <td class="nila">
                                      <?php
                                      $absent_perchatage   = ($absent*100)/$total_class_day;
                                      echo number_format($absent_perchatage,2).'%';
                                      ?>
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

   