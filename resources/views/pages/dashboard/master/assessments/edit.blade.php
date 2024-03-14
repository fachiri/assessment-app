@php
	$_FORM_TYPE = \App\Constants\Option::FORM_TYPE;
@endphp
@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dasbor' => route('dashboard.index'),
        'Master Asesmen' => route('dashboard.master.assessments.index'),
        $assessment->title => null,
    ],
])
@section('title', 'Edit Asesmen')
@push('css')
	<link rel="stylesheet" href="{{ asset('css/extensions/filepond.css') }}">
	<link rel="stylesheet" href="{{ asset('css/extensions/filepond-plugin-image-preview.css') }}">
	<link rel="stylesheet" href="{{ asset('css/extensions/summernote-lite.css') }}">
	<link rel="stylesheet" href="{{ asset('css/form-editor-summernote.css') }}">
	<style>
		.form label p {
			margin-bottom: 0;
		}
	</style>
@endpush
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card border">
				<div class="card-body px-4">
					<x-form.layout.horizontal action="{{ route('dashboard.master.assessments.update', $assessment->uuid) }}" method="PUT" submit-text="Perbarui" enctype="multipart/form-data">
						<x-form.input layout="horizontal" name="title" label="Judul" placeholder="Judul form" :value="$assessment->title" />
						<x-form.editor layout="horizontal" name="description" label="Deskripsi" :value="$assessment->description" />
						<x-form.select layout="horizontal" name="status" label="Status" :value="$assessment->status" :options="[
						    (object) [
						        'label' => App\Constants\AssessmentStatus::ACTIVE,
						        'value' => App\Constants\AssessmentStatus::ACTIVE,
						    ],
						    (object) [
						        'label' => App\Constants\AssessmentStatus::INACTIVE,
						        'value' => App\Constants\AssessmentStatus::INACTIVE,
						    ],
						]" />
						<x-form.input layout="horizontal" type="file" name="cover" label="Gambar" class="image-preview-filepond cover" />
					</x-form.layout.horizontal>
				</div>
			</div>
		</div>

		@foreach ($assessment->questions as $form)
			<div class="col-12">
				<div class="card border">
					<div class="card-body px-4">
						<div class="d-flex gap-3">
							<div class="form flex-grow-1">
								<label for="{{ $form->uuid }}" class="form-label">
									{!! $form->question !!}
								</label>
								<x-form.question :form="$form" placeholder="@if($form->required == 1) Wajib diisi @endif" />
							</div>
							<div class="dropdown">
								<span type="button" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="bi bi-three-dots-vertical"></i>
								</span>
								<ul class="dropdown-menu">
									<li>
										<a class="dropdown-item" href="#">
											<i class="bi bi-arrow-up"></i>
											Naik
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="#">
											<i class="bi bi-arrow-down"></i>
											Turun
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="#">
											<i class="bi bi-trash"></i>
											Hapus
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach

		<div class="col-12 action">
			<div class="card border">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="card-title pl-1">Tambah Pertanyaan</h4>
				</div>
				<div class="card-body px-4">
					<form action="{{ route('dashboard.master.questions.store', $assessment->uuid) }}" method="POST" class="d-flex gap-2">
						@csrf
						<div class="row" style="width: 100%;">
							<div class="col-12 mb-3">
								<textarea name="question" class="form-control" id="form-question">{{ old('question') }}</textarea>
							</div>
							<div class="col-12">
								<select name="type" id="form-type" class="form-select mb-3">
									@foreach ($_FORM_TYPE as $option)
										<option value="{{ $option['value'] }}" {{ old('type') === $option['value'] ? 'selected' : '' }}>{{ $option['label'] }}</option>
									@endforeach
								</select>
								@if (old('type') === 'multiple_choice' || old('type') === 'checkboxes' || old('type') === 'dropdown')
									<div class="d-flex option mb-3 gap-2">
										<input type="text" name="options[]" class="form-control flex-grow-1" placeholder="Opsi" value="Opsi">
										<button type="button" class="btn btn-secondary" id="add-option">
											<i class="bi bi-plus-circle"></i>
										</button>
									</div>
								@endif
							</div>
							<div class="col-12 mb-3">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="required" id="flexSwitchCheckRequired" {{ old('required') ? 'checked' : '' }}>
									<label class="form-check-label" for="flexSwitchCheckRequired">Wajib Diisi</label>
								</div>
							</div>
							<div class="col-12 text-end">
								<button type="submit" class="btn btn-primary">
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
	<script src="{{ asset('js/extensions/filepond-plugin-file-validate-size.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-file-validate-type.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-crop.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-exif-orientation.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-filter.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-preview.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-resize.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond.js') }}"></script>
	<script src="{{ asset('js/extensions/summernote-lite.min.js') }}"></script>
	<script>
		const summernoteFormQuestionOption = {
			tabsize: 1,
			height: 'auto',
			placeholder: 'Pertanyaan',
			toolbar: [
				['font', ['bold', 'underline', 'italic', 'clear']],
				['table', ['table']],
				['insert', ['link', 'picture', 'video']],
			],
			callbacks: {
				onPaste: function(e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			},
		}

		$("#form-question").summernote(summernoteFormQuestionOption)

		$('#form-type').on('change', (e) => {
			const selected = e.target.value

			if (selected === 'multiple_choice' || selected === 'checkboxes' || selected === 'dropdown') {
				const component = `
					<div class="d-flex gap-2 mb-3 option">
						<input type="text" name="options[]" class="form-control flex-grow-1" placeholder="Opsi" value="Opsi">
						<button type="button" class="btn btn-secondary" id="add-option">
							<i class="bi bi-plus-circle"></i>
						</button>
					</div>
				`
				$(component).insertAfter('#form-type')
			} else {
				$('.option').remove()
			}
		})

		$(document).on('click', '#add-option', (e) => {
			$(e.currentTarget).attr('id', 'remove-option');
			$(e.currentTarget).html('<i class="bi bi-dash-circle"></i>');
			const component = `
					<div class="d-flex gap-2 mb-3 option">
						<input type="text" name="options[]" class="form-control flex-grow-1" placeholder="Opsi" value="Opsi">
						<button type="button" class="btn btn-secondary" id="add-option">
							<i class="bi bi-plus-circle"></i>
						</button>
					</div>
				`
			$(component).insertAfter('.option:last');
		});

		$(document).on('click', '#remove-option', (e) => {
			$(e.currentTarget).closest('.option').remove();
		});
	</script>
	<script>
		const imageDataCover = @json($assessment->cover);
		const imageDataCoverUuid = @json($assessment->uuid);

		FilePond.registerPlugin(
			FilePondPluginImagePreview,
			FilePondPluginImageCrop,
			FilePondPluginImageExifOrientation,
			FilePondPluginImageFilter,
			FilePondPluginImageResize,
			FilePondPluginFileValidateSize,
			FilePondPluginFileValidateType,
		)

		FilePond.create(document.querySelector(".cover"), {
			files: imageDataCover ? [{
				source: imageDataCover,
				options: {
					type: 'local',
				},
			}, ] : [],
			server: imageDataCover ? {
				load: (id, load) => {
					fetch(`/dashboard/master/assessments/${imageDataCoverUuid}/load-file`).then(res => res.blob()).then(load)
				}
			} : {},
			credits: null,
			allowImagePreview: true,
			allowImageFilter: false,
			allowImageExifOrientation: false,
			allowImageCrop: false,
			acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg", "image/webp"],
			fileValidateTypeDetectType: (source, type) =>
				new Promise((resolve, reject) => {
					resolve(type)
				}),
			storeAsFile: true,
		})
	</script>
@endpush
