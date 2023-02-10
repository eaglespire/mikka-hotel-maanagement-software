<div wire:key="payroll-{{ Str::random() }}">
    <x-back-button header-title="New Entry">
        <a wire:click.prevent="OpenModal" href="" class="btn btn-success">
            <i class="ion ion-md-create"></i> New
        </a>
    </x-back-button>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm m-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>FullName</th>
                        <th>Staff ID</th>
                        <th>Email</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <x-custom :modal-header="$modalHeader">
        <form>
            <div class="form-group">
                <label for="" class="form-label">Staff</label>
                <select wire:model.defer="staff" id="" class="form-control @error('staff') is-invalid @enderror">
                    <option disabled>Please select</option>
                    @if(count($employees) !== 0)
                        @foreach($employees as $employee)
                            <option value="{{ $employee['id'] }}">{{ $employee->firstname }} {{ $employee->lastname }} - ({{ $employee->staff_identity
                             }})</option>
                        @endforeach
                    @endif
                </select>
                @error('staff')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="" class="form-label">Pay</label>
                <input placeholder="amount" wire:model.defer="amount" type="text" class="form-control @error('amount') is-invalid @enderror">
                @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div wire:loading.block wire:target="" class="alert alert-primary">Processing...</div>
            @if($mode == 0)
                <button wire:click.prevent="" type="submit" class="btn btn-primary">
                    Save
                </button>
            @else
                <button wire:click.prevent="" type="submit" class="btn btn-primary">
                    Update
                </button>
            @endif
        </form>
    </x-custom>
</div>

@push('scripts')
    <script>
        window.addEventListener('livewire:load', function (){
            @this.on('success', message => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: message
                })
            })
            @this.on('fail', message => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: message
                })
            })
            @this.on('remove-payroll', id => {
                Swal.fire({
                    icon: 'question',
                    title: 'Want to delete?',
                    text: 'This action cannot be reversed',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, proceed'
                }).then(response => {
                    if(response.isConfirmed){
                        @this.call('Remove',id)
                    }
                })
            })

        })
    </script>
@endpush

