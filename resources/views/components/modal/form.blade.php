<button type="button" data-bs-toggle="modal" data-bs-target="#modal-form-{{ $id }}" class="btn btn-{{ $color ?? 'primary' }} btn-sm">
	{{ $btn ?? $title }}
</button>
<div class="modal fade" id="modal-form-{{ $id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
	<form action="{{ $action }}" method="{{ $method && $method == 'GET' ? 'GET' : 'POST' }}" class="modal-dialog" enctype="{{ $enctype ?? '' }}">
    @csrf
    @method($method ?? 'POST')
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5">{{ $title }}</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				{{ $slot }}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-{{ $color ?? 'primary' }}">{{ $submit ?? $title }}</button>
			</div>
		</div>
	</form>
</div>