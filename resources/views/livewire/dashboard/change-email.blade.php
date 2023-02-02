<div wire:key="change-email-{{ Str::random() }}" class="mt-3">
    <h4>Update Primary Email </h4>
    <div class="form-group">
        <label for="" class="form-label">Email</label>
        <input @if($disableEmailField) disabled @endif name="email" type="text" value="{{ auth()->user()->email }}"
               class="form-control @error('email') is-invalid @enderror">
        @error('email')
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    @if($commenceProcess)
        <button wire:click.prevent="$emit('commence-process')" type="submit" class="btn btn-primary">Get an OTP</button>
    @endif

     @if($showOTPField)
        <div class="form-group">
            <label for="" class="form-label">Enter OTP</label>
            <input wire:model.defer="otp" type="text" class="form-control @error('otp') is-invalid @enderror">
            @error('otp')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <button wire:click.prevent="SubmitOTP" type="submit" class="btn btn-primary">Submit</button>
     @endif

    @if($showChangeEmailField)
        <div class="form-group">
            <label for="" class="form-label">New Email</label>
            <input wire:model.defer="email"
                   type="text"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="new email"
            >
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="" class="form-label">Enter email again</label>
            <input wire:model.defer="confirmEmail"
                   type="text"
                   class="form-control @error('confirmEmail') is-invalid @enderror"
                   placeholder="confirm new email"
            >
            @error('confirmEmail')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <button wire:click.prevent="UpdateEmail" type="submit" class="btn btn-primary">Change</button>
    @endif

</div>

@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', function (){
            @this.on('commence-process', eventId => {
                Swal.fire({
                    title: 'Update Your Email?',
                    text: "An otp will be sent to your registered email!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, send otp!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('SendOtp')
                        @this.commenceProcess = false;
                        @this.showOTPField = true;
                        Swal.fire({
                            title:'OTP Sent',
                            text: 'An OTP has been sent to your email',
                            icon: 'success'
                        })
                    }
                })
            })
            @this.on('otp-is-valid', event=>{
                @this.showChangeEmailField = true;
                @this.showOTPField = false;
                @this.commenceProcess = false;
            })
            @this.on('otp-is-invalid', event => {
                Swal.fire({
                    title: 'Error',
                    text: 'OTP is invalid!',
                    icon: "error",
                })
            })
            @this.on('email-change-success', event=>{
                Swal.fire({
                    title: 'Success',
                    text: 'Email change was successful!',
                    icon: "success",
                })
                @this.showOTPField = false;
                @this.showChangeEmailField = false;
                @this.commenceProcess = true;
            })
            @this.on('email-change-error', event=>{
                Swal.fire({
                    title: 'Error',
                    text: 'Email change not successful!',
                    icon: "error",
                })
                @this.showOTPField = false;
                @this.showChangeEmailField = false;
                @this.commenceProcess = true;
            })
        })
    </script>
@endpush
