@extends('web.masterWeb')
@section('content')
<div class="col-md-12">
	<div class="header_section">
		<div class="row">
			<div class="col-md-6 page_headers">
				<h4>News And Event</h4>
			</div>
			<div class="col-md-6 page_links">
				<a href="" title="">Home</a> <span> > News And Event</span>
			</div>
		</div>
	</div>
</div>
<!-- Main Content Start Here -->
<div class="col-md-9" style="margin-top: 20px;">
	<h4 style=" color: #17469e;text-align: left;font-family: Arimo;font-weight: 400;font-style: normal;text-transform: uppercase;">Post Title</h4>
	<span>Posted Date : 30 July 2019</span>
	<br>
	<br>
	<p class="text-justify ">
		Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur
	</p>

	<img src="{{URL::to('web_images/news/news-1.JPG')}}" alt="Single Title" class="img-fluid" width="100%" style="height: 200px!important;margin: 10px 0px;">

	<p class="text-justify">
		But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure
	</p>

</div>
<!-- End Main Content  -->
@endsection
