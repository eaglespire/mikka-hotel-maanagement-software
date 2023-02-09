
<div x-data="{ hidePermissionsModal: @entangle('hidePermissionsModal') }">
    <div x-cloak class="aud-app-modal"  :class="{'reveal-modal': hidePermissionsModal }" tabindex="-1">
        <div class="aud-app-modal-dialog aud-app-modal-dialog-centered aud-app-modal-dialog-scrollable modal-lg">
            <div class="aud-app-modal-content">
                <div class="aud-app-modal-header">
                    <h5 class="aud-app-modal-title">{{ $modalHeader }}</h5>
                    <button x-on:click="$wire.ClosePermissionsModal()" type="button" class="aud-app-close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="aud-app-modal-body">
                    {{ $slot }}
                </div>
                <div class="aud-app-modal-footer">
{{--                    <button x-on:click="hideModal=true" type="button" class="btn btn-secondary">Close</button>--}}
                </div>
            </div>
        </div>
    </div>
    <div x-cloak class="aud-app-modal-backdrop" :class="{'reveal-modal': hidePermissionsModal }"></div>
</div>


@push('styles')
    <style>
        [x-cloak] { display: none !important; }
        .reveal-modal{
            display: none;
        }
        .aud-app-modal {
            --bs-modal-zindex: 1055;
            --bs-modal-width: 500px;
            --bs-modal-padding: 1rem;
            --bs-modal-margin: 0.5rem;
            --bs-modal-color:#B7BBBF ;
            --bs-modal-bg: #252735;
            --bs-modal-border-color: var(--bs-border-color-translucent);
            --bs-modal-border-width: 1px;
            --bs-modal-border-radius: 0.5rem;
            --bs-modal-box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            --bs-modal-inner-border-radius: calc(0.5rem - 1px);
            --bs-modal-header-padding-x: 1rem;
            --bs-modal-header-padding-y: 1rem;
            --bs-modal-header-padding: 1rem 1rem;
            --bs-modal-header-border-color: var(--bs-border-color);
            --bs-modal-header-border-width: 1px;
            --bs-modal-title-line-height: 1.5;
            --bs-modal-footer-gap: 0.5rem;
            --bs-modal-footer-bg: #252735;
            --bs-modal-footer-border-color: var(--bs-border-color);
            --bs-modal-footer-border-width: 1px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1055;
            /*display: block;*/
            width: 100%;
            height: 100%;
            overflow-x: hidden;
            overflow-y: auto;
            outline: 0;
        }
        .aud-app-modal-backdrop {
            /*display: none;*/
            --bs-backdrop-zindex: 1050;
            --bs-backdrop-bg: rgba(0,0,0,0.5);
            --bs-backdrop-opacity: 0.5;
            position: fixed;
            top: 0;
            left: 0;
            z-index: var(--bs-backdrop-zindex);
            width: 100vw;
            height: 100vh;
            background-color: var(--bs-backdrop-bg);
            backdrop-filter: blur(5px);
        }
        .aud-app-modal-dialog {
            position: relative;
            width: auto;
            margin: var(--bs-modal-margin);
            pointer-events: none;
        }
        .aud-app-modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - var(--bs-modal-margin) * 2);
        }

        .aud-app-modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            color: var(--bs-modal-color);
            pointer-events: auto;
            background-color: var(--bs-modal-bg);
            background-clip: padding-box;
            border: var(--bs-modal-border-width) solid var(--bs-modal-border-color);
            border-radius: var(--bs-modal-border-radius);
            outline: 0;
        }


        .aud-app-modal-backdrop.aud-app-fade {
            opacity: 0;
        }
        .aud-app-modal-backdrop.aud-app-show {
            opacity: var(--bs-backdrop-opacity);
        }

        .aud-app-modal-header {
            display: flex;
            flex-shrink: 0;
            align-items: center;
            justify-content: space-between;
            padding: var(--bs-modal-header-padding);
            border-bottom: var(--bs-modal-header-border-width) solid var(--bs-modal-header-border-color);
            border-top-left-radius: var(--bs-modal-inner-border-radius);
            border-top-right-radius: var(--bs-modal-inner-border-radius);
        }
        .aud-app-modal-header .aud-app-btn-close {
            padding: calc(var(--bs-modal-header-padding-y) * 0.5) calc(var(--bs-modal-header-padding-x) * 0.5);
            margin: calc(-0.5 * var(--bs-modal-header-padding-y)) calc(-0.5 * var(--bs-modal-header-padding-x)) calc(-0.5 * var(--bs-modal-header-padding-y)) auto;
        }

        .aud-app-modal-title {
            margin-bottom: 0;
            line-height: var(--bs-modal-title-line-height);
        }

        .aud-app-modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: var(--bs-modal-padding);
        }

        .aud-app-modal-footer {
            display: flex;
            flex-shrink: 0;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-end;
            padding: calc(var(--bs-modal-padding) - var(--bs-modal-footer-gap) * 0.5);
            background-color: var(--bs-modal-footer-bg);
            border-top: var(--bs-modal-footer-border-width) solid var(--bs-modal-footer-border-color);
            border-bottom-right-radius: var(--bs-modal-inner-border-radius);
            border-bottom-left-radius: var(--bs-modal-inner-border-radius);
        }
        .aud-app-modal-footer > * {
            margin: calc(var(--bs-modal-footer-gap) * 0.5);
        }

        @media (min-width: 576px) {
            .aud-app-modal {
                --bs-modal-margin: 1.75rem;
                --bs-modal-box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            }
            .aud-app-modal-dialog {
                max-width: var(--bs-modal-width);
                margin-right: auto;
                margin-left: auto;
            }
            .aud-app-modal-sm {
                --bs-modal-width: 300px;
            }
        }
        @media (min-width: 992px) {
            .modal-lg,
            .modal-xl {
                --bs-modal-width: 800px;
            }
        }
        @media (min-width: 1200px) {
            .aud-app-modal-xl {
                --bs-modal-width: 1140px;
            }
        }
        .aud-app-modal-dialog-scrollable {
            height: calc(100% - var(--bs-modal-margin) * 2);
        }
        .aud-app-modal-dialog-scrollable .aud-app-modal-content {
            max-height: 100%;
            overflow: hidden;
        }
        .aud-app-modal-dialog-scrollable .aud-app-modal-body {
            overflow-y: auto;
        }
        .aud-app-close{
            float:right;
            font-size:1.5rem;
            font-weight:700;
            line-height:1;
            color:var(--bs-modal-color);
            text-shadow:0 1px 0 #fff;
            opacity:.5;
            text-decoration:none
        }
        .aud-app-close:not(:disabled):not(.disabled):focus,.close:not(:disabled):not(.disabled):hover{
            opacity:.75
        }
        .aud-app-close:hover {
            color: #fff;
        }
        button.aud-app-close{
            padding:0;
            background-color:transparent;
            border:0;
            -webkit-appearance:none;
            -moz-appearance:none;
            appearance:none;
        }
    </style>
@endpush
