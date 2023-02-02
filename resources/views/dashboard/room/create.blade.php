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
                        <h4 class="mt-0 header-title">Create a new room</h4>
                        <x-top-right-btn icon="right" title="All Rooms" :route="$routeName"/>
                    </div>
                    <form method="post" action="{{ route('b-store-room') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input name="title" class="form-control @error('title') is-invalid @enderror" type="text" value="{{ old('title') }}" id="example-text-input" placeholder="name">
                                @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select class="form-control @error('category') is-invalid @enderror" name="category">
                                    <option disabled>Select</option>
                                    <option value="single">Single</option>
                                    <option value="double">Double</option>
                                    <option value="premium">Premium</option>
                                    <option value="deluxe">Deluxe</option>
                                </select>
                                @error('category')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input name="price" class="form-control @error('price') is-invalid @enderror" type="number" value="{{ old('price') }}" placeholder="price">
                                @error('price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Room Number</label>
                            <div class="col-sm-10">
                                <input name="roomNumber" class="form-control @error('rn') is-invalid @enderror" type="number" value="{{ old('roomNumber') }}" placeholder="room number">
                                @error('rn')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="desc" id="" cols="30" rows="5" class="form-control @error('desc') is-invalid @enderror">{{ old('desc') }}</textarea>
                                @error('desc')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Additional Description</label>
                            <div class="col-sm-10">
                                <textarea name="adesc" id="" cols="30" rows="5" class="form-control @error('adesc') is-invalid @enderror">{{ old('adesc') }}</textarea>
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
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Image (optional)</label>
                            <div class="col-sm-10">
                                <input type="file" name="secondImage" id="" class="form-control-file @error('secondImage') is-invalid @enderror">
                                @error('secondImage')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Image (optional)</label>
                            <div class="col-sm-10">
                                <input type="file" name="thirdImage" id="" class="form-control-file @error('thirdImage') is-invalid @enderror">
                                @error('thirdImage')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Image (optional)</label>
                            <div class="col-sm-10">
                                <input type="file" name="fourthImage" id="" class="form-control-file @error('fourthImage') is-invalid @enderror">
                                @error('fourthImage')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Image (optional)</label>
                            <div class="col-sm-10">
                                <input type="file" name="fifthImage" id="" class="form-control-file @error('fifthImage') is-invalid @enderror">
                                @error('fifthImage')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Image (optional)</label>
                            <div class="col-sm-10">
                                <input type="file" name="sixthImage" id="" class="form-control-file @error('sixthImage') is-invalid @enderror">
                                @error('sixthImage')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-10 offset-lg-2">
                            <button type="submit" class="btn btn-primary btn-block">Add</button>
                        </div>

                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
