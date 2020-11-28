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
      <center><h4 style="margin-top: 89px;"><span style="font-family:arial;border:1px solid #000;padding-top:4px;padding-bottom:4px;padding-left:27px;padding-right:27px;">TOTAL CLASS HELD SUMMARY REPORT</span></h4></center>      
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
            <td>Printed on</td>
            <td>:</td>
            <td><b><?php echo date('d M Y, h:i:s A');  ?></b></td>
          </tr>
        </table>
      <table width="100%" class="nila" style="font-size:14px;">
                  <thead>
                    <tr>    
                    <td class="nila"><strong>SL</strong></td>
                    <td class="nila"><strong>SHIFT</strong></td>
                    <td class="nila"><strong>TOTAL CLASSES</strong></td>
                    <td class="nila"><strong>TOTAL HELD CLASSES</strong></td>
                    <td class="nila"><strong>TOTAL NOT HELD CLASSES</strong></td>
                    <td class="nila"><strong>CLASS HELD  %</strong></td>
                    <td class="nila"><strong>CLASS NOT HELD %</strong></td>
                  </tr>
            </thead>
                         <tbody>
                                    <?php 
                                 $i = 1 ;
                                 foreach ($result as $value) { ?>
                                 <tr>
                                    <td class="nila"><?php echo $i++;?></td>
                                    <td class="nila"><?php echo $value->shiftName ; ?></td>
                                    <td class="nila">
                                      <?php
                                 $total_class_count = DB::table('routine')
                                ->join('semister', 'routine.semister_id', '=', 'semister.id')
                                ->select('routine.*')
                                ->where('routine.year', $from_year)
                                ->where('routine.shift_id', $value->id)
                                ->where('routine.day', $current_day)
                                ->where('semister.status',1)
                                ->count();
                                echo $total_class_count ;
                               ?>
                                    </td>
                                    <td class="nila">
                                      <?php
                                      $total_class_held = DB::table('teacher_attendent')->where('created_at',$from)->where('shift_id',$value->id)->where('status',1)->count();
                                      echo $total_class_held ; 
                                      ?>
                                    </td>
                                    <td class="nila">
                                      <?php $not_held = $total_class_count - $total_class_held ; echo $not_held ;  ?> 
                                    </td>
                                    <td class="nila">
                                      <?php $class_held_perchatage   = ($total_class_held*100)/$total_class_count;
                                      echo number_format($class_held_perchatage,2).'%';
                                      ?>
                                      
                                    </td>
                                    <td class="nila"><?php $class_not_held_perchatage   = ($not_held*100)/$total_class_count;
                                      echo number_format($class_not_held_perchatage,2).'%';
                                      ?></td> 
                                </tr>  
                                    <?php } ?> 
                            </tbody>
                        </table>
	<script type="text/javascript">
	window.print();
	</script>
    </body>
</html>

   