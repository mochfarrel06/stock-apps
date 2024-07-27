@props([
    'name',
    'id' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => '',
    'label' => null,
    'attributes' => [],
])

<div class="form-group">
    @if ($label)
        <label for="{{ $id ?? $name }}">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" class="form-control" name="{{ $name }}" id="{{ $id ?? $name }}"
        value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'form-control']) }}>
</div>
