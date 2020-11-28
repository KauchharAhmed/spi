@extends('web.masterWeb')
@section('content')
<div class="col-md-12">
				<div class="header_section">
					<div class="row">
						<div class="col-md-6 page_headers">
							<h4>Staff List</h4>
						</div>
						<div class="col-md-6 page_links">
							<a href="" title="">Home</a> <span> > Staff List</span>
						</div>
					</div>
				</div>
			</div>
			<!-- Main Content Start Here -->
			<div class="col-md-9" style="margin-top: 20px;">
				<h4 style=" color: #17469e;text-align: left;font-family: Arimo;font-weight: 400;font-style: normal;text-transform: uppercase;">Staff List</h4>
				<hr style="background: #17469e; ">
				<div class="row" >
					
                      <table class="table table-hover table-responsive">
    <thead>
      <tr>
      	 <th>Sl</th>
        <th>Name</th>
        <th>Dept</th>
        <th>Degi</th>
        <th>Mobile</th>
        <th>Image</th>
      </tr>
    </thead>
    <tbody>
    	<?php $i = 1 ; foreach ($result as $value) { ?>
      <tr>
        <td><?php echo $i++ ;?></td>
        <td><?php echo $value->name;?></td>
        <td><?php echo $value->departmentName;?></td>
         <td><?php echo $value->degi;?></td>
          <td><?php echo $value->mobile;?></td>
          <td>
          	<?php if($value->image != ''){?>
          	<img style="border-radius: 50%" height="80" width="80" src="<?php echo $value->image;?>">
          	<?php } ?>
          </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

				</div>
			</div>
			<!-- End Main Content  -->
@endsection
