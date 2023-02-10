@php
    $routeName = route('b-rooms');
@endphp

@extends('layouts.backEnd')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-30 justify-content-between align-items-center">
                        <h4 class="mt-0 header-title">Edit room</h4>
                        <x-top-right-btn icon="right" title="All Rooms" :route="$routeName"/>
                    </div>
                    <form method="post" action="{{ route('b-update-room',$room->slug) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $room->id }}">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input name="title" class="form-control @error('title') is-invalid @enderror" type="text" value="{{ $room->title }}" id="example-text-input" placeholder="name">
                                @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select class="form-control @error('category') is-invalid @enderror" name="category">
                                    @if(count($categories) !== 0)
                                        <option disabled>Please select</option>
                                        @foreach($categories as $category)
                                            <option @if($room->pricing_id == $category->id) selected @endif value="{{ $category['id'] }}">
                                                {{ $category['title'] }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('category')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input name="price" class="form-control @error('price') is-invalid @enderror" type="number" value="{{ $room->price }}" placeholder="price">
                                @error('price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Room Number</label>
                            <div class="col-sm-10">
                                <input name="roomNumber" class="form-control @error('rn') is-invalid @enderror" type="number" value="{{ $room->roomNumber }}" placeholder="room number">
                                @error('rn')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="desc" id="" cols="30" rows="5" class="form-control @error('desc') is-invalid @enderror">{{ $room->description }}</textarea>
                                @error('desc')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Additional Description</label>
                            <div class="col-sm-10">
                                <textarea name="adesc" id="" cols="30" rows="5" class="form-control @error('adesc') is-invalid @enderror">{{ $room->extraInfo }}</textarea>
                                @error('adesc')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Primary Image <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="file" name="firstImage" id="" class="form-control-file @error('firstImage') is-invalid @enderror">
                                @error('firstImage')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                @if(!empty($room->firstImage))
                                    <div>
                                        <img width="200" height="100" src="{{ $room->firstImage }}" alt="first image">
                                        @livewire('dashboard.remove-room-image', ['identifier' => $room->f1_public_id,'_id' => $room->id,'filename' => 'firstImage','publicid' => $room->f1_public_id])
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Image (optional)</label>
                            <div class="col-sm-10">
                                <input type="file" name="secondImage" id="" class="form-control-file @error('secondImage') is-invalid @enderror">
                                @error('secondImage')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                @if(!empty($room->secondImage))
                                    <div>
                                        <img width="200" height="100" src="{{ $room->secondImage }}" alt="second image">
                                        @livewire('dashboard.remove-room-image', ['identifier' => $room->f2_public_id,'_id' => $room->id,'filename' => 'secondImage','publicid' => $room->f2_public_id])
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Image (optional)</label>
                            <div class="col-sm-10">
                                <input type="file" name="thirdImage" id="" class="form-control-file @error('thirdImage') is-invalid @enderror">
                                @error('thirdImage')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                @if(!empty($room->thirdImage))
                                    <div>
                                        <img width="200" height="100" src="{{ $room->thirdImage }}" alt="third image">
                                        @livewire('dashboard.remove-room-image', ['identifier' => $room->f3_public_id,'_id' => $room->id,'filename' => 'thirdImage','publicid' => $room->f3_public_id])
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Image (optional)</label>
                            <div class="col-sm-10">
                                <input type="file" name="fourthImage" id="" class="form-control-file @error('fourthImage') is-invalid @enderror">
                                @error('fourthImage')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                @if(!empty($room->fourthImage))
                                    <div>
                                        <img width="200" height="100" src="{{ $room->fourthImage }}" alt="fourth image">
                                        @livewire('dashboard.remove-room-image', ['identifier' => $room->f4_public_id,'_id' => $room->id,'filename' => 'fourthImage','publicid' => $room->f4_public_id])
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Image (optional)</label>
                            <div class="col-sm-10">
                                <input type="file" name="fifthImage" id="" class="form-control-file @error('fifthImage') is-invalid @enderror">
                                @error('fifthImage')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                @if(!empty($room->fifthImage))
                                    <div>
                                        <img width="200" height="100" src="{{ $room->fifthImage }}" alt="fifth image">
                                        @livewire('dashboard.remove-room-image', ['identifier' => $room->f5_public_id,'_id' => $room->id,'filename' => 'fifthImage','publicid' => $room->f5_public_id])
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Image (optional)</label>
                            <div class="col-sm-10">
                                <input type="file" name="sixthImage" id="" class="form-control-file @error('sixthImage') is-invalid @enderror">
                                @error('sixthImage')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                @if(!empty($room->sixthImage))
                                    <div>
                                        <img width="200" height="100" src="{{ $room->sixthImage }}" alt="sixth image">
                                        @livewire('dashboard.remove-room-image', ['identifier' => $room->f6_public_id,'_id' => $room->id,'filename' => 'sixthImage','publicid' => $room->f6_public_id])
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Publish?</label>
                            <div class="col-sm-10">
                                <select name="publish" id="" class="form-control">
                                    <option disabled >Please select</option>
                                    <option value="1">Yes,Publish</option>
                                    <option value="0">Don't Publish</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-10 offset-lg-2">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection

