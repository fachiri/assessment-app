@extends('layouts.public')
@section('title', $assessment->title)
@push('css')
	<style>
		.form label p {
			margin-bottom: 0;
		}
	</style>
@endpush
@section('content')
	<section class="light" style="padding-top: 5rem">
		<div class="px-md-5 px-3 py-2">
			<div class="row">
				@if (session('success'))
					<div class="col-12 order-0">
						<div class="alert alert-light-success color-success alert-dismissible fade show">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					</div>
				@endif
				@if (isset($student) && $student->answers->count() > 0)
					<div class="col-12 col-lg-9 order-2 order-lg-1">
						<div class="card rounded-4 border-0 shadow">
							<img src="{{ $assessment->cover ? asset('storage/uploads/covers/' . $assessment->cover) : asset('images/default/assessment.jpg') }}" class="card-img-top" alt="Cover" style="object-fit: cover; height: 10rem; object-position: object-position: 50% 50%;;">
							<div class="card-body">
								<h5 class="card-title">{{ $assessment->title }}</h5>
								<p class="card-text">{!! $assessment->description !!}</p>
								<div class="my-3 border"></div>
								<p class="card-text">Jawaban anda telah tersimpan. Terima kasih telah mengisi 🙏.</p>
								<div class="d-flex gap-3">
									<a href="#" class="btn btn-primary">Lihat Jawaban</a>
									<a href="#" class="btn btn-outline-primary">Edit</a>
								</div>
							</div>
						</div>
					</div>
				@else
					<div class="col-12 col-lg-9 order-2 order-lg-1">
						<div class="card rounded-4 border-0 shadow">
							<img src="{{ $assessment->cover ? asset('storage/uploads/covers/' . $assessment->cover) : asset('images/default/assessment.jpg') }}" class="card-img-top" alt="Cover" style="object-fit: cover; height: 10rem; object-position: object-position: 50% 50%;;">
							<div class="card-body">
								<h5 class="card-title">{{ $assessment->title }}</h5>
								<p class="card-text">{!! $assessment->description !!}</p>
								<div class="my-3 border"></div>
								<form action="{{ route('public.answers.store', ['assessment' => $assessment->uuid, 'student' => request('nisn')]) }}" method="POST">
									@csrf
									@foreach ($assessment->questions as $form)
										<div class="form mb-4">
											<label for="{{ $form->uuid }}" class="form-label">{!! $form->question !!}</label>
											<x-form.question :form="$form" />
										</div>
									@endforeach
									<button type="submit" class="btn btn-primary" @if (!isset($student)) disabled @endif>
										Submit
									</button>
								</form>
							</div>
						</div>
					</div>
				@endif
				<div class="col-12 col-lg-3 order-1 order-lg-2">
					<div class="card rounded-4 border-0 shadow">
						<div class="card-body">
							<form action="">
								<x-form.input name="nisn" label="NISN" placeholder="Masukkan NISN" :value="request('nisn')" />
								<button type="submit" class="btn btn-primary">
									Cari
								</button>
							</form>
							<div class="my-3 border"></div>
							@if (isset($student))
								<h5 class="card-title">{{ $student->nisn }}</h5>
								<p class="card-text">{{ $student->user->name }}</p>
							@else
								<p class="card-text text-danger">Siswa dengan NISN <b>{{ request('nisn') }}</b> tidak ditemukan.</p>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
