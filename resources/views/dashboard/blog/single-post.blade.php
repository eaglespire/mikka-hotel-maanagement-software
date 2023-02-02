@extends('layouts.backEnd')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="mt-0 header-title">{{ $post->title}}</h4>
                        <a class="btn btn-primary" href="{{ url()->previous() }}">
                            <i class="ion ion-md-arrow-round-back  "></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    Single Post
                </div>
            </div>
        </div>
    </div>
@endsection
