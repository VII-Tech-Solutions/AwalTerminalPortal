<x-forms::field-wrapper
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}') }">
{{--        <input wire:model="{{$getStatePath()."path"}}" type="text">--}}
        <output wire:model="{{$getStatePath()}}" type="text"></output>
{{--        <x-inputs.text wire:model="{{$getStatePath()}}"/>--}}
    </div>
</x-forms::field-wrapper>
