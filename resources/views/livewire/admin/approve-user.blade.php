<div>
    <x-slot name="title">Approve User</x-slot>
    <div class="container-fluid">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('removed'))
            <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
                {{ session('removed') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card my-2">
            <div class="card-body">
                <h3 class="m-0 font-weight-bold text-primary">Approved User ({{ $totalUser }})</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="background-color: #0654a8; color: #ffffff;">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Last Login</th>
                                <th>Approve</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users->sortBy('id') as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->fname . ' ' . $user->mname . ' ' . $user->lname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->custom_token == 1)
                                            <span class="text-success">Approved</span>
                                        @else
                                            <span class="text-danger">Not Approved</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->last_login ?? 'Never' }}</td>
                                    <td>
                                        @if ($user->custom_token == 1)
                                            <button disabled class="btn btn-secondary">Approved</button>
                                        @else
                                            <button wire:click='approve({{ $user->id }})' class="btn btn-primary">Approve</button>
                                        @endif
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input
                                                type="checkbox"
                                                wire:change="toggleStatus({{ $user->id }})"
                                                {{ $user->custom_token == 1 ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">User Not Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="pagination-container">
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Toggle switch */

    .btn-primary {
            font-size: 14px;
            padding: 5px 10px;
        background-color: #0654a8;
            color: #fff;
            text-align: center;
        }
        .btn-primary.btn-primary:hover{

        background-color: #3882d1;
            color: #fff;

        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
            font-size: 14px;
            padding: 5px 10px;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        /* Smooth transition */
        .btn {
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
    .switch {
        position: relative;
        display: inline-block;
        width: 45px; /* Reduced width */
        height: 24px; /* Reduced height */
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 24px; /* Adjusted for smaller size */
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px; /* Reduced height */
        width: 18px; /* Reduced width */
        left: 3px; /* Adjusted to fit the smaller switch */
        bottom: 3px; /* Adjusted to fit the smaller switch */
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #28a745; /* Green for "on" */
    }

    input:checked + .slider:before {
        transform: translateX(21px); /* Adjusted for the smaller size */
    }

    .slider.round {
        border-radius: 24px; /* Matches the smaller size */
    }

    .slider.round:before {
        border-radius: 50%;
    }

</style>

    <script>
        // Auto-close alert after a few seconds
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                let alert = document.querySelector('.alert');
                if (alert) {
                    alert.classList.remove('show');
                }
            }, 3000);
        });
    </script>
</div>
