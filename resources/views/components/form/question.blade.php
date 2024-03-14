@switch($form->type)
	@case('short_answer')
		<input type="text" class="form-control @error($form->uuid) is-invalid @enderror" name="{{ $form->uuid }}" id="{{ $form->uuid }}" placeholder="Jawaban anda" value="{{ old($form->uuid) }}">
	@break

	@case('paragraph')
		<textarea class="form-control @error($form->uuid) is-invalid @enderror" name="{{ $form->uuid }}" id="{{ $form->uuid }}" placeholder="Jawaban anda">{{ old($form->uuid) }}</textarea>
	@break

	@case('multiple_choice')
		@foreach ($form->options as $option)
			<div class="form-check">
				<input type="radio" class="form-check-input @error($form->uuid) is-invalid @enderror" name="{{ $form->uuid }}" id="{{ $form->uuid }}-{{ $option->label }}" value="{{ $option->label }}" {{ old($form->uuid) === $option->label ? 'checked' : '' }}>
				<label class="form-check-label" for="{{ $form->uuid }}-{{ $option->label }}">
					{{ $option->label }}
				</label>
			</div>
		@endforeach
	@break

	@case('checkboxes')
		@foreach ($form->options as $option)
			<div class="form-check">
				<input class="form-check-input" type="checkbox" name="{{ $form->uuid }}" id="{{ $form->uuid }}-{{ $option->label }}" {{ $option->label == old($form->uuid) ? 'checked' : '' }}>
				<label class="form-check-label" for="{{ $form->uuid }}-{{ $option->label }}">
					{{ $option->label }}
				</label>
			</div>
		@endforeach
	@break

	@case('dropdown')
		<select class="form-select" name="{{ $form->uuid }}">
			<option value="">Pilih</option>
			@foreach ($form->options as $option)
				<option value="{{ $option->label }}" {{ $option->label == old($form->uuid) ? 'selected' : '' }}>
					{{ $option->label }}
				</option>
			@endforeach
		</select>
	@break

	@case('date')
		<input type="date" class="form-control @error($form->uuid) is-invalid @enderror" name="{{ $form->uuid }}" id="{{ $form->uuid }}" value="{{ old($form->uuid) }}">
	@break

	@default
@endswitch
@error($form->uuid)
	<div class="text-danger">{{ $message }}</div>
@enderror
