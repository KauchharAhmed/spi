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

      <center><h4 style="margin-top: 89px;"><span style="font-family:arial;border:1px solid #000;padding-top:4px;padding-bottom:4px;padding-left:27px;padding-right:27px;">HOLIDAY REPORT</span></h4></center>      
      <div class="row">

        <table>
          <tr>
            <td>DATE RANGE</td>
            <td>:</td>
            <td><b><?php echo date('d M Y',strtotime($from)).' To '.date('d M Y',strtotime($to)) ;?></b></td>
          </tr>
          <tr>
            <td>HOLIDAY TYPE</td>
            <td>:</td>
            <td><b>   
                          <?php
                          if($holiday_type_is == ''){
                            echo 'ALL';
                          }else{
                            if($holiday_type_is == '1'){
                              echo "Weekly";

                            }elseif($holiday_type_is == '2'){
                             echo "Public";
                            }elseif($holiday_type_is == '3'){
                              echo "Optional";
                            }elseif($holiday_type_is == '4'){
                              echo "National";
                            }elseif($holiday_type_is == '5'){
                              echo "Exam Break";
                            }elseif($holiday_type_is == '6'){
                              echo "Semester Break";
                            }elseif($holiday_type_is == '7'){
                              echo "Observance";
                            }elseif($holiday_type_is == '8'){
                              echo "Sports Break";
                            }
 
                          }

                          ?></b></td>
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
                    <td class="nila"><strong>HOLIDAY DATE</strong></td>
                    <td class="nila"><strong>HOLYDAY TYPE</strong></td>
                    <td class="nila"><strong>KEY NOTE</strong></td>
            </tr>
            </thead>
                  <tbody>
                               <?php $i = 1 ; foreach ($result as $value) { ?>
                         
                                 <tr>
                                    <td class="nila"><?php echo $i++ ; ?></td>
                                    <td class="nila"><?php echo date('d-M-Y',strtotime($value->holiday_date)) ; ?></td>   
                                    <td class="nila"><?php 
                                    if($value->type == '1'){
                                    echo "Weekly";

                            }elseif($value->type == '2'){
                             echo "Public";
                            }elseif($value->type == '3'){
                              echo "Optional";
                            }elseif($value->type == '4'){
                              echo "National";
                            }elseif($value->type == '5'){
                              echo "Exam Break";
                            }elseif($value->type == '6'){
                              echo "Semester Break";
                            }elseif($value->type == '7'){
                              echo "Observance";
                            }elseif($value->type == '8'){
                              echo "Sports Break";
                            } 

                                     ?></td> 
                                    <td class="nila"><?php 
                                    if($value->type == '1'){
                                   echo "Campus Off";

                            }elseif($value->type == '2'){
                          echo "Campus Off";
                            }elseif($value->type == '3'){
                            echo "Campus Off";
                            }elseif($value->type == '4'){
                              echo "Campus Off";
                            }elseif($value->type == '5'){
                              echo "Campus Open But Class Off";
                            }elseif($value->type == '6'){
                               echo "Campus Open But Class Off";
                            }elseif($value->type == '7'){
                              echo "Campus Open";
                            }elseif($value->type == '8'){
                               echo "Campus Open But Class Off";
                            } 

                                     ?></td>   
                                </tr>
  
                            <?php } ?>
                            </tbody>
                               <tr>
                            <td class="nila" colspan="3">
                              <strong>TOTAL HOLIDAYS</strong>
                            </td>
                             <td class="nila" colspan="4">
                           <strong><?php echo count($result);?></strong>  
                            </td>
                          </tr>

                        </table>

	<script type="text/javascript">
	window.print();
	</script>
    </body>
</html>

   