@extends('layouts.backEnd')


@section('title','Add a new feature')

@section('content')
    <div class="row">
        <div class="col-sm-4 col-4">
            <h4 class="page-title">New Feature</h4>
        </div>
        <div class="col-sm-8 col-8 text-right m-b-20">
            <a href="{{ route('b-feature.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fas fa-plus"></i> Add Feature</a>
        </div>
    </div>
    @livewire('dashboard.add-feature')
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="/assets/css/select2.min.css">
    <link rel="stylesheet" href="/assets/plugins/icons/feather/feather.css">
@endpush

@push('scripts')
    <script src="/assets/js/select2.min.js"></script>
    <script src="/assets/js/moment.min.js"></script>
@endpush
