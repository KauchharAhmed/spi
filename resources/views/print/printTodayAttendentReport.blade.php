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
          <h3>SIRAJGANJ POLYTECHNIC INSTITUTE</h3>
          <P>Fokirtola,Sirajganj</P>
          <p>Cell:01710450614</p>
        </div>
        <div class="bd_logo">
          <img src="{{URL::to('images/spi_logo.jpg')}}" style="width: 100px;height: 100px;">
        </div>
      </div>
      <br>

      <center><h4 style="margin-top: 89px;"><span style="font-family:arial;border:1px solid #000;padding-top:4px;padding-bottom:4px;padding-left:27px;padding-right:27px;">TODAY STUDENT'S CLASS ATTENDENT REPORTS</span></h4></center>      
      <div class="row">

        <table>
          <tr>
            <td>Shift</td>
            <td>:</td>
            <td><b><?php echo $shift_name->shiftName ;  ?></b></td>
          </tr>
          <tr>
            <td>Department</td>
            <td>:</td>
            <td><b><?php echo $dept_name->departmentName ;  ?></b></td>
          </tr>

          <tr>
            <td>Printed on</td>
            <td>:</td>
            <td><b><?php echo date('d M Y, h:i:s A');  ?></b></td>
          </tr>
        </table>


<?php foreach ($section_name as $sections_name) { ?>
                  <p style="margin-left:2px;"><strong>Section - <?php echo $sections_name->section_name ; ?></strong></p>
               
   <table width="100%" class="nila" style="font-size:14px;">
                  <thead>
                    <tr>    
                    <td class="nila"><strong>SL NO</strong></td>
                    <td class="nila"><strong>SEMESTER</strong></td>
                    <td class="nila"><strong>TOTAL STUDENT'S</strong></td>
                    <td class="nila"><strong>PRESENT</strong></td>
                    <td class="nila"><strong>ABSENT</strong></td>
                    <td class="nila"><strong>PRESENT % </strong></td>
                    <td class="nila"><strong>ABSENT %</strong></td>
     
            </tr>
            </thead>
                               <?php $i = 1 ; foreach ($result as $value) { ?>
                               <tbody>
                                 <tr>
                                    <td class="nila"><?php echo $i++ ; ?></td>
                                    <td class="nila"><?php echo $value->semisterName;?></td>   
                                    <td class="nila">  
                                     <?php
                                     // get total student of this semister
                                      date_default_timezone_set('Asia/Dhaka');
                                      $current_year = date('Y');
                                      $student_count        = DB::table('student')
                                      ->where('year',$current_year)
                                      ->where('section_id',$sections_name->id)
                                      ->where('shift_id',$shift_id)
                                      ->where('dept_id',$dept_id)
                                      ->where('semister_id',$value->id)
                                      ->count();
                                       echo $student_count ;
                                     ?>
                                    </td>    
                                    <td class="nila">
                                      <?php
                                      $current_date = date('Y/m/d'); 
                                      $count        = DB::table('student_attendent')
                                      ->where('section_id',$sections_name->id)
                                      ->where('shift_id',$shift_id)
                                      ->where('dept_id',$dept_id)
                                      ->where('semister_id',$value->id)
                                      ->where('created_at',$current_date)
                                      ->groupBy('roll')
                                      ->get();
                                       $total_present = count($count) ;
                                       echo $total_present;
                                       ?>
                                    </td> 
                                    <td class="nila">
                                      <?php 
                                        $absent = $student_count - count($count) ; 
                                        echo $absent ;
                                      ?>
                                    </td>
                                    <td class="nila">
                                    <?php 
                                   if($student_count == 0){
                                    }else{
                                       $present_perchatage   = ($total_present*100)/$student_count;
                                      echo $present_perchatage.'%';
                                    }
                                    ?>
                                      
                                    </td>
                                    <td class="nila">
                                    <?php 
                                      if($student_count == 0){
                                    }else{
                                        $absent_perchatage    = ($absent*100)/$student_count;
                                        echo $absent_perchatage.'%'; 
                                        } 
                                    ?>  
                                    </td>
                                </tr>
                            </tbody>
                            <?php } ?>

                        </table>
                    
                      <?php } ?>

	<script type="text/javascript">
	window.print();
	</script>
    </body>
</html>

   