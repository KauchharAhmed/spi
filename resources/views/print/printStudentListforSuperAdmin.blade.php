<?php
$super_admin_id = Session::get('admin_id');
$type               = Session::get('type');
if($super_admin_id == null && $type != '1'){
return Redirect::to('/admin')->send();
}
?>
<?php foreach ($data as $value1) { }?>
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
      <center><h4 style="margin-top: 89px;"><span style="font-family:arial;border:1px solid #000;padding-top:4px;padding-bottom:4px;padding-left:27px;padding-right:27px;">STUDENT LIST</span></h4></center>      
      <div class="row">
        <table>
          <tr>
            <td>Year</td>
            <td>:</td>
            <td><b><?php echo $year ;?></b></td>
          </tr>
          <tr>
            <td>Department</td>
            <td>:</td>
            <td><b><?php if($dep_id != ''){ echo $value1->departmentName; }else{ echo "All"; } ?></b></td>
          </tr>
          <tr>
            <td>Shift</td>
            <td>:</td>
            <td><b><?php if($shift != ''){ echo $value1->shiftName; }else{ echo "All"; } ?></b></td>
          </tr>
          <tr>
          <tr>
            <td>Semester</td>
            <td>:</td>
            <td><b><?php if($semister != ''){ echo $value1->semisterName; }else{ echo "All"; } ?></b></td>
          </tr>
          <tr>
          <tr>
            <td>Section</td>
            <td>:</td>
            <td><b><?php if($section != ''){ echo $value1->section_name; }else{ echo "All"; } ?></b></td>
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
                    <td class="nila"><strong>SESSION</strong></td>
                    <td class="nila"><strong>NAME</strong></td>
                    <td class="nila"><strong>DEPT</strong></td>
                    <td class="nila"><strong>SHIFT</strong></td>
                    <td class="nila"><strong>SEMISTER</strong></td>
                    <td class="nila"><strong>SECTION</strong></td>
                    <td class="nila"><strong>ROLL</strong></td>
                    <td class="nila"><strong>REG</strong></td>
                    <td class="nila"><strong>MOBILE</strong></td>    
                  </tr>
                  </thead>
                    <?php $i = 1 ; foreach ($data as $value) { ?>
                    <tbody>
                       <tr>
                          <td class="nila"><?php echo $i++ ; ?></td>
                          <td class="nila"><?php echo $value->sessionName;?></td>
                          <td class="nila"><?php echo $value->studentName;?></td>
                           <td class="nila"><?php echo $value->departmentName;?></td>
                          <td class="nila"><?php echo $value->shiftName;?></td>
                          <td class="nila"><?php echo $value->semisterName;?></td>
                          <td class="nila"><?php echo $value->section_name;?></td>
                          <td class="nila"><?php echo $value->roll;?></td>
                          <td class="nila"><?php echo $value->registration;?></td>
                          <td class="nila"><?php echo $value->studentMobile;?></td>  
                          
                      </tr>
                    <?php } ?>       
                    </tbody>
            </table>
	<script type="text/javascript">
	window.print();
	</script>
    </body>
</html>

   