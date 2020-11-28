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

      <center><h4 style="margin-top: 89px;"><span style="font-family:arial;border:1px solid #000;padding-top:4px;padding-bottom:4px;padding-left:27px;padding-right:27px;">DAILY STUDENTS DOOR ATTENDENT REPORT</span></h4></center>      
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
            <td>Date</td>
            <td>:</td>
            <td><b><?php echo date('d M Y',strtotime($from)); ?></b></td>
          </tr>

           <tr>
            <td>Total Students</td>
            <td>:</td>
            <td><b><?php echo $count_student; ?></b></td>
          </tr>
           <tr>
            <td>Presents</td>
            <td>:</td>
            <td><b><?php echo $total_present_student; ?></b></td>
          </tr>
              <tr>
            <td>Absents</td>
            <td>:</td>
            <td><b><?php echo $count_student - $total_present_student; ?></b></td>
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
                    <td class="nila"><strong>NAME</strong></td>
                    <td class="nila"><strong>ROLL</strong></td>
                    <td class="nila"><strong>REG</strong></td>
                    <td class="nila"><strong>MOBILE</strong></td>
                    <td class="nila"><strong>STATUS  </strong></td>
                    <td class="nila"><strong>FIRST ENTER</strong></td>
                    <td class="nila"><strong>ENTER NUMBER </strong></td>
                    <td class="nila"><strong>ENTER TIMES </strong></td>
            </tr>
            </thead>
                               <?php $i = 1 ; foreach ($result as $value) { ?>
                               <tbody>
                                 <tr>
                                    <td class="nila"><?php echo $i++ ; ?></td>
                                    <td class="nila"><?php
                                      $student_info = DB::table('students')->where('id',$value->studentID)->first();
                                      echo  $student_info->studentName ;
                                      ?>
                                    </td> 
                                    <td class="nila"><?php echo $value->roll ; ?></td>   
                                    <td class="nila"><?php echo $value->registration ; ?></td>  
                                    <td class="nila"><?php echo  $student_info->studentMobile ;?></td>  
                                    <td class="nila">
                                      <?php
                                      // get studen status present or absent
                                      $present        = DB::table('tbl_door_log')
                                      ->where('student_id',$value->studentID)
                                      ->where('enter_date',$from)
                                      ->orderBy('enter_time','asc')
                                      ->get();
                                      $prsent_status =  count($present) ;
                                      if($prsent_status > 0):?>
                                         <span style="color:green"> <?php echo "PRESENT";?>
                                         <?php else:?>
                                          <span style="color:red"> <?php echo "ABSENT";?>
                                     <?php endif;?>
                                    </td> 
                                    <td class="nila">
                                       <?php if($prsent_status > 0){ ?>
                                       <span style="color:green">   <?php $present_time = DB::table('tbl_door_log')
                                      ->where('student_id',$value->studentID)
                                      ->where('enter_date',$from)
                                      ->orderBy('enter_time','asc')
                                      ->first();
                                      echo date('h:i:s a',strtotime($present_time->enter_time));
                                      ?>
                                      <?php } ?>
                                    </td>   
                                    <td class="nila">
                                        <span style="color:green"><?php  if($prsent_status > 0){echo $prsent_status;}?></span>
                                    </td>  
                                    <td class="nila">
                                      <?php if($prsent_status > 0){ ?>
                                      <?php foreach ($present as $present_time_value) { ?>
                                      <span style="color:green">
                                        <?php echo date('h:i:s a',strtotime($present_time_value->enter_time)).' , '; ?>
                                      </span> 
                                      <?php } ?>
                                      <?php } ?>
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

   