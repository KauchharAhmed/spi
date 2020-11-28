@extends('web.masterWeb')
@section('content')
	<!-- Main Content Start Here -->
	<div class="col-md-9" style="margin-top: 20px;">
		<h4 style=" color: #17469e;text-align: left;font-family: Arimo;font-weight: 400;font-style: normal;text-transform: uppercase;"><?php echo $row->page_title; ?> <span style="float: right;font-size: 14px;font-family: arial">Last Update : <?php echo date('d M Y',strtotime($row->modified_at)); ?></span></h4>

		<hr style="background: #17469e; ">
		<div class="row" >
			<div class="col-md-12 col-sm-12 notice_all">
				<?php if(!empty($row->page_content)) : ?>
					<?php echo $row->page_content ; ?>
				<?php endif; ?>

				<br>

				<?php if(!empty($row->image)) : ?>
					<img src="{{URL::to('images/docx.png')}}" alt="" width="50" height="50" style="display: <?php 
						$explode = explode('.', $row->image);
						$file_extensaction = $explode[1];
						if ($file_extensaction == 'pdf') {
							echo "none";
						}else{
							echo "";
						}
					?>">
					<img src="{{URL::to('images/pdf_icon.svg')}}" alt=""  width="50" height="50" style="display: <?php 
						$explode = explode('.', $row->image);
						$file_extensaction = $explode[1];
						if ($file_extensaction == 'pdf') {
							echo "";
						}else{
							echo "none";
						}
					?>">
					<a href="{{URL::to('/'.$row->image)}}" title="<?php echo $row->page_title ?>"><?php $another_explode = explode('/', $row->image); echo $another_explode[1]; ?></a>
				<?php endif; ?>
			</div>
		</div>

	</div>
	<!-- End Main Content  -->
@endsection
