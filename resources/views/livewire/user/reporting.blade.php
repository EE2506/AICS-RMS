<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporting Table</title>
    <style>
        /* General Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px; /* Smaller font size */
            text-align: center;
        }

        .card-body {
            padding: 15px; /* Less padding */
        }

        h1 {
            margin-bottom: 10px;
            margin-top: 50px;
            font-size: 24px;
        }

        h2 {
            margin-top: 0;
            font-size: 18px; /* Slightly smaller header */
            color: #333;
        }

        /* Tabs */
        .tabs {
            display: flex;
            gap: 5px;
            padding-right: 1px;
            margin-bottom: 6px;
            margin-top: 30px;
            margin-left: 20px;
        }

        .tab {
            padding: 8px; /* Adjusted padding */
            background-color: #024ba3; /* Primary tab background color */
            color: white; /* Text color */
            border: 1px solid #3f546d; /* Border color */
            cursor: pointer; /* Pointer cursor for tabs */
            border-radius: 5px; /* Rounded corners */
            font-size: 14px; /* Font size */
            margin-right: 5px; /* Space between tabs */
            transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition on hover */
        }

        /* Active Tab State */
        .tab.active {
            background-color: #0261db; /* Slightly lighter background for active tab */
            color: white;
            font-weight: bold; /* Emphasize active tab */
        }

        /* Hover Effect */
        .tab:hover {
            background-color: #0261db; /* Lighter background on hover */
            color: #ffffff; /* Ensure text remains white */
        }

        /* Tab Container for alignment */
        .tab-container {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 5px; /* Space between tabs */
            padding-bottom: 10px; /* Space below tabs */
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Table Container */
        .table-container {
            padding: 10px; /* Reduced padding */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 6px; /* Smaller padding */
            font-size: 12px; /* Smaller font size */
        }

        th {
            background-color: #024ba3;
            color: white;
            font-weight: bold;
            padding: 8px; /* Reduced padding for headers */
            font-size: 14px;
        }

        .highlight {
            background-color: #e0f7da;
        }

        .total-row {
            font-weight: bold;
            background-color: #cbdafd;
            color: #10100d;
            border-top: 2px solid hsl(218, 83%, 69%);
            border-bottom: 2px solid hsl(218, 83%, 69%);
            font-size: 14px;
        }

        .container {
            display: flex;
            align-items: right;
            justify-content: right; /* Align items to the right */
            gap: 5px; /* Space between elements */
            margin-bottom: 20px; /* Adjust as needed */
            margin-right: 80px;
        }

        .filter-container,
        .date-filter-container {
            margin-bottom: 1px;
            margin-top: 10px;
            margin-right: 0;
            margin-left: -1px;
            padding: 10px;
            padding-bottom: 2px;
            font-size: 12px;
            width: 250px; /* Ensure uniform width */
        }

        .date-filter-container input,
        .filter-container select,
        .export-button-container .btn {
            padding: 10px;
            font-size: 12px; /* Adjusted font size */
            width: 100%; /* Full width within the container */
            box-sizing: border-box; /* Include padding and border in width */
        }

        .filter-container select {
            padding: 8px; /* Reduced padding */
            font-size: 12px; /* Adjusted font size */
        }

        .export-button-container .btn {
            padding: 5px;
            font-size: 12px; /* Adjusted font size */
            margin
        }
    </style>

</head>
<body>
    <div>
        <h1>Reporting Table</h1>


        <div class="tabs">
            <button class="tab active" onclick="showTab('table1')">Table 1</button>
            <button class="tab" onclick="showTab('table2')">Table 2</button>
            <button class="tab" onclick="showTab('table3')">Table 3</button>
            <button class="tab" onclick="showTab('table4')">Table 4</button>
            <button class="tab" onclick="showTab('table5')">Table 5</button>
            <button class="tab" onclick="showTab('table6')">Table 6</button>
            <button class="tab" onclick="showTab('table7')">Table 7</button>
            <button class="tab" onclick="showTab('table8')">Table 8</button>
        </div>


        <div class="container">


    <!-- Filter Dropdown -->
            <div class="filter-container">
                <select id="filter" class="form-control" wire:model="selectedFilter">
                    <option value="today">Today</option>
                    <option value="month">Month</option>
                    <option value="semester">Semester</option>
                    <option value="year">Annual</option>
                </select>
            </div>

            <!-- Date Filter -->
            <div class="date-filter-container">
                <input
                    type="text"
                    id="dateFilter"
                    class="form-control"
                    wire:model="selectedDate"
                    placeholder="Select Date"
                />
            </div><!-- Date Filter -->

            <!-- Export Button -->
            <div class="export-button-container dropdown">
                {{-- <button wire:click="export" class="btn btn-primary">Export Data</button> --}}
                <button wire:click="calculateTotalsGenderCounterTable1" class="btn btn-primary">Click Me</button>
            </div>
            <!-- Export Button -- End -->

        </div>

        <!-- Include Flatpickr for Date Picker -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script>
        </script>


        <div class="table-container">
            <!-- Table 1 -->
            <div id="table1" class="tab-content active">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2>Table 1: Summary of beneficiaries served with cost, beneficiary category, and age group.</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Gender</th>
                                    <th>Age Group</th>
                                    <th>Total Amount</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($totals as $category => $genders)
                                    @foreach ($genders as $gender => $ageGroups)
                                        @foreach ($ageGroups as $ageGroup => $total)
                                            <tr>
                                                <td>{{ $category }}</td>
                                                <td>{{ $gender }}</td>
                                                <td>{{ $ageGroup }}</td>
                                                <td>{{ $total }}</td>
                                                <td>{{ $counts[$category][$gender][$ageGroup] }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- Table 1 -->




 <!-- Table 2 -->
            <div id="table2" class="tab-content">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2>Table 2: Assistance provided with cost.</h2>
                        <table>
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2">Service Count</th>
                                        <th colspan="4">Current Fund</th>
                                        <th colspan="4">Continuing</th>
                                        <th colspan="4">TOTAL</th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <th>Cost</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <th>Cost</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <th>Cost</th>
                                    </tr>
                                </thead>
                                <tbody>

                                                <tr class="text-center">
                                                    <td rowspan="3">Educational Assistance</td>

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                                </tr>
                                                <tr class="text-center">

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                                </tr>
                                                <tr class="text-center">

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                                </tr>
                                                <tr class="text-center">
                                                    <td rowspan="3">Transportation Assistance</td>

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                                </tr>
                                                <tr class="text-center">

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                                </tr>
                                                <tr class="text-center">

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                                </tr>
                                                <tr class="text-center">
                                                    <td rowspan="3">Burial Assistance</td>

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                                </tr>
                                                <tr class="text-center">

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                                </tr>
                                                <tr class="text-center">

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                                    <td></td><td></td><td></td><td></td> <!--Total-->

                                                </tr><tr class="text-center">
                                                    <td rowspan="3">Food Assistance</td>

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                                </tr>
                                                <tr class="text-center">
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                                </tr>
                                                <tr class="text-center">

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                                </tr>
                                            </tr><tr class="text-center">
                                                <td rowspan="3">Other Cash Assistance</td>

                                                <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                <td></td><td></td><td></td><td></td><!--Continuing -->
                                                <td></td><td></td><td></td><td></td> <!--Total-->
                                            </tr>
                                            <tr class="text-center">

                                                <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                <td></td><td></td><td></td><td></td><!--Continuing -->
                                                <td></td><td></td><td></td><td></td> <!--Total-->
                                            </tr>
                                            <tr class="text-center">

                                                <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                <td></td><td></td><td></td><td></td><!--Continuing -->
                                                <td></td><td></td><td></td><td></td> <!--Total-->
                                            </tr>
                                        </tr><tr class="text-center">
                                            <td rowspan="3">Hot Meals</td>

                                            <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                        </tr>
                                        <tr class="text-center">

                                            <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                        </tr>
                                        <tr class="text-center">

                                            <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                            <td></td><td></td><td></td><td></td><!--Continuing -->
                                            <td></td><td></td><td></td><td></td> <!--Total-->
                                        </tr>
                                    </tr><tr class="text-center">
                                        <td rowspan="3">Family Food Packs</td>

                                        <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                        <td></td><td></td><td></td><td></td><!--Continuing -->
                                        <td></td><td></td><td></td><td></td> <!--Total-->
                                    </tr>
                                    <tr class="text-center">

                                        <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                    </tr>
                                    <tr class="text-center">

                                        <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                    </tr>
                                </tr><tr class="text-center">
                                    <td rowspan="3">Hygiene And Sleeping Kits</td>

                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                </tr>
                                <tr class="text-center">

                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                </tr>
                                <tr class="text-center">

                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                </tr>
                            </tr><tr class="text-center">
                                <td rowspan="3">Assistive Devices And Technologies</td>

                                <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                <td></td><td></td><td></td><td></td><!--Continuing -->
                                <td></td><td></td><td></td><td></td> <!--Total-->
                            </tr>
                            <tr class="text-center">

                                <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                <td></td><td></td><td></td><td></td><!--Continuing -->
                                <td></td><td></td><td></td><td></td> <!--Total-->
                            </tr>
                            <tr class="text-center">

                                <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                    <td></td><td></td><td></td><td></td> <!--Total-->
                            </tr>
                        </tr><tr class="text-center">
                            <td rowspan="3">Psychosocial</td>

                            <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                            <td></td><td></td><td></td><td></td><!--Continuing -->
                            <td></td><td></td><td></td><td></td> <!--Total-->
                        </tr>
                        <tr class="text-center">

                            <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                            <td></td><td></td><td></td><td></td><!--Continuing -->
                            <td></td><td></td><td></td><td></td> <!--Total-->
                        </tr>
                                    <tr class="text-center">

                                        <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                        <td></td><td></td><td></td><td></td><!--Continuing -->
                                        <td></td><td></td><td></td><td></td> <!--Total-->
                                    </tr>
                                </tr><tr class="text-center">
                                    <td rowspan="3">Referral</td>

                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                </tr>
                                <tr class="text-center">

                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                </tr>
                                <tr class="text-center">

                                    <td><!--Male--></td><td><!--Female--></td><td><!--Total--></td><td><!--Cost--></td> <!--Current Fund -->
                                    <td></td><td></td><td></td><td></td><!--Continuing -->
                                    <td></td><td></td><td></td><td></td> <!--Total-->
                                </tr>
                                            <tr class="total-row">
                                        <td colspan="1" class="total-row text-left">GRAND TOTAL</td>
                                        <td class="total-row text-center"><!--Male--></td><td class="total-row text-center"><!--Female--></td><td class="total-row text-center"><!--Total--></td><td class="total-row text-center"><!--Cost--></td>
                                        <td class="total-row text-center"><!--Male--></td><td class="total-row text-center"><!--Female--></td><td class="total-row text-center"><!--Total--></td><td class="total-row text-center"><!--Continuing --></td>
                                        <td class="total-row text-center"><!--Male--></td><td class="total-row text-center"><!--Female--></td><td class="total-row text-center"><!--Total--></td><td class="total-row text-center"><!--Total --></td>
                                    </tr>
                                </tbody>
                            </table>
                        </table>
                    </div>
                </div>
            </div>



  <!-- Table 3 -->
            <div id="table3" class="tab-content">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2>Table 3: Beneficiaries served per client category</h2>
                        <table>
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2">Client Category</th>
                                        <th colspan="3">Current Fund</th>
                                        <th colspan="3">Continuing</th>
                                        <th colspan="3">TOTAL</th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="text-center">
                                        <td rowspan="3">Family Head and Other Needy Adult (FHONA)</td>

                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td></td><td></td><td></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    </tr>
                                    <tr class="text-center">

                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td></td><td></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td></td><td></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td rowspan="3">Women in Especially Difficult Circumstances (WEDC)</td>
                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td></td><td></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    </tr>
                                    <tr class="text-center">

                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td></td><td></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    </tr>
                                    <tr class="text-center">

                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td></td><td></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td rowspan="3">Children in Need of Special Protection (CNSP)</td>
                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td></td><td></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td></td><td></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    </tr>
                                    <tr class="text-center">

                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td></td><td></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td rowspan="3">Youth in Need of Special Protection (YNSP)</td>

                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td></td><td></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    </tr>
                                    <tr class="text-center">

                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td></td><td></td><td></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    </tr>
                                    <tr class="text-center">

                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td></td><td></td><td></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    </tr>

                                   <tr class="text-center">
                                   <td rowspan="3">Senior Citizen (SC)</td>
                                   <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                   <td></td><td></td><td></td>
                                   <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                </tr>
                                     <tr class="text-center">

                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td></td><td></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                        </tr>
                                                <tr class="text-center">
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td></td><td></td><td></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                </tr>
                                            <tr class="text-center">
                                                <td rowspan="3">Persons With Disability (PWD)</td>
                                                <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                <td></td><td></td><td></td>
                                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            </tr>
                                            <tr class="text-center">

                                                <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td></td><td></td><td></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            </tr>
                                            <tr class="text-center">

                                                <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                <td></td><td></td><td></td>
                                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            </tr>
                                        <tr class="text-center">
                                            <td rowspan="3">Persons Living with HIV-AIDS (PLHIV)</td>

                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td></td><td></td><td></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>

                                        <tr class="text-center">

                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td></td><td></td><td></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                        </tr>
                                        <tr class="text-center">

                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td></td><td></td><td></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                        </tr>

                                  <tr class="total-row">
                                        <td colspan="1" class="total-row text-left">GRAND TOTAL</td>
                                        <td class="total-row text-center"><!--Male--></td><td class="total-row text-center"><!--Female--></td><td class="total-row text-center"><!--Total--></td>
                                        <td class="total-row text-center"><!--Male--></td><td class="total-row text-center"><!--Female--></td><td class="total-row text-center"><!--Total--></td>
                                        <td class="total-row text-center"><!--Male--></td><td class="total-row text-center"><!--Female--></td><td class="total-row text-center"><!--Total--></td>
                                    </tr>
                                </tbody>
                            </table>
                        </table>

                        </div>
                    </div>
                </div>

 <!-- Table 4 -->
            <!-- Add tables 4, 5, 6, 7, and 8 following the same pattern as above -->
            <div id="table4" class="tab-content">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2>Table 4: Beneficiaries Served per Age Group</h2>
                        <table>
                            <table class="table table-striped table-responsive">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="3">Type of Assistance</th>
                                        <th colspan="3">0 to 13</th>
                                        <th colspan="3">14 to 17</th>
                                        <th colspan="3">18 to 29</th>
                                        <th colspan="3">30 to 44</th>
                                        <th colspan="3">45 to 59</th>
                                        <th colspan="3">60 to 70</th>
                                        <th colspan="3">71 to 79</th>
                                        <th colspan="3">80 and above</th>
                                        <th rowspan="2">Grand Total</th>

                                    </tr>
                                    <tr class="text-center">
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                            <th>Male</th>
                                            <th>Female</th>
                                            <th>Total</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                            <th>Male</th>
                                            <th>Female</th>
                                            <th>Total</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                            <th>Male</th>
                                            <th>Female</th>
                                            <th>Total</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                            <th>Male</th>
                                            <th>Female</th>
                                            <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                                <tr class="text-center">
                                                    <td rowspan="3">Educational Assistance</td>

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td>


                                                </tr>
                                                <tr class="text-center">
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td rowspan="3">Transportation Assistance</td>

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td>
                                                </tr>
                                                <tr class="text-center">

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td>
                                                </tr>
                                                <tr class="text-center">

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td rowspan="3">Burial Assistance</td>

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td>
                                                </tr>
                                                <tr class="text-center">

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td>
                                                </tr>
                                                <tr class="text-center">

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td>

                                                </tr><tr class="text-center">
                                                    <td rowspan="3">Food Assistance</td>

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td>
                                                </tr>
                                                <tr class="text-center">

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td>
                                                </tr>
                                                <tr class="text-center">

                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td>
                                                </tr>
                                            </tr><tr class="text-center">
                                                <td rowspan="3">Other Cash Assistance</td>

                                                <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td>
                                            </tr>
                                            <tr class="text-center">

                                                <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td>
                                            </tr>
                                            <tr class="text-center">

                                                <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td>
                                            </tr>
                                        </tr><tr class="text-center">
                                            <td rowspan="3">Hot Meals</td>

                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            <td><!--male--></td>
                                        </tr>
                                        <tr class="text-center">

                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            <td><!--male--></td>
                                        </tr>
                                        <tr class="text-center">

                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            <td><!--male--></td>
                                        </tr>
                                    </tr><tr class="text-center">
                                        <td rowspan="3">Family Food Packs</td>

                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                        <td><!--male--></td>
                                    </tr>
                                    <tr class="text-center">

                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td>
                                    </tr>
                                    <tr class="text-center">

                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                        <td><!--male--></td>
                                    </tr>
                                </tr><tr class="text-center">
                                            <td rowspan="3">Hygiene And Sleeping Kits</td>
                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                                    <td><!--male--></td>
                                        </tr>
                                <tr class="text-center">

                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--male--></td>
                                </tr>

                                <tr class="text-center">
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--male--></td>
                                </tr>


                                <tr class="text-center">
                                            <td rowspan="3">Assistive Devices And Technologies</td>
                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                            <td><!--male--></td>
                                </tr>

                                <tr class="text-center">
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--male--></td>
                            </tr>

                            <tr class="text-center">

                                <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                <td><!--male--></td>
                            </tr>


                            <tr class="text-center">
                            <td rowspan="3">Psychosocial</td>

                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                            <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                            <td><!--male--></td>
                            </tr>

                                    <tr class="text-center">

                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                        <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                        <td><!--male--></td>
                                    </tr>

                                <tr class="text-center">

                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--male--></td>
                                </tr>

                                <tr class="text-center">
                                    <td rowspan="3">Referral</td>

                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--male--></td>
                                </tr>

                                <tr class="text-center">
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--male--></td>
                                </tr>

                                <tr class="text-center">
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--Male--></td><td><!--Female--></td><td><!--Female--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td>
                                    <td><!--male--></td>
                                </tr>
                                            <tr class="total-row">
                                        <td colspan="1" class="total-row text-left">GRAND TOTAL</td>
                                        <td class="total-row text-center"></td><!--male--><td class="total-row text-center"><!--Female--></td><td class="total-row text-center"><!-- total--></td><td class="total-row text-center"><!--male--></td><td class="total-row text-center"><!--female--></td><td class="total-row text-center"><!--total--></td><td class="total-row text-center"><!--male--></td><td class="total-row text-center"><!--female--></td><td class="total-row text-center"><!--total--></td><td class="total-row text-center"><!--male--></td><td class="total-row text-center"><!--female--></td><td class="total-row text-center"><!--total--></td>
                                        <td class="total-row text-center"><!--male--></td><td class="total-row text-center"><!--female--></td><td class="total-row text-center"><!--total--></td><td class="total-row text-center"><!--male--></td><td class="total-row text-center"><!--female--></td><td class="total-row text-center"><!--total--></td><td class="total-row text-center"><!--male--></td><td class="total-row text-center"><!--female--></td><td class="total-row text-center"><!--total--></td><td class="total-row text-center"><!--male--></td><td class="total-row text-center"><!--male--></td><td class="total-row text-center"><!--total--></td><td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </table>
                    </div>
                </div>
            </div>


 <!-- Table 5 -->
            <div id="table5" class="tab-content">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2>Table 5. Beneficiaries served per mode of admission.</h2>
                        <table>
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2">Mode of Admission</th>
                                        <th colspan="3">Sex</th>

                                    </tr>
                                    <tr class="text-center">
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>

                                        <tbody>

                                                <tr class="text-center">
                                                    <td rowspan="1">Walk-In</td>
                                                    <td><!--male-->{{$maleWalkInCount}}</td><td><!--Female-->{{$femaleWalkInCount}}</td><td><!--TOTAL-->{{$WalkInTotal}}</td>
                                                </tr>

                                                <tr class="text-center">
                                                    <td rowspan="1">Referral</td>
                                                    <td><!--male-->{{$maleReferralCount}}</td><td><!--Female-->{{$femaleReferralCount}}</td><td><!--TOTAL-->{{$ReferralTotal}}</td>
                                                </tr>



                                            <tr class="total-row">
                                        <td colspan="1" class="total-row text-left">GRAND TOTAL</td>
                                        <td class="total-row text-center"></td><td class="total-row text-center"></td><td class="total-row text-center"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </table>
                    </div>
                </div>
            </div>

            </div>
  <!-- Table 6 -->
            <div id="table6" class="tab-content">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2>Table 6. Beneficiaries served per mode of admission.</h2>
                        <table>
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2">Served Through</th>
                                        <th colspan="4">Sex</th>
                                        <th colspan="4">Total</th>

                                    </tr>
                                    <tr class="text-center">
                                        <th>Male</th>
                                        <th>Amount</th>
                                        <th>Female</th>
                                        <th>Amount</th>
                                        <th>Count/ No.</th>
                                        <th>Total</th>

                                    </tr>
                                </thead>

                                        <tbody>

                                                <tr class="text-center">
                                                    <td rowspan="1">Onsite</td>
                                                    <td><!--male-->{{$onsiteMaleCount}}</td><td><!-- Amount -->&#8369; {{$onsiteMaleAmount }}</td><td><!--Female-->{{$onsiteFemaleCount }}</td><td><!--Amount-->&#8369; {{$onsiteFemaleAmount }}</td><td><!--Count No-->{{$onsiteTotal}}</td><td><!--TOTAL-->&#8369; {{$onsiteTotalAmount}}</td>
                                                </tr>

                                                <tr class="text-center">
                                                    <td rowspan="1">Offsite</td>
                                                    <td><!--male-->{{$offsiteMaleCount}}</td><td><!-- Amount -->&#8369; {{$offsiteMaleAmount }}</td><td><!--Female-->{{$offsiteFemaleCount }}</td><td><!--Amount-->&#8369; {{$offsiteFemaleAmount }}</td><td><!--Count No-->{{$offsiteTotal}}</td><td><!--TOTAL-->&#8369; {{$offsiteTotalAmount}}</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td rowspan="1">Malasakit</td>
                                                    <td><!--male-->{{$malasakitMaleCount}}</td><td><!-- Amount -->&#8369; {{$malasakitMaleAmount }}</td><td><!--Female-->{{$malasakitFemaleCount }}</td><td><!--Amount-->&#8369; {{$malasakitFemaleAmount }}</td><td><!--Count No-->{{$malasakitTotal}}</td><td><!--TOTAL-->&#8369; {{$malasakitTotalAmount}}</td>

                                                </tr>



                                            <tr class="total-row">
                                        <td colspan="1" class="total-row text-left">GRAND TOTAL</td>
                                        <td class="total-row text-center"></td><td class="total-row text-center"></td><td class="total-row text-center"></td><td class="total-row text-center"></td><td class="total-row text-center"></td><td class="total-row text-center"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </table>
                    </div>
                </div>
            </div>
 <!-- Table 7 -->

            <div id="table7" class="tab-content">
                <table>
                    <table class="table table-striped">
                        <thead>
                            <tr class="text-center">
                                <th rowspan="2">Service Count</th>
                                <th colspan="4">Current Fund</th>
                                <th colspan="4">Continuing</th>
                                <th colspan="4">TOTAL</th>
                            </tr>
                            <tr class="text-center">
                                <th>Male</th>
                                <th>Female</th>
                                <th>Total</th>
                                <th>Cost</th>
                                <th>Male</th>
                                <th>Female</th>
                                <th>Total</th>
                                <th>Cost</th>
                                <th>Male</th>
                                <th>Female</th>
                                <th>Total</th>
                                <th>Cost</th>
                            </tr>
                        </thead>
                        <tbody>




                            <tr class="text-center">
                                <td rowspan="3">Financial Assistance</td>

                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            </tr>
                            <tr class="text-center">

                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            </tr>
                            <tr class="text-center">

                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            </tr>

                                        <tr class="text-center">
                                            <td rowspan="3">Educational Assistance</td>

                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        </tr>
                                        <tr class="text-center">

                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        </tr>
                                        <tr class="text-center">

                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td rowspan="3">Medical Assistance</td>

                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        </tr>
                                        <tr class="text-center">

                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        </tr>
                                        <tr class="text-center">

                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td rowspan="3">Transportation Assistance</td>

                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        </tr>
                                        <tr class="text-center">

                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        </tr>
                                        <tr class="text-center">

                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td rowspan="3">Burial Assistance</td>

                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        </tr>
                                        <tr class="text-center">

                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        </tr>
                                        <tr class="text-center">

                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        </tr><tr class="text-center">
                                            <td rowspan="3">Food Assistance</td>

                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        </tr>
                                        <tr class="text-center">

                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        </tr>
                                        <tr class="text-center">

                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        </tr>
                                    </tr><tr class="text-center">
                                        <td rowspan="3">Other Cash Assistance</td>

                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">

                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">

                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td rowspan="3">Material Assistance</td>

                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">

                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">

                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                </tr><tr class="text-center">
                                    <td rowspan="3">Hot Meals</td>

                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                </tr>
                                <tr class="text-center">

                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                </tr>
                                <tr class="text-center">

                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                </tr>
                            </tr><tr class="text-center">
                                <td rowspan="3">Family Food Packs</td>

                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            </tr>
                            <tr class="text-center">

                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            </tr>
                            <tr class="text-center">

                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            </tr>
                        </tr><tr class="text-center">
                            <td rowspan="3">Hygiene And Sleeping Kits</td>

                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                        </tr>
                        <tr class="text-center">

                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                        </tr>
                        <tr class="text-center">

                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                        </tr>
                    </tr><tr class="text-center">
                        <td rowspan="3">Assistive Devices And Technologies</td>

                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                    </tr>
                    <tr class="text-center">

                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                    </tr>
                    <tr class="text-center">

                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                    </tr>
                </tr><tr class="text-center">
                    <td rowspan="3">Psychosocial</td>

                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                </tr>
                <tr class="text-center">

                    <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                </tr>
                            <tr class="text-center">

                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            </tr>
                        </tr><tr class="text-center">
                            <td rowspan="3">Referral</td>

                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                        </tr>
                        <tr class="text-center">

                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                        </tr>
                        <tr class="text-center">

                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                        </tr>
                                    <tr class="total-row">
                                <td colspan="1" class="total-row text-left">GRAND TOTAL</td>
                                <td class="total-row text-center">33</td><td class="total-row text-center">59</td><td class="total-row text-center">92</td><td class="total-row text-center">1,782,497.89</td>
                                <td class="total-row text-center">-</td><td class="total-row text-center">-</td><td class="total-row text-center">-</td><td class="total-row text-center">-</td>
                                <td class="total-row text-center">33</td><td class="total-row text-center">59</td><td class="total-row text-center">92</td><td class="total-row text-center">1,782,497.89</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>

  <!-- Table 8 -->
  <div class="table-container">
            <div id="table8" class="tab-content">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2>Table 8: Summary of Subcategory provided with cost.</h2>
                            <table class="table table-striped table responsive">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2">Client Category</th>
                                        <th rowspan="2">Client sub-category</th>
                                        <th colspan="4">Current Fund</th>
                                        <th colspan="4">Continuing</th>
                                        <th colspan="4">TOTAL</th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <th>Cost</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <th>Cost</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <th>Cost</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td rowspan="17">Family Heads and Other Needy Adult (FHONA)</td>
                                        <td>Victims of Disaster</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Internally Displaced Family</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Solo Parent</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Victims of Illegal Recruitment</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Surrendered drug users</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Repatriated OFW</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Killed in Action (KIA)</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Wounded in Action (WIA)</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>NONE OF THE ABOVE</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Indigenous People</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Individuals with Cancer</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">

                                        <td>Person of Concerns - Asylum Seeker</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">

                                        <td>Former Rebels</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Dialysis Patients</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Tuberculosis Patients</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Person of Concerns - Refugees</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Person of Concerns - Stateless Persons</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td rowspan="21">Men/Women in Specially Difficult Circumstances (WEDC)</td>
                                        <td>Sexually-abused</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Physically-abused/maltreated/battered</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Victims of Illegal Recruitment</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Victims of involuntary prostitution</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Victims of armed conflict</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Victims of trafficking</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Others specify</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Surrendered drug users</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Repatriated OFW</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Killed in Action (KIA)</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Wounded in Action (WIA)</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>NONE OF THE ABOVE</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Indigenous People</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Individuals with Cancer</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">

                                        <td>Person of Concerns - Asylum Seeker</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Former Rebels</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Dialysis Patients</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">

                                        <td>Tuberculosis Patients</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Person of Concerns - Refugees</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Person of Concerns - Stateless Persons</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">

                                        <td>Solo Parent</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>



                                    <tr class="text-center">
                                        <td rowspan="27">Children in Need of Special Protection (CNSP)</td>
                                        <td>Abandoned</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Neglected</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Voluntary Committed/Surrendered</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Sexually-Abused</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Sexually-Exploited</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Physically-abused/maltreated/battered</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Children in Situations of Armed Conflict</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Victims of Child Labor</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Victims of Child Trafficking</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Street Children</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Victims of Illegal Recruitment</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">

                                        <td>Children with HIV/AIDS</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">

                                        <td>Children with Disabilities</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Children in Conflict with the Law (CICL)</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Surrendered drug users</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Repatriated OFW</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Killed in Action (KIA)</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Wounded in Action (WIA)</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>NONE OF THE ABOVE</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Indigenous People</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Individuals with Cancer</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Person of Concerns - Asylum Seeker</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Former Rebels</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Dialysis Patients</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Tuberculosis Patients</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Person of Concerns - Refugees</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>Person of Concerns - Stateless Persons</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td rowspan="18">Youth (YNSP)</td>
                                        <td>Children in Conflict with the Law (9 to &lt; 18 yrs. old)</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>


                                    <tr class="text-center">
                                        <td>Out of School Youth</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Pre-delinquent Youth</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Victims of Illegal Recruitment</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Surrendered drug users</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Repatriated OFW</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Killed in Action (KIA)</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Wounded in Action (WIA)</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>NONE OF THE ABOVE</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Student</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Indigenous People</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Individuals with Cancer</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Person of Concerns - Asylum Seeker</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Former Rebels</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Dialysis Patients</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Tuberculosis Patients</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Person of Concerns - Refugees</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Person of Concerns - Stateless Persons</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td rowspan="9">Senior Citizens (SC)</td>
                                        <td>NONE OF THE ABOVE</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Indigenous People</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Individuals with Cancer</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Person of Concerns - Asylum Seeker</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Former Rebels</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Dialysis Patients</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Tuberculosis Patients</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Person of Concerns - Refugees</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Person of Concerns - Stateless Persons</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td rowspan="11">Persons with Disabilities (PWD)</td>
                                        <td>Orthopedically handicapped</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                            <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Hearing/Speech impaired</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Visually impaired</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Mentally challenged</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Others specify</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Victims of Illegal Recruitment</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Surrendered drug users</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Repatriated OFW</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Killed in Action (KIA)</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Wounded in Action (WIA)</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>NONE OF THE ABOVE</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>



                                    <tr class="text-center">
                                        <td rowspan="9">Persons Living with HIV-AIDS (PLHIV)</td>
                                        <td>Individuals with Cancer</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Indigenous People</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Tuberculosis Patients</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Person of Concerns - Asylum Seeker</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Former Rebels</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Dialysis Patients</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Person of Concerns - Refugees</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>Person of Concerns - Stateless Persons</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>NONE OF THE ABOVE</td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                        <td><!--male--></td><td><!--Female--></td><td><!--TOTAL--></td><td></td>
                                    </tr>

                                    <tr class="total-row">
                                        <td colspan="2" class="total-row text-left">GRAND TOTAL</td>
                                        <td class="total-row text-center">-</td><td class="total-row text-center">-</td><td class="total-row text-center">-</td><td class="total-row text-center">-</td>
                                        <td class="total-row text-center">-</td><td class="total-row text-center">-</td><td class="total-row text-center">-</td><td class="total-row text-center">-</td>
                                        <td class="total-row text-center">-</td><td class="total-row text-center">-</td><td class="total-row text-center">-</td><td class="total-row text-center">-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

    <script>
        function showTab(tabId) {
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });

            const currentTab = document.getElementById(tabId);
            currentTab.classList.add('active');

            const tabButtons = document.querySelectorAll('.tab');
            tabButtons.forEach(button => {
                button.classList.remove('active');
            });

            event.currentTarget.classList.add('active');
        }

        function getTableData(tableId) {
    const table = document.getElementById(tableId);
    const rows = table.querySelectorAll('tr');
    const data = [];

    rows.forEach(row => {
        const cols = row.querySelectorAll('td, th');
        const rowData = [];
        cols.forEach(col => rowData.push(col.innerText));
        data.push(rowData);
    });

    return data;
}

    </script>
</body>
</html>
