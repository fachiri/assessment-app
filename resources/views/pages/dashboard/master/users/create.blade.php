@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dasbor' => route('dashboard.index'),
        'Master Siswa' => route('dashboard.master.user.index'),
        'Tambah Data' => null
    ]
])
@section('title', 'Tambah Siswa')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="card-title pl-1">Form Tambah Siswa</h4>
				</div>
				<div class="card-body px-4">
					<x-form.layout.horizontal action="{{ route('dashboard.master.user.store') }}" method="POST">
						<h6 class="mb-4">Data Siswa</h6>
						<x-form.input layout="horizontal" name="nis" label="NIS" placeholder="Nomor Induk Siswa" maxlength="10" />
						<x-form.input layout="horizontal" name="nisn" label="NISN" placeholder="Nomor Induk Siswa Nasional" maxlength="10" />
						<x-form.input layout="horizontal" name="name" label="Nama Lengkap" placeholder="Nama Lengkap" />
						<x-form.select layout="horizontal" name="gender" label="Jenis Kelamin" :options="[
						    (object) [
						        'label' => App\Constants\UserGender::MALE,
						        'value' => App\Constants\UserGender::MALE,
						    ],
						    (object) [
						        'label' => App\Constants\UserGender::FEMALE,
						        'value' => App\Constants\UserGender::FEMALE,
						    ],
						]" />
						<x-form.input layout="horizontal" format="phone" name="phone" label="No. HP" placeholder="0812-3456-7890" maxlength="14" />
						<x-form.input layout="horizontal" type="date" name="birthday" label="Tanggal Lahir" placeholder="Tanggal Lahir" />
						<h6 class="mb-4">Akun</h6>
						<x-form.input layout="horizontal" name="username" label="Username" placeholder="Username" />
						<x-form.input layout="horizontal" type="email" name="email" label="Email" placeholder="Email aktif" />
					</x-form.layout.horizontal>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('scripts')
	<script src="{{ asset('js/custom/format-phone.js') }}"></script>
@endpush
