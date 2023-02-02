<div x-data="{ hideModal: @entangle('hideModal') }">
    <section x-cloak :class="{'hide-modal': hideModal}" class="app-modal">
        <div class="app-flex">
            <h6 class="app-modal-header">{{ $header }} | <span x-text="$wire.mode"></span></h6>
            <span  class="app-btn-close" x-on:click="hideModal=true">⨉</span>
        </div>
        <div class="app-modal-body">
            {{ $slot }}
        </div>
    </section>

    <div x-cloak :class="{'hide-modal': hideModal}" class="app-overlay"></div>
</div>



@push('styles')
    <style>
        [x-cloak] { display: none !important; }
        .app-modal {
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 0.4rem;
            width: 450px;
            padding: 1.5rem;
            min-height: 350px;
            position: fixed;
            top: 20%;
            left: 32%;
            background-color: #252735;
            border: 1px solid #252735;
            font-family: "Roboto", sans-serif;
            font-size: 14px;
            border-radius: 15px;
            max-height: calc(100vh - 150px);
            overflow-y: auto;
            z-index: 1000;
            animation: fadeInAnimation ease 1s;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
        }
        @keyframes fadeInAnimation {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }


        .app-modal-body,.app-modal-header{
            color: #e9ecef !important;
        }
        .app-modal-header{

        }

        .app-modal .app-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 40px;
        }

        .app-modal input {
            padding: 0.7rem 1rem;
            border: 1px solid #40485A;
            border-radius: 5px;
            font-size: 0.9em;
        }

        .app-modal p {
            font-size: 0.9rem;
            color: #C6C8E5;
            margin: 0.4rem 0 0.2rem;
        }

        button {
            cursor: pointer;
            border: none;
            font-weight: 600;
        }

        .app-btn {
            display: inline-block;
            padding: 0.8rem 1.4rem;
            font-weight: 700;
            background-color: black;
            color: white;
            border-radius: 5px;
            text-align: center;
            font-size: 1em;
        }

        .app-btn-open {
            position: absolute;
            bottom: 150px;
        }

        .app-btn-close {
            /*transform: translate(10px, -20px);*/
            padding: 0.5rem 0.7rem;
            cursor: pointer !important;
            color: #e9ecef;
        }
        .app-overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 500;
        }
        .hide-modal {
            display: none;
        }
        @media (max-width: 767px) {
            .app-modal {
                position: fixed;
                top: 20%;
                left: 20px;
                right: 30px;
                width: auto;
                margin: 0;
            }
        }

    </style>
@endpush
