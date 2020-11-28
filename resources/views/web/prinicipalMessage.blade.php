@extends('web.masterWeb')
@section('content')
<div class="col-md-12">
				<div class="header_section">
					<div class="row">
						<div class="col-md-6 page_headers">
							<h4>Principal's Message</h4>
						</div>
						<div class="col-md-6 page_links">
							<a href="" title="">Home</a> <span> > Pricipal's Message</span>
						</div>
					</div>
				</div>
			</div>
			<!-- Main Content Start Here -->
			<div class="col-md-9" style="margin-top: 20px;">
				<h4 style=" color: #17469e;text-align: left;font-family: Arimo;font-weight: 400;font-style: normal;text-transform: uppercase;">Pricipal's Message</h4>
				<hr style="background: #17469e; ">
				<div class="row" >
					<div class="col-md-6" style="margin-top: 10px;">
						<p class="text-justify">
							<?php
                            $data = DB::table('w_principal_message')->first();
                            echo $data->principal_message ;
							?>
						</p>
					</div>
					<div class="col-md-6" style="margin-top: 10px;">
						<img style="float: right;" src="{{URL::to('web_images/principal.jpg')}}" class="img-fluid">
					</div>
				</div>
			</div>
			<!-- End Main Content  -->
@endsection
