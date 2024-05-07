@php
	use App\Constants\AssessmentStatus;
	use App\Utils\FormatUtils;
@endphp
@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dasbor' => null,
    ],
])
@section('title', 'Dasbor')
@push('css')
	<link rel="stylesheet" href="{{ asset('css/iconly.css') }}">
@endpush
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="row">
				@if (auth()->user()->isAdmin())
					<div class="col-6 col-lg-3 col-md-6">
						<div class="card">
							<div class="card-body py-4-5 px-4">
								<div class="row">
									<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
										<div class="stats-icon purple mb-2">
											<i class="iconly-boldUser"></i>
										</div>
									</div>
									<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
										<h6 class="text-muted font-semibold">Siswa</h6>
										<h6 class="mb-0 font-extrabold">{{ FormatUtils::digits($students->count(), 3) }}</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6 col-lg-3 col-md-6">
						<div class="card">
							<div class="card-body py-4-5 px-4">
								<div class="row">
									<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
										<div class="stats-icon green mb-2">
											<i class="iconly-boldDocument"></i>
										</div>
									</div>
									<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
										<h6 class="text-muted font-semibold">Asesmen Aktif</h6>
										<h6 class="mb-0 font-extrabold">{{ FormatUtils::digits($assessments->where('status', AssessmentStatus::ACTIVE)->count(), 3) }}</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6 col-lg-3 col-md-6">
						<div class="card">
							<div class="card-body py-4-5 px-4">
								<div class="row">
									<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
										<div class="stats-icon red mb-2">
											<i class="iconly-boldDocument"></i>
										</div>
									</div>
									<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
										<h6 class="text-muted font-semibold">Asesmen Tidak Aktif</h6>
										<h6 class="mb-0 font-extrabold">{{ FormatUtils::digits($assessments->where('status', AssessmentStatus::INACTIVE)->count(), 3) }}</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endif
				@if (auth()->user()->isStudent())
					<div class="col-6 col-lg-3 col-md-6">
						<div class="card">
							<div class="card-body py-4-5 px-4">
								<div class="row">
									<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
										<div class="stats-icon green mb-2">
											<i class="iconly-boldDocument"></i>
										</div>
									</div>
									<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
										<h6 class="text-muted font-semibold">Asesmen Saya</h6>
										<h6 class="mb-0 font-extrabold">{{ FormatUtils::digits($assessments->where('status', AssessmentStatus::ACTIVE)->count(), 3) }}</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endif
			</div>
		</div>
	</section>
@endsection
@push('scripts')
	{{-- <script src="{{ asset('js/extensions/apexcharts.min.js') }}"></script>
  <script src="{{ asset('js/static/dashboard.js') }}"></script> --}}
@endpush
