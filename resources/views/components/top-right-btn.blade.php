@if($icon == 'right')
    <a href="{{ $route }}" class="btn btn-secondary">
        {{ $title }}  <i class="typcn typcn-chevron-{{ $icon }}"></i>
    </a>
@else
    <a href="{{ $route }}" class="btn btn-secondary">
        <i class="typcn typcn-chevron-{{ $icon }}"></i>   {{ $title }}
    </a>
@endif

