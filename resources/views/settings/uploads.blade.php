@extends('layouts.backEnd')

@section('content')
    <x-back-button header-title="Uploads"/>
    @livewire('settings.favicon-upload')
    @livewire('settings.whitelogo-upload')
    @livewire('settings.darklogo-upload')
@endsection
