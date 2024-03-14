<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{ $setting->app_name }} - @yield('title')</title>
		<link rel="shortcut icon" href="{{ $setting->app_logo ? asset('storage/uploads/settings/' . $setting->app_logo) : asset('images/default/jejakode.svg') }}" type="image/x-icon">
		<link rel="preconnect" href="https://fonts.bunny.net">
		<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('css/app-dark.css') }}">
		@stack('css')
		<style>
			@import url("https://fonts.googleapis.com/css2?family=Baloo+2&display=swap");

			body {
				font-family: "Baloo 2", cursive;
			}

			.bg-primary-gradient {
				background-image: linear-gradient(to right, #2078f9, #3f67be);
			}
		</style>
	</head>

	<body>
		<script src="{{ asset('js/initTheme.js') }}"></script>
		<nav class="position-absolute w-100 @if (!Request::is('/')) bg-primary-gradient @endif top-0" style="z-index: 1;">
			<a href="{{ route('public.index') }}" class="text-white" style="text-decoration: none;">
				<div class="d-flex justify-content-between align-items-center px-md-5 px-3 py-2">
					<div class="d-flex align-items-center gap-2">
						<span class="fw-bold fs-4">{{ $setting->app_name }}</span>
					</div>
					<div class="d-flex justify-content-center align-items-center gap-2">
						<a href="{{ route('public.assessments') }}" class="btn btn-outline-white btn-sm fw-bold border-2 py-1">Asesmen</a>
						@auth
							<a href="{{ route('dashboard.index') }}" class="btn btn-outline-white btn-sm fw-bold border-2 py-1">Dashboard</a>
						@else
							<a href="{{ route('auth.login.index') }}" class="btn btn-outline-white btn-sm fw-bold border-2 py-1">Login</a>
						@endauth
					</div>
				</div>
			</a>
		</nav>
		@yield('content')

		<script src="{{ asset('js/dark.js') }}"></script>
		<script src="{{ asset('js/extensions/perfect-scrollbar.min.js') }}"></script>
		<script src="{{ asset('js/app.js') }}"></script>
		@stack('scripts')
	</body>

</html>
