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
      <center><h4 style="margin-top: 89px;"><span style="font-family:arial;border:1px solid #000;padding-top:4px;padding-bottom:4px;padding-left:27px;padding-right:27px;">PERIODIC STUDENT PRESENT ATTENDENT REPORT</span></h4></center>      
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
            <td>Date Range</td>
            <td>:</td>
            <td><b><?php echo date ("d M Y", strtotime($from)).' To '.date("d M Y", strtotime($to));?></b></td>
          </tr>
          <tr>
            <td>Total Day's</td>
            <td>:</td>
            <td><b><?php echo $total_day." DAYS"; ?></b></td>
          </tr>
          <tr>
            <td>Holiday's</td>
            <td>:</td>
            <td><b>
              <?php echo $count_holiday.' DAYS'; ?>
            </b></td>
          </tr>
          <tr>
            <td>Sorting Type</td>
            <td>:</td>
            <td><b>
              <?php if($sorting_type == '1'){
                      echo "Equal";
                    }elseif($sorting_type == '2'){
                      echo "Morethan";
                    }elseif($sorting_type == '3'){
                      echo "Lessthan";
                    } 
              ?>
            </b></td>
          </tr>
          <tr>
            <td>Sorting Days</td>
            <td>:</td>
            <td><b>
              <?php echo $attendent_days; ?>
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
                      <td class="nila"><strong>TOP RANK</strong></td>
                      <td class="nila"><strong>ROLL</strong></td>
                      <td class="nila"><strong>REGISTRATION</strong></td>
                      <td class="nila"><strong>TOTAL CLASS DAYS</strong></td>
                      <td class="nila"><strong>PRESENT DAYS</strong></td>
                      <td class="nila"><strong>PRESENT DAYS %</strong></td>
                   </tr>
                  </thead>
                          <tbody>
                              <?php $i = 1 ; 
                                     $j = 1 ;
                               foreach ($result as $value) { ?>
                                <?php if($sorting_type == '1' AND $attendent_days == $value->count):?>
                                 <tr>
                                    <td class="nila"><?php echo $i++ ; ?></td>
                                      <td class="nila"><?php echo $j++ ; ?></td>
                                    <td class="nila"><?php echo $value->roll ; ?></td>   
                                    <td class="nila"><?php echo $value->registration ; ?></td> 
                                     <td class="nila">
                                      <?php 
                                       $total_class_day = $total_day - $count_holiday ;
                                       echo  $total_class_day ;

                                       ?>
                                     </td>   
                                    <td class="nila">
                                       <?php 
                                        echo $value->count ;
                                      ?>
                                     </td>
                                    <td class="nila"> 
                                      <?php
                                      
                                        $present_perchatage   = ($value->count*100)/$total_class_day;
                                       echo number_format($present_perchatage,2).'%';
                           
                                      ?>
                                    
                                </tr>
                              <?php elseif($sorting_type == '2' AND $attendent_days < $value->count):?>
                                 <tr>
                                    <td class="nila"><?php echo $i++ ; ?></td>
                                    <td class="nila"><?php echo $j++ ; ?></td>
                                    <td class="nila"><?php echo $value->roll ; ?></td>   
                                    <td class="nila"><?php echo $value->registration ; ?></td>   
                                    <td class="nila">
                                         <?php $total_class_day = $total_day - $count_holiday ;
                                       echo  $total_class_day ;?>
                                    </td> 
                                   
                                    <td class="nila">
                                       <?php 
                                  
                                       echo $value->count ;
                                      ?>
                                     </td>
                                    <td class="nila"> 
                                       <?php
                                      
                                        $present_perchatage   = ($value->count*100)/$total_class_day;
                                       echo number_format($present_perchatage,2).'%';
                           
                                      ?>
                                    </td>
                                    
                                </tr>
                                  <?php elseif($sorting_type == '3' AND $attendent_days > $value->count):?>
                                 <tr>
                                    <td class="nila"><?php echo $i++ ; ?></td>
                                    <td class="nila"><?php echo $j++ ; ?></td>
                                    <td class="nila"><?php echo $value->roll ; ?></td>   
                                    <td class="nila"><?php echo $value->registration ; ?></td> 
                                    <td class="nila"><?php $total_class_day = $total_day - $count_holiday ;
                                       echo  $total_class_day ;?></td>   
                                   
                                    <td class="nila">
                                       <?php 
                                         echo $value->count ;
                                      ?>
                                     </td>
                                    <td class="nila"> 
                                      <?php
                                      $present_perchatage   = ($value->count*100)/$total_class_day;
                                       echo number_format($present_perchatage,2).'%';
                                      ?>
                                    </td>
                                    
                                </tr>
                              <?php endif;?>
                                  <?php } ?>    


                              <?php if($sorting_type == '1' AND $attendent_days == '0') :?>
                                 <?php foreach ($absent_result as $absent_value) { ?>
                                     <tr>
                                    <td class="nila"><?php echo $i++ ; ?></td>
                                    <td class="nila"><?php echo $j++ ; ?></td>
                                    <td class="nila"><?php echo $absent_value->roll ; ?></td>   
                                    <td class="nila"><?php echo $absent_value->registration ; ?></td>   
                                    <td class="nila"><?php $total_class_day = $total_day - $count_holiday ;
                                       echo  $total_class_day ;?></td>  
                                   
                                    <td class="nila">
                                     0
                                     </td>
                                    <td class="nila"> 
                                     0.00 % 
                                   </td>
                                    
                                </tr>
                              <?php }?>
                              <?php elseif($sorting_type == '3'):?>
                              <?php foreach ($absent_result as $absent_value) { ?>
                                     <tr>
                                    <td class="nila"><?php echo $i++ ; ?></td>
                                      <td class="nila"><?php echo $j++ ; ?></td>
                                    <td class="nila"><?php echo $absent_value->roll ; ?></td>   
                                    <td class="nila"><?php echo $absent_value->registration ; ?></td>  
                                       <td class="nila"><?php $total_class_day = $total_day - $count_holiday ;
                                       echo  $total_class_day ;?></td>   
                                   
                                    <td class="nila">
                                     0
                                     </td>
                                    <td class="nila"> 
                                     0.00 % 
                                    </td>
                                </tr>
                              <?php }?>
                              <?php endif;?>             
                    </tbody>
                        </table>

	<script type="text/javascript">
	window.print();
	</script>
    </body>
</html>

   