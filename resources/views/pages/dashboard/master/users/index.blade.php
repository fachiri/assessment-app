@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dasbor' => route('dashboard.index'),
        'Master Siswa' => null,
    ],
])
@section('title', 'Master Siswa')
@push('css')
	<link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
@endpush
@section('content')
	<section class="row">
		{{-- <div class="col-12">
			<div class="card">
        <div class="card-header">
					<h4 class="card-title pl-1">Filter</h4>
				</div>
				<div class="card-body table-responsive px-4">
					<div class="row">
						<div class="col-12">
							<label class="form-label">Jenis Kelamin</label>
							<select class="form-select filter-select">
								<option value="">Semua</option>
								<option value="{{ App\Constants\UserGender::MALE }}">{{ App\Constants\UserGender::MALE }}</option>
								<option value="{{ App\Constants\UserGender::FEMALE }}">{{ App\Constants\UserGender::FEMALE }}</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div> --}}
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="card-title pl-1">Daftar Siswa</h4>
					<div class="d-flex gap-2">
						<x-modal.form action="{{ route('dashboard.master.user.import') }}" method="POST" enctype="multipart/form-data" id="sinkronisasi" title="Sinkronisasi" color="success">
							<x-slot:btn>
								<i class="bi bi-arrow-repeat"></i>
								Sinkronisasi
							</x-slot:btn>
							<div class="d-flex justify-content-end mb-3 gap-2">
								<a href="{{ route('dashboard.master.user.import.example') }}" class="btn btn-secondary btn-sm">
									<i class="bi bi-file-earmark-spreadsheet"></i>
									Format
								</a>
								<a href="{{ route('dashboard.master.user.export') }}" class="btn btn-secondary btn-sm">
									<i class="bi bi-file-earmark-arrow-up"></i>
									Export
								</a>
							</div>
							<x-form.input type="file" name="file" label="File" placeholder="File">
								<x-slot:help>
									Format: .xlsx .xls .csv
								</x-slot:help>
							</x-form.input>
							<x-slot:submit>
								<i class="bi bi-clipboard-plus"></i>
								Import
							</x-slot:subm>
						</x-modal.form>
						<a href="{{ route('dashboard.master.user.create') }}" class="btn btn-primary btn-sm">
							<i class="bi bi-plus-square"></i>
							Tambah Data
						</a>
					</div>
				</div>
				<div class="card-body table-responsive px-4">
					<table class="table-striped data-table table">
						<thead>
							<tr>
								<th>Nama</th>
								<th>NISN</th>
								<th style="white-space: nowrap">Aksi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('scripts')
	<script type="text/javascript">
		$(function() {
			const table = $('.data-table').DataTable({
				serverSide: true,
				ajax: "{{ route('dashboard.master.user.index') }}",
				columns: [{
						data: 'name',
						name: 'name'
					},
					{
						data: 'student_nisn',
						name: 'student_nisn',
						orderable: false,
					},
					{
						data: 'action',
						name: 'action',
						orderable: false,
						searchable: false
					}
				]
			});

			$('.filter-select').change(function() {
				table.column(2).search($(this).val()).draw();
			});
		});
	</script>
@endpush
