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
      <center><h4 style="margin-top: 89px;"><span style="font-family:arial;border:1px solid #000;padding-top:4px;padding-bottom:4px;padding-left:27px;padding-right:27px;">STAFF TRAINING REPORT</span></h4></center>      
      <div class="row">

        <table>
          <tr>
            <td>DATE RANGE</td>
            <td>:</td>
            <td><b><?php echo date('d M Y',strtotime($from)).' To '.date('d M Y',strtotime($to)) ;?></b></td>
          </tr>
          <tr>
            <td>STAFF</td>
            <td>:</td>
            <td><b>    <?php
                          if($staff == '0'){
                            echo 'ALL';
                          }else{
                            foreach ($result as $value1) {
                            
                            }
                         echo $value1->name.' - '.$value1->departmentName.' - '.$value1->degi ;
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
                    <td class="nila"><strong>STAFF</strong></td>
                    <td class="nila"><strong>DEPT</strong></td>
                    <td class="nila"><strong>DEGI</strong></td>
                    <td class="nila"><strong>TRAINING DATE</strong></td>
            </tr>
            </thead>
             <tbody>
                               <?php $i = 1 ; foreach ($result as $value) { ?>
                              
                                 <tr>
                                    <td class="nila"><?php echo $i++ ; ?></td>
                                    <td class="nila"><?php echo $value->name ; ?>
                                    </td> 
                                    <td class="nila"><?php echo $value->departmentName ; ?></td>   
                                    <td class="nila"><?php echo $value->degi ; ?></td>  
                                    <td class="nila"><?php 
                                    echo date('d M Y',strtotime($value->final_request_from)) ;
                                    ?></td>    
                                </tr>
                              
                            <?php } ?>
                            </tbody>
                            <tr>
                            <td class="nila" colspan="4">
                              <strong>TOTAL DAYS</strong>
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

   