<div class="card" wire:key="blog-module-{{ Str::random() }}">
    <div class="card-body">
        <div class="d-flex justify-content-between my-2">
            <h4 class="mt-0 header-title">All Blog</h4>
            <button class="btn btn-primary" wire:click.prevent="OpenModal">
                <i class="ion ion-md-create"></i> Create
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm m-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Views</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($posts->total() > 0)
                    @foreach($posts as $post)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td style="cursor: pointer" onclick="window.location = '{{ route('b-post',['post' => $post]) }}'">{{ Str::limit($post->title) }}</td>
                            <td>{{ $post->reads }}</td>
                            <td>{{ $post->postcategory->name }}</td>
                            <td>
                                <div class="d-flex">
                                    <button wire:click.prevent="OpenModal(1,'{{ $post->id }}')" class="btn btn-secondary mr-1">
                                        <i class="dripicons-document-edit"></i> edit
                                    </button>
                                    <button wire:click.prevent="$emit('delete',{{ $post->id }})" class="btn btn-danger mr-1">
                                        <i class="ion ion-md-trash"></i> delete
                                    </button>
                                    @if($post->published === 1)
                                        <button wire:click.prevent="PublishPost({{ $post->id }},'0')"  class="btn btn-success mr-1">
                                            <i class="ion ion-md-trash"></i> UnPublish
                                        </button>
                                    @else
                                        <button wire:click.prevent="PublishPost({{ $post->id }},'1')" class="btn btn-secondary mr-1">
                                            <i class="ion ion-md-trash"></i> publish
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <p>No data to display...</p>
                @endif
                </tbody>
            </table>
        </div>
        @if($posts->total() > 0 && $posts->count() < $posts->total())
            <button wire:click="LoadMore" wire:loading.remove class="btn btn-primary">
                {{__('See more')}}
            </button>
        @endif
    </div>

    <x-custom :modal-header="$header">
        <div class="form-group">
            <label for="" class="form-label">Title</label>
            <input wire:model.defer="title" id="" type="text" class="form-control @error('title') is-invalid @enderror">
            @error('title')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="" class="form-label">Tags( Separate by a space or a comma )</label>
            <input wire:model.defer="tags" id="" type="text" class="form-control @error('tags') is-invalid @enderror">
            @error('tags')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="" class="form-label">Body</label>
            <textarea wire:model.defer="body" cols="30" rows="5" id="" class="form-control @error('body') is-invalid @enderror"></textarea>
            @error('body')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="" class="form-label">Choose Category</label>
            <select wire:model.defer="category" id="" class="form-control @error('category') is-invalid @enderror">
                @if(!empty($categories))
                    <option disabled>Please select</option>
                    @foreach($categories as $cat)
                        <option @if($category === $cat['id']) selected @endif value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                    @endforeach
                @endif
            </select>
            @error('category')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="" class="form-label">Publish Post ?</label>
            <select wire:model.defer="published" id="" class="form-control @error('published') is-invalid @enderror">
                <option disabled>Please select</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            @error('published')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        @if($mode === 1)
            <button wire:click.prevent="UpdatePost" class="btn btn-success">Update</button>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div wire:target="SaveFile" wire:loading.block class="alert alert-info">Please wait...</div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Upload First Image</label>
                            <input wire:model.defer="image" type="file" class="form-control-file @error('image') is-invalid @enderror">
                            @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <button wire:click.prevent="SaveFile('image','1')" class="btn btn-primary my-2">Upload</button>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="" class="form-control-label">Upload Second Image</label>
                            <input wire:model.defer="image2" type="file" class="form-control-file @error('image2') is-invalid @enderror">
                            @error('image2')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <button wire:click.prevent="SaveFile('image2','2')" class="btn btn-primary my-2">Upload</button>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="" class="form-control-label">Upload Third Image</label>
                            <input wire:model.defer="image3" type="file" class="form-control-file @error('image3') is-invalid @enderror">
                            @error('image3')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <button wire:click.prevent="SaveFile('image3','3')" class="btn btn-primary my-2">Upload</button>
                        </div>
                    </div>
                </div>


            @if(!empty($firstImage))
                <img src="{{ $firstImage }}" alt="image" width="100" height="100" title="first image">
            @endif
            @if(!empty($secondImage))
                <img src="{{ $secondImage }}" alt="image" width="100" height="100" title="second image">
            @endif
            @if(!empty($thirdImage))
                <img src="{{ $thirdImage }}" alt="image" width="100" height="100" title="third image">
            @endif
        @else
            <button wire:click.prevent="SavePost" class="btn btn-success">Submit</button>
        @endif
        @include('includes.processing',['action' => 'SavePost','PublishPost','UpdatePost','UploadImage'])
    </x-custom>
</div>

@push('scripts')
    <script>
        window.addEventListener('livewire:load', function () {
            @this.on('success', (message) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: message,
                    toast: true,
                    position:'top-end'
                })
            })
            @this.on('fail', () => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error has occurred',
                    toast: true,
                    position:'top-end'
                })
            })
            @this.on('delete', id => {
                Swal.fire({
                    icon: 'question',
                    title: 'Remove post?',
                    text: 'This action cannot be undone',
                    showCancelButton: true,
                    cancelButtonText: 'Cancel',
                    cancelButtonColor:'#EC4561'
                }).then(response => {
                    if(response.isConfirmed){
                        @this.call('DeletePost', id)
                    }
                })
            })
        })
    </script>
@endpush
