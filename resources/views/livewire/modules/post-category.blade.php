<div class="card" wire:key="post-category-{{ Str::random() }}">
    <x-blog-category>
        <form>
            <div class="form-group">
                <label for="" class="form-label">Name</label>
                <input wire:model.defer="name" type="text" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div wire:loading.block>
                <div class="alert alert-info">Processing...</div>
            </div>
            @if($updateMode)
                <button wire:click.prevent="UpdateCategory" type="submit" class="btn btn-success">Update</button>
            @else
                <button wire:click.prevent="SaveNewCategory" type="submit" class="btn btn-success">Submit</button>
            @endif
        </form>
    </x-blog-category>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mt-0 header-title">All categories</h4>
                <p class="text-muted m-b-30"> Add new category update and remove categories </p>
            </div>
            <div class="">
                <button class="btn btn-secondary">
                    <i class="typcn typcn-chevron-left "></i> Back
                </button>
                <button class="btn btn-primary" wire:click.prevent="OpenCreateModal">
                    <i class="typcn typcn-plus "></i>  New category
                </button>
            </div>
        </div>

        <div wire:loading.inline wire:target="DeleteCategory">
            <div class="alert alert-info">Processing...</div>
        </div>
        <div class="table-responsive">
            <table class="table table-sm m-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($categories) !== 0)
                        @foreach($categories as $category)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $category['name'] }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a wire:click.prevent="LaunchEditModal({{ $category['id'] }},'{{ $category['name'] }}')" href="" class="btn
                                        btn-secondary">
                                            <i class="typcn typcn-edit "></i> edit
                                        </a>
                                        <a wire:click.prevent="DeleteCategory({{ $category['id'] }})" href="" class="btn btn-danger mx-2">
                                            <i class="typcn typcn-trash "></i> trash
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

        </div>

    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('livewire:load', function () {
            @this.on('success', ()=> {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Operation successful',
                    toast: true,
                    position: 'top-end',
                    timer: 10000
                })
            })
            @this.on('failure', ()=> {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred',
                    toast: true,
                    position: 'top-end',
                    timer: 10000
                })
            })
        })
    </script>
@endpush
