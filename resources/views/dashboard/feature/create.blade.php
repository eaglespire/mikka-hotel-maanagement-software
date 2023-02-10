@extends('layouts.backEnd')

@section('content')
    <div class="row">
        <div class="col">
            <x-back-button header-title="New Feature">
                <a href="{{ route('b-room-features') }}" class="btn btn-primary mb-2">All Features</a>
            </x-back-button>
            <div class="card card-body">
                <form action="{{ route('b-store-feature') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="" class="form-label">Feature Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name of feature">
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        @error('icon')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row">
                        @include('dashboard.feature.icons')
                    </div>
                    <button type="submit" class="btn btn-primary my-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('input[type="checkbox"]').on('change', function() {
            $('input[type="checkbox"]').not(this).prop('checked', false);
        });
    </script>
@endsection

