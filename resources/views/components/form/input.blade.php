@if (isset($layout) && $layout == 'horizontal')
	<div class="col-md-4">
		<label for="{{ $name }}">{{ $label }}</label>
	</div>
	<div class="col-md-8 form-group">
		@if (isset($type) && $type === 'switch')
			<div class="form-check form-switch">
				<input class="form-check-input" type="checkbox" name="{{ $name }}" id="flexSwitchCheck{{ $name }}">
				<label class="form-check-label" for="flexSwitchCheck{{ $name }}">{{ $placeholder ?? '' }}</label>
			</div>
		@else
			<input type="{{ $type ?? 'text' }}" class="form-control @error($name) is-invalid @enderror {{ $class ?? '' }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder ?? $label }}" value="{{ old($name) ?? ($value ?? '') }}" format="{{ $format ?? '' }}" maxlength="{{ $maxlength ?? '' }}" {{ isset($disabled) && $disabled == true ? 'disabled' : '' }} {{ isset($readonly) && $readonly == true ? 'readonly' : '' }} />
		@endif
		@error($name)
			<div class="invalid-feedback">{{ $message }}</div>
		@enderror
	</div>
@else
	<div class="mb-3">
		<label for="{{ $name }}" class="form-label">{{ $label }}</label>
		<div class="{{ isset($addonLabel) ? 'input-group' : '' }}">
			<input type="{{ $type ?? 'text' }}" class="form-control @error($name) is-invalid @enderror {{ $class ?? '' }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder ?? $label }}" value="{{ old($name) ?? ($value ?? '') }}" format="{{ $format ?? '' }}" maxlength="{{ $maxlength ?? '' }}" {{ isset($disabled) && $disabled == true ? 'disabled' : '' }} {{ isset($readonly) && $readonly == true ? 'readonly' : '' }} />
			@if (isset($addonLabel))
				<a href="{{ $addonLink }}" class="btn btn-primary" id="button-addon-{{ $name }}">
					{!! $addonLabel !!}
				</a>
			@endif
		</div>
		@if (isset($help))
			<div id="{{ $name }}HelpBlock" class="form-text">
				{{ $help }}
			</div>
		@endif
		@error($name)
			<div class="invalid-feedback">{{ $message }}</div>
		@enderror
	</div>
@endif
