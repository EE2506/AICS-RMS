<div class="container mt-5">
    <div class="row">
        <!-- Change Password Section -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title m-0 font-weight-bold text-primary">Change Password</h3>

                    @if (session()->has('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <form wire:submit.prevent="changePassword">
                        <div class="form-group">
                            <label for="currentPassword">Current Password</label>
                            <input type="password" wire:model.lazy="currentPassword" class="form-control" id="currentPassword" required>
                            @error('currentPassword') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" wire:model.lazy="newPassword" class="form-control" id="newPassword" required>
                            @error('newPassword') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="confirmNewPassword">Confirm New Password</label>
                            <input type="password" wire:model.lazy="confirmNewPassword" class="form-control" id="confirmNewPassword" required>
                            @error('confirmNewPassword') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
