<div
    x-data="{ mode: 'light' }"
    x-on:dark-mode-toggled.window="mode = $event.detail"
>
    <span x-show="mode === 'light'">
        <img src="{{ asset('assets/images/logo-black.svg') }}" alt="Logo" class="h-10" >

    </span>

    <span x-show="mode === 'dark'">
       <img src="{{ asset('assets/images/logo-white.svg') }}" alt="Logo" class="h-10" >

    </span>
</div>



