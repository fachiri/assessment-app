@php
	$_FORM_TYPE = \App\Constants\Option::FORM_TYPE;
@endphp
@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dasbor' => route('dashboard.index'),
        'Master Asesmen' => route('dashboard.master.assessments.index'),
        'Tambah' => null,
    ],
])
@section('title', 'Tambah Form Asesmen')
@push('css')
	<link rel="stylesheet" href="{{ asset('css/extensions/filepond.css') }}">
	<link rel="stylesheet" href="{{ asset('css/extensions/filepond-plugin-image-preview.css') }}">
	<link rel="stylesheet" href="{{ asset('css/extensions/summernote-lite.css') }}">
	<link rel="stylesheet" href="{{ asset('css/form-editor-summernote.css') }}">
@endpush
@section('content')
	<section class="row">
		{{-- <div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="card-title pl-1">Pertanyaan</h4>
				</div>
				<div class="card-body px-4">
					<form action="" method="GET">
						<div class="d-flex gap-3 border rounded p-3 mb-3">
							<div class="flex-grow-1">
								<label for="section" class="form-label">Judul / Bagian</label>
								<input type="text" class="form-control" id="section" name="section" placeholder="misal: Identitas Pribadi">
							</div>
							<button type="submit" class="btn btn-primary">
								<svg viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>plus</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set-Filled" sketch:type="MSLayerGroup" transform="translate(-362.000000, -1037.000000)" fill="#ffffff"> <path d="M390,1049 L382,1049 L382,1041 C382,1038.79 380.209,1037 378,1037 C375.791,1037 374,1038.79 374,1041 L374,1049 L366,1049 C363.791,1049 362,1050.79 362,1053 C362,1055.21 363.791,1057 366,1057 L374,1057 L374,1065 C374,1067.21 375.791,1069 378,1069 C380.209,1069 382,1067.21 382,1065 L382,1057 L390,1057 C392.209,1057 394,1055.21 394,1053 C394,1050.79 392.209,1049 390,1049" id="plus" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
							</button>
						</div>
						<div class="d-flex gap-3 border rounded p-3">
							<div class="flex-grow-1">
								<label for="form" class="form-label">Form</label>
								<input type="text" class="form-control" id="form" name="form" placeholder="misal: Nama Lengkap">
							</div>
							
							<button type="submit" class="btn btn-primary">
								<svg viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>plus</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set-Filled" sketch:type="MSLayerGroup" transform="translate(-362.000000, -1037.000000)" fill="#ffffff"> <path d="M390,1049 L382,1049 L382,1041 C382,1038.79 380.209,1037 378,1037 C375.791,1037 374,1038.79 374,1041 L374,1049 L366,1049 C363.791,1049 362,1050.79 362,1053 C362,1055.21 363.791,1057 366,1057 L374,1057 L374,1065 C374,1067.21 375.791,1069 378,1069 C380.209,1069 382,1067.21 382,1065 L382,1057 L390,1057 C392.209,1057 394,1055.21 394,1053 C394,1050.79 392.209,1049 390,1049" id="plus" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>

							</button>
						</div>
					</form>
				</div>
			</div>
		</div> --}}

		<div class="col-12">
			<div class="card border">
				<div class="card-body px-4">
					<div class="row">
						<x-form.input layout="horizontal" name="title" label="Judul" placeholder="Judul form" />
						<x-form.editor layout="horizontal" name="description" label="Deskripsi" />
					</div>
				</div>
			</div>
		</div>

		<div class="form col-12 card border">
			<div class="card-body px-4">
				<div class="row">
					<div class="col-6">
						<textarea name="question[]" class="form-control form-question"></textarea>
					</div>
					<div class="col-6">
						<div class="d-flex mb-3 gap-2">
							<button type="button" class="btn btn-light btn-sm">
								<i class="bi bi-arrow-up"></i>
							</button>
							<button type="button" class="btn btn-light btn-sm">
								<i class="bi bi-arrow-down"></i>
							</button>
							<button type="button" class="btn btn-light btn-sm">
								<i class="bi bi-copy"></i>
							</button>
							<button type="button" class="btn btn-light btn-sm">
								<i class="bi bi-trash"></i>
							</button>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="col-12 action">
			<div class="card border">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="card-title pl-1">Tambah Pertanyaan</h4>
				</div>
				<div class="card-body px-4">
					<form action="{{ route('dashboard.master.questions.store', $assessment->uuid) }}" class="d-flex gap-2">
						<div class="row">
							<div class="col-12 mb-3">
								<textarea name="question" class="form-control" id="form-question"></textarea>
							</div>
							<div class="col-12 mb-3">
								<select name="type" id="form-type" class="form-select">
									@foreach ($_FORM_TYPE as $option)
										<option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-12 mb-3">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="required" id="flexSwitchCheckRequired">
									<label class="form-check-label" for="flexSwitchCheckRequired">Wajib Diisi</label>
								</div>
							</div>
							<div class="col-12 text-end">
								<button type="submit" class="btn btn-secondary btn-sm">
									<i class="bi bi-plus-circle"></i>
									Tambah Pertanyaan
								</button>
							</div>
						</div>
						{{-- <button type="button" class="btn btn-secondary btn-sm" id="add-section">
							<i class="bi bi-view-list"></i>
							Tambah Bagian
						</button> --}}
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('scripts')
	<script src="{{ asset('js/extensions/jquery.min.js') }}"></script>
	<script src="{{ asset('js/extensions/summernote-lite.min.js') }}"></script>
	<script>
		const summernoteFormQuestionOption = {
			tabsize: 1,
			height: 'auto',
			placeholder: 'Pertanyaan',
		}

		$("#add-question").on('click', () => {
			const component = `
				<div class="form col-12 card border">
					<div class="card-body px-4">
						<div class="row">
							<div class="col-6">
								<textarea name="question[]" class="form-control form-question"></textarea>
							</div>
							<div class="col-6">
								<select name="form_type[]" id="form-type" class="form-select">
									@foreach ($_FORM_TYPE as $option)
										<option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
			`;

			$(component).insertBefore('.action');

			$(".form textarea.form-question").each(function() {
				$(this).summernote(summernoteFormQuestionOption);
			});
		})

		$("#form-question").summernote(summernoteFormQuestionOption)
	</script>
@endpush
