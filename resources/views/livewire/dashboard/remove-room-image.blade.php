<div wire:key="dashboard-remove-image-4563gdu-377" class="my-2">
    <button wire:click.prevent="$emit('open-alert')" @if($identifier == null) disabled @endif class="btn btn-danger" wire:click.prevent="RemoveImage">
        Remove
    </button>
</div>

@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', function (){
            @this.on('deleted-image', event => {
                Swal.fire({
                    'title':'Success',
                    'text':'Deleted',
                    'icon':'success'
                })
            })
            @this.on('open-alert', event => {
                Swal.fire({
                    title: 'Remove image?',
                    text: "Do you want to proceed ?!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('RemoveImage')
                    }
                })
            } )
            @this.on('deleted-image', event => {
                Swal.fire({
                    title:'success',
                    text: 'Image removed',
                    icon: 'success'
                })
            })
            @this.on('deleted-image-error', event => {
                Swal.fire({
                    title:'error',
                    text: 'An error occurred',
                    icon: 'error'
                })
            })
        })
    </script>
@endpush
