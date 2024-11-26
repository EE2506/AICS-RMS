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
                        <table>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Gender</th>
                                        <th>Age Group</th>
                                        <th>Count</th>
                                        <th>Total Amount</th>
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
                                                    <td>{{ $counts[$category][$gender][$ageGroup] }}</td>
                                                    <td>{{ $total }}</td>

                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endforeach

                                </tbody>
                            </table>
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
                                    <tr>
                                        <th>Type of Assistance</th>
                                        <th>Female Total</th>
                                        <th>Male Total</th>
                                        <th>Combined Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assistanceData as $type => $totals)
                                        <tr>
                                            <td>{{ $type }}</td>
                                            <td>{{ number_format($totals['FEMALE'], 2) }}</td>
                                            <td>{{ number_format($totals['MALE'], 2) }}</td>
                                            <td>{{ number_format($totals['TOTAL'], 2) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr class="total-row">
                                        <td colspan="1" class="total-row text-left">GRAND TOTAL</td>
                                        <td class="total-row text-center">{{ number_format($grandTotalFemale, 2) }}</td>
                                        <td class="total-row text-center">{{ number_format($grandTotalMale, 2) }} </td>
                                        <td class="total-row text-center">{{ number_format($grandTotalOverall, 2) }}</td>
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
                                        <tr>
                                            <th>Client Category</th>
                                            <th>Male</th>
                                            <th>Female</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($this->countGenderByCategoryTable3() as $category => $counts)
                                        @if($category !== 'grand_total') <!-- Exclude 'grand_total' from loop -->
                                        <tr>
                                            <td>{{ $category }}</td>
                                            <td>{{ $counts['male'] }}</td>
                                            <td>{{ $counts['female'] }}</td>
                                            <td>{{ $counts['total'] }}</td>
                                        </tr>
                                    @endif
                                        @endforeach
                                    </tbody>


                                  <tr class="total-row">
                                        <td colspan="1" class="total-row text-left">GRAND TOTAL</td>
                                        <td class="total-row text-center">{{ $this->countGenderByCategoryTable3()['grand_total']['male'] }}</td>
                                        <td class="total-row text-center">{{ $this->countGenderByCategoryTable3()['grand_total']['female'] }}</td>
                                        <td class="total-row text-center">{{ $this->countGenderByCategoryTable3()['grand_total']['total'] }}</td>
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
                                        <!-- age group -->
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <!-- age group -->
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <!-- age group -->
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <!-- age group -->
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <!-- age group -->
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <!-- age group -->
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <!-- age group -->
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <!-- age group -->
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total</th>
                                        <!-- age group -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>{{ $client['type_of_assistance'] }}</td>
                                            @foreach (['0-13', '14-17', '18-29', '30-44', '45-59', '60-70', '71-79', '80+'] as $group)
                                                <td>{{ $client["{$group}_male"] }}</td>
                                                <td>{{ $client["{$group}_female"] }}</td>
                                                <td>{{ $client["{$group}_total"] }}</td>
                                            @endforeach
                                            <td>{{ $client['grand_total'] }}</td>
                                        </tr>
                                    @endforeach

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
                                        <td class="total-row text-center">{{$GrandTotalMaleTable5}}</td><td class="total-row text-center">{{$GrandTotalFemaleTable5}}</td><td class="total-row text-center">{{$GrandTotalTable5}}</td>
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
                                        <td class="total-row text-center"><!--male-->{{$GrandTotalMaleTable6}}</td><td class="total-row text-center"><!--male AMOUNT-->&#8369; {{$GrandTotalMaleAmountTable6}}</td><td class="total-row text-center"><!--Female-->{{$GrandTotalFemaleTable6}}</td><td class="total-row text-center"><!--female Amount-->&#8369; {{$GrandTotalFemaleAmountTable6}}</td><td class="total-row text-center"><!--Total Gender-->{{$GrandTotalCountTable6}}</td><td class="total-row text-center"><!--Total Amount-->&#8369; {{$GrandTotalAmountTable6}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </table>
                    </div>
                </div>
            </div>
    <!-- Table 7 -->
<div id="table7" class="tab-content">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2>Table 7. Summary of Assistance provided with cost.</h2>
                <table class="table table-striped">
                        <table>
                            <thead>
                                <tr>
                                    <th>Type of Assistance</th>
                                    <th>Female Count</th>
                                    <th>Male Count</th>
                                    <th>Total Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assistanceCounterDataTable7 as $type => $counts)
                                    <tr>
                                        <td>{{ $type }}</td>
                                        <td>{{ $counts['FEMALE'] }}</td>
                                        <td>{{ $counts['MALE'] }}</td>
                                        <td>{{ $counts['TOTAL'] }}</td>
                                    </tr>
                                @endforeach



                                    <tfoot>
                                        <tr class="total-row">
                                            <th class="total-row text-center">Grand Total</th>
                                            <th class="total-row text-center">{{ $grandTotalFemaleCountTable7 }}</th>
                                            <th class="total-row text-center">{{ $grandTotalMaleCountTable7 }}</th>
                                            <th class="total-row text-center">{{ $grandTotalCountTable7 }}</th>
                                        </tr>
                                    </tfoot>
                    </tbody>
                </table>
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
                                    <tr>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Male Count</th>
                                        <th>Female Count</th>
                                        <th>Total Count</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $category => $details)
                                        @php $subcategories = $details['subcategories']; @endphp
                                        @if ($subcategories->isNotEmpty())
                                            @php $rowspan = $subcategories->count(); @endphp
                                            @foreach ($subcategories as $index => $subcategory)
                                                <tr>
                                                    @if ($index === 0)
                                                        <td rowspan="{{ $rowspan }}">{{ $category }}</td>
                                                    @endif
                                                    <td>{{ $subcategory['name'] }}</td>
                                                    <td>{{ $subcategory['male_count'] }}</td>
                                                    <td>{{ $subcategory['female_count'] }}</td>
                                                    <td>{{ $subcategory['total_count'] }}</td>
                                                    <td>{{ number_format($subcategory['total_amount'], 2) }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td rowspan="1">{{ $category }}</td>
                                                <td colspan="5">No data available for this category.</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                </table>
                        </div>
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
