<div class="d-flex justify-content-between my-2 align-items-center">
    <div class="d-flex align-items-center">
        <h4 class="header-title mr-2">{{ $headerTitle }}</h4>
        {{ $slot }}
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-primary">
        <i class="typcn typcn-chevron-left"></i> Back
    </a>
</div>
