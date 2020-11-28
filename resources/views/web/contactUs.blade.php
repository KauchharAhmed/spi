@extends('web.webMasterWithoutSidebar')
@section('content')
<div class="col-md-12">
	<div class="header_section">
		<div class="row">
			<div class="col-md-6 page_headers">
				<h4>Contact Us</h4>
			</div>
			<div class="col-md-6 page_links">
				<a href="" title="">Home</a> <span> > Contact Us</span>
			</div>
		</div>
	</div>
</div>
<!-- Main Content Start Here -->
<div class="col-md-12" style="margin-top: 20px;">
	<h4 style=" color: #17469e;text-align: left;font-family: Arimo;font-weight: 400;font-style: normal;text-transform: uppercase;">Contact US</h4>
	<hr style="background: #17469e; ">

	<div class="col-md-12">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3631.12954624582!2d89.68226551454082!3d24.48096788423425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fdc03437b86a4d%3A0x5cc8f632f81db526!2sSirajganj+Polytechnic+Institute%2C+Sirajganj!5e0!3m2!1sen!2sbd!4v1564485246514!5m2!1sen!2sbd" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
	<br>
	<div class="row">
		<div class="col-md-6">
			<h4 style=" color: #17469e;text-align: left;font-family: Arimo;font-weight: 400;font-style: normal;text-transform: uppercase;">Send Email</h4>
			<hr style="background: #17469e;">
			<form id="contract_us" method="post">
			  <div style="padding: 15px;">
			  	<div class="form-group row">
				    <label for="inputFullName" class="col-form-label">Full Name</label>
				    <span style="color: red;font-weight: bold;" id="inputFullName"></span>
				    <input type="text" class="form-control" name="full_name" placeholder="Full Name" required="">
				  </div>

				  <div class="form-group row">
				    <label for="inputEmail" class="col-form-label">Email Address</label>
				    <span style="color: red;font-weight: bold;" id="inputEmail"></span>
				    <input type="text" class="form-control" name="email" placeholder="Email Address" required="">
				  </div>

				  <div class="form-group row">
				    <label for="inputSubject" class="col-form-label">Subject</label>
				    <span style="color: red;font-weight: bold;" id="inputSubject"></span>
				    <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
				  </div>

				  <div class="form-group row">
				    <label for="inputMessage" class=" col-form-label">Message</label>
				    <span style="color: red;font-weight: bold;" id="inputMessage"></span>
				   	<textarea class="form-control" rows="5" name="message" required=""></textarea>
				  </div>

				  <div class="form-group row">
				    <button type="submit" class="btn btn-success btn-md">Submit</button>

				  </div>
			  </div>		
			</form>
		</div>

		<div class="col-md-6">
			<h4 style=" color: #17469e;text-align: left;font-family: Arimo;font-weight: 400;font-style: normal;text-transform: uppercase;">Contact Details</h4>
			<hr style="background: #17469e;">
			<p class="text-justify">
			   Address : Kazipur Road , Sirajganj Sador , Sirajganj
			</p>

			<p class="text-danger">
				<i class="fa fa-phone" aria-hidden="true"></i> 075164286;
			</p>
			<p class="text-danger">
				<i class="fa fa-phone" aria-hidden="true"></i> 01716235243;
			</p>
			<p class="text-danger">
				<i class="fa fa-envelope" aria-hidden="true"></i> principal.spi@gmail.com
			</p>
		</div>

	</div>

</div>
<!-- End Main Content  -->
@endsection
