<div>
    <x-slot name="title">
        User Dashboard
    </x-slot>

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 m-0 font-weight-bold text-primary">Dashboard</h1>
            <div class="d-flex align-items-center">

 <!-- Date Filter -->

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


                   <!-- EXPORT BUTTON-->
                        <div class="d-flex justify-content-between align-items-center mb-8">
                            <button class="btn-download" id="export-btn">
                                <span class="text">Download Report</span>
                                <i class="fas fa-download arrow-icon"></i>
                            </button>

                        <!-- Include necessary libraries -->
                            <script src="/path/to/Chart.min.js"></script>
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-treemap"></script>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>


                            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

                            <script>
                            document.getElementById('export-btn').addEventListener('click', function () {
                                const container = document.querySelector('.container-fluid');

                                // Use html2canvas to capture the entire dashboard
                                html2canvas(container, {
                                    scale: 3, // High resolution
                                    scrollY: -window.scrollY, // Handle scroll offsets
                                }).then(canvas => {
                                    // Convert the canvas to a data URL
                                    const imgData = canvas.toDataURL('image/png');

                                    // Create a new Excel workbook and worksheet
                                    const workbook = XLSX.utils.book_new();
                                    const worksheet = {};

                                    // Insert the image into the worksheet
                                    worksheet['!images'] = [
                                        {
                                            image: imgData,
                                            type: 'png',
                                            position: {
                                                type: 'twoCellAnchor',
                                                from: { col: 0, row: 0 }, // Position the image in the top-left corner
                                                to: { col: 20, row: 40 }, // Adjust size (rows/columns to occupy)
                                            }
                                        }
                                    ];

                                    // Add the worksheet to the workbook
                                    XLSX.utils.book_append_sheet(workbook, worksheet, 'Dashboard');

                                    // Save the Excel file
                                    XLSX.writeFile(workbook, 'dashboard_report.xlsx');
                                });
                            });
                            </script>
                      </div>
                </div>
            </div>
        </div>



    <!-- Bootstrap Carousel for Cards -->
<div id="cardCarousel" class="carousel slide" data-bs-interval="false">

    <!-- Carousel inner (cards container) -->
    <div class="carousel-inner">

        <!-- First slide with 4 cards -->
        <div class="carousel-item active">
            <div class="row justify-content-center mt-3">
                <!-- Total Documents Card -->
                <div class="col-xl-3 col-md-6 mb-4" style="height: 130px;">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 text-center">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Documents</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDocument }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Served Clients Card -->
                <div class="col-xl-3 col-md-6 mb-4" style="height: 130px;">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 text-center">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Served Clients</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalServedClients }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Amount of Assistance Card -->
                <div class="col-xl-3 col-md-6 mb-4" style="height: 130px;">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 text-center">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Amount of Assistance</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAmountAssistance }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Most Requested Assistance Card -->
                <div class="col-xl-3 col-md-6 mb-4" style="height: 130px;">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 text-center">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Most Requested Assistance</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mostRequestedAssistance }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second slide with 4 more cards -->
        <div class="carousel-item">
            <div class="row justify-content-center mt-3">
                <!-- Most Used Mode Admission Card -->
                <div class="col-xl-3 col-md-6 mb-4" style="height: 130px;">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 text-center">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Most Used Mode Admission</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $table5MostUsedAdmissionMode }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Most Served Through Card -->
                <div class="col-xl-3 col-md-6 mb-4" style="height: 130px;">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 text-center">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Most Served Through</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $table6MostUsedAdmissionMode }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Age Group With Most Assistance Release Card -->
                <div class="col-xl-3 col-md-6 mb-4" style="height: 130px;">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 text-center">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Age Group With Most Assistance Release</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $table4ageGroupWithMostAssistanceReleased }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </div>

    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev custom-carousel-control" type="button" data-bs-target="#cardCarousel" data-bs-slide="prev">
        <span class="custom-arrow"><i class="fas fa-chevron-left"></i></span>
    </button>
    <button class="carousel-control-next custom-carousel-control" type="button" data-bs-target="#cardCarousel" data-bs-slide="next">
        <span class="custom-arrow"><i class="fas fa-chevron-right"></i></span>
    </button>
</div>

<!-- Add Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>





<div class="container-fluid mt-3">
    <div class="row">
        <!-- Beneficiary Category Distribution (Chart 1) -->
        <div class="col-lg-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-header bg-light d-flex justify-content-between">
                    <h6 class="font-weight-bold text-dark">Client Category Distribution</h6>
                </div>
                <div id="beneficiaryChart" class="collapse show">
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height:500px; width:100%;">
                            <canvas id="table1Piechart1"></canvas>
                        </div>
                        <small class="text-muted">Hover to see details</small>
                    </div>
                </div>
            </div>
        </div>


    <!-- Type of Assistance | Service Count Released per Gender -->
    <div class="col-lg-8 col-md-20 mb-4">
        <div class="card shadow h-100">
            <div class="card-header bg-light d-flex justify-content-between">
                <h6 class="font-weight-bold text-dark">Type of Assistance | Service Count Released per Gender</h6>
            </div>
            <div id="assistanceTypes">
                <div class="card-body">
                    @foreach ($assistanceData as $type => $data)
                    <div class="mb-3">
                        <h6 class="font-weight-bold">{{ $type }}</h6>
                        <div class="progress mb-2" style="height: 20px;">
                            <div class="progress-bar bg-light-red text-dark" role="progressbar" style="width: {{ $data['FEMALE'] ? ($data['FEMALE']->total / $data['TOTAL']['total']) * 100 : 0 }}%;" aria-valuenow="{{ $data['FEMALE']->total ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
                                Female: {{ number_format($data['FEMALE']->total ?? 0) }}
                            </div>
                            <div class="progress-bar bg-blue text-dark" role="progressbar" style="width: {{ $data['MALE'] ? ($data['MALE']->total / $data['TOTAL']['total']) * 100 : 0 }}%;" aria-valuenow="{{ $data['MALE']->total ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
                                Male: {{ number_format($data['MALE']->total ?? 0) }}
                            </div>
                        </div>
                        <p class="text-muted">Total: {{ number_format($data['TOTAL']['total']) }} (₱{{ number_format($data['TOTAL']['total_amount'], 2) }})</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Combined Card for Age Group and Mode of Admission -->
    <div class="col-md-4 d-flex flex-column justify-content-between">
        <!-- Donut Chart 1 -->
        <div class="card shadow mb-2">
            <div class="card-header bg-light d-flex justify-content-between">
                <h6 class="font-weight-bold text-dark">Age Group Served with Cost</h6>
            </div>
            <div id="ageGenderChart">
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 300px; width: 100%;">
                        <canvas id="table1Piechart2"></canvas>
                    </div>
                    <small class="text-muted">Hover to see details</small>
                </div>
            </div>
        </div>

        <!-- Progress Bars: Mode of Admission Total Count and Released per Gender -->
        <div class="card shadow h-100">
            <div class="card-header bg-light d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Mode of Admission Total Count and Released per Gender</h6>
            </div>
            <div class="card-body">
                <div class="container">
                    <!-- Referral Progress Bars -->
                    <h6 class="font-weight-bold">Referral</h6>
                    <!-- Female Progress Bar -->
                    <div class="progress mb-2">
                        <div class="progress-bar text-dark font-weight-bold bg-light-red" role="progressbar"
                            style="width: {{ isset($genderCountReferral['FEMALE']) ? ($genderCountReferral['FEMALE'] / array_sum($genderCountReferral)) * 100 : 0 }}%;"
                            aria-valuenow="{{ $genderCountReferral['FEMALE'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
                            Female: {{ number_format($genderCountReferral['FEMALE'] ?? 0) }}
                            (₱{{ number_format($amountReferral['FEMALE'] ?? 0, 2) }})
                        </div>
                    </div>
                    <!-- Male Progress Bar -->
                    <div class="progress mb-4">
                        <div class="progress-bar text-dark font-weight-bold bg-blue" role="progressbar"
                            style="width: {{ isset($genderCountReferral['MALE']) ? ($genderCountReferral['MALE'] / array_sum($genderCountReferral)) * 100 : 0 }}%;"
                            aria-valuenow="{{ $genderCountReferral['MALE'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
                            Male: {{ number_format($genderCountReferral['MALE'] ?? 0) }}
                            (₱{{ number_format($amountReferral['MALE'] ?? 0, 2) }})
                        </div>
                    </div>

                    <!-- Walk-In Progress Bars -->
                    <h6 class="font-weight-bold">Walk-In</h6>
                    <!-- Female Progress Bar -->
                    <div class="progress mb-2">
                        <div class="progress-bar text-dark font-weight-bold bg-light-red" role="progressbar"
                            style="width: {{ isset($genderCountWalkIn['FEMALE']) ? ($genderCountWalkIn['FEMALE'] / array_sum($genderCountWalkIn)) * 100 : 0 }}%;"
                            aria-valuenow="{{ $genderCountWalkIn['FEMALE'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
                            Female: {{ number_format($genderCountWalkIn['FEMALE'] ?? 0) }}
                            (₱{{ number_format($amountWalkIn['FEMALE'] ?? 0, 2) }})
                        </div>
                    </div>
                    <!-- Male Progress Bar -->
                    <div class="progress mb-4">
                        <div class="progress-bar text-dark font-weight-bold bg-blue" role="progressbar"
                            style="width: {{ isset($genderCountWalkIn['MALE']) ? ($genderCountWalkIn['MALE'] / array_sum($genderCountWalkIn)) * 100 : 0 }}%;"
                            aria-valuenow="{{ $genderCountWalkIn['MALE'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
                            Male: {{ number_format($genderCountWalkIn['MALE'] ?? 0) }}
                            (₱{{ number_format($amountWalkIn['MALE'] ?? 0, 2) }})
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="row">
        <!-- Beneficiary Category Distribution (Chart 1) -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow h-100">
                <div class="card-header bg-light d-flex justify-content-between">

                <h6 class="m-0 font-weight-bold text-dark">Total Amount of Service Provided</h6>
            </div>
            <div class="card-body">
                <div class="chart-container" style="position: relative; height:600px; width:100%;">
                    <canvas id="clientCategoryBarChart"></canvas>
                </div>
                <small class="text-muted">Hover to see details</small>
            </div>
        </div>
    </div>

    <!-- Donut Charts: Mode of Admission and Mode of Admission Through -->
    <div class="col-lg-4 col-md-4 d-flex flex-column">
        <div class="row h-100">
            <!-- Donut Chart 1: Mode of Admission -->
            <div class="col-12 mb-2 d-flex align-items-stretch">
                <div class="card shadow h-100 w-100">
                    <div class="card-header bg-light d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark">Mode of Admission</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height: 200px; width: 100%;">
                            <canvas id="table5PieChart1"></canvas>
                        </div>
                        <small class="text-muted">Hover to see details</small>
                    </div>
                </div>
            </div>

            <!-- Donut Chart 2: Mode of Admission Through -->
            <div class="col-12 mb-4 d-flex align-items-stretch">
                <div class="card shadow h-100 w-100">
                    <div class="card-header bg-light d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark">Mode of Admission Through</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height: 200px; width: 100%;">
                            <canvas id="table6PieChart1"></canvas>
                        </div>
                        <small class="text-muted">Hover to see details</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let typeofServiceAssistance = @json($servedData);

    const labels = [
        'EDUCATIONAL', 'MEDICAL', 'TRANSPORTATION', 'FUNERAL', 'FOOD',
        'FINANCIAL', 'OTHERS', 'HYGIENE & SLEEPING KITS'
    ];

    let totalValues = labels.map(label => {
        return typeofServiceAssistance[label] ? parseFloat(typeofServiceAssistance[label]) : 0;
    });

    const ctx = document.getElementById('clientCategoryBarChart');
    const chartCtx = ctx.getContext('2d');

    // Darker gradient red background for bars
    const gradientRed = chartCtx.createLinearGradient(0, 0, 0, 400);
    gradientRed.addColorStop(0, 'rgba(200, 40, 50, 1)');   // Darker red
    gradientRed.addColorStop(1, 'rgba(255, 99, 132, 1)');   // Lighter red for a softer gradient

    new Chart(chartCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Total Amount Released (₱)',
                    data: totalValues,
                    backgroundColor: gradientRed,
                    borderColor: '#e6e6e6',
                    borderWidth: 1,
                    hoverBackgroundColor: 'rgba(255, 99, 132, 0.8)', // Darker on hover for emphasis
                    hoverBorderColor: '#ff5733'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    grid: {
                        display: false, // Hides gridlines on the X-axis for a cleaner look
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Amount Released (₱)',
                        color: '#333', // Darker title color
                        font: {
                            size: 14,
                            weight: 'bold',
                        }
                    },
                    ticks: {
                        callback: function(value) {
                            return '₱' + value.toLocaleString(); // Display peso sign on Y-axis
                        },
                        color: '#666', // Gray color for better readability
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        font: {
                            size: 12,
                        },
                        color: '#333' // Darker legend font
                    },
                    position: 'top'
                },
                tooltip: {
                    backgroundColor: 'rgba(200, 40, 50, 0.9)', // Darker background for tooltip
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderWidth: 1,
                    borderColor: '#ff5733',
                    callbacks: {
                        label: function (tooltipItem) {
                            let value = tooltipItem.raw || 0;
                            return `${tooltipItem.dataset.label}: ₱${value.toLocaleString()}`;
                        }
                    }
                },
                datalabels: {
                    anchor: 'end',  // Position the label at the top of the bar
                    align: 'end',  // Align the label at the top of the bar
                    color: '#0d0d0d',  // White text color for visibility
                    font: {
                        size: 14,
                        weight: 'bold'
                    },
                    formatter: function(value) {
                        return `₱${value.toLocaleString()}`;  // Display the value with a Peso sign
                    },
                    offset: 10,  // Adjust the label to be slightly above the bar
                }
            }
        },
        plugins: [ChartDataLabels]
    });
});
</script>



                    <!-- Pie Chart 1: Table 4 Type Distribution - Chart 7 -->
                    <div class="col-lg-14 col-md-20 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-header bg-light d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Total Amount Released Through</h6>
                            </div>
                            <div class="card-body">

                            <div class="col-md-15">
                                <div class="card shadow mb-4">
                                    <div class="card-header bg-light justify-content-between">
                                        <canvas id="groupedBarChart"></canvas>
                                            </div>
                                            <small class="text-muted">Hover to see details</small>
                                        </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
                        <script>
                            // Data for the chart
                            const labels = ['Malasakit', 'Onsite', 'Offsite']; // Labels for different modes

                            // Prepare dataset with counts and amounts
                            const data = {
                                labels: labels,
                                datasets: [
                                    {
                                        label: 'Female',
                                        backgroundColor: 'rgba(255, 99, 132, 0.5)', // Light red for females
                                        borderColor: 'rgba(255, 99, 132, 1)',
                                        borderWidth: 1,
                                        data: [
                                            { count: {{ $genderCountMalasakit['FEMALE'] ?? 0 }}, amount: {{ $amountMalasakit['FEMALE'] ?? 0 }} },
                                            { count: {{ $genderCountOnsite['FEMALE'] ?? 0 }}, amount: {{ $amountOnsite['FEMALE'] ?? 0 }} },
                                            { count: {{ $genderCountOffsite['FEMALE'] ?? 0 }}, amount: {{ $amountOffsite['FEMALE'] ?? 0 }} }
                                        ]
                                    },
                                    {
                                        label: 'Male',
                                        backgroundColor: 'rgba(54, 162, 235, 0.5)', // Blue for males
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 1,
                                        data: [
                                            { count: {{ $genderCountMalasakit['MALE'] ?? 0 }}, amount: {{ $amountMalasakit['MALE'] ?? 0 }} },
                                            { count: {{ $genderCountOnsite['MALE'] ?? 0 }}, amount: {{ $amountOnsite['MALE'] ?? 0 }} },
                                            { count: {{ $genderCountOffsite['MALE'] ?? 0 }}, amount: {{ $amountOffsite['MALE'] ?? 0 }} }
                                        ]
                                    }
                                ]
                            };

                            // Config for the chart
                            const config = {
                                type: 'bar',
                                data: {
                                    labels: data.labels,
                                    datasets: data.datasets.map(dataset => ({
                                        label: dataset.label,
                                        backgroundColor: dataset.backgroundColor,
                                        borderColor: dataset.borderColor,
                                        borderWidth: dataset.borderWidth,
                                        data: dataset.data.map(entry => entry.count) // Use count for the bar heights
                                    }))
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            title: {
                                                display: true,
                                                text: 'Number of Clients'
                                            }
                                        }
                                    },
                                    plugins: {
                                        title: {
                                            display: true,
                                            text: 'Mode of Admission Released Per Gender'
                                        },
                                        tooltip: {
                                            callbacks: {
                                                label: function(tooltipItem) {
                                                    const dataset = tooltipItem.dataset;
                                                    const entry = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.dataIndex];
                                                    return `${dataset.label}: ${entry.count} clients (₱${entry.amount.toLocaleString()})`;
                                                }
                                            }
                                        },
                                        datalabels: {
                                            anchor: 'end',  // Position the label at the top of the bar
                                            align: 'end',   // Align the label at the end of the bar
                                            color: '#000',  // Black text color for visibility
                                            font: {
                                                size: 12,
                                                weight: 'bold'
                                            },
                                            formatter: function(value, context) {
                                                const datasetIndex = context.datasetIndex;
                                                const dataIndex = context.dataIndex;
                                                const entry = data.datasets[datasetIndex].data[dataIndex];
                                                return `${entry.count} clients\n₱${entry.amount.toLocaleString()}`; // Show count and total amount
                                            },
                                            offset: -10 // Position the label slightly above the bar
                                        }
                                    }
                                },
                                plugins: [ChartDataLabels] // Include the datalabels plugin
                            };

                            // Render the chart
                            const groupedBarChart = new Chart(
                                document.getElementById('groupedBarChart'),
                                config
                            );
                        </script>



<div class="container-fluid mt-3">
    <div class="row">
        <!-- Beneficiary Category Distribution (Chart 1) -->
        <div class="col-lg-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-header bg-light d-flex justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-dark">Total Amount Released per District</h6>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-15">
                                <div class="card shadow mb-4">
                                    <div class="card-header bg-light justify-content-between">
                                            <div class="card-body">
                                                <canvas id="budgetChart"></canvas>
                                                <small class="text-muted">Hover to see details</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const ctx = document.getElementById('budgetChart').getContext('2d');
                                const budgetData = @json($budgetData);
                                const labels = Object.keys(budgetData);
                                const data = Object.values(budgetData);

                                // Create darker gradient
                                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                                gradient.addColorStop(0, 'rgba(30, 144, 255, 1)'); // Darker blue
                                gradient.addColorStop(1, 'rgba(0, 50, 100, 1)'); // Darker blue

                                const budgetChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Total Budget Amount Released per District',
                                            data: data,
                                            backgroundColor: gradient, // Use the darker gradient color
                                            borderColor: 'rgba(0, 102, 204, 1)', // Dark border color
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                title: {
                                                    display: true,
                                                    text: 'Amount (PHP)'
                                                }
                                            },
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: 'Districts'
                                                }
                                            }
                                        },
                                        plugins: {
                                            tooltip: {
                                                callbacks: {
                                                    label: function(tooltipItem) {
                                                        const { dataset, raw } = tooltipItem;
                                                        return `${dataset.label}: ₱${raw.toLocaleString()}`; // Custom tooltip format
                                                    }
                                                }
                                            },
                                            datalabels: {
                                                anchor: 'end',  // Position the label at the top of the bar
                                                align: 'end',   // Align the label at the end of the bar
                                                color: '#000',  // Black text color for visibility
                                                font: {
                                                    size: 12,
                                                    weight: 'bold'
                                                },
                                                formatter: function(value) {
                                                    return `₱${value.toLocaleString()}`;  // Format the label with Peso sign
                                                },
                                                offset: -5,  // Position the label slightly above the bar
                                            }
                                        }
                                    },
                                    plugins: [ChartDataLabels] // Include the datalabels plugin
                                });
                            });
                        </script>

<!-- Chart Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Data for Bar Chart
    let clientCategoryData = @json($clientCategoryData);
    let clientCategories = Object.keys(clientCategoryData); // Extract categories
    let assistanceAmounts = Object.values(clientCategoryData); // Extract amounts

    // Bar Chart: Client With Most Assistance Released
    var ctx1 = document.getElementById('table1Piechart1').getContext('2d');
    var table1Piechart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: clientCategories,
            datasets: [{
                label: 'Client With Most Assistance Released',
                data: assistanceAmounts,
                backgroundColor: ['#DC143C', '#ffcc00', '#223D8D', '#E6F69D', '#ef8585e2', '#223D8D', '#2D87BB'],
                borderColor: ['#e6e6e6'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'left',
                    labels: {
                        boxWidth: 0,
                        padding: 10,
                        font: { size: 12 }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: context => `${context.label}: PHP ${context.raw.toLocaleString()}`
                    }
                },
                datalabels: {
                    anchor: 'end',
                    align: 'end',
                    color: '#000',
                    font: {
                        size: 12,
                        weight: 'bold'
                    },
                    formatter: function(value) {
                        return `₱${value.toLocaleString()}`;  // Display the value with a Peso sign
                    }  // <-- Closing bracket added here
                }
            },
            layout: {
                padding: {
                    top: 10
                }
            },
            scales: {
                x: {
                    ticks: {
                        autoSkip: false,
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'PHP ' + value.toLocaleString();
                        }
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });

    // Data for Pie Chart
    let ageBracketData = @json($ageBracketData);
    let ageBracketLabels = ['0-13', '14-17', '18-29', '30-44', '45-59', '60-70', '71-79', '80+'];
    let clientCounts = Object.values(ageBracketData);

    // Pie Chart: Age Distribution Per Gender
    var ctx2 = document.getElementById('table1Piechart2').getContext('2d');
    var table1Piechart2 = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ageBracketLabels,
            datasets: [{
                label: 'Number of Clients',
                data: clientCounts,
                backgroundColor: ['#DC143C', '#1A5319', '#11235A', '#FDA403', '#ef8585e2', '#223D8D', '#2D87BB', '#AADEA7'],
                borderColor: ['#e6e6e6'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        boxWidth: 10,
                        padding: 20,
                        font: { size: 12 },
                        textAlign: 'left'
                    }
                },
                tooltip: {
                    callbacks: {
                        label: context => `${context.label}: ${context.raw.toLocaleString()} clients`
                    }
                },
                datalabels: {
                    color: '#fff',
                    font: {
                        size: 14,
                        weight: 'bold'
                    },
                    formatter: (value, context) => {
                        let label = context.chart.data.labels[context.dataIndex];
                        return `${value.toLocaleString()} clients`;  // Display only value
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 15
                }
            },
            layout: {
                padding: {
                    right: 30
                }
            }
        },
        plugins: [ChartDataLabels]
    });

    // Resize handling
    window.addEventListener('resize', function () {
        table1Piechart1.resize();
        table1Piechart2.resize();
    });
});
</script>




<script>
    document.addEventListener('DOMContentLoaded', function () {
                let categories = [];
                let femaleCounts = [];
                let maleCounts = [];

                // Process the data from the backend
                data.forEach(item => {
                    categories.push(item.category);  // Add category name
                    femaleCounts.push(item.female_count);  // Add female count
                    maleCounts.push(item.male_count);  // Add male count
                });

                // Bar Chart for Client Distribution by Sex
                var ctx3 = document.getElementById('clientCategoryBarChart').getContext('2d');
                var clientCategoryBarChart = new Chart(ctx3, {
                    type: 'bar',  // Bar chart for sex distribution
                    data: {
                        labels: categories,  // Client category labels
                        datasets: [
                            {
                                label: 'Female',
                                data: femaleCounts,  // Female data
                                backgroundColor: '#DC143C'  // Red color for females
                            },
                            {
                                label: 'Male',
                                data: maleCounts,  // Male data
                                backgroundColor: '#223D8D'  // Blue color for males
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top'  // Legend at the top
                            },
                            tooltip: {
                                callbacks: {
                                    label: context => `${context.dataset.label}: ${context.raw} clients`  // Show raw data in tooltip
                                }
                            }
                        },
                        scales: {
                            x: {
                                stacked: true  // Stack male and female data
                            },
                            y: {
                                beginAtZero: true,
                                stacked: true  // Stack the bars on y-axis
                            }
                        }
                    }
                });

    });
</script>

<script>
    let assistanceData = {
            labels: ['Medical', 'Burial', 'Food', 'Cash', 'Educational', 'Transportation', 'Hygiene & Sleeping Kits', 'Assistive Devices & Technologies', 'Psychosocial', 'Referral'],
            values: [356355, 135400, 201850, 456355, 435400, 1850, 6355, 5400, 1500, 800],
            colors: ['#DC143C', '#1A5319', '#11235A', '#FDA403', '#ef8585e2', '#223D8D', '#2D87BB', '#AADEA7', '#FF6384', '#36A2EB']
        };

        // Pie Chart 2: 'table4PieChart1'
        var ctxAssistance = document.getElementById('table4PieChart1').getContext('2d');
        var table4PieChart1 = new Chart(ctxAssistance, {
            type: 'doughnut',
            data: {
                labels: assistanceData.labels,
                datasets: [{
                    label: 'Assistance Data',
                    data: assistanceData.values,
                    backgroundColor: assistanceData.colors,
                    borderColor: ['#e6e6e6'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'left',
                        labels: {
                            boxWidth: 15,
                            padding: 10,
                            usePointStyle: true,
                            font: { size: 12 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                return `${label}: ${value.toLocaleString()}`;
                            }
                        }
                    }
                }
            }
        });

</script>



<script>
    document.addEventListener('livewire:load', function () {
        let typeofAssistanceData = @json($typeofAssistanceData);

        let labels = typeofAssistanceData.map(item => item.type_of_assistance1);
        let values = typeofAssistanceData.map(item => item.total_amount);
        let colors = ['#DC143C', '#1A5319', '#11235A', '#FDA403', '#ef8585e2', '#223D8D', '#2D87BB', '#AADEA7', '#FF6384', '#36A2EB'];

        var ctxAssistance = document.getElementById('assistanceBarChart').getContext('2d');
        var assistanceBarChart = new Chart(ctxAssistance, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Amount Released (PHP)',
                    data: values,
                    backgroundColor: colors.slice(0, labels.length),
                    borderColor: ['#e6e6e6'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'left',
                        labels: {
                            boxWidth: 15,
                            padding: 10,
                            usePointStyle: true,
                            font: { size: 12 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                return `${label}: PHP ${value.toLocaleString()}`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Adjusted configuration for table5PieChart1
        let modeOfAdmissionData5 = @json($table5ModeOfAdmissionData);
        let modeLabels5 = Object.keys(modeOfAdmissionData5);
        let modeValues5 = Object.values(modeOfAdmissionData5);

        document.getElementById('table5PieChart1').style.width = '450px';
        document.getElementById('table5PieChart1').style.height = '450px';

        var ctx5 = document.getElementById('table5PieChart1').getContext('2d');
        var table5PieChart1 = new Chart(ctx5, {
            type: 'doughnut',
            data: {
                labels: modeLabels5,
                datasets: [{
                    label: 'Mode of Admission',
                    data: modeValues5,
                    backgroundColor: ['#C40C0C', '#1E2A5E'],
                    borderColor: ['#e6e6e6', '#e6e6e6'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: 20
                },
                plugins: {
                    legend: {
                        position: 'left',
                        labels: {
                            boxWidth: 15,
                            padding: 10,
                            usePointStyle: true,
                            font: { size: 12 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                return `${label}: ${value.toLocaleString()}`;
                            }
                        }
                    },
                    datalabels: {
                        anchor: 'end', // Move labels outside
                        align: 'end',
                        formatter: (value, context) => {
                            return `${context.chart.data.labels[context.dataIndex]}: ${value}`;
                        },
                        font: {
                            size: 10,
                            weight: 'bold'
                        },
                        color: '#000',
                        padding: 8 // Add space between labels and slices
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Adjusted configuration for table6PieChart1
        let modeOfAdmissionData6 = @json($table6ModeOfAdmissionData);
        let modeLabels6 = Object.keys(modeOfAdmissionData6);
        let modeValues6 = Object.values(modeOfAdmissionData6);

        // Set canvas size (larger size to accommodate labels)
        document.getElementById('table6PieChart1').style.width = '500px';
        document.getElementById('table6PieChart1').style.height = '500px';

        var ctx6 = document.getElementById('table6PieChart1').getContext('2d');
        var table6PieChart1 = new Chart(ctx6, {
            type: 'doughnut',
            data: {
                labels: modeLabels6.map(label => label.toUpperCase()), // Convert labels to uppercase
                datasets: [
                    {
                        label: 'Mode of Admission',
                        data: modeValues6,
                        backgroundColor: ['#C40C0C', '#FDA403', '#223D8D'],
                        borderColor: ['#e6e6e6', '#e6e6e6', '#e6e6e6'],
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: 30, // Add extra padding for data labels
                },
                plugins: {
                    legend: {
                        position: 'left',
                        labels: {
                            boxWidth: 15,
                            padding: 10,
                            usePointStyle: true,
                            font: { size: 12 },
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                return `${label.toUpperCase()}: ${value.toLocaleString()}`; // Tooltip in uppercase
                            },
                        },
                    },
                    datalabels: {
                        anchor: 'end', // Place labels outside the slices
                        align: 'end', // Align labels to end
                        formatter: (value, context) => {
                            return `${context.chart.data.labels[context.dataIndex].toUpperCase()}: ${value}`;
                        },
                        font: {
                            size: 12,
                            weight: 'bold',
                        },
                        color: '#000',
                        padding: 10, // Adjust padding to prevent overlapping
                        clip: false, // Ensure labels are not clipped
                    },
                },
            },
            plugins: [ChartDataLabels],
        });
    });
</script>



    <style>
        .progress-bar-custom {
            height: 30px;
            border-radius: 5px;
        }
        .progress-container {
            margin-bottom: 20px;
        }
        .bg-sky-blue {
            background-color: #e4eff3;
        }
        .container {
            width: 100%;
            margin: 20px auto;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border-radius: 10px;
        }
        .card-header {
            background-color: #c6e2e2;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-body {
            padding: 20px;
        }
        .summary-box {
            text-align: center;
            margin-bottom: 20px;
        }
        .summary-box p {
            font-size: 1.2em;
            color: #555;
        }
        .summary-box h3 {
            font-size: 2em;
            color: #333;
        }
        canvas {
            background-color: #f4f4f4;
            border-radius: 10px;
        }
          .container {
            width: 80%;
            margin: 50px auto;
        }
        .chart-card {
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }

        .chart-card canvas {
            width: 100% !important;
            height: 400px !important;
        }
        .progress-bar.bg-light-red {
         background-color: #ef8585e2; /* Light red color */
       }
         .progress-bar.bg-light-blue {
        background-color: #223D8De6; /* Light blue color */
         }
         .custom-arrow i {
        color: blue; /* Set arrow color to blue */
        font-size: 2rem; /* Adjust size of the arrows */
        }

        /* Position the arrows */
        .carousel-control-prev {
            left: -120px; /* Adjust the left arrow position */
        }

        .carousel-control-next {
            right: -120px; /* Adjust the right arrow position */
        }

        /* Remove the box and background of the buttons */
        .custom-carousel-control {
            background: none;
            border: none;
        }

        /* Optional: Hover effect to highlight the arrow */
        .custom-carousel-control:hover .custom-arrow i {
            color: darkblue; /* Darker shade when hovered */

        }
        .input-group-text {
            font-size: 14px;
            font-weight: bold;
        }

        .form-control-sm {
            font-size: 14px;
        }
        .btn-download {
            display: flex;
            flex-direction: row; /* Arrange items in a row */
            align-items: center; /* Center items vertically */
            justify-content: center; /* Align items horizontally */
            padding: 2px 20px;
            font-size: 14px;
            border: none;
            border-radius: 20px; /* Rounded sides */
            background-color: #0654a8;
            color: #fff;
            text-align: center;
            white-space: nowrap; /* Prevent text wrapping */
            width: auto; /* Allow flexible width */
            height: 60px; /* Maintain consistent height */
            position: relative;
            cursor: pointer;
        }

        .btn-download .text {
            margin-right: 10px; /* Add spacing between the text and arrow */
            font-weight: bold;
        }

        .btn-download .arrow-icon {
            font-size: 16px; /* Adjust icon size */
        }
        @media print {
        /* Hide unnecessary elements during print/export */
        .btn-download, #export-btn {
            display: none;
        }

        /* Adjust chart size for better export */
        canvas {
            width: 100% !important;
            height: auto !important;
        }
    }
    .filter-section, .export-button, .dashboard-title {
    display: none !important;
    }

        .btn-download:hover {
            background-color: #054a8c; /* Slightly darker blue on hover */
            transform: scale(1.05); /* Slightly enlarges the button on hover */
        }


        </style>
    </div>

