@extends('web.webMasterWithoutSidebar')
@section('content')
<div class="col-md-12">
	<div class="header_section">
		<div class="row">
			<div class="col-md-6 page_headers">
				<h4>Photo Gallery</h4>
			</div>
			<div class="col-md-6 page_links">
				<a href="" title="">Home</a> <span> > Photo Gallery</span>
			</div>
		</div>
	</div>
</div>
<!-- Main Content Start Here -->
<div class="col-md-12" style="margin-top: 20px;">
	<h4 style=" color: #17469e;text-align: left;font-family: Arimo;font-weight: 400;font-style: normal;text-transform: uppercase;">Photo Gallery</h4>
	<hr style="background: #17469e; ">

	<div class="row"> <!-- End Row -->
        <div class="col-md-4">
            <div class="gallery_image">
                <a data-fancybox="gallery" href="{{URL::to('web_images/gallery/g-1.jpg')}}">
                    <img src="{{URL::to('web_images/gallery/g-1.jpg')}}" alt="Finger Lock" class="img-fluid" style="width:100%;height: 150px;">
                </a>
                <div class="overlay">Welcome To Sirajganj Polytechnic Institute</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="gallery_image">
                <a data-fancybox="gallery" href="{{URL::to('web_images/gallery/g-2.jpg')}}">
                    <img src="{{URL::to('web_images/gallery/g-2.jpg')}}" alt="Finger Lock" class="img-fluid" style="width:100%;height: 150px;">
                </a>
                <div class="overlay">Welcome To Sirajganj Polytechnic Institute</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="gallery_image">
                <a data-fancybox="gallery" href="{{URL::to('web_images/gallery/g-3.jpg')}}">
                    <img src="{{URL::to('web_images/gallery/g-3.jpg')}}" alt="Finger Lock" class="img-fluid" style="width:100%;height: 150px;">
                </a>
                <div class="overlay">Welcome To Sirajganj Polytechnic Institute</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="gallery_image">
                <a data-fancybox="gallery" href="{{URL::to('web_images/gallery/g-4.jpg')}}">
                    <img src="{{URL::to('web_images/gallery/g-4.jpg')}}" alt="Finger Lock" class="img-fluid" style="width:100%;height: 150px;">
                </a>
                <div class="overlay">Welcome To Sirajganj Polytechnic Institute</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="gallery_image">
                <a data-fancybox="gallery" href="{{URL::to('web_images/gallery/g-5.jpg')}}">
                    <img src="{{URL::to('web_images/gallery/g-5.jpg')}}" alt="Finger Lock" class="img-fluid" style="width:100%;height: 150px;">
                </a>
                <div class="overlay">Welcome To Sirajganj Polytechnic Institute</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="gallery_image">
                <a data-fancybox="gallery" href="{{URL::to('web_images/gallery/g-6.jpg')}}">
                    <img src="{{URL::to('web_images/gallery/g-6.jpg')}}" alt="Finger Lock" class="img-fluid" style="width:100%;height: 150px;">
                </a>
                <div class="overlay">Welcome To Sirajganj Polytechnic Institute</div>
            </div>
        </div>

    </div> <!-- End Row -->

</div>
<!-- End Main Content  -->
@endsection
