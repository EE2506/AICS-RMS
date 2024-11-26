<div class="container-fluid">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <!-- Header Section for User Activity Logs -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h4 text-gray-700 font-weight-bold">User Activity Logs</h1>
            </div>

            <!-- Card Section for Table -->
            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table mt-4 text-center table-bordered">
                        <thead class="table-header">
                            <tr>
                                <th>Activity Type</th>
                                <th>Description</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($logs as $log)
                                <tr>
                                    <td>{{ $log->activity_type }}</td>
                                    <td>{{ $log->description }}</td>
                                    <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No activity logs available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Center the pagination -->

                </div>
            </div>
        </div>
    </div>

    <style>
        /* Center the pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

        /* Styling for table header */
        .table-header {
            background-color: #0654a8; /* Blue background */
            color: #fff; /* White text */
            text-align: center;
        }

        /* Table styling for alignment, spacing, and consistency */
        .table th, .table td {
            padding: 10px 20px; /* Adjusted padding */
            vertical-align: middle; /* Center-align vertically */
            text-align: center; /* Center-align text */
        }

        /* Card shadow and font color consistency */
        .card {
            border-radius: 10px;
        }

        /* Improved empty message */
        .text-muted {
            color: #6c757d; /* Consistent gray color */
        }
    </style>
</div>
