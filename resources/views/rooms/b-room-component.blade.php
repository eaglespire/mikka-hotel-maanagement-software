@extends('layouts.backEnd')
@section('content')
    @vite('resources/js/rooms/Rooms.jsx')
    All rooms
    <div id="room-component"></div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="/assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap-datetimepicker.min.css">
@endpush

@push('scripts')
    <script src="/assets/js/select2.min.js"></script>
    <script src="/assets/js/moment.min.js"></script>
    <script src="/assets/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        $(function () {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'

            });
        });
    </script>
@endpush
