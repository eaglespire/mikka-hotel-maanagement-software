@extends('layouts.backEnd')

@section('content')
    <div class="row">
        <div class="col-12">
            @livewire('settings.general')
            @livewire('settings.contact')
            @livewire('settings.social')
            <div>
                @livewire('settings.favicon-upload')
                @livewire('settings.whitelogo-upload')
                @livewire('settings.darklogo-upload')
            </div>
{{--            @livewire('settings.upload')--}}
        </div> <!-- end col -->
    </div>
@endsection

@push('styles')

@endpush
