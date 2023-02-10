<div wire:key="employee-{{ Str::random() }}" class="row">
    <div class="col-12">
        <x-back-button header-title="Staff Information">
            @can(\App\Services\Permissions::CAN_CREATE_EMPLOYEES)
                <a wire:click.prevent="OpenModal" href="" class="btn btn-success">
                    <i class="ion ion-md-create"></i> New
                </a>
            @endcan
        </x-back-button>
    </div>
    <div class="col-12 my-5">
        <div class="card" x-data="{ show:false, showDate: false }">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <div wire:loading.block wire:target="updatedFile" class="alert alert-primary">
                        Uploading...Please wait
                    </div>

                    <button wire:click.prevent="ExportStaffData" class="btn btn-outline-primary mr-1">Export CSV</button>
                    <input wire:model="file" type="file" id="selectedFile" style="display: none;" />
                    <input class="btn btn-outline-secondary mr-1" type="button" value="Import CSV" onclick="document.getElementById('selectedFile').click();" />

                    <template x-if="!show">
                        <button class="btn btn-info mr-1" x-on:click="show=true">
                            Show Password
                        </button>
                    </template>
                    <template x-if="!showDate">
                        <button class="btn btn-outline-info mr-1" x-on:click="showDate=true">
                            Show Date
                        </button>
                    </template>
                    <template x-if="show">
                        <button class="btn btn-secondary mr-1" x-on:click="show=false">
                            Hide Password
                        </button>
                    </template>
                    <template x-if="showDate">
                        <button class="btn btn-outline-secondary mr-1" x-on:click="showDate=false">
                            Hide Date
                        </button>
                    </template>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <th>{{__('#')}}</th>
                            <th>{{__('Image')}}</th>
                            <th>{{__('FullName')}}</th>
                            <th>{{__('Email')}}</th>
                            <template x-if="showDate">
                                <th>{{__('DOB')}}</th>
                            </template>
                            <template x-if="showDate">
                                <th>{{__('Date Joined')}}</th>
                            </template>
                            <th>{{__('Staff ID')}}</th>
                            <th>{{__('Position')}}</th>
                            <th>{{__('Status')}}</th>
                            <template x-if="show">
                                <th>{{__('Password')}}</th>
                            </template>
                            <th colspan="2">{{__('Action')}}</th>
                        </thead>
                        <tbody>
                        @if($employees->total() > 0)
                           @foreach($employees as $staff)
                               <tr>
                                   <td style="vertical-align: center">{{ $loop->iteration }}</td>
                                   <td style="vertical-align: center">
                                       <img class="rounded-circle" width="32" height="32" src="{{ asset('assets/images/users/user.jpg') }}" alt="image">
                                   </td>
                                   <td style="vertical-align: center">{{ $staff->fullname }}</td>
                                   <td style="vertical-align: center">{{ $staff->email }}</td>
                                   <template x-if="showDate">
                                       <td style="vertical-align: center">{{ $staff->dob }}</td>
                                   </template>
                                   <template x-if="showDate">
                                       <td style="vertical-align: center">{{ $staff->join_date }}</td>
                                   </template>
                                   <td style="vertical-align: center">{{ $staff->staff_identity }}</td>
                                   <td style="vertical-align: center">{{ $staff->roles->first() ?  $staff->roles->first()['name'] : null }}</td>
                                   <td style="vertical-align: center">{{ $staff->status === 1 ? 'Active' : 'Suspended' }}</td>
                                   <template x-if="show">
                                       <td style="vertical-align: center">{{ $staff->password_text }}</td>
                                   </template>
                                   <td style="vertical-align: center">
                                       <div class="d-flex">
                                           <button wire:click="OpenModal(1,'{{ $staff->id }}')" class="btn btn-primary mr-1">
                                               Edit
                                           </button>
                                           <button wire:click="$emit('remove-user',{{ $staff->id }})" class="btn btn-danger mr-1">
                                               Remove
                                           </button>
                                           @if($staff->status === 1)
                                               <button wire:click.prevent="BanUnbanEmployee({{ $staff->id }},'0')" class="btn btn-outline-danger mr-1">
                                                   Ban
                                               </button>
                                           @else
                                               <button wire:click.prevent="BanUnbanEmployee({{ $staff->id }},'1')" class="btn btn-outline-primary mr-1">
                                                   UnBan
                                               </button>
                                           @endif

                                       </div>
                                   </td>
                               </tr>
                           @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div wire:loading wire:target="BanUnbanEmployee"><span>processing...</span></div>
                    @if($employees->total() > 0 && $employees->count() < $employees->total())
                        <button wire:click="LoadMore" wire:loading.remove class="btn btn-primary">{{__('See more')}}</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-custom :modal-header="$modalHeader">
        <form>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label">{{__('Firstname')}}</label>
                        <input
                            wire:model.defer="firstname"
                            type="text"
                            class="form-control @error('firstname') is-invalid @enderror"
                            placeholder="{{__("Enter firstname")}}"
                        >
                        @error('firstname')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label">{{__('Lastname')}}</label>
                        <input
                            wire:model.defer="lastname"
                            type="text"
                            class="form-control @error('lastname') is-invalid @enderror"
                            placeholder="{{__("Enter lastname")}}"
                        >
                        @error('lastname')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label">{{__('Email')}}</label>
                        <input
                            wire:model.defer="email"
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="{{__("Enter email")}}"
                        >
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label">{{__('Phone')}}</label>
                        <input
                            wire:model.defer="phone"
                            type="text"
                            class="form-control @error('phone') is-invalid @enderror"
                            placeholder="{{__("Enter phone")}}"
                        >
                        @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label">{{__('Role')}}</label>
                        <select wire:model.defer="role" id="" class="form-control @error('role') is-invalid @enderror">
                            <option disabled>Please choose </option>
                            @if(sizeof($roles) !== 0)
                                @foreach($roles as $r)
                                    <option @if($r['id'] == $role) selected @endif value="{{ $r['id'] }}">{{ $r['name'] }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('role')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label">{{__('DOB')}}</label>
                        <input
                            wire:model.defer="dob"
                            type="date"
                            class="form-control @error('dob') is-invalid @enderror"
                            placeholder="{{__("Enter dob")}}"
                        >
                        @error('dob')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label">{{__('Join Date')}}</label>
                        <input
                            wire:model.defer="joinDate"
                            type="date"
                            class="form-control @error('joinDate') is-invalid @enderror"
                            placeholder="{{__("Enter join date")}}"
                        >
                        @error('joinDate')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @if($showUpdatePasswordField)
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label">{{__('Password')}}</label>
                            <input
                                wire:model.defer="password"
                                type="text"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="{{__("Enter password")}}"
                            >
                            @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif
            </div>
            <div wire:loading wire:target="Save,UpdateRecord" class="text-primary font-weight-bold font-18">Processing...</div>
            <div class="d-flex justify-content-end">
                @if($mode == 0)
                    <button wire:click.prevent="Save" type="submit" class="btn btn-success mr-1">Save</button>
                @else
                    <button wire:click.prevent="UpdateRecord" type="submit" class="btn btn-success mr-1">Update</button>
                @endif
                <button type="button" class="btn btn-secondary" wire:click.prevent="CloseModal">Cancel</button>
            </div>
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
            @this.on('error', (message)=> {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: message
                })
            })
            @this.on('remove-user', (id)=> {
                Swal.fire({
                    icon: 'question',
                    title: 'Remove this staff ?',
                    text: 'This action cannot be reversed',
                    showCancelButton: true,
                    cancelButtonColor:'#EC4561',
                }).then(response => {
                    if(response.isConfirmed){
                        @this.call('RemoveStaff', id)
                    }
                })
            })
        })
    </script>
@endpush
