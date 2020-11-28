@extends('web.masterWeb')
@section('content')
	<div class="col-md-12">
		<div class="header_section">
			<div class="row">
				<div class="col-md-6 page_headers">
					<h4>History Of SPI</h4>
				</div>
				<div class="col-md-6 page_links">
					<a href="" title="">Home</a> <span> > History Of SPI</span>
				</div>
			</div>
		</div>
	</div>
	<!-- Main Content Start Here -->
	<div class="col-md-9" style="margin-top: 20px;">
		<h4 style=" color: #17469e;text-align: left;font-family: Arimo;font-weight: 400;font-style: normal;text-transform: uppercase;">HISTORY OF SPI</h4>
		<hr style="background: #17469e; ">
		<div class="row" >
			<div class="col-md-6" style="margin-top: 10px;">
				<p class="text-justify">
					Sirajgonj polytechnic institute is one of the &nbsp;new Polytechnic Institute in Bangladesh.Its foundation stone &nbsp;was established in 2000 by Mohammad Nasim. ,M P and Honorable  Minister Ministry of Home,Postal and Telecommunication and Public works affairs .It started class in 2004 with only 40 students in the first year classes of Diploma-In-Engineering in one technology, named,Computer with the growing demands of mid-level technical manpower at home and abroad the Institute has since greatly expanded. The Institute now offers courses in five technologies Computer,Civil,Electronics ,RAC.and Electrical.
				</p>
			</div>

			<div class="col-md-6" style="margin-top: 10px;">
				<img src="{{URL::to('web_images/spi_image.jpg')}}" alt="SPI History" class="img-fluid">
			</div>

		</div>

	</div>
	<!-- End Main Content  -->
@endsection
