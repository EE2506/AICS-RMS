<div class="container-fluid">
    <!-- Dashboard Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 font-weight-bold text-primary">Dashboard</h1>
        <button class="btn btn-primary btn-sm" id="downloadReport">
            <i class="fas fa-download"></i> Download Report
        </button>

    </div>


            <!-- Filters and Search -->
            <div class="d-flex justify-content-between align-items-center mb-3">
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

    <!-- Metrics Row -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body text-center">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Users</div>
                    <div class="h5 font-weight-bold text-gray-800">{{ $totalUser }}</div>
                </div>
            </div>
        </div>
        <!-- Add other metrics cards here -->
    </div>

    <!-- Charts Row -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <h5 class="font-weight-bold text-primary mb-4">User Count</h5>
                    <canvas id="userBarChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <h5 class="font-weight-bold text-primary mb-4">Activity Trend Over Time</h5>
                    <canvas id="activityTrendChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script src="{{ asset('admin_assets/js/chart.js') }}"></script>
    <script>
        // Activity Trend Over Time (Line Chart)
        document.addEventListener("DOMContentLoaded", function () {
            const activityCtx = document.getElementById('activityTrendChart').getContext('2d');
            new Chart(activityCtx, {
                type: 'line',
                data: {
                    labels: @json($activityDates), // Dates from backend
                    datasets: [{
                        label: 'Activities',
                        data: @json($activityCounts), // Counts from backend
                        backgroundColor: 'rgba(78, 115, 223, 0.05)',
                        borderColor: '#4e73df',
                        pointBackgroundColor: '#4e73df',
                        pointBorderColor: '#ffffff',
                        pointHoverBackgroundColor: '#ffffff',
                        pointHoverBorderColor: '#4e73df',
                        borderWidth: 2,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Activity Count'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.dataset.label}: ${context.raw}`;
                                }
                            }
                        }
                    }
                }
            });

            // User Count (Bar Chart)
            const userCtx = document.getElementById('userBarChart').getContext('2d');
            new Chart(userCtx, {
                type: 'bar',
                data: {
                    labels: ['Active Users', 'Inactive Users'],
                    datasets: [{
                        label: 'User Count',
                        data: [{{ $activeUser }}, {{ $inactiveUser }}],
                        backgroundColor: ['#1cc88a', '#e74a3b'],
                        borderColor: ['#17a673', '#d63031'],
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Count'
                            }
                        },
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    const value = context.raw;
                                    return `${context.dataset.label}: ${value}`;
                                }
                            }
                        }
                    }
                }
            });
        });

    </script>


    <script>
            document.addEventListener("DOMContentLoaded", function () {
        const downloadButton = document.getElementById("downloadReport");

        downloadButton.addEventListener("click", function () {
            // Set button text to "Generating..."
            downloadButton.textContent = "Generating...";

            // Capture the dashboard content
            const dashboardContent = document.querySelector(".container-fluid");

            // Use html2canvas to create the screenshot
            html2canvas(dashboardContent, {
                scale: 10, // Higher scale for clearer images
                useCORS: true, // Enable cross-origin resource sharing
                backgroundColor: "#ffffff", // Ensures white background
            })
                .then((canvas) => {
                    // Download the PNG file
                    const link = document.createElement("a");
                    link.download = "DashboardReport.png"; // File name
                    link.href = canvas.toDataURL("image/png", 1.0); // High-quality PNG
                    link.click();
                })
                .catch((error) => {
                    console.error("Error generating the report:", error);
                    alert("An error occurred while generating the report. Please try again.");
                })
                .finally(() => {
                    // Always reset the button text, even if an error occurs
                    downloadButton.textContent = "Download Report";
                });
        });
    });

</script>

<style>
    .input-group {
        margin-bottom: 1rem;
    }
    .input-group-text {
    font-size: 14px;
    font-weight: bold;
    }

    .card {
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card h5 {
        font-size: 16px;
        margin-bottom: 15px;
        color: #4e73df;
    }

    .card-body {
        padding: 20px;
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
    .chart-container {
    position: relative;
    margin: auto;
    height: 400px; /* Set specific height for exported charts */
    width: 100%;
    }
    .container-fluid {
    padding: 20px;
    }

</style>
</div>



