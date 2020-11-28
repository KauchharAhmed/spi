@extends('web.masterWeb')
@section('content')
<div class="col-md-12">
				<div class="header_section">
					<div class="row">
						<div class="col-md-6 page_headers">
							<h4>Mission & Vission</h4>
						</div>
						<div class="col-md-6 page_links">
							<a href="" title="">Home</a> <span> > Mission & Vision</span>
						</div>
					</div>
				</div>
			</div>
			<!-- Main Content Start Here -->
			<div class="col-md-9" style="margin-top: 20px;">
				<h4 style=" color: #17469e;text-align: left;font-family: Arimo;font-weight: 400;font-style: normal;text-transform: uppercase;">Mission</h4>
				<hr style="background: #17469e; ">
				<div class="row" >
					<div class="col-md-6" style="margin-top: 10px;">
						<p class="text-justify">
							a)To Provide quality education, teaching & learning.<br>
							b)To ensure human resource development to meet the challenge of the current and future technology.<br>
							c) To strive for industries/employers satisfaction & earn their confidence.<br>
							d) To ensure sustainable development in TVET sector.<br>
						</p>
					</div>

					<div class="col-md-6" style="margin-top: 10px;">
						<img src="{{URL::to('web_images/news/news-2.jpg')}}" alt="SPI Mission" class="img-fluid">
					</div>

				</div>

				<h4 style=" color: #17469e;text-align: left;font-family: Arimo;font-weight: 400;font-style: normal;text-transform: uppercase;margin-top: 20px;">Vission</h4>
				<hr style="background: #17469e; ">
				<div class="row" >
					<div class="col-md-6" style="margin-top: 10px;">
						<p class="text-justify">
							To be the Unique modern TVET Institution in Bangladesh and to make significant contribution to the nation, employment for all graduates and enhance employers trust.

						</p>
					</div>

					<div class="col-md-6" style="margin-top: 10px;">
						<img src="{{URL::to('web_images/news/vission.jpg')}}" alt="SPI Vission" class="img-fluid">
					</div>

				</div>

			</div>
			<!-- End Main Content  -->
@endsection
