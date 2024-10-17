<div>
    <x-slot name="title">
        User/Admin Login
    </x-slot>

    <div class="background">
        <div class="wrap d-md-flex">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mb-5"></div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-11 col-lg-9">
                        <!-- Success Modal -->
                        @if (session()->has('success'))
                        <div class="modal fade show d-block custom-modal" style="background-color: rgba(0,0,0,0.5);" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i class="fas fa-check-circle text-success"></i> Success
                                        </h5>
                                        <button type="button" class="close" aria-label="Close" wire:click="closeModal">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ session('success') }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Error Modal -->
                        @if (session()->has('error'))
                        <div class="modal fade show d-block custom-modal" style="background-color: rgba(0,0,0,0.5);" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i class="fas fa-exclamation-triangle text-danger"></i> Error
                                        </h5>
                                        <button type="button" class="close" aria-label="Close" wire:click="closeModal">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ session('error') }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- OTP Modal -->
                        @if ($isOtpSent)
                        <div class="modal fade show d-block custom-modal" style="background-color: rgba(0,0,0,0.5);" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Enter OTP</h5>
                                        <button type="button" class="close" aria-label="Close" wire:click="closeOtpModal">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form wire:submit.prevent="verifyOtp">
                                            <div class="form-group">
                                                <label for="userVerificationCode">Verification Code</label>
                                                <input type="text" id="userVerificationCode" class="form-control" wire:model="userInputOtp" autocomplete="off">
                                                @error('userInputOtp') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Verify</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4" style="color: rgb(79, 111, 255); font-weight: bold;">Login</h3>
                                </div>
                            </div>

                            <form wire:submit.prevent="login">
                                <div class="form-group">
                                    <label for="loginCredential">Email or Username</label>
                                    <input class="form-control py-4" wire:model="loginCredential" id="loginCredential" type="text" placeholder="Enter email or username" />
                                    @error('loginCredential') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input class="form-control py-4" wire:model="password" id="password" type="password" placeholder="Enter password" />
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">
                                        <span wire:loading.remove wire:target="login">Login</span>
                                        <span wire:loading wire:target="login">Logging in...</span>
                                    </button>
                                </div>
                                <div class="d-md-flex">
                                    <div class="w-50 text-right">
                                        <a href="{{ route('user.register') }}" class="admin-login-link">Sign Up</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .background {
            background-image: url('{{ asset('images/NEW.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-attachment: fixed;
        }

        .custom-modal {
            z-index: 1050;
        }
    </style>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Prevent autofill on OTP input
        const otpInput = document.getElementById('userVerificationCode');
        if (otpInput) {
            otpInput.setAttribute('autocomplete', 'off');
            otpInput.setAttribute('name', 'otp_code_' + Math.random().toString(36).substr(2, 10)); // Use a random name to avoid autofill
        }

        // Clear the OTP field on page load
        if (otpInput) {
            otpInput.value = '';
        }
    });
</script>
