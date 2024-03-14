@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dasbor' => route('dashboard.index'),
        'Master Pengguna' => route('dashboard.master.user.index'),
        $user->name => route('dashboard.master.user.show', $user->uuid),
        'Edit' => null,
    ],
])
@section('title', 'Edit Pengguna')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="card-title pl-1">Edit Data</h4>
				</div>
				<div class="card-body px-4">
					<x-form.layout.horizontal action="{{ route('dashboard.master.user.update', $user->uuid) }}" method="PUT" submit-text="Perbarui">
						<h6 class="mb-4">Data Siswa</h6>
						<x-form.input layout="horizontal" name="nis" label="NIS" placeholder="Nomor Induk Siswa" maxlength="10" :value="$user->student->nis" />
						<x-form.input layout="horizontal" name="nisn" label="NISN" placeholder="Nomor Induk Siswa Nasional" maxlength="10" :value="$user->student->nisn" />
						<x-form.input layout="horizontal" name="name" label="Nama Lengkap" placeholder="Nama Lengkap" :value="$user->name" />
						<x-form.select layout="horizontal" name="gender" label="Jenis Kelamin" :value="$user->gender" :options="[
						    (object) [
						        'label' => App\Constants\UserGender::MALE,
						        'value' => App\Constants\UserGender::MALE,
						    ],
						    (object) [
						        'label' => App\Constants\UserGender::FEMALE,
						        'value' => App\Constants\UserGender::FEMALE,
						    ],
						]" />
						<x-form.input layout="horizontal" format="phone" name="phone" label="No. HP" placeholder="0812-3456-7890" maxlength="14" :value="$user->phone" />
						<x-form.input layout="horizontal" type="date" name="birthday" label="Tanggal Lahir" placeholder="Tanggal Lahir" :value="$user->birthday" />
						<h6 class="mb-4">Akun</h6>
						<x-form.input layout="horizontal" name="username" label="Username" placeholder="Username" :value="$user->username" />
						<x-form.input layout="horizontal" type="email" name="email" label="Email" placeholder="Email aktif" :value="$user->email" />
					</x-form.layout.horizontal>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="card-title pl-1">Ganti Password</h4>
				</div>
				<div class="card-body px-4">
					<x-form.layout.horizontal action="{{ route('dashboard.master.user.update.password', $user->uuid) }}" method="PUT" submit-text="Perbarui">
						<x-form.input layout="horizontal" type="password" name="new_password" label="Password Baru" placeholder="Password Baru" />
						<x-form.input layout="horizontal" type="password" name="confirm_password" label="Konfirmasi Password Baru" placeholder="Konfirmasi Password Baru" />
					</x-form.layout.horizontal>
				</div>
			</div>
		</div>
	</section>
@endsection
