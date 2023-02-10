@extends('layouts.backEnd')
 @php
    $images = [];
    $images[] = $room->secondImage ?: null;
    $images[] = $room->thirdImage ?: null;
    $images[] = $room->fourthImage ?: null;
    $images[] = $room->fifthImage ?: null;
    $images[] = $room->sixthImage ?: null;

    //remove the null values
    $filtered = array_filter($images)
 @endphp

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-back-button header-title="{{ $room->title }}">
                <a  href="{{ route('b-rooms') }}" class="btn btn-success">
                    <i class="ion ion-md-create"></i> All Rooms
                </a>
            </x-back-button>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="mt-0 header-title">Room Images</h4>
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-interval="3000">
                                <div class="carousel-inner" role="listbox">
                                    @if(sizeof($filtered) !== 0)
                                       @foreach($filtered as $image)
                                            <div style="height: 200px;" class="carousel-item @if($loop->iteration == 1) active @endif">
                                                <img style="width: 100%; height: 100% !important; object-fit: cover;" class="d-block img-fluid" src="{{ $image }}" alt="First slide">
                                            </div>
                                       @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title font-16 mt-0">Name: {{ $room->title }}</h4>
                            <h6 class="card-subtitle font-14 text-muted">Category: {{ $room->category }}</h6>
                        </div>
                        <img class="img-fluid" src="{{ $room->firstImage }}" alt="Card image cap">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card text-white bg-dark">
                        <div class="card-body">
                            <blockquote class="card-blockquote mb-0">
                                <h4>Description</h4>
                                <p>{{ $room->description }}</p>
                            </blockquote>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-lg-n5">
                        <div class="col-lg-5">
                            <div class="card text-white bg-secondary">
                                <div class="card-body">
                                    <blockquote class="card-blockquote mb-0">
                                        <footer class="blockquote-footer text-white font-12">
                                            Price -<cite title="Source Title">
                                               $ {{ number_format($room->price) }}
                                            </cite>
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <blockquote class="card-blockquote mb-0">
                                <h4>Additional Information</h4>
                                <p>{{ $room->extraInfo }}</p>
                            </blockquote>
                        </div>
                    </div>

                    <div class="row mt-lg-n5 justify-content-center">
                        <div class="col-lg-3">
                            <div class="card text-white bg-secondary">
                                <div class="card-body">
                                    <blockquote class="card-blockquote mb-0">
                                        <footer class="blockquote-footer text-white font-12">
                                            Availability Status - <cite title="Source Title">
                                                @if($room->roomBooked == 1)
                                                    Booked
                                                @else
                                                    Not Booked
                                                @endif
                                            </cite>
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card text-white bg-secondary">
                                <div class="card-body">
                                    <blockquote class="card-blockquote mb-0">
                                        <footer class="blockquote-footer text-white font-12">
                                            Published Status -<cite title="Source Title">
                                                @if($room->roomShown == 1)
                                                    Published
                                                @else
                                                    Not published
                                                @endif
                                            </cite>
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card text-white bg-secondary">
                                <div class="card-body">
                                    <blockquote class="card-blockquote mb-0">
                                        <footer class="blockquote-footer text-white font-12">
                                            Hygienic Status - <cite title="Source Title">
                                                @if($room->roomClean == 1)
                                                   Room is tidy
                                                @else
                                                    Room is dirty
                                                @endif
                                            </cite>
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
