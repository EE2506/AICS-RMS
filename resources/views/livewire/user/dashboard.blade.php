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
                <div class="d-flex align-items-center mr-3">

                        <input
                            type="text"
                            id="dateFilter"
                            class="form-control mr-3"
                            wire:model="selectedDate"
                            placeholder="Select Date"
                        />
                    </div>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#dateFilter", {
            dateFormat: "Y-m-d", // Ensure the format matches your database
            onChange: function(selectedDates, dateStr, instance) {
                @this.set('selectedDate', dateStr);
            }
        });
    });
</script>
                <div class="d-flex align-items-center mr-3">
                    <!-- Date Filter Dropdown -->



                     <!-- Export Button -->
                     <div class="dropdown ml-lg-auto ml-3 toolbar-item">
                                           <!-- Include html2canvas for image capture -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<button onclick="captureGraph()">Export Graph as PDF</button>

<script>
function captureGraph() {
    html2canvas(document.getElementById('table1Piechart1')).then(function(canvas) {
        canvas.toBlob(function(blob) {
            let formData = new FormData();
            formData.append('image', blob, 'dashboard-graph.png');

            fetch('{{ route("user.dashboard.save-image") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.reportId) {
                    window.location.href = `{{ url('user/dashboard/download-pdf') }}/${data.reportId}`;
                } else {
                    throw new Error('No reportId received');
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert('An error occurred while processing your request. Please try again.');
            });
        }, 'image/png');
    }).catch(error => {
        console.error("Error capturing graph:", error);
        alert('Failed to capture the graph. Please try again.');
    });
}
</script>
                      </div>
                </div>
            </div>
            <style>
                .btn-dark-blue:hover {
                    background-color: #3676b6; /* Darker Blue for hover effect */
                    border-color: #3375b8;
                }
            </style>
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

                <!-- Client With Most Assistance Release Card -->
                <div class="col-xl-3 col-md-6 mb-4" style="height: 130px;">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 text-center">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Client With Most Assistance Release</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $table3ClientCategoryWithMostAssistanceReleased }}</div>
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
                }
            }
        }
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
                        <script>
                            // Data for the chart
                            const labels = ['Malasakit', 'Onsite', 'Offsite'];  // Labels for different modes

                            const data = {
                                labels: labels,
                                datasets: [
                                    {
                                        label: 'Female',
                                        backgroundColor: 'rgba(255, 99, 132, 0.5)',  // Light red for females
                                        borderColor: 'rgba(255, 99, 132, 1)',
                                        borderWidth: 1,
                                        data: [
                                            {{ $genderCountMalasakit['FEMALE'] ?? 0 }},
                                            {{ $genderCountOnsite['FEMALE'] ?? 0 }},
                                            {{ $genderCountOffsite['FEMALE'] ?? 0 }}
                                        ]
                                    },
                                    {
                                        label: 'Male',
                                        backgroundColor: 'rgba(54, 162, 235, 0.5)',  // Blue for males
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 1,
                                        data: [
                                            {{ $genderCountMalasakit['MALE'] ?? 0 }},
                                            {{ $genderCountOnsite['MALE'] ?? 0 }},
                                            {{ $genderCountOffsite['MALE'] ?? 0 }}
                                        ]
                                    }
                                ]
                            };

                            // Config for the chart
                            const config = {
                                type: 'bar',
                                data: data,
                                options: {
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
                                                    let dataset = tooltipItem.dataset;
                                                    let value = dataset.data[tooltipItem.dataIndex];
                                                    let amount;
                                                    if (tooltipItem.datasetIndex === 0) {  // Female dataset
                                                        if (tooltipItem.dataIndex === 0) {
                                                            amount = {{ $amountMalasakit['FEMALE'] ?? 0 }};
                                                        } else if (tooltipItem.dataIndex === 1) {
                                                            amount = {{ $amountOnsite['FEMALE'] ?? 0 }};
                                                        } else {
                                                            amount = {{ $amountOffsite['FEMALE'] ?? 0 }};
                                                        }
                                                    } else {  // Male dataset
                                                        if (tooltipItem.dataIndex === 0) {
                                                            amount = {{ $amountMalasakit['MALE'] ?? 0 }};
                                                        } else if (tooltipItem.dataIndex === 1) {
                                                            amount = {{ $amountOnsite['MALE'] ?? 0 }};
                                                        } else {
                                                            amount = {{ $amountOffsite['MALE'] ?? 0 }};
                                                        }
                                                    }
                                                    return dataset.label + ": " + value + ' (₱' + amount.toLocaleString() + ')';
                                                }
                                            }
                                        }
                                    }
                                }
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

                                const formattedData = data.map(amount => `₱${amount.toLocaleString()}`); // Format data as PHP

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
                                                        return `${dataset.label}: ${raw} (₱${raw.toLocaleString()})`; // Custom tooltip format
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
                            });
                        </script>



<!-- CHARTS AND GRAPHS SECTION -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- Table 1 Pie Charts -  'table1PieChart1' -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Data for Client Category Distribution
        let clientCategoryData = @json($clientCategoryData);
        let clientCategories = Object.keys(clientCategoryData);
        let assistanceAmounts = Object.values(clientCategoryData);

        // Pie Chart 1: Client Category Distribution
        var ctx1 = document.getElementById('table1Piechart1').getContext('2d');
        var table1Piechart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: clientCategories,
                datasets: [{
                    label: 'Client With Most Assistance Released',  // Label with no red box
                    data: assistanceAmounts,
                    backgroundColor: ['#DC143C', '#ffcc00', '#223D8D', '#E6F69D', '#ef8585e2', '#223D8D', '#2D87BB'],
                    borderColor: ['#e6e6e6'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,  // Allow the chart to resize properly
                plugins: {
                    legend: {
                        position: 'left',
                        labels: {
                            boxWidth: 0,  // Remove the red box
                            padding: 10,
                            font: { size: 12 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: context => `${context.label}: PHP ${context.raw.toLocaleString()}`
                        }
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
                            autoSkip: false,  // Ensure all labels are shown
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'PHP ' + value.toLocaleString();  // Format y-axis labels
                            }
                        }
                    }
                },
                onResize: function(chart, size) {
                    chart.options.plugins.legend.labels.font.size = size.width < 500 ? 10 : 12;  // Adjust font size based on screen width
                    chart.update();
                }
            }
        });

        // Handle screen resizing to prevent chart from "messing up"
        window.addEventListener('resize', function () {
            table1Piechart1.resize();  // Force chart to resize on window adjustments
        });

        // Data for Age Bracket Distribution
        let ageBracketData = @json($ageBracketData);

        let ageBracketLabels = {
            '0-13': '0-13',
            '14-17': '14-17',
            '18-29': '18-29',
            '30-44': '30-44',
            '45-59': '45-59',
            '60-70': '60-70',
            '71-79': '71-79',
            '80+': '80 and above'
        };

        let ageBrackets = Object.keys(ageBracketLabels).map(label => ageBracketLabels[label]);
        let clientCounts = Object.values(ageBracketData);

        // Pie Chart 2: Age Distribution Per Gender
        var ctx2 = document.getElementById('table1Piechart2').getContext('2d');
        var table1Piechart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ageBrackets,
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
                maintainAspectRatio: false,  // Allow the chart to resize properly
                plugins: {
                    legend: {
                        position: 'left',
                        labels: {
                            boxWidth: 0,  // Remove the red box
                            padding: 10,
                            font: { size: 12 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: context => `${context.label}: ${context.raw.toLocaleString()} clients`
                        }
                    }
                },
                onResize: function(chart, size) {
                    chart.options.plugins.legend.labels.font.size = size.width < 500 ? 10 : 12;  // Adjust font size based on screen width
                    chart.update();
                }
            }
        });

        // Handle screen resizing to prevent chart from "messing up"
        window.addEventListener('resize', function () {
            table1Piechart2.resize();  // Force chart to resize on window adjustments
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


<!-- Table 5 Pie Charts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fetch Mode of Admission Data (Pie Chart 1)
        let modeOfAdmissionData = @json($table5ModeOfAdmissionData);
        let modeLabels = Object.keys(modeOfAdmissionData);
        let modeValues = Object.values(modeOfAdmissionData);

        // Pie Chart 1: Mode of Admission
        var ctx8 = document.getElementById('table5PieChart1').getContext('2d');
        var table5PieChart1 = new Chart(ctx8, {
            type: 'doughnut',
            data: {
                labels: modeLabels,
                datasets: [{
                    label: 'Mode of Admission',
                    data: modeValues,
                    backgroundColor: ['#C40C0C','#1E2A5E'],
                    borderColor: ['#e6e6e6', '#e6e6e6'],
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

        // Fetch Gender Distribution Data (Pie Chart 2)
        let genderData = @json($table5GenderDistributionData);
        let genderLabels = Object.keys(genderData);
        let genderValues = Object.values(genderData);

        // Pie Chart 2: Distribution Per Gender
        var ctx9 = document.getElementById('table5PieChart2').getContext('2d');
        var table5PieChart2 = new Chart(ctx9, {
            type: 'doughnut',
            data: {
                labels: genderLabels,
                datasets: [{
                    label: 'Distribution Per Gender',
                    data: genderValues,
                    backgroundColor: ['#1E2A5E', '#C40C0C'],
                    borderColor: ['#e6e6e6', '#e6e6e6'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
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


<!-- Table 6 Piecharts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fetch Mode of Admission Data (Pie Chart 1)
        let modeOfAdmissionData = @json($table6ModeOfAdmissionData);
        let modeLabels = Object.keys(modeOfAdmissionData);
        let modeValues = Object.values(modeOfAdmissionData);

        // Pie Chart 1: Mode of Admission
        var ctx8 = document.getElementById('table6PieChart1').getContext('2d');
        var table6PieChart1 = new Chart(ctx8, {
            type: 'doughnut',
            data: {
                labels: modeLabels,
                datasets: [{
                    label: 'Mode of Admission',
                    data: modeValues,
                    backgroundColor: ['#C40C0C', '#FDA403', '#223D8D' ],
                    borderColor: ['#e6e6e6', '#e6e6e6', '#e6e6e6'],
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

        // Fetch Gender Distribution Data (Pie Chart 2)
        let genderData = @json($table6GenderDistributionData);
        let genderLabels = Object.keys(genderData);
        let genderValues = Object.values(genderData);

        // Pie Chart 2: Distribution Per Gender
        var ctx9 = document.getElementById('table6PieChart2').getContext('2d');
        var table6PieChart2 = new Chart(ctx9, {
            type: 'doughnut',
            data: {
                labels: genderLabels,
                datasets: [{
                    label: 'Distribution Per Gender',
                    data: genderValues,
                    backgroundColor: ['#AADEA7', '#223D8D'],
                    borderColor: ['#e6e6e6', '#e6e6e6'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
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
    });
</script>




    <script src="/path/to/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-treemap"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
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


    </style>
</div>
