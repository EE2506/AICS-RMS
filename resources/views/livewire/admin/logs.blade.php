<div class="container-fluid">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h4 text-gray-700 font-weight-bold">Activity Logs</h1>
                <button class="btn btn-primary btn-sm" wire:click="exportLogs">
                    <i class="fas fa-download"></i> Download Report
                </button>
            </div>

            <!-- Filters and Search -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- Search Input -->
                <input type="text"
                       class="form-control form-control-sm mr-2"
                       placeholder="Search logs..."
                       wire:model.debounce.300ms="search">

                <!-- Start Date Input -->
                <div class="input-group input-group-sm mr-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Start Date</span>
                    </div>
                    <input type="date"
                           class="form-control"
                           wire:model="startDate">
                </div>

                <!-- End Date Input -->
                <div class="input-group input-group-sm mr-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">End Date</span>
                    </div>
                    <input type="date"
                           class="form-control"
                           wire:model="endDate">
                </div>
            </div>

            <!-- Logs Table -->
            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table mt-4 text-center table-bordered">
                        <thead class="table-header">
                            <tr>
                                <th>User Email</th>
                                <th>Activity Type</th>
                                <th>Description</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($logs as $log)
                                <tr>
                                    <td>{{ $log->user->email }}</td>
                                    <td>{{ ucfirst($log->activity_type) }}</td>
                                    <td>{{ $log->description }}</td>
                                    <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No activity logs available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- Center the pagination -->
                    <div class="pagination-container">
                        {{ $logs->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Styling for table header */
        .table-header {
            background-color: #0654a8;
            color: #fff;
            text-align: center;
        }

        /* Table styling */
        .table th, .table td {
            padding: 10px;
            vertical-align: middle;
            text-align: center;
        }

        .btn-sm {
            font-size: 14px;
            padding: 5px 10px;
            background-color: #0654a8;
            color: #fff;
            text-align: center;
        }

        .input-group-text {
            font-size: 14px;
            font-weight: bold;
        }

        .form-control-sm {
            font-size: 14px;
        }
          /* Center the pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }
    </style>
</div>
