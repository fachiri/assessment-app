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
		@if ($form->other_option === 1)
			<div class="form-check">
				<input type="radio" class="form-check-input @error($form->uuid) is-invalid @enderror" name="{{ $form->uuid }}" id="{{ $form->uuid }}-opsi-lain" value="opsi-lain" {{ old($form->uuid) === 'opsi-lain' ? 'checked' : '' }}>
				<label class="form-check-label" for="{{ $form->uuid }}-opsi-lain">
					Lainnya
				</label>
			</div>
			<div id="form-input-other-{{ $form->uuid }}-container" class="{{ old($form->uuid) != 'opsi-lain' ? 'd-none' : '' }}">
				<input type="text" class="form-control @error("{$form->uuid}_other") is-invalid @enderror" name="{{ $form->uuid }}_other" placeholder="Lainnya" value="{{ old($form->uuid . '_other') }}">
				@error("{$form->uuid}_other")
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
			<script>
				document.addEventListener('DOMContentLoaded', function() {
					var otherOption = document.getElementById('{{ $form->uuid }}-opsi-lain');
					var otherInputContainer = document.getElementById('form-input-other-{{ $form->uuid }}-container');
					var radioButtons = document.getElementsByName('{{ $form->uuid }}');

					function toggleOtherInput() {
						if (otherOption.checked) {
							otherInputContainer.classList.remove('d-none');
						} else {
							otherInputContainer.classList.add('d-none');
						}
					}

					otherOption.addEventListener('change', toggleOtherInput);
					radioButtons.forEach(function(radio) {
						radio.addEventListener('change', toggleOtherInput);
					});

					// Initialize state on page load
					toggleOtherInput();
				});
			</script>
		@endif
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
