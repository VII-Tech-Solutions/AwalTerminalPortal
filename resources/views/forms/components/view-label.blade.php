@php
    $datalistOptions = $getDatalistOptions();

    $affixLabelClasses = [
        'whitespace-nowrap group-focus-within:text-primary-500',
        'text-gray-400' => ! $errors->has($getStatePath()),
        'text-danger-400' => $errors->has($getStatePath()),
    ];
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div {{ $attributes->merge($getExtraAttributes())->class(['filament-forms-placeholder-component']) }}>
        @if (($prefixAction = $getPrefixAction()) && (! $prefixAction->isHidden()))
            {{ $prefixAction }}
        @endif

        @if ($icon = $getPrefixIcon())
            <x-dynamic-component :component="$icon" class="w-5 h-5"/>
        @endif
            <use x-bind:xlink:href="myicon" xlink:href="#myicon"></use>
        @if ($label = $getPrefixLabel())
            <span @class($affixLabelClasses)>
                {{ $label }}
            </span>
        @endif

        <input
        @unless ($hasMask())
            {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
            type="{{ $getType() }}"
        @else
            x-data="textInputFormComponent({
                        {{ $hasMask() ? "getMaskOptionsUsing: (IMask) => ({$getJsonMaskConfiguration()})," : null }}
            state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')') }},
                    })"
            type="text"
            wire:ignore
            {{ $getExtraAlpineAttributeBag() }}

        @endunless
        dusk="filament.forms.{{ $getStatePath() }}"
        {!! ($autocapitalize = $getAutocapitalize()) ? "autocapitalize=\"{$autocapitalize}\"" : null !!}
        {!! ($autocomplete = $getAutocomplete()) ? "autocomplete=\"{$autocomplete}\"" : null !!}
        {!! $isAutofocused() ? 'autofocus' : null !!}
        {!! $isDisabled() ? 'disabled' : null !!}
        id="{{ $getId() }}"
        {!! ($inputMode = $getInputMode()) ? "inputmode=\"{$inputMode}\"" : null !!}
        {!! $datalistOptions ? "list=\"{$getId()}-list\"" : null !!}
        {!! ($placeholder = $getPlaceholder()) ? "placeholder=\"{$placeholder}\"" : null !!}
        {!! ($interval = $getStep()) ? "step=\"{$interval}\"" : null !!}
        @if (! $isConcealed())
            {!! filled($length = $getMaxLength()) ? "maxlength=\"{$length}\"" : null !!}
            {!! filled($value = $getMaxValue()) ? "max=\"{$value}\"" : null !!}
            {!! filled($length = $getMinLength()) ? "minlength=\"{$length}\"" : null !!}
            {!! filled($value = $getMinValue()) ? "min=\"{$value}\"" : null !!}
            {!! $isRequired() ? 'required' : null !!}
        @endif
        {{ $getExtraInputAttributeBag()->class([
                     'block w-full transition duration-75  focus:border-transparent focus:ring-transparent focus:ring-transparent disabled:opacity-70',
                     'dark:bg-gray-700 dark:text-white dark:focus:border-transparent' => config('forms.dark_mode'),
                     'border-transparent' => ! $errors->has($getStatePath()),
                     'dark:border-transparent' => (! $errors->has($getStatePath())) && config('forms.dark_mode'),
                     'border-transparent ring-transparent' => $errors->has($getStatePath()),
                 ]) }}
        />

        @if ($label = $getSuffixLabel())
            <span @class($affixLabelClasses)>
                {{ $label }}
            </span>
        @endif

        @if ($icon = $getSuffixIcon())
            <x-dynamic-component :component="$icon" class="w-5 h-5"/>
        @endif

        @if (($suffixAction = $getSuffixAction()) && (! $suffixAction->isHidden()))
            {{ $suffixAction }}
        @endif
    </div>

    @if ($datalistOptions)
        <datalist id="{{ $getId() }}-list">
            @foreach ($datalistOptions as $option)
                <option value="{{ $option }}"/>
            @endforeach
        </datalist>
    @endif
</x-dynamic-component>
