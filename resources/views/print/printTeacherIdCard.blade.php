<?php
$department_head_id = Session::get('admin_id');
$type               = Session::get('type');
if($department_head_id == null && $type != '2'){
return Redirect::to('/admin')->send();
}
?>
<html lang="en">
<head>
  <title></title>
   <link rel="stylesheet" href="{{URL::to('public/assets/css/solaimanlipi.css')}}"/>
    <link href="{{URL::to('public/assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::to('public/assets/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="{{URL::to('public/assets/default/media/img/logo/favicon.ico')}}"/> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.3/sweetalert2.min.css">
    <link rel="stylesheet" href="{{URL::to('public/assets/css/custom_style.css')}}"/>
  <meta charset="utf-8">
  <style type="text/css">
  @media print {
  body {-webkit-print-color-adjust: exact;}
  } 
  .wrapper{
    width:100%;
    height:auto;
    !background:pink !important;
    margin:0px auto;
  }
  .row1{
    width:60%;
    height:auto;
    !background:orange !important;
    float:left;
  }
  .row2{
    width:30%;
    height:auto;
    !background:green !important;
    float:right;
  }
  .row3{
    width:100%;
    height:auto;
    !background:green !important;
    float:right;
  }
  table.cut,tr.cut,td.cut{
    border-collapse: collapse;
    border:1px solid #000;
    padding:5px;
    font-family:tahoma;
    font-size:14px;
  }
  .first_row{
    width:100%;
    height:140px;
    margin-top:15px;
  }
  .second_row{
    width:100%;
    height:500px;
    margin-top:0px;
  }
  
  table.roni, td.roni, th.roni {
      border: none;
    }

  .text_main{
  text-align:center;
  margin:0;
  padding:0;
  line-height:5px;
  }
  .sompa ul li{
      float:left;
    }
    .nila tr td{
      border-collapse: collapse;
      border:1px solid black;
      padding:5px;
      font-family:tahoma;
      font-size:14px;
    }
  div.fixed {
      position: fixed;
      bottom: 0;
      right: 0;
      width:100%;
    }
  table.align {
    border-collapse: collapse;
    text-align: center;
       }
  </style>
</head>

<body> 

<style type="text/css">

.scholl_name {
        background: black !important;
        color: white !important;
        
    }

 @media print and (color){
  -webkit-print-color-adjust: exact;
  print-color-adjust: exact;
}

 @media print{
  .scholl_name {
    -webkit-print-color-adjust: exact;
    background: black !important;
        
    }

  .student_color{
    -webkit-print-color-adjust: exact;
    background: black !important;
    padding-top: 10px;
    padding-bottom:10px
  }
  }

  html {zoom: 100%;}
 }

  

/*    @page:first {
  size: portrait;  
  margin-bottom: -500px;
  
  
}*/
/*  @page {
  size: portrait;  
  margin-top: 100px;
}*/

</style>


<div class="row">
               <div class="col-xs-4">
        
                           <h6 class="scholl_name" style="padding-top: 10px;padding-bottom:10px;background-color: #2d3caf !important"><center><span style="color:white !important;font-weight: bolder;">SIRAJGANJ POLYTECHNIC INSTITUTE</span></center></h6>
                              <center>                                
                                <img width="50" src="{{URL::to('images/bd_logo.png') }}">

                            Fakirtola , Sirajganj ,

                           Est-2004
                           <img width="50" height="50" src="{{URL::to('images/spi_logo.jpg') }}">
                           </center>
                           <center>
                           <img style="display:none;" width="70px;" style="height:80px" src="images/<?php //echo $setting->showSetting()->image;?>">
                           <img width="80px;" style="height:80px" src="{{URL::to($data->image) }}" width="100" height="50">
                           <img style="display: none;" width="70px;" style="height:80px" src="images/<?php //echo $value1->studentImage;?>">
                           </center>
                            <h4 style="padding-top: 10px;padding-bottom:1px;">
                              <center><span style="color:black !important;font-weight: bolder;text-transform:uppercase;"><?php echo $data->name;?></span></center></h4>
                              <h6 style="padding-top: 1px;padding-bottom:1px;">
                              <center><span style="color:black !important;font-weight: bolder;text-transform:uppercase;"><?php echo $data->degi;?></span></center></h6>
                            <table>
                              <tr>
                                <td style="font-size:10px; padding-left: 22px;">Id No.</td>
                                <td style="font-size:10px;"><?php echo $data->user_id ; ?></td>
                                <td style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dept</td>
                                <td style="font-size:10px;">  <?php if($dept != '0'){
                                   echo $dept->departmentName; 
                                 }
                                   ?>
                                    </td>
                              </tr>
                                <tr>
                                <td style="font-size:10px;  padding-left: 22px;">Mobile</td>
                                <td style="font-size:10px;"><?php
                                echo $data->mobile;  ?> 
                                  </td>

                                <td style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email</td>
                                <td style="font-size:10px;"><?php
                                echo $data->email;  ?> </td>
                              </tr>
                                <tr>
                                <td style="font-size:10px;  padding-left: 22px;">Join Date</td>
                                <td style="font-size:10px;"><?php
                                echo $data->joinig_date;  ?> 
                                  </td>

                                  <tr>
                                <td style="font-size:10px; padding-left: 22px;"><span style="color:red;">Blood Group</span></td>
                                <td style="font-size:10px;" colspan="3"> <span style="color:red;">
                                  <?php echo $data->blood_group;?>
                                </span></td>
                              </tr>
                                </tr>
                               
                            </table>

                             <center>                                
                              <table>
                              
                                <tr>
                                  <td><img width="50" height="25" style="margin-right: 50px; display: none;" src="{{URL::to('images/principal.png') }}"></td>
                                  <td><img width="50" height="25" style="margin-right: 50px;display: none;" src="{{URL::to('images/principal.png') }}"></td>
                                  <td><img width="50" height="25" src="{{URL::to('images/principal.png') }}"></td>
                                </tr>
                                <tr>
                                  <td><span style="border-top:1px solid #000; display: none;">Register</span></td>
                                  <td><span style="border-top:1px solid #000; display: none;">Dept. Head</span></td>
                                   <td><span style="border-top:1px solid #000;">Principal</span></td>
                                </tr>
                              </table>
                            </center>
                            <div class="row" style="margin-top:5px;
    font-size: 9px;
    padding-left:  35px;
}">
                           Software Developed By : Asian IT Inc (asianitinc.com)
                           </div>
                           </div>


</div>






  <script type="text/javascript">
  window.print();
  </script>
</body>
</html>     
      