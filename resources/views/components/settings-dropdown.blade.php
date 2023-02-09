<div x-data="{ hideDropdown: @entangle('hideDropdown') }">
    <div x-cloak class="custom-dropdown-contents" :class="{'hide': hideDropdown }">
        {{ $slot }}
    </div>
</div>

@push('styles')
    <style>
        .custom-dropdown-contents{
            border-radius: 5px;
            flex-direction: column;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            background-color: #2E3648;
            position: absolute;
            min-width: 200px;
            right: 5.0rem;
        }
        .hide{
            display: none !important;
        }
        .custom-dropdown-contents a{
            display: block;
            color: #C0C6CD;
            padding: 12px 16px;
            text-decoration: none;
        }
        .custom-dropdown-contents a:hover{
            background-color: #323A4E;
            color: #fff;
        }
        [x-cloak]{
            display: none;
        }
    </style>
@endpush
