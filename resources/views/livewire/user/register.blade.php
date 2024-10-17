<div>
    <div class="container"></div>
    <div class="Row justify-content-center">
        <div class="wrap d-md-flex">
            <div class="login-wrap p-4">
                <div class="d-flex">
                    <div class="w-100">
                        <h3 class="mb-4" style="color: rgb(79, 111, 255); font-weight: bold;">Sign Up</h3>
                    </div>
                </div>

                <!-- Session Flash Message -->
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form wire:submit.prevent='create' class="signin-form">
                    <div class="form-group mb-3">
                        <label for="inputFirstName">First name</label>
                        <input class="form-control" wire:model='fname' id="fname" name="fname" placeholder="Enter your First Name" required>
                        @error('fname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="inputLastName">Last name</label>
                        <input class="form-control" wire:model='lname' type="text" placeholder="Enter your Last Name" required />
                        @error('lname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="inputEmail">Email address</label>
                        <input class="form-control" wire:model='email' type="email" placeholder="name@example.com" required/>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <div class="form-floating mb-3 mb-md-0">
                            <label for="inputPassword">Password</label>
                            <input class="form-control" wire:model='password' type="password" placeholder="Create a password" required/>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="d-grid">
                            <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                        </div>
                    </div>
                </form>
                <p class="text-center">Already have an account? <a href="{{ route('user.login') }}">Go to login</a></p>
            </div>
        </div>

        <style>
            .Row {
                background-image: url('{{ asset('images/NEW.png') }}');
                background-size: justify center;
                background-repeat: no-repeat;
                height:100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                background-attachment: fixed;
                padding-bottom: 5%;
            }
        </style>
    </div>
  </div>
