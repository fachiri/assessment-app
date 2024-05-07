@php
		$bg = $setting->auth_bg ? asset('storage/uploads/settings/' . $setting->auth_bg) : asset('images/default/bg-masthead.png') 
@endphp
@extends('layouts.public')
@section('title', 'Asesmen Diagnostik Non Kognitif')
@push('css')
	<link rel="stylesheet" href="{{ asset('css/public.css') }}">
	<style>
		header.masthead {
			position: relative;
			background: url("{{ $bg }}") no-repeat center center;
			background-size: cover;
			height: 100vh;
		}

		header.masthead:before {
			content: "";
			position: absolute;
			background-color: #040e68;
			height: 100vh;
			width: 100%;
			top: 0;
			left: 0;
			opacity: 0.75;
		}
	</style>
@endpush
@section('content')
	<header class="masthead">
		<div class="h-100 position-relative d-flex flex-column gap-4 justify-content-center align-items-center">
			<div>
				@if ($setting->app_logo)
					<img src="{{ asset('storage/uploads/settings/' . $setting->app_logo) }}" alt="Logo" style="height: 100px;">
				@else
					<img src="{{ asset('images/default/logo.png') }}" alt="Logo" style="height: 100px;">
				@endif
			</div>
			<div class="text-center" style="max-width: 50rem;">
				<h1 class="fs-1 text-white">Selamat datang di Portal Asesmen Diagnostik Non Kognitif - SMA Negeri 2 Gorontalo</h1>
			</div>
			<form style="max-width: 30rem;" action="{{ route('public.assessments') }}">
				<div class="row">
					<div class="col">
						<input class="form-control form-control-lg" id="nisn" name="nisn" type="text" placeholder="Masukkan NISN" required />
					</div>
					<div class="col-auto">
						<button class="btn btn-warning" style="height: 100%;" type="submit">
							<i class="bi bi-send me-1"></i>
							Submit
						</button>
					</div>
				</div>
			</form>
		</div>
	</header>
	{{-- <section class="features-icons bg-light text-center">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="features-icons-item mb-lg-0 mb-lg-3 mx-auto mb-5">
						<div class="features-icons-icon d-flex"><i class="bi-window text-primary m-auto"></i></div>
						<h3>Fully Responsive</h3>
						<p class="lead mb-0">This theme will look great on any device, no matter the size!</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="features-icons-item mb-lg-0 mb-lg-3 mx-auto mb-5">
						<div class="features-icons-icon d-flex"><i class="bi-layers text-primary m-auto"></i></div>
						<h3>Bootstrap 5 Ready</h3>
						<p class="lead mb-0">Featuring the latest build of the new Bootstrap 5 framework!</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="features-icons-item mb-lg-3 mx-auto mb-0">
						<div class="features-icons-icon d-flex"><i class="bi-terminal text-primary m-auto"></i></div>
						<h3>Easy to Use</h3>
						<p class="lead mb-0">Ready to use with your own content, or customize the source files!</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="showcase">
		<div class="container-fluid p-0">
			<div class="row g-0">
				<div class="col-lg-6 order-lg-2 showcase-img text-white" style="background-image: url('{{ asset('images/default/bg-showcase-1.jpg') }}')"></div>
				<div class="col-lg-6 order-lg-1 showcase-text my-auto">
					<h2>Fully Responsive Design</h2>
					<p class="lead mb-0">When you use a theme created by Start Bootstrap, you know that the theme will look great on any device, whether it's a phone, tablet, or desktop the page will behave responsively!</p>
				</div>
			</div>
			<div class="row g-0">
				<div class="col-lg-6 showcase-img text-white" style="background-image: url('{{ asset('images/default/bg-showcase-2.jpg') }}')"></div>
				<div class="col-lg-6 showcase-text my-auto">
					<h2>Updated For Bootstrap 5</h2>
					<p class="lead mb-0">Newly improved, and full of great utility classes, Bootstrap 5 is leading the way in mobile responsive web development! All of the themes on Start Bootstrap are now using Bootstrap 5!</p>
				</div>
			</div>
			<div class="row g-0">
				<div class="col-lg-6 order-lg-2 showcase-img text-white" style="background-image: url('{{ asset('images/default/bg-showcase-3.jpg') }}')"></div>
				<div class="col-lg-6 order-lg-1 showcase-text my-auto">
					<h2>Easy to Use & Customize</h2>
					<p class="lead mb-0">Landing Page is just HTML and CSS with a splash of SCSS for users who demand some deeper customization options. Out of the box, just add your content and images, and your new landing page will be ready to go!</p>
				</div>
			</div>
		</div>
	</section>
	<section class="testimonials bg-light text-center">
		<div class="container">
			<h2 class="mb-5">What people are saying...</h2>
			<div class="row">
				<div class="col-lg-4">
					<div class="testimonial-item mb-lg-0 mx-auto mb-5">
						<img class="img-fluid rounded-circle mb-3" src="{{ asset('images/default/testimonials-1.jpg') }}" alt="..." />
						<h5>Margaret E.</h5>
						<p class="font-weight-light mb-0">"This is fantastic! Thanks so much guys!"</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="testimonial-item mb-lg-0 mx-auto mb-5">
						<img class="img-fluid rounded-circle mb-3" src="{{ asset('images/default/testimonials-2.jpg') }}" alt="..." />
						<h5>Fred S.</h5>
						<p class="font-weight-light mb-0">"Bootstrap is amazing. I've been using it to create lots of super nice landing pages."</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="testimonial-item mb-lg-0 mx-auto mb-5">
						<img class="img-fluid rounded-circle mb-3" src="{{ asset('images/default/testimonials-3.jpg') }}" alt="..." />
						<h5>Sarah W.</h5>
						<p class="font-weight-light mb-0">"Thanks so much for making these free resources available to us!"</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="call-to-action text-center text-white" id="signup">
		<div class="position-relative container">
			<div class="row justify-content-center">
				<div class="col-xl-6">
					<h2 class="mb-4">Ready to get started? Sign up now!</h2>
					<form class="form-subscribe" id="contactFormFooter" data-sb-form-api-token="API_TOKEN">
						<div class="row">
							<div class="col">
								<input class="form-control form-control-lg" id="emailAddressBelow" type="email" placeholder="Email Address" data-sb-validations="required,email" />
								<div class="invalid-feedback text-white" data-sb-feedback="emailAddressBelow:required">Email Address is required.</div>
								<div class="invalid-feedback text-white" data-sb-feedback="emailAddressBelow:email">Email Address Email is not valid.</div>
							</div>
							<div class="col-auto"><button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit">Submit</button></div>
						</div>
						<div class="d-none" id="submitSuccessMessage">
							<div class="mb-3 text-center">
								<div class="fw-bolder">Form submission successful!</div>
								<p>To activate this form, sign up at</p>
								<a class="text-white" href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
							</div>
						</div>
						<div class="d-none" id="submitErrorMessage">
							<div class="text-danger mb-3 text-center">Error sending message!</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<footer class="footer bg-light">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 h-100 text-lg-start my-auto text-center">
					<ul class="list-inline mb-2">
						<li class="list-inline-item"><a href="#!">About</a></li>
						<li class="list-inline-item">⋅</li>
						<li class="list-inline-item"><a href="#!">Contact</a></li>
						<li class="list-inline-item">⋅</li>
						<li class="list-inline-item"><a href="#!">Terms of Use</a></li>
						<li class="list-inline-item">⋅</li>
						<li class="list-inline-item"><a href="#!">Privacy Policy</a></li>
					</ul>
					<p class="text-muted small mb-lg-0 mb-4">&copy; Your Website 2023. All Rights Reserved.</p>
				</div>
				<div class="col-lg-6 h-100 text-lg-end my-auto text-center">
					<ul class="list-inline mb-0">
						<li class="list-inline-item me-4">
							<a href="#!"><i class="bi-facebook fs-3"></i></a>
						</li>
						<li class="list-inline-item me-4">
							<a href="#!"><i class="bi-twitter fs-3"></i></a>
						</li>
						<li class="list-inline-item">
							<a href="#!"><i class="bi-instagram fs-3"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</footer> --}}
@endsection
