@if($image)
    <div style="height: 150px;" class="my-2">
        <img src="{{ $image }}" alt="image" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
@endif

@if($imagePreview)
    <div class="my-2" style="height: 150px;">
        <img src="{{ $imagePreview->temporaryUrl() }}" alt="image" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
@endif

