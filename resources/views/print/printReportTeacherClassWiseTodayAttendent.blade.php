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

      <center><h4 style="margin-top: 89px;"><span style="font-family:arial;border:1px solid #000;padding-top:4px;padding-bottom:4px;padding-left:27px;padding-right:27px;">TEACHER CLASS WISE TODAY CLASS ATTENDENT REPORT</span></h4></center>      
      <div class="row">
        <table>
          <tr>
            <td>Today Date</td>
            <td>:</td>
            <td><b><?php echo date('d M Y');  ?></b></td>
          </tr>
          <tr>
            <td>Day</td>
            <td>:</td>
            <td><b><?php echo date('l',strtotime($today));?></b></td>
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
                    <td class="nila"><strong>TEACHER NAME</strong></td>
                    <td class="nila"><strong>DEPT</strong></td>
                    <td class="nila"><strong>DEG</strong></td>
                    <td class="nila"><strong>TODAY TOTAL CLASS</strong></td>
                    <td class="nila"><strong>PRESENT CLASS</strong></td>
                    <td class="nila"><strong>ABSENT CLASS</strong></td>
                    <td class="nila"><strong>PRESENT CLASS %</strong></td>
                    <td class="nila"><strong>ABSENT CLASS %</strong></td>
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
                                  //today total class of this teacher
                                  $from_year = date('Y');
                                 $total_class =  DB::table('routine')
                                ->join('semister', 'routine.semister_id', '=', 'semister.id')
                                ->select('routine.*')
                                ->where('teacher_id',$value->id)
                                ->where('routine.year', $from_year)
                                ->where('routine.day', $day)
                                ->where('semister.status',1)
                                ->count();
                                echo $total_class ;
                                  ?>
                                    </td> 
                                    <td class="nila">
                                      <?php
                                       // check leave status 

                                       // check leave status 
                                      $leave = DB::table('tbl_leave')
                                      ->where('user_id',$value->id)
                                      ->where('final_request_from', '<=', $today)
                                      ->where('final_request_to', '>=', $today)
                                      ->where('type_status', '0')
                                      ->count();
                                      $traning = DB::table('tbl_leave')
                                      ->where('user_id',$value->id)
                                      ->where('final_request_from', '<=', $today)
                                      ->where('final_request_to', '>=', $today)
                                      ->where('type_status', '1')
                                      ->count();
                                      ?>
                                   
                                
                                     <?php if($leave > 0):?>
                                       <span style="color: orange;">LEAVE</span>
                                          <?php elseif($traning > 0):?>
                                       <span style="color: blue;">TRAINING</span>
                                      <?php else: ?>
                                        <?php
                                      // present class count
                                      $present = DB::table('teacher_attendent')
                                      ->where('teacherId',$value->id)
                                      ->where('created_at', $today)
                                      ->where('status',1)
                                      ->count();
                                       echo $present ;
                                      ?>
                                    <?php endif;?> 
                                    </td>
                                    <td class="nila"> <?php if($leave > 0):?>
                                       <span style="color: orange;">LEAVE</span>
                                          <?php elseif($traning > 0):?>
                                       <span style="color: blue;">TRAINING</span>
                                      <?php else: ?>
                                        <?php
                                        $absent = $total_class-$present ;
                                        echo $absent ;
                                        ?>
                                      <?php endif;?>  </td>
                                      <td class="nila">
                                        <?php if($leave > 0):?>
                                       <span style="color: orange;">LEAVE</span>
                                          <?php elseif($traning > 0):?>
                                       <span style="color: blue;">TRAINING</span>
                                      <?php else: ?>
                                        <?php if($total_class >0){
                                        $present_percentage = ($present*100)/$total_class;
                                        echo number_format($present_percentage,2).' %' ;
                                      }?>
                                    <?php endif;?>
                                  
                                      </td>
                                      <td class="nila">   
                                        <?php if($leave > 0):?>
                                       <span style="color: orange;">LEAVE</span>
                                          <?php elseif($traning > 0):?>
                                       <span style="color: blue;">TRAINING</span>
                                      <?php else: ?>
                                        <?php if($total_class >0){
                                        $absent_percentage = ($absent*100)/$total_class;
                                        echo number_format($absent_percentage,2).' %' ;
                                      }
                                      ?>
                                    <?php endif;?>
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

   