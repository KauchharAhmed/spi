@extends('web.masterWeb')
@section('content')
	<div class="col-md-12">
		<div class="header_section">
			<div class="row">
				<div class="col-md-6 page_headers">
					<h4>Notice</h4>
				</div>
				<div class="col-md-6 page_links">
					<a href="" title="">Home</a> <span> > Notice</span>
				</div>
			</div>
		</div>
	</div>
	<!-- Main Content Start Here -->
	<div class="col-md-9" style="margin-top: 20px;">
		<h4 style=" color: #17469e;text-align: left;font-family: Arimo;font-weight: 400;font-style: normal;text-transform: uppercase;">Central Notice Board</h4>
		<hr style="background: #17469e; ">
		<div class="row" >
			<div class="col-md-12 col-sm-12 notice_all">
				<ul>
					 <?php 
                        foreach ($last_100_notice as $last_10_value) { ?>
                          <li><i class="fas fa-check" style="color: green;"></i> <?php echo $last_10_value->notice_title ; ?><span style="float: right;"><?php echo date('d M Y',strtotime($last_10_value->notice_date)) ; ?></span>
                            <span><?php if($last_10_value->image != ''){?>
                            <a  style="color:red" href="{{URL::to('notice_doc/'.$last_10_value->image)}}">DOWNLOAD</a>
                            <?php } ?></span>
                        </li>
                        <?php } ?>
				</ul>
			</div>

		</div>

	</div>
	<!-- End Main Content  -->
@endsection
