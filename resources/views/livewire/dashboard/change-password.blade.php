<div wire:key="dashboard-change-password-{{ Str::random() }}">
    <h3>Update Your Password</h3>
    @if($showCurrentPasswordField)
        <div class="form-group">
            <label for="" class="form-label">Current Password</label>
            <input wire:model.defer="currentPassword" type="text"
                   class="form-control @error('currentPassword') is-invalid @enderror"
                   placeholder="current  password">
            @error('currentPassword')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <button wire:click.prevent="SendOTP" type="submit" class="btn btn-primary">Send Otp</button>
    @endif

    @if($showEmailOtpField)
        <div class="form-group">
            <label for="" class="form-label">Email OTP</label>
            <input wire:model.defer="emailOtp" type="text" class="form-control @error('emailOtp') is-invalid @enderror" placeholder="email otp">
            @error('emailOtp')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <button wire:click.prevent="SubmitOTP" type="submit" class="btn btn-primary">Submit</button>
    @endif

    @if($showNewPasswordField)
        <div class="form-group">
            <label for="" class="form-label">New Password</label>
            <input wire:model.defer="newPassword" type="text" class="form-control @error('newPassword') is-invalid @enderror" placeholder="new password">
            @error('newPassword')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="" class="form-label">Confirm Password</label>
            <input wire:model.defer="confirmPassword" type="text" class="form-control @error('confirmPassword') is-invalid @enderror"
                   placeholder="confirm password">
            @error('confirmPassword')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <button wire:click.prevent="updatePassword" type="submit" class="btn btn-primary">Update Password</button>
    @endif

</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            @this.on('otp-sent', event => {
                Swal.fire({
                    title: 'Success',
                    text: 'An OTP has been sent to your email account!',
                    icon: "success",
                })
                @this.showEmailOtpField = true;
                @this.showCurrentPasswordField = false;
                @this.showNewPasswordField = false;
            })
            @this.on('current-password-error', event => {
                Swal.fire({
                    title: 'Error',
                    text: 'Password is incorrect!',
                    icon: "error",
                })
            })
            @this.on('otp-is-valid', event=>{
                @this.showEmailOtpField = false;
                @this.showCurrentPasswordField = false;
                @this.showNewPasswordField = true;
            })
            @this.on('otp-is-invalid', event => {
                Swal.fire({
                    title: 'Error',
                    text: 'OTP is invalid!',
                    icon: "error",
                })
            })
            @this.on('password-change-success', event=>{
                Swal.fire({
                    title: 'Success',
                    text: 'Password change was successful!',
                    icon: "success",
                })
                @this.showEmailOtpField = false;
                @this.showCurrentPasswordField = true;
                @this.showNewPasswordField = false;
            })

            @this.on('password-change-error', event=>{
                Swal.fire({
                    title: 'Error',
                    text: 'Password change not successful!',
                    icon: "error",
                })
                @this.showEmailOtpField = false;
                @this.showCurrentPasswordField = false;
                @this.showNewPasswordField = true;
            })
        })
    </script>
@endpush
