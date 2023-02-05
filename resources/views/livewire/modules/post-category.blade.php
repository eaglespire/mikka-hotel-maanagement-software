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
        <div class="d-flex justify-content-between my-2 align-items-center">
            <div class="d-flex align-items-center">
                <h4 class="header-title mr-2">All Categories</h4>
                @can(\App\Services\Permissions::CAN_CREATE_BLOG_POST)
                    <button class="btn btn-primary" wire:click.prevent="OpenCreateModal">
                        <i class="ion ion-md-create "></i>  Create
                    </button>
                @endcan
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-primary">
                <i class="typcn typcn-chevron-left"></i> Back
            </a>
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
                    @can(\App\Services\Permissions::CAN_CREATE_BLOG_POST)
                        <th>Action</th>
                    @endcan
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
                                        @can(\App\Services\Permissions::CAN_UPDATE_BLOG_POST)
                                            <a wire:click.prevent="LaunchEditModal({{ $category['id'] }},'{{ $category['name'] }}')" href="" class="btn
                                        btn-secondary">
                                                <i class="typcn typcn-edit "></i> edit
                                            </a>
                                        @endcan
                                      @can(\App\Services\Permissions::CAN_DELETE_BLOG_POST)
                                            <a wire:click.prevent="DeleteCategory({{ $category['id'] }})" href="" class="btn btn-danger mx-2">
                                                <i class="typcn typcn-trash "></i> trash
                                            </a>
                                      @endcan
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
