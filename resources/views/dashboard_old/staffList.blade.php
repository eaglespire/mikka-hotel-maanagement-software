@extends('layouts.backEnd')
@section('title','Staff List | '. config('app.name'))

@section('content')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Staff</h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{ route('b-create-staff') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i> Add Staff</a>
        </div>
    </div>
    @livewire('dashboard.staff-list-component')
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="/assets/css/select2.min.css">
@endpush

@push('scripts')
    <script src="/assets/js/select2.min.js"></script>
@endpush
