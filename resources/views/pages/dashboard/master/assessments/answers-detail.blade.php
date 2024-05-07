@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dasbor' => route('dashboard.index'),
        'Master Asesmen' => route('dashboard.master.assessments.index'),
        $assessment->title => route('dashboard.master.assessments.edit', $assessment->uuid),
        'Jawaban' => route('dashboard.master.assessments.answers', $assessment->uuid),
        $user->student->nisn => null,
    ],
])
@section('title', 'Jawaban ' . $user->name)
@push('css')
	<link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
@endpush
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="card-title pl-1">Daftar Jawaban {{ $user->name }}</h4>
					<div class="d-flex gap-2"></div>
				</div>
				<div class="card-body table-responsive px-4">
					<table class="table-striped data-table table">
						<thead>
							<tr>
								<th>Pertanyaan</th>
								<th>Jawaban</th>
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
				ajax: "{{ route('dashboard.master.assessments.answers.user', ['assessment' => $assessment->uuid, 'user' => $user->uuid]) }}",
				columns: [{
						data: 'question',
						name: 'question'
					},
					{
						data: 'answer',
						name: 'answer',
					}
				]
			});
		});
	</script>
@endpush
